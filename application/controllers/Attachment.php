<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachment extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct($config = 'rest')
	{
 		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		$this->load->database();

		$this->load->helper('url');
		// $this->load->library('grocery_CRUD');

	}

	// public function __construct()
	// {
	// 	parent::__construct();

	// 	$this->load->database();
	// 	$this->load->helper('url');

	// 	$this->load->library('grocery_CRUD');
	// }
	
	public function index()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Sub Unit";
		
		$header['title'] = "Attachment";
		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),

			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/attachment.js"),
		];
		
		$output['content'] = '';
		
		$nama_pabrik = $this->session->user;
		$kategori = $this->session->kategori;

		$query = $this->db->query("SELECT nama FROM master_pabrik;");

		$output['dropdown_pabrik']= "";
		if($kategori<2){
			$output['dropdown_pabrik']= "<select id=\"pabrik\">";
		}else{
			$output['dropdown_pabrik']= "<select id=\"pabrik\" disabled>";
		}
		
		foreach ($query->result() as $row)
		{
			if($nama_pabrik==$row->nama){
				$output['dropdown_pabrik'] = $output['dropdown_pabrik']."<option selected=\"selected\">".$row->nama."</option>";
			}else{
				$output['dropdown_pabrik'] = $output['dropdown_pabrik']."<option>".$row->nama."</option>";
			}
		}
		$output['dropdown_pabrik'] .= "/<select>";
		$output['dropdown_station'] = "<select id=\"station\"></select>";		
		$output['dropdown_unit'] = "<select id=\"unit\"></select>";		
		$output['dropdown_sub_unit'] = "<select id=\"sub_unit\"></select>";		


		$this->load->view('header',$header);
		$this->load->view('content-attachment',$output);
		$this->load->view('footer',$footer);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$unit = $_REQUEST['unit'];
		$sub_unit = $_REQUEST['sub_unit'];

		$this->db->query("DELETE FROM `master_attachment` where id_pabrik = '$pabrik' AND id_station = '$station' AND id_unit = '$unit' AND id_sub_unit = '$sub_unit'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'id_unit' => $unit,
				'id_sub_unit' => $sub_unit,
				'nomor' => $value[0],
				'attachment' => ucwords($value[1]),
				'cm' => ucwords($value[2]),
				'job_aid' => $value[3],
				'work_exec' => $value[4],
			);
			// print_r($data);
			$this->db->insert('master_attachment', $data);
		}
	}
	
	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];

		$query = $this->db->query("SELECT nomor,attachment,cm,job_aid,work_exec FROM master_attachment where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND id_unit = '$id_unit' AND id_sub_unit = '$id_sub_unit';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
			$d[$i][0] = $row->nomor; // or methods defined on the 'User' class
			$d[$i][1] = $row->attachment; // or methods defined on the 'User' class
			$d[$i][2] = $row->cm; // or methods defined on the 'User' class
			$d[$i][3] = $row->job_aid; // or methods defined on the 'User' class
			$d[$i++][4] = $row->work_exec; // or methods defined on the 'User' class
		}
		echo json_encode($d);
	}

	public function ajax()
	{
		// $id_pabrik = $_REQUEST['id_pabrik'];
		$id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_station where id_pabrik = '$id_pabrik';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['name'] = $row->nama;
				$a['id'] = $row->nama;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}

	public function ajax_dropdown(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode($this->uri->segment(4, 0));
		$id_unit = urldecode($this->uri->segment(5, 0));
		$id_sub_unit = urldecode($this->uri->segment(6, 0));

		$query = $this->db->query("SELECT nomor,attachment FROM master_attachment where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND id_unit = '$id_unit' AND id_sub_unit = '$id_sub_unit' ;");
		foreach ($query->result() as $row)
		{
			echo "<option value=\"$row->nomor\">".$row->attachment."</option>";
		}
	}

	public function dhtmlx(){
		$id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_station where id_pabrik = '$id_pabrik';");
		$i = 0;
		$d = [];
		// echo "{\"collections\":{\"type\":[";
		foreach ($query->result() as $row)
		{
			// echo '{"id":"'.$i++.'","value":"'.$row->nama.'","label":"'.$row->nama.'"},';
			// echo "<option>".$row->nama."</option>";
			$d[$i++] = $row->nama;
		}
		// echo "]}}";
		echo json_encode($d);
	}

	public function list_attachment_dropdown(){
		$id_pabrik = $this->uri->segment(3, 0);
		$job_aid = urldecode($this->uri->segment(4, 0));

		$query = $this->db->query("SELECT
		CONCAT(
			master_attachment.id_pabrik,'.',
			master_attachment.id_station,'.',
			master_attachment.id_unit,'.',
			master_attachment.id_sub_unit,'.',
			master_attachment.nomor
		) AS nomor,
		master_attachment.attachment, 
		master_station.nama as nama_station,
		master_unit.nama as nama_unit,
		master_sub_unit.nama as nama_sub_unit

		FROM master_attachment, master_station, master_unit, master_sub_unit
		WHERE master_attachment.id_pabrik = '$id_pabrik' 
		AND job_aid LIKE '%$job_aid%'
		
		AND master_station.nomor = master_attachment.id_station 
		AND	master_station.id_pabrik = master_attachment.id_pabrik 
		
		AND	master_unit.nomor = master_attachment.id_unit 
		AND	master_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_unit.id_station = master_attachment.id_station 
		
		AND	master_sub_unit.nomor = master_attachment.id_sub_unit 
		AND	master_sub_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_sub_unit.id_station = master_attachment.id_station 
		AND	master_sub_unit.id_unit = master_attachment.id_unit
		;");

		foreach ($query->result() as $row)
		{
			echo "<option value=\"$row->nomor\">".$row->nama_station." | ".$row->nama_unit." | ".$row->nama_sub_unit." | ".$row->attachment."</option>";
		}
	}

	public function list_attachment_dropdown_no_station(){
		$id_pabrik = $this->uri->segment(3, 0);
		$job_aid = urldecode($this->uri->segment(4, 0));
		$id_station = $this->uri->segment(5, 0);

		$query = $this->db->query("SELECT
		CONCAT(
			master_attachment.id_pabrik,'.',
			master_attachment.id_station,'.',
			master_attachment.id_unit,'.',
			master_attachment.id_sub_unit,'.',
			master_attachment.nomor
		) AS nomor,
		master_attachment.attachment, 
		master_station.nama as nama_station,
		master_unit.nama as nama_unit,
		master_sub_unit.nama as nama_sub_unit

		FROM master_attachment, master_station, master_unit, master_sub_unit
		WHERE master_attachment.id_pabrik = '$id_pabrik' 
		AND job_aid LIKE '%$job_aid%'
		AND master_station.nomor = '$id_station'

		AND master_station.nomor = master_attachment.id_station 
		AND	master_station.id_pabrik = master_attachment.id_pabrik 
		
		AND	master_unit.nomor = master_attachment.id_unit 
		AND	master_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_unit.id_station = master_attachment.id_station 
		
		AND	master_sub_unit.nomor = master_attachment.id_sub_unit 
		AND	master_sub_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_sub_unit.id_station = master_attachment.id_station 
		AND	master_sub_unit.id_unit = master_attachment.id_unit
		;");

		foreach ($query->result() as $row)
		{
			echo "<option value=\"$row->nomor\">".$row->nama_unit." | ".$row->nama_sub_unit." | ".$row->attachment."</option>";
		}
	}

	public function list_attachment_modal(){
		$id_pabrik = $this->uri->segment(3, 0);
		$job_aid = $this->uri->segment(4, 0);

		$query = $this->db->query("SELECT
		CONCAT(
				master_attachment.id_pabrik,'.',
				master_attachment.id_station,'.',
				master_attachment.id_unit,'.',
				master_attachment.id_sub_unit,'.',
				master_attachment.nomor
			,' - ',
			master_station.nama,' | ',
			master_unit.nama,' | ',
			master_sub_unit.nama,' | ',
			master_attachment.attachment
		) as daftar
		FROM master_attachment, master_station, master_unit, master_sub_unit
		WHERE master_attachment.id_pabrik = '$id_pabrik' 
		AND job_aid LIKE '%$job_aid%'
		
		AND master_station.nomor = master_attachment.id_station 
		AND	master_station.id_pabrik = master_attachment.id_pabrik 
		
		AND	master_unit.nomor = master_attachment.id_unit 
		AND	master_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_unit.id_station = master_attachment.id_station 
		
		AND	master_sub_unit.nomor = master_attachment.id_sub_unit 
		AND	master_sub_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_sub_unit.id_station = master_attachment.id_station 
		AND	master_sub_unit.id_unit = master_attachment.id_unit
		;");

		echo(json_encode($query->result()));
	}

	public function list_attachment_modal_no_station(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = $this->uri->segment(4, 0);
		$job_aid = $this->uri->segment(5, 0);

		$query = $this->db->query("SELECT
		CONCAT(
				master_attachment.id_pabrik,'.',
				master_attachment.id_station,'.',
				master_attachment.id_unit,'.',
				master_attachment.id_sub_unit,'.',
				master_attachment.nomor
			,' - ',
			master_station.nama,' | ',
			master_unit.nama,' | ',
			master_sub_unit.nama,' | ',
			master_attachment.attachment
		) as daftar
		FROM master_attachment, master_station, master_unit, master_sub_unit
		WHERE master_attachment.id_pabrik = '$id_pabrik' 
		AND master_attachment.id_station = '$id_station' 
		AND job_aid LIKE '%$job_aid%'
		
		AND master_station.nomor = master_attachment.id_station 
		AND	master_station.id_pabrik = master_attachment.id_pabrik 
		
		AND	master_unit.nomor = master_attachment.id_unit 
		AND	master_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_unit.id_station = master_attachment.id_station 
		
		AND	master_sub_unit.nomor = master_attachment.id_sub_unit 
		AND	master_sub_unit.id_pabrik = master_attachment.id_pabrik 
		AND	master_sub_unit.id_station = master_attachment.id_station 
		AND	master_sub_unit.id_unit = master_attachment.id_unit
		;");

		echo(json_encode($query->result()));
	}
}

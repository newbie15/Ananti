<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J4 extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		// $this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J4';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J4 - ".$row->nama;
		}

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j4.js"),
		];
		
		$output['content'] = '';

		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J4.pdf";
		
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

		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j4',$output);
		$this->load->view('footer',$footer);
	}

	public function resume(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$job_aid = "J4"; //urldecode($this->uri->segment(4, 0));
		$tahun = $_REQUEST['y'];

		$query_list = $this->db->query("SELECT
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

		$query_executed = $this->db->query("SELECT
		CONCAT(
			master_attachment.id_pabrik,'.',
			master_attachment.id_station,'.',
			master_attachment.id_unit,'.',
			master_attachment.id_sub_unit,'.',
			master_attachment.nomor
		) AS nomor_equipment,

		count(DISTINCT job_aid_j4_a1.tanggal) as a1_date,
		count(DISTINCT job_aid_j4_a3.tanggal) as a3_date

		FROM master_attachment, master_station, master_unit, master_sub_unit, job_aid_j4_a1, job_aid_j4_a3
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

		AND CONCAT(
			master_attachment.id_pabrik,'.',
			master_attachment.id_station,'.',
			master_attachment.id_unit,'.',
			master_attachment.id_sub_unit,'.',
			master_attachment.nomor
		) = job_aid_j4_a1.equipment
		AND CONCAT(
			master_attachment.id_pabrik,'.',
			master_attachment.id_station,'.',
			master_attachment.id_unit,'.',
			master_attachment.id_sub_unit,'.',
			master_attachment.nomor
		) = job_aid_j4_a3.equipment

		AND YEAR(job_aid_j4_a1.tanggal) = $tahun
		AND YEAR(job_aid_j4_a3.tanggal) = $tahun

		;");

		$i = 0;
		$d = [];

		$l = [];
		foreach ($query_list->result() as $row){
			$l[$row->nomor][0] = $row->nomor;
			$l[$row->nomor][1] = $row->nama_station."\n".$row->nama_unit."\n".$row->nama_sub_unit."\n".$row->attachment;
			$l[$row->nomor][2] = 0;
			$l[$row->nomor][3] = 0;
		}

		foreach ($query_executed->result() as $row){
			// $l[$row->nomor][0] = $row->nama_station."\n".$row->nama_unit."\n".$row->nama_sub_unit."\n".$row->attachment;
			$l[$row->nomor_equipment][2] = $row->a1_date;
			$l[$row->nomor_equipment][3] = $row->a3_date;
		}

		foreach($l as $row)
		{
			if(@$row[0]!=null){
				$d[$i][0] = $row[0];
				$d[$i][1] = $row[1];
				$d[$i][2] = $row[2];	
				$d[$i++][3] = $row[3];	
			}
		}
		
		echo json_encode($d);
	}

	public function a1()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J4 - A1 Physical Inspection";
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
			base_url("assets/job_aid/j4-a1.js"),
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

		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j4-a1',$output);
		$this->load->view('footer',$footer);		
	}

	public function a1_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j4_a1` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'inspection_test' => $value[0],
				'satuan' => $value[1],
				'status' => $value[2],
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[0]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j4_a1', $datax);
	}

	public function a1_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j4_a1
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->inspection_test;
			$d[$i][1] = $row->satuan;
			$d[$i++][2] = $row->status;
		}
		echo json_encode($d);
	}

	public function a1_list(){
		$id_pabrik = $this->uri->segment(4, 0);
		$job_aid = $this->uri->segment(4, 0);

		$query = $this->db->query("SELECT DISTINCT 
		CONCAT(
			job_aid_j4_a1.tanggal, ' - ' ,
			job_aid_j4_a1.equipment, ' - <br>' ,
			master_station.nama, ' | ' , 
			master_unit.nama, ' | ' ,
			master_sub_unit.nama
			) AS daftar
		FROM job_aid_j4_a1,master_station,master_unit,master_sub_unit
		
		WHERE
			master_station.id_pabrik = '$id_pabrik'
		AND	master_station.nomor = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',2),'.',-1)
		AND master_station.id_pabrik = SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',1)
		
		AND master_unit.nomor = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',3),'.',-1)
		AND master_unit.id_pabrik = SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',1)
		AND master_unit.id_station = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',2),'.',-1)
		
		AND master_sub_unit.nomor = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',4),'.',-1)
		AND master_sub_unit.id_pabrik = SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',1)
		AND master_sub_unit.id_station = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',2),'.',-1)
		AND master_sub_unit.id_unit = SUBSTRING_INDEX(SUBSTRING_INDEX(job_aid_j4_a1.equipment,'.',3),'.',-1)
		
		;");


		echo(json_encode($query->result()));
	}

	public function a3()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J4 - A3 Infrared Inspection";
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
			base_url("assets/job_aid/j4-a3.js"),
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

		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j4-a3',$output);
		$this->load->view('footer',$footer);		
	}

	public function a3_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j4_a3` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'inspection_test' => $value[0],
				'satuan' => $value[1],
				'status' => $value[2],
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[0]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j4_a3', $datax);
	}

	public function a3_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j4_a3
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->inspection_test;
			$d[$i][1] = $row->satuan;
			$d[$i++][2] = $row->status;
		}
		echo json_encode($d);
	}

}

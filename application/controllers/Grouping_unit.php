<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grouping_unit extends CI_Controller {

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
		$output['main_title'] = "Data Station";
		
		$header['title'] = "Grup Unit";
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
			base_url("assets/mdp/grouping_unit.js"),
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
		$output['dropdown_group_unit'] = "<select id=\"group_unit\"></select>";		
		
		$this->load->view('header',$header);
		$this->load->view('content-grouping-unit',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$grouping = $_REQUEST['grouping'];

		$query = $this->db->query("SELECT id_station,id_unit,id_sub_unit FROM master_grouping where id_pabrik = '$id_pabrik' AND nama = '$grouping';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->id_station;
			$d[$i][1] = $row->id_unit;
			$d[$i++][2] = $row->id_sub_unit;
			// $d[$i][3] = $row->kode_asset;
			// $d[$i++][1] = $row->nama;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$grouping = $_REQUEST['grouping'];

		$this->db->query("DELETE FROM `master_grouping` where id_pabrik = '$pabrik' AND nama = '$grouping' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'nama' => $grouping,
				'id_station' => $value[0],
				'id_unit' => $value[1],
				'id_sub_unit' => $value[2],
			);
			// print_r($data);
			$this->db->insert('master_grouping', $data);
		}
	}

	public function ajax_load()
	{
		$id_pabrik = $_REQUEST['pabrik'];
		$grouping = $_REQUEST['group_unit'];

		$query = $this->db->query("SELECT id_station,id_unit,id_sub_unit FROM master_grouping where id_pabrik = '$id_pabrik' AND nama = '$grouping';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->id_station;
			$d[$i][1] = $row->id_unit;
			$d[$i++][2] = $row->id_sub_unit;
			// $d[$i][3] = $row->kode_asset;
			// $d[$i++][1] = $row->nama;
		}
		echo json_encode($d);
	}

	public function ajax_table(){
		$id_pabrik = $this->uri->segment(3, 0);
		$nama_group = urldecode($this->uri->segment(4, 0));
		$query = $this->db->query("SELECT id_station,id_unit,id_sub_unit FROM master_grouping where id_pabrik = '$id_pabrik' AND nama = '$nama_group';");
		// $i = 0;
		// $d = [];
		echo "<tbody><tr>
			<th>Station</th>
			<th>Unit</th>
			<th>Sub Unit</th>
		</tr>";
		foreach ($query->result() as $row)
		{
			echo "<tr>";
			
			echo "<td>".$row->id_station."</td>";
			echo "<td>".$row->id_unit."</td>";
			echo "<td>".$row->id_sub_unit."</td>";
		
			echo "</td>";
		
		}
		echo "</tbody>";
		// echo json_encode($d);
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
}

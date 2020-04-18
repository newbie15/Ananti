<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

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
	}

	public function index()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Unit";
		
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
			base_url("assets/mdp/unit.js"),
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
		
		$this->load->view('header',$header);
		$this->load->view('content-unit',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT kode_asset,nama,critical_unit,hourmeter_mod,vibration_mod,temperature_mod,oiling_mod,electromotor_mod FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->kode_asset;
			$d[$i++][1] = $row->nama;
			// $d[$i][2] = $row->critical_unit;
			// $d[$i][3] = $row->hourmeter_mod;
			// $d[$i][4] = $row->vibration_mod;
			// $d[$i][5] = $row->temperature_mod;
			// $d[$i][6] = $row->oiling_mod;
			// $d[$i++][7] = $row->electromotor_mod;

		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];

		$this->db->query("DELETE FROM `master_unit` where id_pabrik = '$pabrik' AND id_station = '$station' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'kode_asset' => $value[0],
				'nama' => ucwords($value[1]),
				// 'critical_unit' => $value[2],
				// 'hourmeter_mod' => $value[3],
				// 'vibration_mod' => $value[4],
				// 'temperature_mod' => $value[5],
				// 'oiling_mod' => $value[6],
				// 'electromotor_mod' => $value[7],

				// 'date' => 'My date'
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[1]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		$this->db->insert_batch('m_planing', $datax);
	}

	public function ajax()
	{
		// $id_pabrik = $_REQUEST['id_pabrik'];
		$id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				$a['name'] = $row->nama;
				$a['id'] = $row->nama;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}

	public function ajax_dropdown_sub(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode( $this->uri->segment(4, 0) );
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");
		// $i = 0;
		// $d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				// $a['name'] = $row->nama;
				// $a['id'] = $row->nama;
				// $d[$i++] = $a;
				echo "<option>".$row->nama."</option>";
		}
		// echo json_encode($d);
		// echo "SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';";
	}	

	public function ajax_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	public function hm_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND hourmeter_mod=1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	public function temperature_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND temperature_mod=1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	public function vibration_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND vibration_mod=1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	public function oiling_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND oiling_mod=1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	public function electromotor_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		// $id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND electromotor_mod=1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; // access attributes
		}
		echo json_encode($d);
	}

	
	public function ajax_dropdown(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode($this->uri->segment(4, 0));
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		foreach ($query->result() as $row)
		{
			echo "<option>".$row->nama."</option>";
		}
	}

	public function ajax_dropdown_all(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode($this->uri->segment(4, 0));
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		echo "<option>-- ALL --</option>";
		foreach ($query->result() as $row)
		{
			echo "<option>".$row->nama."</option>";
		}
	}

	public function dhtmlx(){
		$id_pabrik = $this->uri->segment(3, 0);
		// $id_station = urldecode($this->uri->segment(4, 0));
		$query = $this->db->query("SELECT id_station,nama FROM master_unit where id_pabrik = '$id_pabrik'");
		$i = 0;
		$ls = "";
		$d = [];
		foreach ($query->result() as $row)
		{	
			// if($row->nama != "" || $row->id_station != ""){
				if($ls!=$row->id_station){
					$ls=$row->id_station;
					$d[$i++] = "= = = = =".$row->id_station."= = = = =";
					$d[$i++] = $row->nama;
				}else{
					$d[$i++] = $row->nama;
				}
			// }			
		}
		echo json_encode($d);
	}

	public function dhtmlxx(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode($this->uri->segment(4, 0));
		$query = $this->db->query("SELECT id_station,nama FROM master_unit where id_pabrik = '$id_pabrik'");
		$i = 0;
		$ls = "";
		$d = [];
		foreach ($query->result() as $row)
		{	
			// // if($row->nama != "" || $row->id_station != ""){
			// 	if($ls!=$row->id_station){
			// 		$ls=$row->id_station;
			// 		$d[$i++] = "= = = = =".$row->id_station."= = = = =";
			// 		$d[$i++] = $row->nama;
			// 	}else{
			// 		$d[$i++] = $row->nama;
			// 	}
			// // }
			
			// $d[$i++][];
		}
		echo json_encode($d);
	}
}

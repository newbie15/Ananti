<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J24 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J24';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J24 - ".$row->nama;
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
			base_url("assets/job_aid/j24.js"),
		];
		
		$output['content'] = '';

		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J24.pdf";		

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
		$this->load->view('job_aid/content-j24',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J24 - A0 Visual Check";
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
			base_url("assets/job_aid/j24-a0.js"),
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
		$this->load->view('job_aid/content-j24-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j24_a0` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'inspection_test' => $value[0],
				'satuan' => $value[1],
				'status' => $value[2],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j24_a0', $datax);

		$this->db->query("DELETE FROM `job_aid_j24_a0_fault` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_fault'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'code' => $value[0],
				'desc' => $value[1],
				'date' => $value[2],
				'time' => $value[3],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j24_a0_fault', $datax);

		$this->db->query("DELETE FROM `job_aid_j24_a0_setting` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_setting'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'code' => $value[0],
				'desc' => $value[1],
				'value' => $value[2],
				'remarks' => $value[3],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j24_a0_setting', $datax);
	}

	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$d = [];


		$query = $this->db->query("SELECT * FROM job_aid_j24_a0
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['pre'][$i][0] = $row->inspection_test;
			$d['pre'][$i][1] = $row->satuan;
			$d['pre'][$i++][2] = $row->status;
		}

		$query = $this->db->query("SELECT * FROM job_aid_j24_a0_fault
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['fault'][$i][0] = $row->code;
			$d['fault'][$i][1] = $row->desc;
			$d['fault'][$i][2] = $row->date;
			$d['fault'][$i++][3] = $row->time;
		}

		$query = $this->db->query("SELECT * FROM job_aid_j24_a0_setting
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['setting'][$i][0] = $row->code;
			$d['setting'][$i][1] = $row->desc;
			$d['setting'][$i][2] = $row->value;
			$d['setting'][$i++][3] = $row->remarks;
		}

		echo json_encode($d);
	}	

	public function a3()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J24 - Infrared Inspection";
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
			base_url("assets/job_aid/j24-a3.js"),
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
		$this->load->view('job_aid/content-j24-a3',$output);
		$this->load->view('footer',$footer);		
	}

	public function a3_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j24_a3` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $equipment,
				'inspection_test' => $value[0],
				'satuan' => $value[1],
				'status' => $value[2],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j24_a3', $datax);
	}

	public function a3_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$d = [];

		$query = $this->db->query("SELECT * FROM job_aid_j24_a3
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		AND equipment = '$equipment'
		;");

		$i = 0;
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->inspection_test;
			$d[$i][1] = $row->satuan;
			$d[$i++][2] = $row->status;
		}

		echo json_encode($d);
	}		

	public function a18()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J24 - ";
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
			base_url("assets/job_aid/j24-a18.js"),
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
		$this->load->view('job_aid/content-j24-a18',$output);
		$this->load->view('footer',$footer);
	}	

	public function a18_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j24_a18` where id_pabrik = '$pabrik' AND tanggal = '$tanggal'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $value[0],
				'lokasi' => $value[1],
				'daya' => $value[2],
				'panel_tag' => $value[3],
				'tipe_vsd' => $value[4],
				'poin_pengukuran' => $value[5],
				'resistance' => $value[6],
				'status' => $value[7],
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[0]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j24_a18', $datax);
	}

	public function a18_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j24_a18
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->daya;
			$d[$i][3] = $row->panel_tag;
			$d[$i][4] = $row->tipe_vsd;
			$d[$i][5] = $row->poin_pengukuran;
			$d[$i][6] = $row->resistance;
			$d[$i++][7] = $row->status;
		}
		echo json_encode($d);
	}	

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J53 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J53';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J53 - ".$row->nama;
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
			base_url("assets/job_aid/j53.js"),
		];
		
		$output['content'] = '';
		
		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J53.pdf";

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
		$this->load->view('job_aid/content-j53',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J53 - A0 Visual Inspection";

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
			base_url("assets/job_aid/j53-a0.js"),
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
		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j53-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j53_a0` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
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
		$this->db->insert_batch('job_aid_j53_a0', $datax);
	}

	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];
		// $id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j53_a0
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

	public function a3()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J53 - A3 Infrared Inspection";
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
			base_url("assets/job_aid/j53-a3.js"),
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
		$this->load->view('job_aid/content-j53-a3',$output);
		$this->load->view('footer',$footer);		
	}

	public function a3_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j53_a3` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
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
		$this->db->insert_batch('job_aid_j53_a3', $datax);
	}

	public function a3_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j53_a3
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

	public function a8()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J53 - A8 Insulation Resistance Test";

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
			base_url("assets/job_aid/j53-a8.js"),
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
		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j53-a8',$output);
		$this->load->view('footer',$footer);		
	}

	public function a8_save(){
		$pabrik = $_REQUEST['pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j53_a8` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
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
		$this->db->insert_batch('job_aid_j53_a8', $datax);
	}

	public function a8_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j53_a8
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
	
	public function a12()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J53 - A12 Winding Resistance Test";

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
			base_url("assets/job_aid/j53-a12.js"),
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
		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j53-a12',$output);
		$this->load->view('footer',$footer);		
	}	

	public function a12_save(){
		$pabrik = $_REQUEST['pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j53_a12` where id_pabrik = '$pabrik' AND tanggal = '$tanggal'");
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
		$this->db->insert_batch('job_aid_j53_a12', $datax);
	}

	public function a12_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];
		// $id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j53_a12
		WHERE id_pabrik = '$id_pabrik'
		AND equipment = '$equipment'
		AND tanggal = '$tanggal'
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

	public function a18()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J53 - A18 Winding Resistance Test";

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
			base_url("assets/job_aid/j53-a18.js"),
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
		$output['dropdown_equipment'] = "<select id=\"equipment\"></select>";

		$this->load->view('header',$header);
		$this->load->view('job_aid/content-j53-a18',$output);
		$this->load->view('footer',$footer);		
	}	

	public function a18_save(){
		$pabrik = $_REQUEST['pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j53_a18` where id_pabrik = '$pabrik' AND tanggal = '$tanggal'");
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
				'bonding' => $value[2],
				'resistansi' => $value[3],
				'status' => $value[4],
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[0]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j53_a18', $datax);
	}

	public function a18_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];
		// $id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j53_a18
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->bonding;
			$d[$i][3] = $row->resistansi;
			$d[$i++][4] = $row->status;
		}
		echo json_encode($d);
	}

}

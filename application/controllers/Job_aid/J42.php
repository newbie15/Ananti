<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J42 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J42';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J42 - ".$row->nama;
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
			base_url("assets/job_aid/j42.js"),
		];
		
		$output['content'] = '';

		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J42.pdf";		

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
		$this->load->view('job_aid/content-j42',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J42 | A0 Visual Inspection";
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
			base_url("assets/job_aid/j42-a0.js"),
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
		$this->load->view('job_aid/content-j42-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j42_a0` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $value[0],
				'tipe' => $value[1],
				'kvar' => $value[2],
				'capacitance' => $value[3],
				'a' => $value[4],
				'b' => $value[5],
				'c' => $value[6],
				'd' => $value[7],
				'status' => $value[8],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j42_a0', $datax);
	}
	
	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j42_a0
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->tipe;
			$d[$i][2] = $row->kvar;
			$d[$i][3] = $row->capacitance;
			$d[$i][4] = $row->a;
			$d[$i][5] = $row->b;
			$d[$i][6] = $row->c;
			$d[$i][7] = $row->d;
			$d[$i++][8] = $row->status;
		}
		echo json_encode($d);
	}

	public function a3()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J42 | A3 Infrared Inspection";
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
			base_url("assets/job_aid/j42-a3.js"),
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
		$this->load->view('job_aid/content-j42-a3',$output);
		$this->load->view('footer',$footer);		
	}

	public function a3_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j42_a3` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
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
				'tipe' => $value[2],
				'tag' => $value[3],
				'max_temp' => $value[4],
				'temp_r' => $value[5],
				'temp_s' => $value[6],
				'temp_t' => $value[7],
				'status' => $value[8],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j42_a3', $datax);
	}
	
	public function a3_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j42_a3
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->tipe;
			$d[$i][3] = $row->tag;
			$d[$i][4] = $row->max_temp;
			$d[$i][5] = $row->temp_r;
			$d[$i][6] = $row->temp_s;
			$d[$i][7] = $row->temp_t;
			$d[$i++][8] = $row->status;
		}
		echo json_encode($d);
	}	

	public function a8()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J42 | A8 Insulation Resistance Test";
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
			base_url("assets/job_aid/j42-a8.js"),
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
		$this->load->view('job_aid/content-j42-a8',$output);
		$this->load->view('footer',$footer);		
	}	

	public function a8_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j42_a8` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'equipment' => $value[0],
				'item' => $value[1],
				'tag' => $value[2],
				'humidity' => $value[3],
				'temperatur' => $value[4],
				'voltage' => $value[5],
				'ir' => $value[6],
				'status' => $value[7],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j42_a8', $datax);
	}
	
	public function a8_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j42_a8
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->item;
			$d[$i][2] = $row->tag;
			$d[$i][3] = $row->humidity;
			$d[$i][4] = $row->temperatur;
			$d[$i][5] = $row->voltage;
			$d[$i][6] = $row->ir;
			$d[$i++][7] = $row->status;
		}
		echo json_encode($d);
	}		
}

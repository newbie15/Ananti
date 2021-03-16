<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J52 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J52';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J52 - ".$row->nama;
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
			base_url("assets/job_aid/j52.js"),
		];
		
		$output['content'] = '';
		
		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J52.pdf";

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
		$this->load->view('job_aid/content-j52',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J52 - A0 Visual Inspection";

		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j52-a0.js"),
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
		$this->load->view('job_aid/content-j52-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j52_a0` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
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
		$this->db->insert_batch('job_aid_j52_a0', $datax);
	}

	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j52_a0
		WHERE id_pabrik = '$id_pabrik'
		AND id_station = '$id_station'
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

	public function a0_session(){
		$this->session->up_pabrik = $_REQUEST['pabrik'];
		$this->session->up_equipment = $_REQUEST['equipment'];
		$this->session->up_tahun = $_REQUEST['y'];
		$this->session->up_bulan = $_REQUEST['m'];
		$this->session->up_tanggal = $_REQUEST['d'];
	}

	public function a0_upload(){
		if (!empty($_FILES['file']['name'])) {
			
			$lokasi = $this->session->up_pabrik."/".$this->session->up_equipment."/".$this->session->up_tahun."/".$this->session->up_bulan."/".$this->session->up_tanggal;
			$path = 'assets/uploads/job_aid/j52/a0'."/".$lokasi;
			$path = str_replace(".","-",$path);

			// Set preference
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|bmp|png';
			// $config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}

	}

	public function a0_delete_image(){
		// $lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8)."/".$this->uri->segment(9);
		$lokasi = $_REQUEST['pabrik']."/".$_REQUEST['equipment']."/".$_REQUEST['y']."/".$_REQUEST['m']."/".$_REQUEST['d'];

		$path = 'assets/uploads/job_aid/j52/a0'."/".$lokasi;
		$path = str_replace(".","-",$path);
		
		unlink($path."/".$_REQUEST['f']);
	}

	public function a0_images(){
		
		$lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$path = 'assets/uploads/job_aid/j52/a0'."/".$lokasi;
		$path = str_replace(".","-",$path);

		$fileList = glob($path.'/*');
		foreach($fileList as $filename){
			if(is_file($filename)){
				// echo $filename, '<br>'; 
				$ext = explode(".",$filename);
				$ext = end($ext);

				$namafile = explode("/",$filename);
				$namafile = end($namafile);
 
				if($ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "png"){
					$img = base_url($filename);
					echo "
					<div class=\"col-md-4\">
						<div class=\"thumbnail\">
							<a href=\"$img\">
								<img src=\"$img\" alt=\"$filename\" style=\"width:100%\">
							</a>
							<div class=\"caption\">
							<p>
							$namafile
							<button class=\"btn btn-danger\" value=\"".base_url($filename)."\" style=\"float: right;\">Delete</button>
							</p>
							</div>
						
						</div>
					</div>
					";
				}
			}
		}
	}

	public function a8()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J52 - A8 Insulation Resistance Test";

		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j52-a8.js"),
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
		$this->load->view('job_aid/content-j52-a8',$output);
		$this->load->view('footer',$footer);		
	}

	public function a8_save(){
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j52_a8` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal' AND equipment = '$equipment'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
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
		$this->db->insert_batch('job_aid_j52_a8', $datax);
	}

	public function a8_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j52_a8
		WHERE id_pabrik = '$id_pabrik'
		AND id_station = '$id_station'
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

	public function a8_session(){
		$this->session->up_pabrik = $_REQUEST['pabrik'];
		$this->session->up_equipment = $_REQUEST['equipment'];
		$this->session->up_tahun = $_REQUEST['y'];
		$this->session->up_bulan = $_REQUEST['m'];
		$this->session->up_tanggal = $_REQUEST['d'];
	}

	public function a8_upload(){
		if (!empty($_FILES['file']['name'])) {
			
			$lokasi = $this->session->up_pabrik."/".$this->session->up_equipment."/".$this->session->up_tahun."/".$this->session->up_bulan."/".$this->session->up_tanggal;
			$path = 'assets/uploads/job_aid/j52/a8'."/".$lokasi;
			$path = str_replace(".","-",$path);

			// Set preference
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|bmp|png';
			// $config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}

	}

	public function a8_delete_image(){
		// $lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8)."/".$this->uri->segment(9);
		$lokasi = $_REQUEST['pabrik']."/".$_REQUEST['equipment']."/".$_REQUEST['y']."/".$_REQUEST['m']."/".$_REQUEST['d'];

		$path = 'assets/uploads/job_aid/j52/a8'."/".$lokasi;
		$path = str_replace(".","-",$path);
		
		unlink($path."/".$_REQUEST['f']);
	}

	public function a8_images(){
		
		$lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$path = 'assets/uploads/job_aid/j52/a8'."/".$lokasi;
		$path = str_replace(".","-",$path);

		$fileList = glob($path.'/*');
		foreach($fileList as $filename){
			if(is_file($filename)){
				// echo $filename, '<br>'; 
				$ext = explode(".",$filename);
				$ext = end($ext);

				$namafile = explode("/",$filename);
				$namafile = end($namafile);
 
				if($ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "png"){
					$img = base_url($filename);
					echo "
					<div class=\"col-md-4\">
						<div class=\"thumbnail\">
							<a href=\"$img\">
								<img src=\"$img\" alt=\"$filename\" style=\"width:100%\">
							</a>
							<div class=\"caption\">
							<p>
							$namafile
							<button class=\"btn btn-danger\" value=\"".base_url($filename)."\" style=\"float: right;\">Delete</button>
							</p>
							</div>
						
						</div>
					</div>
					";
				}
			}
		}
	}	
	
	public function a12()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J52 - A12 Winding Resistance Test";

		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j52-a12.js"),
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
		$this->load->view('job_aid/content-j52-a12',$output);
		$this->load->view('footer',$footer);		
	}	

	public function a12_save(){
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j52_a12` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'tanggal' => $tanggal,
				'equipment' => $value[0],
				'lokasi' => $value[1],
				'gulungan' => $value[2],
				'suhu' => $value[3],
				'kelembapan' => $value[4],
				'uv' => $value[5],
				'vw' => $value[6],
				'uw' => $value[7],
				'rata' => $value[8],
				'variasi' => $value[9],
				'status' => $value[10],
			);
			// print_r($data);
			// $this->db->insert('master_unit', $data);
			if($value[0]!=""){
				// $this->db->insert('m_planing', $data);
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j52_a12', $datax);
	}

	public function a12_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j52_a12
		WHERE id_pabrik = '$id_pabrik'
		AND id_station = '$id_station'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->gulungan;
			$d[$i][3] = $row->suhu;
			$d[$i][4] = $row->kelembapan;
			$d[$i][5] = $row->uv;
			$d[$i][6] = $row->vw;
			$d[$i][7] = $row->uv;
			$d[$i][8] = $row->rata;
			$d[$i][9] = $row->variasi;
			$d[$i++][10] = $row->status;
		}
		echo json_encode($d);
	}

	public function a12_session(){
		$this->session->up_pabrik = $_REQUEST['pabrik'];
		$this->session->up_equipment = $_REQUEST['equipment'];
		$this->session->up_tahun = $_REQUEST['y'];
		$this->session->up_bulan = $_REQUEST['m'];
		$this->session->up_tanggal = $_REQUEST['d'];
	}

	public function a12_upload(){
		if (!empty($_FILES['file']['name'])) {
			
			$lokasi = $this->session->up_pabrik."/".$this->session->up_equipment."/".$this->session->up_tahun."/".$this->session->up_bulan."/".$this->session->up_tanggal;
			$path = 'assets/uploads/job_aid/j52/a12'."/".$lokasi;
			$path = str_replace(".","-",$path);

			// Set preference
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|bmp|png';
			// $config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}

	}

	public function a12_delete_image(){
		// $lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8)."/".$this->uri->segment(9);
		$lokasi = $_REQUEST['pabrik']."/".$_REQUEST['equipment']."/".$_REQUEST['y']."/".$_REQUEST['m']."/".$_REQUEST['d'];

		$path = 'assets/uploads/job_aid/j52/a12'."/".$lokasi;
		$path = str_replace(".","-",$path);
		
		unlink($path."/".$_REQUEST['f']);
	}

	public function a12_images(){
		
		$lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$path = 'assets/uploads/job_aid/j52/a12'."/".$lokasi;
		$path = str_replace(".","-",$path);

		$fileList = glob($path.'/*');
		foreach($fileList as $filename){
			if(is_file($filename)){
				// echo $filename, '<br>'; 
				$ext = explode(".",$filename);
				$ext = end($ext);

				$namafile = explode("/",$filename);
				$namafile = end($namafile);
 
				if($ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "png"){
					$img = base_url($filename);
					echo "
					<div class=\"col-md-4\">
						<div class=\"thumbnail\">
							<a href=\"$img\">
								<img src=\"$img\" alt=\"$filename\" style=\"width:100%\">
							</a>
							<div class=\"caption\">
							<p>
							$namafile
							<button class=\"btn btn-danger\" value=\"".base_url($filename)."\" style=\"float: right;\">Delete</button>
							</p>
							</div>
						
						</div>
					</div>
					";
				}
			}
		}
	}	

	public function a18()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J52 - A18 Winding Resistance Test";

		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j52-a18.js"),
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
		$this->load->view('job_aid/content-j52-a18',$output);
		$this->load->view('footer',$footer);		
	}	

	public function a18_save(){
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j52_a18` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
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
		$this->db->insert_batch('job_aid_j52_a18', $datax);
	}

	public function a18_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query("SELECT * FROM job_aid_j52_a18
		WHERE id_pabrik = '$id_pabrik'
		AND id_station = '$id_station'
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

	public function a18_session(){
		$this->session->up_pabrik = $_REQUEST['pabrik'];
		$this->session->up_equipment = $_REQUEST['equipment'];
		$this->session->up_tahun = $_REQUEST['y'];
		$this->session->up_bulan = $_REQUEST['m'];
		$this->session->up_tanggal = $_REQUEST['d'];
	}

	public function a18_upload(){
		if (!empty($_FILES['file']['name'])) {
			
			$lokasi = $this->session->up_pabrik."/".$this->session->up_equipment."/".$this->session->up_tahun."/".$this->session->up_bulan."/".$this->session->up_tanggal;
			$path = 'assets/uploads/job_aid/j52/a18'."/".$lokasi;
			$path = str_replace(".","-",$path);

			// Set preference
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|bmp|png';
			// $config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}

	}

	public function a18_delete_image(){
		// $lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8)."/".$this->uri->segment(9);
		$lokasi = $_REQUEST['pabrik']."/".$_REQUEST['equipment']."/".$_REQUEST['y']."/".$_REQUEST['m']."/".$_REQUEST['d'];

		$path = 'assets/uploads/job_aid/j52/a18'."/".$lokasi;
		$path = str_replace(".","-",$path);
		
		unlink($path."/".$_REQUEST['f']);
	}

	public function a18_images(){
		
		$lokasi = $this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$path = 'assets/uploads/job_aid/j52/a18'."/".$lokasi;
		$path = str_replace(".","-",$path);

		$fileList = glob($path.'/*');
		foreach($fileList as $filename){
			if(is_file($filename)){
				// echo $filename, '<br>'; 
				$ext = explode(".",$filename);
				$ext = end($ext);

				$namafile = explode("/",$filename);
				$namafile = end($namafile);
 
				if($ext == "jpg" || $ext == "jpeg" || $ext == "bmp" || $ext == "png"){
					$img = base_url($filename);
					echo "
					<div class=\"col-md-4\">
						<div class=\"thumbnail\">
							<a href=\"$img\">
								<img src=\"$img\" alt=\"$filename\" style=\"width:100%\">
							</a>
							<div class=\"caption\">
							<p>
							$namafile
							<button class=\"btn btn-danger\" value=\"".base_url($filename)."\" style=\"float: right;\">Delete</button>
							</p>
							</div>
						
						</div>
					</div>
					";
				}
			}
		}
	}	

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J23 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J23';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J23 - ".$row->nama;
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
			base_url("assets/job_aid/j23.js"),
		];
		
		$output['content'] = '';

		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J23.pdf";		

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
		$this->load->view('job_aid/content-j23',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "ACM";
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
			base_url("assets/job_aid/j23-a0.js"),
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
		$this->load->view('job_aid/content-j23-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j23_a0` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
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
				'a' => $value[2],
				'b' => $value[3],
				'c' => $value[4],
				'd' => $value[5],
				'e' => $value[6],
				'f' => $value[7],
				'g' => $value[8],
				'h' => $value[9],
				'i' => $value[10],
				'j' => $value[11],
				'k' => $value[12],
				'l' => $value[13],
				'm' => $value[14],
				'n' => $value[15],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j23_a0', $datax);
	}
	
	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j23_a0
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->a;
			$d[$i][3] = $row->b;
			$d[$i][4] = $row->c;
			$d[$i][5] = $row->d;
			$d[$i][6] = $row->e;
			$d[$i][7] = $row->f;
			$d[$i][8] = $row->g;
			$d[$i][9] = $row->h;
			$d[$i][10] = $row->i;
			$d[$i][11] = $row->j;
			$d[$i][12] = $row->k;
			$d[$i][13] = $row->l;
			$d[$i][14] = $row->m;
			$d[$i++][15] = $row->n;
		}
		echo json_encode($d);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J20 extends CI_Controller {

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
		$query = $this->db->query("SELECT nama,comment FROM aux_job_aid WHERE nomor = 'J20';");
		foreach ($query->result() as $row)
		{
			$output['comment'] = $row->comment;
			$header['title'] = "J20 - ".$row->nama;
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
			base_url("assets/job_aid/j20.js"),
		];
		
		$output['content'] = '';
		
		$output['pdf'] = "yes";
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "emp";
		$output['filename'] = "J20.pdf";

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
		$this->load->view('job_aid/content-j20',$output);
		$this->load->view('footer',$footer);
	}

	public function a0()
	{

		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J20 - A0 Visual Inspection";
		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/job_aid/j20-a0.js"),
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
		$this->load->view('job_aid/content-j20-a0',$output);
		$this->load->view('footer',$footer);		
	}

	public function a0_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j20_a0` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
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
				'kw' => $value[2],
				'tag' => $value[3],
				'starter' => $value[4],
				'a' => $value[5],
				'b' => $value[6],
				'c' => $value[7],
				'd' => $value[8],
				'e' => $value[9],
				'f' => $value[10],
				'status' => $value[11],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j20_a0', $datax);
	}
	
	public function a0_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j20_a0
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->equipment;
			$d[$i][1] = $row->lokasi;
			$d[$i][2] = $row->kw;
			$d[$i][3] = $row->tag;
			$d[$i][4] = $row->starter;
			$d[$i][5] = $row->a;
			$d[$i][6] = $row->b;
			$d[$i][7] = $row->c;
			$d[$i][8] = $row->d;
			$d[$i][9] = $row->e;
			$d[$i][10] = $row->f;
			$d[$i++][11] = $row->status;
		}
		echo json_encode($d);
	}

	public function a3()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J20 - A3 Infrared Inspection";
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
			base_url("assets/job_aid/j20-a3.js"),
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
		$this->load->view('job_aid/content-j20-a3',$output);
		$this->load->view('footer',$footer);
	}	
	
	public function a3_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j20_a3` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND equipment = '$equipment'");
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
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j20_a3', $datax);
	}
	
	public function a3_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j20_a3
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


	public function a14()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['title'] = "J20 - A14 Electrical Operability Test";
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
			base_url("assets/job_aid/j20-a14.js"),
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
		$this->load->view('job_aid/content-j20-a14',$output);
		$this->load->view('footer',$footer);		
	}

	public function a14_save(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$this->db->query("DELETE FROM `job_aid_j20_a14` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
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
				'breaker' => $value[2],
				'trip_unit' => $value[3],
				'tag_panel' => $value[4],
				'as_found' => $value[5],
				'as_left' => $value[6],
				'item_a' => $value[7],
				'item_b' => $value[8],
				'item_c' => $value[9],
				'item_d' => $value[10],
				'item_e' => $value[11],
				'item_f' => $value[12],
				'item_g' => $value[13],
				'item_h' => $value[14],
				'item_i' => $value[15],
				'item_j' => $value[16],
				'item_k' => $value[17],
				'item_l' => $value[18],
				'ci_long_i_inj' => $value[19],
				'ci_long_i_set' => $value[20],
				'ci_long_i_percent' => $value[21],
				'ci_long_t_inj' => $value[22],
				'ci_long_t_set' => $value[23],
				'ci_long_t_percent' => $value[24],
				'ci_short_i_inj' => $value[25],
				'ci_short_i_set' => $value[26],
				'ci_short_i_percent' => $value[27],
				'ci_short_t_inj' => $value[28],
				'ci_short_t_set' => $value[29],
				'ci_short_t_percent' => $value[30],
				'ci_gnd_i_inj' => $value[31],
				'ci_gnd_i_set' => $value[32],
				'ci_gnd_i_percent' => $value[33],
				'ci_gnd_t_inj' => $value[34],
				'ci_gnd_t_set' => $value[35],
				'ci_gnd_t_percent' => $value[36],
				'ci_inst_i_inj' => $value[37],
				'ci_inst_i_set' => $value[38],
				'ci_inst_i_percent' => $value[39],
				'voltage_puv' => $value[40],
				'voltage_rated' => $value[41],
				'voltage_percent' => $value[42],
				'voltage_status' => $value[43],
				'ot_g' => $value[44],
				'ot_h' => $value[45],
				'ot_i' => $value[46],
				'ot_j' => $value[47],
				'ot_k' => $value[48],
				'ot_l' => $value[49],
			);
			if($value[0]!=""){
				array_push($datax,$data);
			}
		}
		print_r($datax);
		$this->db->insert_batch('job_aid_j20_a14', $datax);
	}
	
	public function a14_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		// $equipment = $_REQUEST['equipment'];

		$query = $this->db->query("SELECT * FROM job_aid_j20_a14
		WHERE id_pabrik = '$id_pabrik'
		AND tanggal = '$tanggal'
		;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][]= $row->id_pabrik;
			$d[$i][]= $row->tanggal;
			$d[$i][0]= $row->equipment;
			$d[$i][1]= $row->lokasi;
			$d[$i][2]= $row->breaker;
			$d[$i][3]= $row->trip_unit;
			$d[$i][4]= $row->tag_panel;
			$d[$i][5]= $row->as_found;
			$d[$i][6]= $row->as_left;
			$d[$i][7]= $row->item_a;
			$d[$i][8]= $row->item_b;
			$d[$i][9]= $row->item_c;
			$d[$i][10]= $row->item_d;
			$d[$i][11]= $row->item_e;
			$d[$i][12]= $row->item_f;
			$d[$i][13]= $row->item_g;
			$d[$i][14]= $row->item_h;
			$d[$i][15]= $row->item_i;
			$d[$i][16]= $row->item_j;
			$d[$i][17]= $row->item_k;
			$d[$i][18]= $row->item_l;
			$d[$i][19]= $row->ci_long_i_inj;
			$d[$i][20]= $row->ci_long_i_set;
			$d[$i][21]= $row->ci_long_i_percent;
			$d[$i][22]= $row->ci_long_t_inj;
			$d[$i][23]= $row->ci_long_t_set;
			$d[$i][24]= $row->ci_long_t_percent;
			$d[$i][25]= $row->ci_short_i_inj;
			$d[$i][26]= $row->ci_short_i_set;
			$d[$i][27]= $row->ci_short_i_percent;
			$d[$i][28]= $row->ci_short_t_inj;
			$d[$i][29]= $row->ci_short_t_set;
			$d[$i][30]= $row->ci_short_t_percent;
			$d[$i][31]= $row->ci_gnd_i_inj;
			$d[$i][32]= $row->ci_gnd_i_set;
			$d[$i][33]= $row->ci_gnd_i_percent;
			$d[$i][34]= $row->ci_gnd_t_inj;
			$d[$i][35]= $row->ci_gnd_t_set;
			$d[$i][36]= $row->ci_gnd_t_percent;
			$d[$i][37]= $row->ci_inst_i_inj;
			$d[$i][38]= $row->ci_inst_i_set;
			$d[$i][39]= $row->ci_inst_i_percent;
			$d[$i][40]= $row->voltage_puv;
			$d[$i][41]= $row->voltage_rated;
			$d[$i][42]= $row->voltage_percent;
			$d[$i][43]= $row->voltage_status;
			$d[$i][44]= $row->ot_g;
			$d[$i][45]= $row->ot_h;
			$d[$i][46]= $row->ot_i;
			$d[$i][47]= $row->ot_j;
			$d[$i][48]= $row->ot_k;
			$d[$i++][49]= $row->ot_l;
		}
		echo json_encode($d);
	}

}

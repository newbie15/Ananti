<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

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

		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Feedback Process";
		
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
			base_url("assets/mdp/feedback.js"),
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
		$this->load->view('content-feedback',$output);
		$this->load->view('footer',$footer);
	}

	public function show(){
		$output['content'] = "test";
		$output['main_title'] = "Data Feedback Process";
		
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/feedback.js"),
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

		// $output['dropdown_station'] = "<select id=\"station\"></select>";

		$this->load->view('header',$header);
		$this->load->view('content-feedback',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		
		$olah = $this->db->query("SELECT 
			`tbs_olah`,`tbs_terima`,`taksasi`,`rata_lori`,`er_cpo`,`er_kernel`,`er_pko`,`troughput_pom`,`troughtput_kcp`,`pemakaian_air`,`oil_content_kernel`,`sludge_olah`,`s_cpo`,`s_pko`,`s_kernel`,`s_pke`,`breakdown`,`usb`,`press_cake`,`tandan_kosong`,`heavy_phase`,`wet_nut`,`total_abs_loss`,`destoner`,`fiber_cyclone`,`ltds1`,`ltds2`,`hydrocyclone`,`total_kernel_loss`
			FROM o_feedback_olah where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';
		");

		$i = 0;
		$o = [];
		foreach ($olah->result() as $row)
		{
			$o[$i][0]= $row->tbs_olah;
			$o[$i][1]= $row->tbs_terima;
			$o[$i][2]= $row->taksasi;
			$o[$i][3]= $row->rata_lori;
			$o[$i][4]= $row->er_cpo;
			$o[$i][5]= $row->er_kernel;
			$o[$i][6]= $row->er_pko;
			$o[$i][7]= $row->troughput_pom;
			$o[$i][8]= $row->troughtput_kcp;
			$o[$i][9]= $row->pemakaian_air;
			$o[$i][10]= $row->oil_content_kernel;
			$o[$i][11]= $row->sludge_olah;
			$o[$i][12]= $row->s_cpo;
			$o[$i][13]= $row->s_pko;
			$o[$i][14]= $row->s_kernel;
			$o[$i][15]= $row->s_pke;
			$o[$i][16]= $row->breakdown;

			$o[$i][17]= $row->usb;
			$o[$i][18]= $row->press_cake;
			$o[$i][19]= $row->tandan_kosong;
			$o[$i][20]= $row->heavy_phase;
			$o[$i][21]= $row->wet_nut;
			$o[$i][22]= $row->total_abs_loss;
			$o[$i][23]= $row->destoner;
			$o[$i][24]= $row->fiber_cyclone;
			$o[$i][25]= $row->ltds1;
			$o[$i][26]= $row->ltds2;
			$o[$i][27]= $row->hydrocyclone;
			$o[$i++][28]= $row->total_kernel_loss;
		}


		$pks = $this->db->query("SELECT 
			`item`,`deskripsi`,`standard`,`unit_1`,`unit_2`,`unit_3`,`unit_4`,`unit_5`,`unit_6`,`unit_7`,`unit_8`,`unit_9`,`unit_10`,`rata`
			FROM o_feedback_pks where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';
		");

		$i = 0;
		$p = [];
		foreach ($pks->result() as $row)
		{
			$p[$i][0] = $row->item;
			$p[$i][1] = $row->deskripsi;
			$p[$i][2] = $row->standard;
			$p[$i][3] = $row->unit_1;
			$p[$i][4] = $row->unit_2;
			$p[$i][5] = $row->unit_3;
			$p[$i][6] = $row->unit_4;
			$p[$i][7] = $row->unit_5;
			$p[$i][8] = $row->unit_6;
			$p[$i][9] = $row->unit_7;
			$p[$i][10] = $row->unit_8;
			$p[$i][11] = $row->unit_9;
			$p[$i][12] = $row->unit_10;
			$p[$i++][13] = $row->rata;
		}

		$kcp = $this->db->query("SELECT 
			`item`,`deskripsi`,`standard`,`unit_1`,`unit_2`,`unit_3`,`unit_4`,`unit_5`,`unit_6`,`unit_7`,`unit_8`,`unit_9`,`unit_10`,`rata`
			FROM o_feedback_kcp where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';
		");

		$i = 0;
		$k = [];
		foreach ($kcp->result() as $row)
		{
			$k[$i][0] = $row->item;
			$k[$i][1] = $row->deskripsi;
			$k[$i][2] = $row->standard;
			$k[$i][3] = $row->unit_1;
			$k[$i][4] = $row->unit_2;
			$k[$i][5] = $row->unit_3;
			$k[$i][6] = $row->unit_4;
			$k[$i][7] = $row->unit_5;
			$k[$i][8] = $row->unit_6;
			$k[$i][9] = $row->unit_7;
			$k[$i][10] = $row->unit_8;
			$k[$i][11] = $row->unit_9;
			$k[$i][12] = $row->unit_10;
			$k[$i++][13] = $row->rata;
		}
		// echo json_encode($d);

		$eff = $this->db->query("SELECT 
			`item`,`standard`,`anaerobic_1`,`anaerobic_2`,`anaerobic_3`,`anaerobic_4`,`rata`
			FROM o_feedback_effluent where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';
		");

		$i = 0;
		$e = [];
		foreach ($eff->result() as $row)
		{
			$e[$i][0] = $row->item;
			$e[$i][1] = $row->standard;
			$e[$i][2] = $row->anaerobic_1;
			$e[$i][3] = $row->anaerobic_2;
			$e[$i][4] = $row->anaerobic_3;
			$e[$i][5] = $row->anaerobic_4;
			$e[$i++][6] = $row->rata;
		}
		// echo json_encode($d);

		$boiler = $this->db->query("SELECT 
			`parameter`,`softener_1`,`softener_2`,`std_feed`,`feed_1`,`std_boiler`,`boiler_1`,`boiler_2`,`boiler_3`,`boiler_4`
			FROM `o_feedback_boiler` where id_pabrik = '$id_pabrik' AND tanggal = '$tanggal';
		");

		$i = 0;
		$b = [];
		foreach ($boiler->result() as $row)
		{
			$b[$i][0] = $row->parameter;
			$b[$i][1] = $row->softener_1;
			$b[$i][2] = $row->softener_2;
			$b[$i][3] = $row->std_feed;
			$b[$i][4] = $row->feed_1;
			$b[$i][5] = $row->std_boiler;
			$b[$i][6] = $row->boiler_1;
			$b[$i][7] = $row->boiler_2;
			$b[$i++][8] = $row->boiler_3;
		}

		$data['olah'] = $o;
		$data['pks'] = $p;
		$data['kcp'] = $k;
		$data['eff'] = $e;
		$data['boiler'] = $b;

		echo json_encode($data);

	}



	public function simpan()
	{
		// print_r($_REQUEST);

		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$d_olah = $_REQUEST['data_olah'];
		$d_absloss = $_REQUEST['data_absloss'];
		$d_abskloss = $_REQUEST['data_abskloss'];
		$d_pks = $_REQUEST['data_pks'];
		$d_kcp = $_REQUEST['data_kcp'];
		$d_effluent = $_REQUEST['data_effluent'];
		$d_boiler = $_REQUEST['data_boiler'];

		$olah = json_decode($d_olah);
		$absloss = json_decode($d_absloss);
		$abskloss = json_decode($d_abskloss);
		$pks = json_decode($d_pks);
		$kcp = json_decode($d_kcp);
		$effluent = json_decode($d_effluent);
		$boiler = json_decode($d_boiler);

		// print_r($pks);
		print_r($kcp);
		// print_r($effluent);
		// print_r($boiler);

		$this->db->query("DELETE FROM `o_feedback_olah` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");

		$data = [];
		$data = array(
			'id_pabrik' => $pabrik,
			'tanggal' => $tanggal,

			'tbs_olah' => $olah[0][1],
			'tbs_terima' => $olah[1][1],
			'taksasi' => $olah[2][1],
			'rata_lori' => $olah[3][1],
			'er_cpo' => $olah[4][1],
			'er_kernel' => $olah[5][1],
			'er_pko' => $olah[6][1],
			'troughput_pom' => $olah[7][1],
			'troughtput_kcp' => $olah[8][1],
			'pemakaian_air' => $olah[9][1],
			'oil_content_kernel' => $olah[10][1],
			'sludge_olah' => $olah[11][1],
			's_cpo' => $olah[12][1],
			's_pko' => $olah[13][1],
			's_kernel' => $olah[14][1],
			's_pke' => $olah[15][1],
			'breakdown' => $olah[16][1],

			'usb' => $absloss[0][1],
			'press_cake' => $absloss[1][1],
			'tandan_kosong' => $absloss[2][1],
			'heavy_phase' => $absloss[3][1],
			'wet_nut' => $absloss[4][1],
			'total_abs_loss' => $absloss[5][1],

			'destoner' => $abskloss[0][1],
			'fiber_cyclone' => $abskloss[1][1],
			'ltds1' => $abskloss[2][1],
			'ltds2' => $abskloss[3][1],
			'hydrocyclone' => $abskloss[4][1],
			'total_kernel_loss' => $abskloss[5][1],
		);

		// print_r($data);

		$this->db->insert('o_feedback_olah', $data);

		$data = [];
		$this->db->query("DELETE FROM `o_feedback_pks` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		foreach ($pks as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,

				'item' => $value[0],
				'deskripsi' => $value[1],
				'standard' => $value[2],
				'unit_1' => $value[3],
				'unit_2' => $value[4],
				'unit_3' => $value[5],
				'unit_4' => $value[6],
				'unit_5' => $value[7],
				'unit_6' => $value[8],
				'unit_7' => $value[9],
				'unit_8' => $value[10],
				'unit_9' => $value[11],
				'unit_10' => $value[12],
				'rata' => $value[13],

			);
			$this->db->insert('o_feedback_pks', $data);
		}

		$data = [];
		$this->db->query("DELETE FROM `o_feedback_kcp` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		foreach ($kcp as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,

				'item' => $value[0],
				'deskripsi' => $value[1],
				'standard' => $value[2],
				'unit_1' => $value[3],
				'unit_2' => $value[4],
				'unit_3' => $value[5],
				'unit_4' => $value[6],
				'unit_5' => $value[7],
				'unit_6' => $value[8],
				'unit_7' => $value[9],
				'unit_8' => $value[10],
				'unit_9' => $value[11],
				'unit_10' => $value[12],
				'rata' => $value[13],
			);
			$this->db->insert('o_feedback_kcp', $data);
			echo "tes\n";
		}

		$data = [];
		$this->db->query("DELETE FROM `o_feedback_effluent` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		foreach ($effluent as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,

				'item' => $value[0],
				'standard' => $value[1],
				'anaerobic_1' => $value[2],
				'anaerobic_2' => $value[3],
				'anaerobic_3' => $value[4],
				'anaerobic_4' => $value[5],
				'rata' => $value[6],
			);
			$this->db->insert('o_feedback_effluent', $data);
		}

		$data = [];
		$this->db->query("DELETE FROM `o_feedback_boiler` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		foreach ($boiler as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,

				'parameter' => $value[0],
				'softener_1' => $value[1],
				'softener_2' => $value[2],
				'std_feed' => $value[3],
				'feed_1' => $value[4],
				'std_boiler' => $value[5],
				'boiler_1' => $value[6],
				'boiler_2' => $value[7],
				'boiler_3' => $value[8],
				'boiler_4' => $value[9],
			);
			$this->db->insert('o_feedback_boiler', $data);
		}
	}

	public function load_problem(){
		// SELECT max(tanggal) as tanggal,id_station,unit,acm FROM `m_acm` where acm = 1 GROUP by unit
		$id_pabrik = $_REQUEST['id_pabrik'];

		$query = $this->db->query("SELECT max(tanggal) as tanggal,id_station,unit,acm,keterangan FROM `m_acm` where acm = 0 AND id_pabrik = '$id_pabrik' GROUP by unit");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->tanggal; 
			$d[$i][1] = $row->id_station; 
			$d[$i][2] = $row->unit;
			$d[$i][3] = $row->acm;
			$d[$i++][4] = $row->keterangan;
		}
		echo json_encode($d);
	}

	public function problem()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Avaibility Cricital Machine";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/acm_problem.js"),
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
		$this->load->view('content-acm-problem',$output);
		$this->load->view('footer',$footer);
	}

}

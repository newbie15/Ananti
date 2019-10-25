<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends CI_Controller {

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
				// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Pabrik Astra Agro Lestari";
		
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

			base_url("assets/mdp/pabrik.js"),
		];
		
		$output['content'] = '';
		
		$this->load->view('header',$header);
		$this->load->view('content-pabrik',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$query = $this->db->query("SELECT nama,tipe FROM master_pabrik;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->nama; // access attributes
			$d[$i++][1] = $row->tipe; // or methods defined on the 'User' class
		}
		echo json_encode($d);

	}

	public function simpan()
	{
		$this->db->query("TRUNCATE TABLE `master_pabrik`");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'nama' => $value[0],
				'tipe' => $value[1],
				// 'date' => 'My date'
			);
			// print_r($data);
			$this->db->insert('master_pabrik', $data);
		}
	}

	public function proses(){
		$output = "";

        $output['taksasi_t'] = '';
        $output['start_t'] = '';
        $output['jam_t'] = '';

        $output['ffa_hi'] = '';
        $output['ffa_shi'] = '';
        $output['taksasi_y'] = '';
        $output['taksasi_vs_real'] = '';

        $output['er_cpo_hi'] = '';
        $output['er_cpo_shi'] = '';

        $output['tbs_terima_hi'] = '';
        $output['tbs_terima_shi'] = '';

        $output['tbs_olah_hi'] = '';
        $output['tbs_olah_shi'] = '';

        $output['er_kernel_hi'] = '';
        $output['er_kernel_shi'] = '';

        $output['throughput_hi'] = '';
        $output['throughput_shi'] = '';

        $output['throughput_hi'] = '';
        $output['throughput_shi'] = '';

        $output['breakdown_hi'] = '';
        $output['breakdown_shi'] = '';

        $output['er_pko_hi'] = '';
        $output['er_pko_shi'] = '';

        $output['stok_cpo'] = '';
        $output['stok_kernel'] = '';

        $output['stok_pko'] = '';
        $output['stok_pke'] = '';
		

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


		$this->load->view('display-proses',$output);
	
	}

	public function tbs_olah(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['tanggal'];

		$query = $this->db->query("SELECT tbs_olah FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$tanggal';");

		
	}

	private function _feedback_olah($pabrik,$tanggal){
		$query = $this->db->query("SELECT tbs_olah,tbs_terima,taksasi,troughput_pom,er_cpo,er_pko,er_kernel,s_cpo,s_pko,s_kernel,s_pke FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$tanggal';");

		$d = [];
		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['tbs_olah'] = $row->tbs_olah;
			$d['tbs_terima'] = $row->tbs_terima;
			$d['taksasi'] = $row->taksasi;
			$d['troughput_pom'] = $row->troughput_pom;
			$d['er_cpo'] = $row->er_cpo;
			$d['er_pko'] = $row->er_pko;
			$d['er_kernel'] = $row->er_kernel;
			$d['s_cpo'] = $row->s_cpo;
			$d['s_pko'] = $row->s_pko;
			$d['s_pke'] = $row->s_pke;
			$d['s_kernel'] = $row->s_kernel;

		}
		return $d;
	}

	private function _feedback_pks($pabrik,$tanggal){
		$query = $this->db->query("SELECT unit_1 FROM `o_feedback_pks` WHERE item = 'CPO Produksi' AND deskripsi = 'FFA' AND id_pabrik = '$pabrik' AND tanggal = '$tanggal';");

		$d = [];
		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['FFA'] = $row->unit_1;
		}
		return $d;
	}

	public function view(){
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['tanggal'];
		$kemarin = date('Y/m/d',strtotime("-1 days"));

		// $query = $this->db->query("SELECT tbs_olah,tbs_terima,taksasi,troughput_pom,er_cpo,er_pko,er_kernel FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$kemarin';");
		// echo "SELECT tbs_olah,tbs_terima,taksasi,troughput_pom,er_cpo,er_pko,er_kernel FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$tanggal';";
		$query = $this->db->query("SELECT tbs_olah,tbs_terima,taksasi,troughput_pom,er_cpo,er_pko,er_kernel,s_cpo,s_pko,s_kernel,s_pke,breakdown FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$kemarin';");

		$d = [];
		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['tbs_olah'] = $row->tbs_olah;
			$d['tbs_terima'] = $row->tbs_terima;
			$d['taksasi'] = $row->taksasi;
			$d['troughput_pom'] = $row->troughput_pom;
			$d['er_cpo'] = $row->er_cpo;
			$d['er_pko'] = $row->er_pko;
			$d['er_kernel'] = $row->er_kernel;
			$d['s_cpo'] = $row->s_cpo;
			$d['s_pko'] = $row->s_pko;
			$d['s_pke'] = $row->s_pke;
			$d['s_kernel'] = $row->s_kernel;
			$d['breakdown'] = $row->breakdown;
		}

		$feedback_olah = $d;

		@$data['tbs_olah'] = $feedback_olah['tbs_olah'];
		@$data['tbs_terima'] = $feedback_olah['tbs_terima'];
		@$data['taksasi'] = $feedback_olah['taksasi'];
		@$data['troughput_pom'] = $feedback_olah['troughput_pom'];
		@$data['er_cpo'] = $feedback_olah['er_cpo'];
		@$data['er_pko'] = $feedback_olah['er_pko'];
		@$data['er_kernel'] = $feedback_olah['er_kernel'];
		@$data['s_cpo'] = $feedback_olah['s_cpo'];
		@$data['s_pko'] = $feedback_olah['s_pko'];
		@$data['s_pke'] = $feedback_olah['s_pke'];
		@$data['s_kernel'] = $feedback_olah['s_kernel'];
		@$data['breakdown'] = $feedback_olah['breakdown'];

		$query = $this->db->query("SELECT taksasi FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$tanggal';");
		// echo "SELECT tbs_olah,tbs_terima,taksasi,troughput_pom,er_cpo,er_pko,er_kernel FROM o_feedback_olah WHERE id_pabrik = '$pabrik' AND tanggal = '$tanggal';";
		$d = [];
		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['taksasi'] = $row->taksasi;
		}
		@$data['taksasi_t'] = $d['taksasi'];

		$query = $this->db->query("SELECT unit_1 FROM `o_feedback_pks` WHERE item = 'CPO Produksi' AND deskripsi = 'FFA' AND id_pabrik = '$pabrik' AND tanggal = '$kemarin';");
		// echo "SELECT unit_1 FROM `o_feedback_pks` WHERE item = 'CPO Produksi' AND deskripsi = 'FFA' AND id_pabrik = '$pabrik' AND tanggal = '$tanggal';";
		
		$d = [];
		$i = 0;
		foreach ($query->result() as $row)
		{
			$d['FFA'] = $row->unit_1;
		}

		$feedback_pks = $d;

		@$data['ffa'] = $feedback_pks['FFA'];

		echo json_encode($data);
	}

	public function maintenance(){
		$output = "";

		$this->load->view('display-maintenance',$output);
	}


}

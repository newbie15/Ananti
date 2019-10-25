<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cost extends CI_Controller {

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

	}
	
	public function index()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Cost Olah dan Repair Maintenance";
		
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
			base_url("assets/mdp/cost.js"),
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

		$this->load->view('header',$header);
		$this->load->view('content-cost',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$nama_pabrik = $_REQUEST['id_pabrik'];
		$d = $_REQUEST['d'];
		$m = $_REQUEST['m'];
		$y = $_REQUEST['y'];

		$query = $this->db->query("SELECT pkrm,porm,pkolah,poolah FROM `m_cost` WHERE id_pabrik = '$nama_pabrik' AND tanggal = '$y-$m-$d'");
		
		$d = [];
		$i=0;
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->pkrm; 
			$d[$i][1] = $row->porm; 
			$d[$i][2] = $row->pkolah; 
			$d[$i++][3] = $row->poolah; 
		}
		echo json_encode($d);

	}

	public function simpan()
	{
		$nama_pabrik = $_REQUEST['pabrik'];
		$d = $_REQUEST['d'];
		$m = $_REQUEST['m'];
		$y = $_REQUEST['y'];
		$tanggal = $y."-".$m."-".$d;
		$this->db->query("DELETE FROM `m_cost` where id_pabrik = '$nama_pabrik' AND tanggal = '$y-$m-$d';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $nama_pabrik,
				'tanggal' => $tanggal,
				'pkrm' => $value[0],
				'porm' => $value[1],
				'pkolah' => $value[2],
				'poolah' => $value[3],
			);
			print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_cost', $data);
			}
		}
	}
}

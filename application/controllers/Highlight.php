<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Highlight extends CI_Controller {

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
		$output['main_title'] = "Highlight";
		
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
			base_url("assets/mdp/highlight.js"),
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
		$this->load->view('content-highlight',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];

		$query = $this->db->query("SELECT station,unit,problem,corrective_action,due_date,PIC,account,status,penyelesaian FROM m_highlight where id_pabrik = '$id_pabrik' AND tahun='$tahun' AND bulan='$bulan';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->station;
			$d[$i][1] = $row->unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->corrective_action;
			$d[$i][4] = $row->due_date;
			$d[$i][5] = $row->PIC;
			$d[$i][6] = $row->account;
			$d[$i][7] = $row->status;
			$d[$i++][8] = $row->penyelesaian;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];

		$this->db->query("DELETE FROM `m_highlight` where id_pabrik = '$pabrik' AND tahun='$tahun' AND bulan='$bulan';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'bulan' => $bulan,
				'station' => $value[0],
				'unit' => $value[1],
				'problem' => $value[2],
				'corrective_action' => $value[3],
				'due_date' => $value[4],
				'PIC' => $value[5],
				'account' => $value[6],
				'status' => $value[7],
				'penyelesaian' => $value[8],
				// 'date' => 'My date'
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_highlight', $data);
			}
		}
	}

}

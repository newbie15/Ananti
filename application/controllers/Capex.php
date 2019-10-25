<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capex extends CI_Controller {

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
	public function index()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "CAPEX";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = "";
		// $footer['js_files'] = [		
		// 	base_url("assets/jexcel/js/jquery.jexcel.js"),
		// 	base_url("assets/jexcel/js/jquery.jcalendar.js"),
		// 	base_url("assets/jexcel/js/numeral.min.js"),
		// 	base_url("assets/mdp/config.js"),
		// 	base_url("assets/mdp/global.js"),
		// 	base_url("assets/mdp/capex.js"),
		// ];
		
		$output['content'] = '';
		
		$nama_pabrik = $this->session->user;
		$kategori = $this->session->kategori;

		$query = $this->db->query("SELECT nama FROM master_pabrik;");

		$output['dropdown_pabrik']= "";
		if($kategori<2){
			$footer['js_files'] = [
				// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
				base_url("assets/jexcel/js/jquery.jexcel.js"),
				base_url("assets/jexcel/js/jquery.jcalendar.js"),
				base_url("assets/jexcel/js/numeral.min.js"),
				base_url("assets/mdp/config.js"),
				base_url("assets/mdp/global.js"),
				base_url("assets/mdp/capex.js"),
			];

			$output['dropdown_pabrik']= "<select id=\"pabrik\">";
		}else{
			$footer['js_files'] = [
				// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
				base_url("assets/jexcel/js/jquery.jexcel.js"),
				base_url("assets/jexcel/js/jquery.jcalendar.js"),
				base_url("assets/jexcel/js/numeral.min.js"),
				base_url("assets/mdp/config.js"),
				base_url("assets/mdp/global.js"),
				base_url("assets/mdp/capex.readonly.js"),
			];

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
		$this->load->view('content-capex',$output);
		$this->load->view('footer',$footer);

	}

	public function loadPI()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT project_id,tipe,deskripsi,qty,um,budget,pkpo,status_pi,due_date,PIC,kategori_progress,progress FROM m_capex_pi where id_pabrik = '$id_pabrik' AND tahun='$tahun';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			$d[$i][0] = $row->project_id; 
			$d[$i][1] = $row->tipe; 
			$d[$i][2] = $row->deskripsi; 
			$d[$i][3] = $row->qty; 
			$d[$i][4] = $row->um; 
			$d[$i][5] = $row->budget; 
			$d[$i][6] = $row->pkpo; 
			$d[$i][7] = $row->status_pi; 
			$d[$i][8] = $row->due_date; 
			$d[$i][9] = $row->PIC; 
			$d[$i][10] = $row->kategori_progress; 
			$d[$i++][11] = $row->progress; 
		}
		echo json_encode($d);
	}

	public function loadPRPO()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT project_id,no_pr,nominal_pr,status,no_po,nominal_po,vendor,keterangan FROM m_capex_prpo where id_pabrik = '$id_pabrik' AND tahun='$tahun';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->project_id; 
			$d[$i][1] = $row->no_pr; 
			$d[$i][2] = $row->nominal_pr; 
			$d[$i][3] = $row->status; 
			$d[$i][4] = $row->no_po; 
			$d[$i][5] = $row->nominal_po; 
			$d[$i][6] = $row->vendor; 
			$d[$i++][7] = $row->keterangan; 
		}
		echo json_encode($d);
	}


	public function simpanPI()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `m_capex_pi` where id_pabrik = '$pabrik' AND tahun='$tahun';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'project_id' => $value[0],
				'tipe' => $value[1],
				'deskripsi' => $value[2],
				'qty' => $value[3],
				'um' => $value[4],
				'budget' => $value[5],
				'pkpo' => $value[6],
				'status_pi' => $value[7],
				'due_date' => $value[8],
				'PIC' => $value[9],
				'kategori_progress' => $value[10],
				'progress' => $value[11],
				// 'date' => 'My date'
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_capex_pi', $data);
			}
		}
	}


	public function simpanPRPO()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `m_capex_prpo` where id_pabrik = '$pabrik' AND tahun='$tahun';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'project_id' => $value[0], 
				'no_pr' => $value[1], 
				'nominal_pr' => $value[2], 
				'status' => $value[3], 
				'no_po' => $value[4], 
				'nominal_po' => $value[5], 
				'vendor' => $value[6], 
				'keterangan' => $value[7] 
			);
			if($value[0]!=""){
				$this->db->insert('m_capex_prpo', $data);
			}
		}
	}

	public function ajaxPI(){
		$id_pabrik = $this->uri->segment(3, 0);
		$tahun = $this->uri->segment(4, 0);

		$query = $this->db->query("SELECT project_id FROM m_capex_pi where id_pabrik = '$id_pabrik' AND tahun='$tahun';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['name'] = $row->project_id;
				$a['id'] = $row->project_id;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mr extends CI_Controller {

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
		$output['main_title'] = "Breakdown";
		
		$header['title'] = "Material Requisition";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/mr.js"),
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
		$this->load->view('content-mr',$output);
		$this->load->view('footer',$footer);

	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['tahun'].'-'.$_REQUEST['bulan'].'-'.$_REQUEST['tanggal'];

		$query = $this->db->query(
			"SELECT *
			FROM m_mr where id_pabrik = '$id_pabrik' AND tanggal = '$tanggal';
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->part_no;
			$d[$i][1] = $row->part_desc;
			$d[$i][2] = $row->spec1;
			$d[$i][3] = $row->um;
			$d[$i][4] = $row->qty;
			$d[$i][5] = $row->total_cost;
			$d[$i][6] = $row->cost_center;
			$d[$i][7] = $row->kategori;
			$d[$i][8] = $row->no_wo;
			$d[$i][9] = $row->station;
			$d[$i][10] = $row->unit;
			$d[$i++][11] = $row->sub_unit;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['id_pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['tahun']."-".$_REQUEST['bulan']."-".$_REQUEST['tanggal'];
		$this->db->query("DELETE FROM `m_mr` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);

		$datax = array();

		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,

				'part_no' => $value[0],
				'part_desc' => $value[1],

				'spec1' => $value[2],
				'um' => $value[3],
				'qty' => $value[4],
				'total_cost' => $value[5],
				'cost_center' => $value[6],
				'kategori' => $value[7],
				'no_wo' => $value[8],

				'station' => $value[9],
				'unit' => $value[10],
				'sub_unit' => $value[11],

				
			);
			// print_r($data);
			if($value[0]!=""){
				// $this->db->insert('m_mr', $data);
				array_push($datax,$data);
			}
		}
		if(count($datax)>0){
			@$this->db->insert_batch('m_mr', $datax);
		}
	}


	public function load_default(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];

		$query = $this->db->query(
			"SELECT m_wo.station,m_wo.unit,m_wo.problem,m_activity.jenis_breakdown,m_activity.tipe,tindakan,mulai,selesai,keterangan
			FROM m_breakdown_pabrik where id_pabrik = '$id_pabrik' AND tanggal = '$tanggal';
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->station;
			$d[$i][1] = $row->unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->jenis;
			$d[$i][4] = $row->tipe;
			$d[$i][5] = $row->tindakan;
			$d[$i][6] = $row->mulai;
			$d[$i][7] = $row->selesai;
			$d[$i++][8] = $row->keterangan;
		}
		echo json_encode($d);
	}

	public function summary()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Breakdown";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/breakdown.js"),
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
		$this->load->view('content-breakdown-summary',$output);
		$this->load->view('footer',$footer);

	}

}

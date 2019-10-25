<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polarisasi extends CI_Controller {

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
	public function __construct($config = 'rest')
	{
 		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
	}
	public function index()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Indeks Polarisasi Turbin & Genset";
		
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

			base_url("assets/mdp/polarisasi.js"),
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

		$th = 2019;
		$opt_tahun = "";
		$xy = intval(date("Y"));
		while ($th <= $xy) {
			$opt_tahun .= "<option>$th</option>";
			$th++;
		}

		$output['dropdown_tahun'] = "<select id=\"tahun\">".$opt_tahun."</select>";

		$output['dropdown_periode'] = "<select id=\"periode\">
			<option value=\"1\">Januari - April (Cawu 1)</option>
			<option value=\"2\">Mei - Agustus (Cawu 2)</option>
			<option value=\"3\">September - Desember (Cawu 3)</option>
		</select>";


		$this->load->view('header',$header);
		$this->load->view('content-polarisasi',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
		SELECT `tgl`,`unit`,`fase`,`detik_0`,`detik_30`,`menit_1`,`menit_10`,`ratio_IP1`,`ratio_IP2`,`hasil_IP1`,`hasil_IP2` 
		FROM m_polarisasi 
		where id_pabrik = '$id_pabrik' AND m_polarisasi.tahun = '$tahun'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{			
			$d[$i][0] = $row->tgl;
			$d[$i][1] = $row->unit;
			$d[$i][2] = $row->fase;
			$d[$i][3] = $row->detik_0;
			$d[$i][4] = $row->detik_30;
			$d[$i][5] = $row->menit_1;
			$d[$i][6] = $row->menit_10;
			$d[$i][7] = $row->ratio_IP1;
			$d[$i][8] = $row->ratio_IP2;
			$d[$i][9] = $row->hasil_IP1;
			$d[$i++][10] = $row->hasil_IP2;	
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];
		$this->db->query("DELETE FROM `m_polarisasi` where id_pabrik = '$pabrik' AND tahun = '$tahun' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'tgl' => $value[0],
				'unit' => $value[1],
				'fase' => $value[2],
				'detik_0' => $value[3],
				'detik_30' => $value[4],
				'menit_1' => $value[5],
				'menit_10' => $value[6],
				'ratio_IP1' => $value[7],
				'ratio_IP2' => $value[8],
				'hasil_IP1' => $value[9],
				'hasil_IP2' => $value[10],
			);
			print_r($data);
			$this->db->insert('m_polarisasi', $data);
		}
	}


	
	// public function ajax()
	// {
	// 	$id_pabrik = $this->uri->segment(3, 0);
	// 	$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik';");

	// 	$i = 0;
	// 	$d = [];
	// 	foreach ($query->result() as $row)
	// 	{
	// 		$a['name'] = $row->nama;
	// 		$a['id'] = $row->nama;
	// 		$d[$i++] = $a;
	// 	}
	// 	echo json_encode($d);
	// }

	// public function ajax_default_list()
	// {
	// 	$id_pabrik = $_REQUEST['id_pabrik'];
	// 	$id_station = $_REQUEST['id_station'];
	// 	$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

	// 	$i = 0;
	// 	$d = [];
	// 	foreach ($query->result() as $row)
	// 	{
	// 		$d[$i++][0] = $row->nama; 
	// 	}
	// 	echo json_encode($d);
	// }
}

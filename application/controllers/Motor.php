<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motor extends CI_Controller {

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
		$output['main_title'] = "Data Inspeksi Mesin Berputar";
		
		$header['title'] = "Motor";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),

			base_url("assets/mdp/motor.js"),
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
		$this->load->view('content-motor',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];
		$station = $_REQUEST['id_station'];
		$periode = $_REQUEST['periode'];

		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		
		// $query = $this->db->query("
		// SELECT m_motor.unit,m_motor.sub_unit,ampere,bearing_depan,bearing_belakang,suhu_body,kondisi_fan,seal_terminal,kabel_gland 
		// FROM m_motor RIGHT JOIN master_sub_unit
		// ON master_sub_unit.id_pabrik = m_motor.id_pabrik
		// AND master_sub_unit.id_unit = m_motor.unit
		// AND master_sub_unit.nama = m_motor.unit
		// where master_sub_unit.id_pabrik = '$id_pabrik' AND m_motor.tahun = '$tahun'
		// AND m_motor.station = '$station' AND m_motor.periode = '$periode'
		// AND master_sub_unit.electromotor_mod = 1
		// ");

		$query = $this->db->query("
		SELECT m_motor.unit,m_motor.sub_unit,ampere,bearing_depan,bearing_belakang,suhu_body,kondisi_fan,seal_terminal,kabel_gland 
		FROM m_motor
		where m_motor.id_pabrik = '$id_pabrik' AND m_motor.tahun = '$tahun'
		AND m_motor.station = '$station' AND m_motor.periode = '$periode'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->unit."\n".$row->sub_unit;
			$d[$i][1] = $row->ampere;
			$d[$i][2] = $row->bearing_depan;
			$d[$i][3] = $row->bearing_belakang;
			$d[$i][4] = $row->suhu_body;
			$d[$i][5] = $row->kondisi_fan;
			$d[$i][6] = $row->seal_terminal;
			$d[$i][7] = $row->kabel_gland;

			for($j=1;$j<=4;$j++){
				if($d[$i][$j]==0){
					$d[$i][$j] = "";
				}
			}

			$i++;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tahun = $_REQUEST['tahun'];
		$periode = $_REQUEST['periode'];
		$this->db->query("DELETE FROM `m_motor` where id_pabrik = '$pabrik' AND station = '$station' AND tahun = '$tahun' AND periode = '$periode' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$x = explode("\n",$value[0]);
			$data = array(
				'tahun' => $tahun,
				'periode' => $periode ,
				'id_pabrik' => $pabrik,
				'station' => $station,
				'unit' => $x[0],
				'sub_unit' => $x[1],
				'ampere' => $value[1] ,
				'bearing_depan' => $value[2] ,
				'bearing_belakang' => $value[3] ,
				'suhu_body' => $value[4] ,
				'kondisi_fan' => $value[5] ,
				'seal_terminal' => $value[6] ,
				'kabel_gland' => $value[7]
			);
			// print_r($data);
			$this->db->insert('m_motor', $data);
		}
	}


	
	public function ajax()
	{
		$id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				$a['name'] = $row->nama;
				$a['id'] = $row->nama;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}

	public function ajax_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$query = $this->db->query("SELECT id_unit,nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND electromotor_mod = 1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			// $d[$i++][0] = $row->nama; 
			$d[$i++][0] = $row->id_unit."\n".$row->nama; 
		}
		echo json_encode($d);
	}
}

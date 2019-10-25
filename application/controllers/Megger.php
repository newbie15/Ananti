<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Megger extends CI_Controller {

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
		$output['main_title'] = "Data Inspeksi Megger Motor";
		
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

			base_url("assets/mdp/megger.js"),
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
		$this->load->view('content-megger',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];
		$station = $_REQUEST['id_station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
		SELECT m_megger.unit,`kabel_rs`,`kabel_st`,`kabel_tr`,`kabel_rn`,`kabel_sn`,`kabel_tn`,`motor_rs`,`motor_st`,`motor_tr`,`motor_re`,`motor_se`,`motor_te`
		FROM m_megger RIGHT JOIN master_unit
		ON master_unit.id_pabrik = m_megger.id_pabrik
		AND master_unit.nama = m_megger.unit
		where master_unit.id_pabrik = '$id_pabrik' AND m_megger.tahun = '$tahun' AND m_megger.station = '$station'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->unit;
			$d[$i][1] = $row->kabel_rs;
			$d[$i][2] = $row->kabel_st;
			$d[$i][3] = $row->kabel_tr;
			$d[$i][4] = $row->kabel_rn;
			$d[$i][5] = $row->kabel_sn;
			$d[$i][6] = $row->kabel_tn;
			$d[$i][7] = $row->motor_rs;
			$d[$i][8] = $row->motor_st;
			$d[$i][9] = $row->motor_tr;
			$d[$i][10] = $row->motor_re;
			$d[$i][11] = $row->motor_se;
			$d[$i++][12] = $row->motor_te;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];
		$station = $_REQUEST['station'];
		$this->db->query("DELETE FROM `m_megger` where id_pabrik = '$pabrik' AND tahun = '$tahun' AND station = '$station'");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'station' => $station,
				'unit' => $value[0],
				'kabel_rs' => $value[1],
				'kabel_st' => $value[2],
				'kabel_tr' => $value[3],
				'kabel_rn' => $value[4],
				'kabel_sn' => $value[5],
				'kabel_tn' => $value[6],
				'motor_rs' => $value[7],
				'motor_st' => $value[8],
				'motor_tr' => $value[9],
				'motor_re' => $value[10],
				'motor_se' => $value[11],
				'motor_te' => $value[12],

			);
			print_r($data);
			$this->db->insert('m_megger', $data);
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
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; 
		}
		echo json_encode($d);
	}
}

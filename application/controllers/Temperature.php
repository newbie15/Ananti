<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temperature extends CI_Controller {

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
		// $this->load->view('welcome_message');
		$output['content'] = "test";
		$output['main_title'] = "Data Temperature";
		
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
			base_url("assets/mdp/temperature.js"),
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
		$this->load->view('content-temperature',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		
		$tahun = $_REQUEST['y'];
		$bulan = $_REQUEST['m'];
		$minggu = $_REQUEST['w'];
		
		$query = $this->db->query("SELECT id_unit,gearbox,bearing FROM m_temperature where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND tahun='$tahun' AND bulan='$bulan' AND minggu='$minggu';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			$d[$i][0] = $row->id_unit; // or methods defined on the 'User' class
			$d[$i][1] = $row->gearbox; // or methods defined on the 'User' class
			$d[$i++][2] = $row->bearing; // or methods defined on the 'User' class			
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$id_pabrik = $_REQUEST['pabrik'];
		$id_station = $_REQUEST['station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		
		$tahun = $_REQUEST['y'];
		$bulan = $_REQUEST['m'];
		$minggu = $_REQUEST['w'];
		

		$this->db->query("DELETE FROM `m_temperature` where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND tahun='$tahun' AND bulan='$bulan' AND minggu='$minggu';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'tahun' => $tahun,
				'bulan' => $bulan,
				'minggu' => $minggu,
				'id_pabrik' => $id_pabrik,
				'id_station' => $id_station,
				'id_unit' => $value[0],
				'gearbox' => $value[1],
				'bearing' => $value[2],
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_temperature', $data);
			}
		}
	}

}

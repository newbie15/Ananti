<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bunchpress extends CI_Controller {

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
		$output['main_title'] = "Data Hour Meter Part Bunch Press";
		
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
			base_url("assets/mdp/bunchpress.js"),
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
		$this->load->view('content-bunchpress',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT master_unit.nama as `unit`,`scroll`,`top_semi_cage_ring`,`bottom_semi_cage_ring`,`semi_press_cone`,`adjusting_knife`
		FROM `m_recordhm_bunchpress` RIGHT JOIN master_unit
		ON m_recordhm_bunchpress.unit = master_unit.nama
		WHERE m_recordhm_bunchpress.id_pabrik = '$id_pabrik'
		AND m_recordhm_bunchpress.tanggal = '$tanggal'
		");
		
		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->unit;
			$d[$i][1] = $row->scroll;
			$d[$i][2] = $row->top_semi_cage_ring;
			$d[$i][3] = $row->bottom_semi_cage_ring;
			$d[$i][4] = $row->semi_press_cone;
			$d[$i++][5] = $row->adjusting_knife;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$this->db->query("DELETE FROM `m_recordhm_bunchpress` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'tanggal' => $tanggal,
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'unit' => $value[0],
				'hm' => $value[1],
				'scroll' => $value[2],
				'top_semi_cage_ring' => $value[3],
				'bottom_semi_cage_ring' => $value[4],
				'semi_press_cone' => $value[5],
				'adjusting_knife' => $value[6],
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_recordhm_bunchpress', $data);
			}
		}
	}

}

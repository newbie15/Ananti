<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planing extends CI_Controller {

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
		$output['content'] = "test";
		$output['main_title'] = "Planing Harian Maintenance";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/planing.js"),
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
		$this->load->view('content-planing',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$query = $this->db->query(
			"SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`plan`,`mpp`,`nama_mpp`,`mek_el`,`start`,`stop`,`tipe`,`ket`
			FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->station;
			$d[$i][2] = $row->unit;
			$d[$i][3] = $row->sub_unit;
			$d[$i][4] = $row->problem;
			$d[$i][5] = $row->plan;
			$d[$i][6] = $row->mpp;
			$d[$i][7] = $row->nama_mpp;
			$d[$i][8] = $row->mek_el;
			$d[$i][9] = $row->start;
			$d[$i][10] = $row->stop;
			$d[$i][11] = $row->tipe;
			$d[$i++][12] = $row->ket;
		}
		echo json_encode($d);
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

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$this->db->query("DELETE FROM `m_planing` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'tanggal' => $tanggal,
				'id_pabrik' => $pabrik,
				'no_wo' => $value[0],
				'station' => $value[1],
				'unit' => $value[2],
				'sub_unit' => $value[3],
				'problem' => $value[4],
				'plan' => $value[5],
				'mpp' => $value[6],
				'nama_mpp' => $value[7],
				'mek_el' => $value[8],
				'start' => $value[9],
				'stop' => $value[10],
				'tipe' => $value[11],
				'ket' => $value[12]
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_planing', $data);
			}
		}
	}	
}

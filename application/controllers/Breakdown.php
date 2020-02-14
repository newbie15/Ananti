<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breakdown extends CI_Controller {

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
		$this->load->view('content-breakdown',$output);
		$this->load->view('footer',$footer);

	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];

		$tanggal = $_REQUEST['tahun'].'-'.$_REQUEST['bulan'].'-'.$_REQUEST['tanggal'];

		$query = $this->db->query(
			"SELECT station,unit,sub_unit,problem,jenis,tipe,tindakan,mulai,selesai,keterangan
			FROM m_breakdown_pabrik where id_pabrik = '$id_pabrik' AND tanggal = '$tanggal';
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$mulai = explode(" ",$row->mulai);
			$selesai = explode(" ",$row->selesai);

			$d[$i][0] = $row->station;
			$d[$i][1] = $row->unit;
			$d[$i][2] = $row->sub_unit;
			$d[$i][3] = $row->problem;
			$d[$i][4] = $row->jenis;
			$d[$i][5] = $row->tipe;
			$d[$i][6] = $row->tindakan;
			$d[$i][7] = $mulai[0];
			$d[$i][8] = substr($mulai[1], 0, -3);
			$d[$i][9] = $selesai[0];
			$d[$i][10] = substr($selesai[1], 0, -3);
			$d[$i++][11] = $row->keterangan;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['id_pabrik'];
		// $station = $_REQUEST['station'];
		$tanggal = $_REQUEST['tahun']."-".$_REQUEST['bulan']."-".$_REQUEST['tanggal'];
		$this->db->query("DELETE FROM `m_breakdown_pabrik` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);



		foreach ($data as $key => $value) {
			$tanggal_mulai = str_replace(" 00:00:00","",$value[7]);
			$tanggal_stop = str_replace(" 00:00:00","",$value[9]);

			$jam_mulai = $value[8].":00";
			$jam_stop = $value[10].":00";


			// $this->db->insert
			$data = array(
				'tanggal' => $tanggal,
				'id_pabrik' => $pabrik,
				'station' => $value[0],
				'unit' => $value[1],
				'sub_unit' => $value[2],
				'problem' => $value[3],
				'jenis' => $value[4],
				'tipe' => $value[5],
				'tindakan' => $value[6],
				'mulai' => $tanggal_mulai." ".$jam_mulai,
				'selesai' => $tanggal_stop." ".$jam_stop,
				'keterangan' => $value[11],
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_breakdown_pabrik', $data);
			}
		}
		// echo $value[6]." ".$value[7];
		// echo "\n";
		// echo $value[8]." ".$value[9];

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
}

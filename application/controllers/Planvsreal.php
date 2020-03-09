<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planvsreal extends CI_Controller {

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
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/planvsreal.js"),
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
		$this->load->view('content-planvsreal',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m'];

		$query_plan = $this->db->query(
			"SELECT `no_wo`,sum(m_planing.mpp * m_planing.time) as waktu_plan
			FROM `m_planing` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%'
		");

		$query_real = $this->db->query(
			"SELECT `no_wo`,sum(m_activity_detail.realisasi) as waktu_real
			FROM `m_activity_detail` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%'
		");

		$query = $this->db->query(
			"SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`status`,`tanggal_closing`
			FROM `m_wo` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%'
		");

		// echo "SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`status`,`tanggal_closing`
		// 	FROM `m_wo` WHERE 
		// 	no_wo LIKE '%$id_pabrik-$tanggal%'
		// ";

		$i = 0;
		$d = [];
		$p = [];
		$r = [];

		foreach ($query_plan->result() as $plan) {
			$jam = intval($plan->waktu_plan/60);
			$menit = $plan->waktu_plan % 60;

			if($jam<10){
				$jam = "0".$jam;
			}
			if($menit<10){
				$menit = "0".$menit;
			}



			$p[$plan->no_wo] = $jam.":".$menit;
		}

		foreach ($query_real->result() as $real) {
			$jam = intval($real->waktu_real/60);
			$menit = $real->waktu_real % 60;

			if($jam<10){
				$jam = "0".$jam;
			}
			if($menit<10){
				$menit = "0".$menit;
			}


			$r[$real->no_wo] = $jam.":".$menit;
		}

		foreach ($query->result() as $row)
		{
		
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->station ."\n". $row->unit . "\n" . $row->sub_unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->status;
			if($row->tanggal_closing != "0000-00-00"){
				$d[$i][4] = $row->tanggal_closing;
			}else{
				$d[$i][4] = "";
			}
			
			if(isset($p[$row->no_wo])){
				$d[$i][5] = $p[$row->no_wo];
			}else{
				$d[$i][5] = "";
			}
			if(isset($r[$row->no_wo])){
				$d[$i][6] = $r[$row->no_wo];
			}else{
				$d[$i][6] = "";
			}
			$i++;
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
			$eq = explode("\n",$value[1]); 
			$data = array(
				'tanggal' => $tanggal,
				'id_pabrik' => $pabrik,
				'no_wo' => $value[0],
				'station' => $eq[0],
				'unit' => $eq[1],
				'sub_unit' => $eq[2],
				'problem' => $value[2],
				'plan' => $value[3],
				'mpp' => $value[4],
				'nama_mpp' => $value[5],
				'mek_el' => $value[6],
				'start' => $value[7],
				'stop' => $value[8],
				'tipe' => $value[9],
				'ket' => $value[10]
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_planing', $data);
			}
		}
	}
	
	public function get_plan(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$query = $this->db->query(
			"SELECT `no_wo`,concat(`station`,'-',`unit`,'\n',`sub_unit`,'\n',`problem`) as area
			FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i++][1] = $row->area;
		}
		echo json_encode($d);
	}

	public function download_plan_harian(){
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));
		$bulan = urldecode($this->uri->segment(5));
		$tanggal = urldecode($this->uri->segment(6));

		// $id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];

		$tanggal = $tahun."-".$bulan."-".$tanggal;


		$query = $this->db->query(
			"SELECT * FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");

		header('Content-Type: aplication/vnd-ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=PLAN_'.$id_pabrik.'_'.$tanggal.'.xls');

		echo "SITE\t";
		echo "TANGGAL\t";
		echo "NAMA KARYAWAN\t";
		echo "WO\t";
		echo "STATION\t";
		echo "UNIT\t";
		echo "SUB UNIT\t";
		echo "KATEGORI\t";
		echo "JAM START\t";
		echo "JAM STOP\t";
		echo "MAN HOUR\t";
		echo "SCOPE OF WORK";
		echo "\n";

		foreach ($query->result() as $row)
		{
			$nama = explode(";",$row->nama_mpp);
			foreach ($nama as $key => $value) {
				echo $row->id_pabrik; echo "\t";
				echo $row->tanggal; echo "\t";
				echo $value; echo "\t";
				echo $row->no_wo; echo "\t";
				echo $row->station; echo "\t";
				echo $row->unit; echo "\t";
				echo $row->sub_unit; echo "\t";
				echo $row->tipe; echo "\t";
				echo $row->start; echo "\t";
				echo $row->stop; echo "\t";
				echo $row->time; echo "\t";
				echo $row->plan; echo "\n";
			}
		}


	}
}
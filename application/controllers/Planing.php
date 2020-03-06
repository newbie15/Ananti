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
			$d[$i][1] = $row->station ."\n". $row->unit . "\n" . $row->sub_unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->plan;
			$d[$i][4] = $row->mpp;
			$d[$i][5] = $row->nama_mpp;
			$d[$i][6] = $row->mek_el;
			$d[$i][7] = $row->start;
			$d[$i][8] = $row->stop;
			$d[$i][9] = $row->tipe;
			$d[$i++][10] = $row->ket;
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

			$awal = explode(":",$value[7]);
			$akhir = explode(":",$value[8]);

			$jam_aw = intval($awal[0]);
			$jam_ak = intval($akhir[0]);

			$datetime1 = null;
			$datetime2 = null;

			if ($jam_aw > $jam_ak){ // lewat hari misal start 21:00 selesai 01:00
				$datetime1 = new DateTime('2014-02-11 '.$value[7].':00'); // awal 
				$datetime2 = new DateTime('2014-02-12 '.$value[8].':00'); // akhir
			}else{
				$datetime1 = new DateTime('2014-02-11 '.$value[7].':00'); // awal 
				$datetime2 = new DateTime('2014-02-11 '.$value[8].':00'); // akhir
			}

			$interval = $datetime1->diff($datetime2);

			$jm = $interval->format('%h');
			$mn = $interval->format('%i'); 

			// if($jm<10){
			// 	$jm = "0".$jm;
			// }
			
			// if($mn<10){
			// 	$mn = "0".$mn;
			// }

			$time = ($jm*60) + $mn;

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
				'time' => $time,
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

			$jam = intval($row->time / 60);
			$menit = $row->time % 60;

			if($jam<10){
				$jam = "0".$jam;
			}

			$time = $jam.":".$menit;

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
				echo $time; echo "\t";
				echo $row->plan; echo "\n";
			}
		}


	}
}

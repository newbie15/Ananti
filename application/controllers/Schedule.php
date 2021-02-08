<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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
		$output['main_title'] = "Data Master Schedule";
		
		$header['title'] = "PM Schedule";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/daypilot/css/scheduler_traditional.css"),

			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.css"),
			base_url("assets/fullcalendar-3.9.0/scheduler.min.css"),
		];

		$header['customcss'] = "
		.fc-sun {
			background-color: red !important;
		}
		";

		$footer['js_files'] = [
			base_url("assets/daypilot/js/daypilot-all.min.js"),

			base_url("assets/fullcalendar-3.9.0/lib/moment.min.js"),
			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.js"),
			base_url("assets/fullcalendar-3.9.0/locale/id.js"),
			base_url("assets/fullcalendar-3.9.0/scheduler.min.js"),

			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/schedule.js"),
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
		$output['dropdown_unit'] = "<select id=\"unit\"></select>";		
		$output['dropdown_sub_unit'] = "<select id=\"sub_unit\"></select>";		
		
		$this->load->view('header',$header);
		$this->load->view('content-schedule',$output);
		$this->load->view('footer',$footer);

	}

	public function monitoring_item()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Master Schedule";
		
		$header['title'] = "Schedule";
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
			base_url("assets/mdp/schedule_monitoring_item.js"),
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
		$output['dropdown_unit'] = "<select id=\"unit\"></select>";		
		$output['dropdown_sub_unit'] = "<select id=\"sub_unit\"></select>";		
		
		$this->load->view('header',$header);
		$this->load->view('content-schedule-monitoring-item',$output);
		$this->load->view('footer',$footer);

	}	

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];

		$query = $this->db->query("SELECT monitoring_item,standard,parameter,waktu,frekuensi FROM master_schedule where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND id_unit = '$id_unit' AND id_sub_unit = '$id_sub_unit';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->monitoring_item;
			$d[$i][1] = $row->standard;
			$d[$i][2] = $row->parameter;
			$d[$i][3] = $row->waktu;
			$d[$i++][4] = $row->frekuensi;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$unit = $_REQUEST['unit'];
		$sub_unit = $_REQUEST['sub_unit'];

		$this->db->query("DELETE FROM `master_schedule` where id_pabrik = '$pabrik' AND id_station = '$station' AND id_unit = '$unit' AND id_sub_unit = '$sub_unit' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'id_unit' => $unit,
				'id_sub_unit' => $sub_unit,
				'monitoring_item' => $value[0],
				'standard' => $value[1],
				'parameter' => $value[2],
				'waktu' => $value[3],
				'frekuensi' => $value[4],
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('master_schedule', $data);
			}
		}
	}

	public function ajax()
	{
		// $id_pabrik = $_REQUEST['id_pabrik'];
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

	public function get_monitoring_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];

		$sql = "SELECT
		master_schedule.id_pabrik,
		CONCAT(master_schedule.id_station,'@',master_station.nama) AS id_station,
		CONCAT(master_schedule.id_unit,'@',master_unit.nama) AS id_unit,
		CONCAT(master_schedule.id_sub_unit,'@',master_sub_unit.nama) AS id_sub_unit,
		master_schedule.monitoring_item		
		FROM master_schedule,master_station,master_unit,master_sub_unit WHERE
		master_schedule.id_pabrik = '$id_pabrik' AND
		master_schedule.id_station = '$id_station' AND
		master_station.nomor = master_schedule.id_station AND
		master_station.id_pabrik = master_schedule.id_pabrik
		";

		if($id_unit != "-- ALL --"){
			$sql = $sql ." AND master_schedule.id_unit = '$id_unit'
			AND master_unit.nomor = master_schedule.id_unit 
			AND	master_unit.id_pabrik = master_schedule.id_pabrik
			AND master_unit.id_station = master_schedule.id_station
			";
		}else{
			$sql = $sql ." AND master_unit.nomor = master_schedule.id_unit 
			AND	master_unit.id_pabrik = master_schedule.id_pabrik
			AND master_unit.id_station = master_schedule.id_station
			";
		}

		if($id_sub_unit != "-- ALL --"){
			$sql = $sql ." AND master_schedule.id_sub_unit = '$id_sub_unit'
			AND	master_sub_unit.nomor = master_schedule.id_sub_unit
			AND	master_sub_unit.id_unit = master_schedule.id_unit
			AND	master_sub_unit.id_station = master_schedule.id_station
			AND	master_sub_unit.id_pabrik = master_schedule.id_pabrik
			";
		}else{
			$sql = $sql ." AND master_sub_unit.nomor = master_schedule.id_sub_unit
			AND	master_sub_unit.id_unit = master_schedule.id_unit
			AND	master_sub_unit.id_station = master_schedule.id_station
			AND	master_sub_unit.id_pabrik = master_schedule.id_pabrik
			";
		}

		$query = $this->db->query($sql);

		$i=0;
		$d=null;
		foreach ($query->result() as $row)
		{
			$d[$i]['id'] = str_replace(" ","_",$row->id_pabrik)."-".str_replace(" ","_",$row->id_station)."-".str_replace(" ","_",$row->id_unit)."-".str_replace(" ","_",$row->id_sub_unit)."+".str_replace(" ","_",$row->monitoring_item);
			$d[$i]['monitoring'] = $row->id_unit;
			$d[$i++]['title'] = $row->id_sub_unit." - ".$row->monitoring_item;
			// $d[$i++]['stop'] = $row->tgl_stop."T00:00:00";
		}
		echo json_encode($d);
	}

	public function get_monitoring_event_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];

		$query = $this->db->query("SELECT * FROM master_schedule WHERE
		id_pabrik = '$id_pabrik' AND
		id_station = '$id_station' AND
		id_unit = '$id_unit' AND
		id_sub_unit = '$id_sub_unit'
		");

		$i=0;
		foreach ($query->result() as $row)
		{

			$d[$i]['id'] = str_replace(" ","_",$row->id_pabrik)."-".str_replace(" ","_",$row->id_station)."-".str_replace(" ","_",$row->id_unit)."-".str_replace(" ","_",$row->id_sub_unit)."+".$i;
			$d[$i]['monitoring'] = $row->id_sub_unit;
			$d[$i++]['title'] = $row->monitoring_item;
			// $d[$i++]['stop'] = $row->tgl_stop."T00:00:00";
		}
		echo json_encode($d);
	}

	public function item_schedule_monitoring(){
		$id_pabrik = $this->uri->segment(3, 0);
		$tahun = $this->uri->segment(4, 0);

		// $tanggal = date("Y-m-");

		$sql = "SELECT
		master_schedule_monitoring.id_pabrik,
		CONCAT(master_schedule_monitoring.id_station,'@',master_station.nama) AS id_station,
		CONCAT(master_schedule_monitoring.id_unit,'@',master_unit.nama) AS id_unit,
		CONCAT(master_schedule_monitoring.id_sub_unit,'@',master_sub_unit.nama) AS id_sub_unit,
		master_schedule_monitoring.item,				
		master_schedule_monitoring.start,				
		master_schedule_monitoring.stop				
		
		FROM `master_schedule_monitoring`,master_station,master_unit,master_sub_unit 
		WHERE  `master_schedule_monitoring`.`id_pabrik` = '$id_pabrik'
		AND  `master_schedule_monitoring`.`tahun` = $tahun
		AND
		master_station.nomor = master_schedule_monitoring.id_station AND
		master_station.id_pabrik = master_schedule_monitoring.id_pabrik AND
		
		master_unit.nomor = master_schedule_monitoring.id_unit AND
		master_unit.id_pabrik = master_schedule_monitoring.id_pabrik AND
		master_unit.id_station = master_schedule_monitoring.id_station AND
		
		master_sub_unit.nomor = master_schedule_monitoring.id_sub_unit AND
		master_sub_unit.id_pabrik = master_schedule_monitoring.id_pabrik AND
		master_sub_unit.id_station = master_schedule_monitoring.id_station AND
		master_sub_unit.id_unit = master_schedule_monitoring.id_unit
		";

		$query = $this->db->query($sql);

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i]['resourceId'] = $row->id_pabrik."-".str_replace(' ','_',$row->id_station)."-".str_replace(' ','_',$row->id_unit)."-".str_replace(' ','_',$row->id_sub_unit)."+".str_replace(' ','_',$row->item);
			// $d[$i]['title'] = $row->no_wo." / ".$row->station." | ".$row->unit." | ".$row->sub_unit."\n".$row->plan;
			$d[$i]['title'] = $row->id_sub_unit." - ".$row->item;

			// if($row->start!=""){
				$d[$i]['start'] = $row->start;//."T00:00".":00+07:00";
			// }else{
			// 	$d[$i]['start'] = $row->start."";
			// }
			// if($row->stop!=""){
				$d[$i++]['stop'] = $row->stop;//."T23:59".":00+07:00";
			// }else{
			// 	$d[$i++]['end'] = $row->tanggal."";
			// }
			// $d[$i++][10] = $row->ket;
		}
		echo json_encode($d);
	}

	public function monitoring_schedule()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT * FROM m_schedule WHERE
		id_pabrik = '$id_pabrik' AND
		id_station = '$id_station' AND
		id_unit = '$id_unit' AND
		id_sub_unit = '$id_sub_unit' AND
		tahun = $tahun
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i]['id'] = $row->id_pabrik."_".$row->id_station."_".$row->id_unit."_".$row->id_sub_unit;
			$d[$i]['title'] = $row->item;
			$d[$i]['start'] = $row->tgl_mulai."T00:00:00";
			$d[$i++]['stop'] = $row->tgl_stop."T00:00:00";
		}
		echo json_encode($d);

	}

	public function delete_monitoring_schedule()
	{
		$pabrik = $_REQUEST['id_pabrik'];
		$station = current(explode('@',$_REQUEST['id_station']));
		$unit = current(explode('@',$_REQUEST['id_unit']));
		$sub_unit = current(explode('@',$_REQUEST['id_sub_unit']));
		$title = $_REQUEST['title'];
		$start = $_REQUEST['start'];
		$stop = $_REQUEST['start'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `master_schedule_monitoring`
		where `id_pabrik` = '$pabrik'
		AND `id_station` = '$station'
		AND `id_unit` = '$unit'
		AND `id_sub_unit` = '$sub_unit'
		AND `item` = '$title'
		AND `start` = '$start'
		AND `stop` = '$stop'
		AND `tahun` = $tahun
		");

		$this->db->query("DELETE FROM `m_wo`
		where `id_pabrik` = '$pabrik'
		AND `station` = '$station'
		AND `unit` = '$unit'
		AND `sub_unit` = '$sub_unit'
		AND `problem` = '$title'
		AND `tanggal` = '$start'
		");

		$this->db->query("DELETE FROM `m_planing`
		where `id_pabrik` = '$pabrik'
		AND `station` = '$station'
		AND `unit` = '$unit'
		AND `sub_unit` = '$sub_unit'
		AND `problem` = '$title'
		AND `tanggal` = '$start'
		");


		echo "ok";
	}

	public function add_monitoring_schedule()
	{
		$pabrik = $_REQUEST['id_pabrik'];
		$station = current(explode('@',$_REQUEST['id_station']));
		$unit = current(explode('@',$_REQUEST['id_unit']));
		$sub_unit = current(explode('@',$_REQUEST['id_sub_unit']));
		$title = $_REQUEST['title'];
		$start = $_REQUEST['start'];
		$stop = $_REQUEST['start'];
		$tahun = $_REQUEST['tahun'];

		// $this->db->query("DELETE FROM `master_schedule` where id_pabrik = '$pabrik' AND id_station = '$station' AND id_unit = '$unit' ");
		// $data_json = $_REQUEST['data_json'];
		// $data = json_decode($data_json);
		// foreach ($data as $key => $value) {
		// 	// $this->db->insert

		$data = array(
			'id_pabrik' => $pabrik,
			'id_station' => $station,
			'id_unit' => $unit,
			'id_sub_unit' => $sub_unit,
			'item' => $title,
			'start' => $start,
			'stop' => $stop,
			'tahun' => $tahun,
			// 'frekuensi' => $value[4],
		);

		$this->db->insert('master_schedule_monitoring', $data);

		$tanggal = $_REQUEST['start'];		
		$query = $this->db->query("SELECT no_wo FROM m_wo where id_pabrik = '$pabrik' AND tanggal='$tanggal' ORDER BY no_wo desc LIMIT 0,1;");

		$no_wo = 0;
		foreach ($query->result() as $row)
		{
			$no_wo = $row->no_wo;
		}

		$s = explode("-",$no_wo);

		// echo $no_wo;
		// echo "\n";

		if (count($s) < 3){
			$no_wo = "01";
			// echo "no wo = 0";
			// echo "\n";
			// echo $no_wo;
			// echo "\n";
		} else {
			// echo "no wo != 0";
			// echo "\n";
			// $s = explode("-",$no_wo);
			// print_r($s);
			$i = (int) $s[4] + 1;
			if($i < 10){
				$no_wo = "0".$i;
			}else{
				$no_wo = $i;
			}
		}
		// echo "=====\n";
		// echo $no_wo;
		// echo "\n";

		$wo = array(
			'id_pabrik' => $pabrik,
			'tanggal' => $start,
			'no_wo' => $pabrik.'-'.$start.'-'.$no_wo,
			'station' => $station,
			'unit' => $unit,
			'sub_unit' => $sub_unit,
			'problem' => $title,
			'desc_masalah' => '',
			'hm' => '',
			'kategori' => 'maintenance',
			'tipe' => '', // M atau E
			'jenis' => 'preventive', // preventive atau predictive
			'status' => 'open',
			'tanggal_closing' => '0000-00-00',
			// 'date' => 'My date'
		);
		$this->db->insert('m_wo', $wo);

		$plan = array(
			'tanggal' => $start,
			'id_pabrik' => $pabrik,
			'no_wo' => $pabrik.'-'.$start.'-'.$no_wo,
			'station' => $station,
			'unit' => $unit,
			'sub_unit' => $sub_unit,
			'problem' => $title,
			'plan' => $title,
			'mpp' => '',
			'nama_mpp' => '',
			'mek_el' => '',
			'start' => '',
			'stop' => '',
			'time' => '',
			'istirahat' => '',
			'tipe' => '',
			'ket' => ''
		);
		$this->db->insert('m_planing', $plan);

		echo "ok";
	}

}

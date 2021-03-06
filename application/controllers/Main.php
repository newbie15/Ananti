<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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

		// $this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function index()
	{
		$header['title'] = "Dashboard";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/adminlte/bower_components/Flot/jquery.flot.js"),
			base_url("assets/adminlte/bower_components/Flot/jquery.flot.pie.js"),

			base_url("assets/fullcalendar-3.9.0/lib/moment.min.js"),
			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.js"),
			base_url("assets/fullcalendar-3.9.0/locale-all.js"),

			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),

			base_url("assets/mdp/main.js"),
			base_url("assets/mdp/main-fullcalendar.js"),

		];

		$output['content'] = '';
		
		$nama_pabrik = $this->session->user;
		$kategori = $this->session->kategori;

		$query = $this->db->query("SELECT nama FROM master_pabrik;");

		$output['dropdown_pabrik']= "";
		if($kategori<2){
			$output['dropdown_pabrik']= "<select id=\"pabrik\">";
			$output['dropdown_pabrik'] .= "<option>" . "ALL SITE" . "</option>";

			$output['dropdown_tahun'] = "<select id=\"tahun\">
			<option>2017</option>
            <option>2018</option>
			<option>2019</option>
			</select>";
			$output['dropdown_bulan'] = "<select id=\"bulan\">
			<option value=\"00\">YTD</option>
			<option value=\"01\">januari</option>
            <option value=\"02\">februari</option>
            <option value=\"03\">maret</option>
            <option value=\"04\">april</option>
            <option value=\"05\">mei</option>
            <option value=\"06\">juni</option>
            <option value=\"07\">juli</option>
            <option value=\"08\">agustus</option>
            <option value=\"09\">september</option>
            <option value=\"10\">oktober</option>
            <option value=\"11\">november</option>
            <option value=\"12\">desember</option>
			</select>";
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


		// $this->load->helper('url');
		// $output = "";
		$this->load->view('header',$header);
		$this->load->view('content-main',$output);
		$this->load->view('footer',$footer);
	}

	public function statistik()
	{
		$nama_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['tanggal']; //"2018-11-22";
		$tgl = date("Y-m-d");
		$m = date("m");
		$y = date("Y");
		// $t = explode("-",$tanggal);

		//nilai data jam breakdown
		$query = $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,mulai,selesai)) as jumlah FROM `m_breakdown_pabrik` WHERE `jenis` = 'total' and id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m-%'");
		$row = $query->row();
		$menit_breakdown = $row->jumlah;

		//nilai data jumlah wo belum close atau selesai
		$query = $this->db->query("SELECT count(no_wo) as jumlah FROM `m_wo` WHERE `status` = 'open' and id_pabrik = '$nama_pabrik'");
		$row = $query->row();
		$jumlah_no_wo = $row->jumlah;

		//nilai data jumlah wo bulan ini
		$query = $this->db->query("SELECT count(no_wo) as jumlah FROM `m_wo` WHERE `status` = 'open' and id_pabrik = '$nama_pabrik' and tanggal LIKE '%$y-$m-%' ");
		$row = $query->row();
		$jumlah_wo_baru = $row->jumlah;

		//nilai data jumlah unit yang bermasalah
		$query = $this->db->query("SELECT DISTINCT sub_unit FROM `m_wo` WHERE `status` = 'open' and id_pabrik = '$nama_pabrik'");
		$row = $query->num_rows();
		$jumlah_unit_trouble = $row;

		//nilai data mill avaibility
		$query = $this->db->query("SELECT ROUND(sum(acm)/count(acm)*100,2) as jumlah FROM `m_acm` where tanggal = '$tgl' and id_pabrik = '$nama_pabrik';");
		$row = $query->row();
		$mill_avaibility = $row->jumlah;

		// data array list plan pekerjaan maintenance hari ini
		$query = $this->db->query("SELECT station,unit,problem,mpp FROM m_planing WHERE tanggal = '$tanggal' and id_pabrik = '$nama_pabrik';");
		$i = 0;
		$job_list = [];
		foreach ($query->result() as $row)
		{
			$job_list[$i][0] = $row->station;
			$job_list[$i][1] = $row->unit;
			$job_list[$i][2] = $row->problem;
			$job_list[$i++][3] = $row->mpp;
		}

		// SELECT id_pabrik, station, COUNT(station) as jumlah FROM `m_wo` GROUP by station
		$bulan = date('m');
		$i = 0;
		$station_list = [];
		// $query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `tanggal`  LIKE '%-".$bulan."-%' and id_pabrik = '$nama_pabrik' GROUP by station");
		$query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `status`  = 'open' and id_pabrik = '$nama_pabrik' GROUP by station");
		foreach ($query->result() as $row)
		{
			$station_list[$i][0] = $row->station;
			$station_list[$i++][1] = $row->jumlah;
		}

		$bulan = date('m');
		$i = 0;
		$high_maintenance_list = [];
		// $query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `tanggal`  LIKE '%-".$bulan."-%' and id_pabrik = '$nama_pabrik' GROUP by station");
		$query = $this->db->query("SELECT unit, COUNT(unit) as jumlah FROM `m_wo` WHERE `status`  = 'open' and id_pabrik = '$nama_pabrik' GROUP by unit order by jumlah desc limit 0,3");
		foreach ($query->result() as $row)
		{
			$high_maintenance_list[$i][0] = $row->unit;
			$high_maintenance_list[$i++][1] = $row->jumlah;
		}


		// $query = $this->db->query("SELECT jenis_breakdown,count(id) as jumlah FROM `m_activity` where tanggal LIKE '%$t[1]%' and id_pabrik = '$nama_pabrik' group by jenis_breakdown");

		$out['breakdown'] = round($menit_breakdown/60,2);
		$out['wo_unfinished'] = $jumlah_no_wo;
		$out['unit_problem'] = $jumlah_unit_trouble;
		$out['wo_baru'] = $jumlah_wo_baru;
		$out['mill_avaibility'] = $mill_avaibility;
		$out['job_today'] = $job_list;
		$out['station_list'] = $station_list; 
		$out['high_maintenance_unit'] = $high_maintenance_list;

		// print_r($out);
		// echo $m;
		echo json_encode($out);
	}

	public function downtime(){
		$nama_pabrik = $this->uri->segment(3);
		$bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		$bulanx = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$y = date('Y');
		$m = $bulan[date('m')-1];
		$mx = $bulanx[date('m')-1];


		// "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))) total from m_breakdown_pabrik";

		$query = $this->db->query("SELECT (SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai))))/3600.0 as total FROM m_breakdown_pabrik WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' AND (jenis='unit' OR jenis='line') ");
		$row = $query->row();

		$query1 = $this->db->query("SELECT tanggal,(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai))))/3600.0 as total FROM m_breakdown_pabrik WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' AND (jenis='unit' OR jenis='line') GROUP BY tanggal  ORDER BY tanggal desc limit 1");
		$row1 = $query1->row();
		// print_r($row);

		if($row && $row1){
			$hi = round(floatval($row1->total),2);
			$t = $row1->tanggal;
			$shi = round(floatval($row->total),2);
			$t = explode("-",$t);

			echo "TGL : ".$t[2]."-$m-$y<br>HI : ".$hi."<br>SHI : ".$shi;
		}else{
			echo "data bulan ".$mx." belum diisi";
		}		
	}
	public function breakdown(){
		$nama_pabrik = $this->uri->segment(3);
		$bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		$bulanx = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$y = date('Y');
		$m = $bulan[date('m')-1];
		$mx = $bulanx[date('m')-1];


		// "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))) total from m_breakdown_pabrik";

		$query = $this->db->query("SELECT (SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai))))/3600.0 as total FROM m_breakdown_pabrik WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' AND jenis='pabrik' ");
		$row = $query->row();

		$query1 = $this->db->query("SELECT tanggal,(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai))))/3600.0 as total FROM m_breakdown_pabrik WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' AND jenis='pabrik' GROUP BY tanggal ORDER BY tanggal desc limit 1");
		$row1 = $query1->row();
		// print_r($row);

		if($row && $row1){
			$hi = round(floatval($row1->total),2);
			$t = $row1->tanggal;
			$shi = round(floatval($row->total),2);
			$t = explode("-",$t);

			echo "TGL : ".$t[2]."-$m-$y<br>HI : ".$hi."<br>SHI : ".$shi;
		}else{
			echo "data bulan ".$mx." belum diisi / belum ada breakdown";
		}		
	}

	public function bd_chart(){
		$nama_pabrik = $_REQUEST['id_pabrik'];

		$bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		// $bulanx = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$y = date('Y');
		$m = $bulan[date('m')-1];
		// $mx = $bulanx[date('m')-1];


		$query = $this->db->query("SELECT jenis,(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))) total FROM m_breakdown_pabrik WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' GROUP BY jenis");
		// $row = $query->row();
		
		$unit = 0;
		$line = 0;
		$pabrik = 0;

		foreach ($query->result() as $row)
		{
			if($row->jenis == 'unit'){
				$unit = $row->total;
			}else if($row->jenis == 'line'){
				$line = $row->total;
			}else if($row->jenis == 'pabrik'){
				$pabrik = $row->total;
			}
		}
		$data['unit'] = $unit;
		$data['line'] = $line;
		$data['pabrik'] = $pabrik;


		// $data = '{'.'{ "label": "Unit",  data: '.$unit.' },'.'{ "label": "Line",  data: '.$line.' },'.'{ "label": "Pabrik",  data: '.$pabrik.'}}';
		echo json_encode($data);
	}

	public function ol(){
		echo "tes";
	}
	public function cporm(){
		$nama_pabrik = $this->uri->segment(3);
		$bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		$bulanx = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$y = date('Y');
		$m = $bulan[date('m')-1];
		$mx = $bulanx[date('m')-1];

		$query = $this->db->query("SELECT AVG(porm) as rata FROM `m_cost` WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' ");
		$row = $query->row();

		$query1 = $this->db->query("SELECT tanggal,porm FROM `m_cost` WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' ORDER BY tanggal desc limit 1");
		$row1 = $query1->row();
		// print_r($row);

		if($row && $row1){
			$hi = $row1->porm;
			$t = $row1->tanggal;
			$shi = $row->rata;
			$t = explode("-",$t);

			echo "TGL : ".$t[2]."-$m-$y<br>HI :".$hi."<br>SHI : ".$shi;
		}else{
			echo "data bulan ".$mx." belum diisi";
		}
	}
	
	public function cpkrm(){
		$nama_pabrik = $this->uri->segment(3);
		$bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		$bulanx = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];


		$y = date('Y');
		$m = $bulan[date('m')-1];
		$mx = $bulanx[date('m')-1];

		$query = $this->db->query("SELECT AVG(pkrm) as rata FROM `m_cost` WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' ");
		$row = $query->row();

		$query1 = $this->db->query("SELECT tanggal,pkrm FROM `m_cost` WHERE id_pabrik = '$nama_pabrik' AND tanggal LIKE '%$y-$m%' ORDER BY tanggal desc limit 1");
		$row1 = $query1->row();
		// print_r($row);

		if($row && $row1){
			$hi = $row1->pkrm;
			$t = $row1->tanggal;
			$shi = $row->rata;
			// $stok = $row->nilai_stok;
			$t = explode("-",$t);

			echo "TGL : ".$t[2]."-$m-$y<br>HI :".$hi."<br>SHI : ".$shi;
		}else{
			echo "data bulan ".$mx." belum diisi";
		}
	}
	public function sg(){
		// echo $this->uri->segment(3);
		$nama_pabrik = $this->uri->segment(3);
		$bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$y = date('Y');
		$m = $bulan[date('m')-1];

		$query = $this->db->query("SELECT * FROM `m_inventory` WHERE id_pabrik = '$nama_pabrik' AND tahun = '$y' AND bulan = '$m'");
		$row = $query->row();
		// print_r($row);

		if($row){
			$min = $row->norma_min;
			$max = $row->norma_max;
			$stok = $row->nilai_stok;

			echo "Min :".$min."<br>Max : ".$max."<br>Stok : ".$stok;
		}else{
			echo "data bulan ".$m." belum diisi";
		}
	}

	public function wo_unfinished(){

	}

	public function wo_statistik_all(){
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];

		if($bulan=="00"){
			$sql = "
			Select a.id_pabrik,a.total_wo,b.open_wo,c.close_wo,d.unknow_wo from
			(SELECT id_pabrik,COUNT(no_wo) as total_wo FROM `m_wo` WHERE YEAR(tanggal)=$tahun group by id_pabrik) as a
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as open_wo FROM `m_wo` WHERE m_wo.status = 'open' AND YEAR(tanggal)=$tahun group by id_pabrik) as b
			on a.id_pabrik = b.id_pabrik
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as close_wo FROM `m_wo` WHERE m_wo.status = 'close' AND YEAR(tanggal)=$tahun group by id_pabrik) as c
			on a.id_pabrik = c.id_pabrik
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as unknow_wo FROM `m_wo` WHERE m_wo.status != 'close' AND m_wo.status != 'open' AND YEAR(tanggal)=$tahun group by id_pabrik) as d
			on a.id_pabrik = d.id_pabrik;
			";
		}else{
			$sql = "
			Select a.id_pabrik,a.total_wo,b.open_wo,c.close_wo,d.unknow_wo from
			(SELECT id_pabrik,COUNT(no_wo) as total_wo FROM `m_wo` WHERE YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as a
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as open_wo FROM `m_wo` WHERE m_wo.status = 'open' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as b
			on a.id_pabrik = b.id_pabrik
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as close_wo FROM `m_wo` WHERE m_wo.status = 'close' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as c
			on a.id_pabrik = c.id_pabrik
			LEFT JOIN
			(SELECT id_pabrik,COUNT(no_wo) as unknow_wo FROM `m_wo` WHERE m_wo.status != 'close' AND m_wo.status != 'open' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as d
			on a.id_pabrik = d.id_pabrik;
			";
		}

		$query = $this->db->query($sql);
		
		$i = 0;
		$d = [];
		foreach ($query->result() as $row) {
			$d[$i][0] = $row->id_pabrik;
			$d[$i][1] = $row->total_wo;
			$d[$i][2] = $row->open_wo;
			$d[$i][3] = $row->close_wo;
			$d[$i++][4] = $row->unknow_wo;
		}
		echo json_encode($d);
	}


	public function bd_statistik_all()
	{
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];

		$jenis = $_REQUEST['jenis'];
		if ($bulan == "00") {
		$sql = "
		SELECT a.id_pabrik,a.total,b.pp,c.pnp,d.mp,e.mnp from 
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as total FROM `m_breakdown_pabrik` where jenis='$jenis' AND YEAR(tanggal)=$tahun group by id_pabrik) as a
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as pp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Operation Pogen' AND YEAR(tanggal)=$tahun group by id_pabrik) as b
		on a.id_pabrik = b.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as pnp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Operation Non Pogen' AND YEAR(tanggal)=$tahun group by id_pabrik) as c
		on a.id_pabrik = c.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as mp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Maintenance Pogen' AND YEAR(tanggal)=$tahun group by id_pabrik) as d
		on a.id_pabrik = d.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as mnp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Maintenance Non Pogen' AND YEAR(tanggal)=$tahun group by id_pabrik) as e
		on a.id_pabrik = e.id_pabrik";
		}else{
			$sql = "
		SELECT a.id_pabrik,a.total,b.pp,c.pnp,d.mp,e.mnp from 
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as total FROM `m_breakdown_pabrik` where jenis='$jenis' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as a
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as pp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Operation Pogen' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as b
		on a.id_pabrik = b.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as pnp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Operation Non Pogen' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as c
		on a.id_pabrik = c.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as mp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Maintenance Pogen' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as d
		on a.id_pabrik = d.id_pabrik
		LEFT JOIN
		(SELECT id_pabrik,ROUND(SUM(TIME_TO_SEC(TIMEDIFF(selesai,mulai)))/3600.0,2) as mnp FROM `m_breakdown_pabrik` where jenis='$jenis' AND tipe = 'Maintenance Non Pogen' AND YEAR(tanggal)=$tahun AND MONTH(tanggal)=$bulan group by id_pabrik) as e
		on a.id_pabrik = e.id_pabrik";

		}
		$query = $this->db->query($sql);

		$i = 0;
		$d = [];
		foreach ($query->result() as $row) {
			$d[$i][0] = $row->id_pabrik;
			$d[$i][1] = $row->total;
			$d[$i][2] = $row->pp;
			$d[$i][3] = $row->pnp;
			$d[$i][4] = $row->mp;
			$d[$i++][5] = $row->mnp;
		}
		echo json_encode($d);
	}

	public function wo_planing(){
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];

		$sql = "
		SELECT id_pabrik,COUNT(no_wo) total_wo, DAY(tanggal) AS d  FROM `m_planing`
		WHERE YEAR(tanggal)=$tahun 
		AND MONTH(tanggal)=$bulan
		group by id_pabrik,d
		order by id_pabrik asc
		";

		$query = $this->db->query($sql);

		$i = -1;
		$d = [];
		$lastpabrik = "";
		$total = 0;
		foreach ($query->result() as $row) {
			if($lastpabrik!=$row->id_pabrik){
				$i++;
				$total = 0;
			}
			$total += $row->total_wo; 
			$d[$i][0] = $row->id_pabrik;
			$d[$i][1] = $total;
			$d[$i][($row->d)+1] = $row->total_wo;
			$lastpabrik = $row->id_pabrik;
		}
		echo json_encode($d);
	}
}

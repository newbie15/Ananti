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
		
		$header['title'] = "Plan VS Real";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),

			// base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			// base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),

			// base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			// base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			// base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
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

		$tgl = $_REQUEST['d'];
		if($tgl != "--ALL--"){
			$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		}


		$query_plan = $this->db->query(
			"SELECT `no_wo`,sum(m_planing.mpp * m_planing.time) as waktu_plan
			FROM `m_planing` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%' GROUP BY no_wo
		");

		$query_real = $this->db->query(
			"SELECT `no_wo`,sum(m_activity_detail.realisasi) as waktu_real
			FROM `m_activity_detail` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%' GROUP BY no_wo
		");

		$query = $this->db->query(
			"SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`status`,`tanggal_closing`,`kategori`
			FROM `m_wo` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%'
			ORDER BY no_wo ASC
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
			$d[$i][4] = $row->kategori;

			if($row->tanggal_closing != "0000-00-00"){
				$d[$i][5] = $row->tanggal_closing;
			}else{
				$d[$i][5] = "";
			}
			
			if(isset($p[$row->no_wo])){
				$d[$i][6] = $p[$row->no_wo];
			}else{
				$d[$i][6] = "";
			}
			if(isset($r[$row->no_wo])){
				$d[$i][7] = $r[$row->no_wo];
			}else{
				$d[$i][7] = "";
			}
			$i++;
		}
		echo json_encode($d);
	}

	public function download(){
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));
		$bulan = urldecode($this->uri->segment(5));
		$tgl = urldecode($this->uri->segment(6));

		$tanggal = $tahun."-".$bulan;

		if($tgl != "--ALL--"){
			$tanggal = $tahun."-".$bulan."-".$tgl;
		}

		$query_plan = $this->db->query(
			"SELECT `no_wo`,sum(m_planing.mpp * m_planing.time) as waktu_plan
			FROM `m_planing` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%' GROUP BY no_wo
		");

		$query_real = $this->db->query(
			"SELECT `no_wo`,sum(m_activity_detail.realisasi) as waktu_real
			FROM `m_activity_detail` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%' GROUP BY no_wo
		");

		$query = $this->db->query(
			"SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`status`,`tanggal_closing`,`kategori`
			FROM `m_wo` WHERE 
			no_wo LIKE '%$id_pabrik-$tanggal%'
			ORDER BY no_wo ASC
		");

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

		header('Content-Type: aplication/vnd-ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=PLANVSREAL_'.$id_pabrik.'_'.$tanggal.'.xls');

		echo "NO WO\t";
		echo "STATION\t";
		echo "UNIT\t";
		echo "SUB UNIT\t";
		echo "PROBLEM\t";
		echo "STATUS\t";
		echo "KATEGORI\t";
		echo "TANGGAL CLOSING\t";
		echo "PLAN\t";
		echo "REAL";
		echo "\n";


		foreach ($query->result() as $row)
		{		
			// $d[$i][0] = $row->no_wo;
			// $d[$i][1] = $row->station ."\n". $row->unit . "\n" . $row->sub_unit;
			// $d[$i][2] = $row->problem;
			// $d[$i][3] = $row->status;
			// $d[$i][4] = $row->kategori;
			if($row->tanggal_closing != "0000-00-00"){
				$d[$i][5] = $row->tanggal_closing;
			}else{
				$d[$i][5] = "";
			}
			
			if(isset($p[$row->no_wo])){
				$d[$i][6] = $p[$row->no_wo];
			}else{
				$d[$i][6] = "";
			}
			if(isset($r[$row->no_wo])){
				$d[$i][7] = $r[$row->no_wo];
			}else{
				$d[$i][7] = "";
			}

			echo $row->no_wo; echo "\t";
			echo $row->station; echo "\t";
			echo $row->unit; echo "\t";
			echo $row->sub_unit; echo "\t";
			echo $row->problem; echo "\t";
			echo $row->status; echo "\t";
			echo $row->kategori; echo "\t";
			echo $d[$i][5]; echo "\t";
			echo $d[$i][6]; echo "\t";
			echo $d[$i][7]; echo "\n";
			$i++;
		}
		// echo json_encode($d);
	}

	public function download_excel(){
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			// echo 'This is a server using Windows!';
			include APPPATH.'third_party\PHPExcel.php';
		// $fe = "template_planvsreal.xlsx";
		$fe = "template_00_planvsreal.xls";
		$filex = dirname(__FILE__) .'\..\..\assets\excel\\'.$fe;

		} else {
			// echo 'This is a server not using Windows!';
			include APPPATH.'third_party/PHPExcel.php';
		$fe = "template_00_planvsreal.xls";
		// $fe = "template_planvsreal.xlsx";
		$filex = dirname(__FILE__) .'/../../assets/excel/'.$fe;

		}
		// include APPPATH.'third_party\PHPExcel.php';

		// $fe = "template_planvsreal.xlsx";
		// $filex = dirname(__FILE__) .'\..\..\assets\excel\\'.$fe;
		
		// Panggil class PHPExcel nya
		$phpExcel = PHPExcel_IOFactory::load($filex);

		$cell_collection = $phpExcel->getActiveSheet()->getCellCollection();

		// $excel = new PHPExcel();
		// Settingan awal file excel
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));
		$bulan = urldecode($this->uri->segment(5));
		// $tgl = urldecode($this->uri->segment(6));

		// $id_pabrik = "SDI1";
		// $bulan = "04";
		// $tahun = "2020";

		$query_wo_list = $this->db->query(
			"SELECT * from (
				SELECT `m_wo`.no_wo,`m_wo`.tipe, m_wo.status,`m_wo`.station,
				`m_wo`.unit,`m_wo`.sub_unit,`m_wo`.problem,`m_wo`.kategori as asal_wo , `m_planing`.tipe as kategori
				FROM `m_planing`,m_wo WHERE 
				MONTH(`m_planing`.tanggal) = $bulan AND YEAR(`m_planing`.tanggal) = $tahun
				AND `m_planing`.no_wo = m_wo.no_wo 
				AND m_wo.id_pabrik = '$id_pabrik'

				UNION 

				SELECT `m_wo`.no_wo,`m_wo`.tipe, m_wo.status, `m_wo`.station,
				`m_wo`.unit,`m_wo`.sub_unit,`m_wo`.problem, `m_wo`.kategori as asal_wo, `m_wo`.tipe as kategori
				FROM `m_activity`,m_wo WHERE 
				MONTH (`m_activity`.tanggal) = $bulan AND
				YEAR (`m_activity`.tanggal) = $tahun AND
				`m_activity`.no_wo = m_wo.no_wo 
				AND m_wo.id_pabrik = '$id_pabrik'
			) as tabel group by tabel.no_wo
		");

		$query_plan_list = $this->db->query(
			"SELECT `m_planing`.tanggal, `m_planing`.no_wo, 
			(`m_planing`.mpp * `m_planing`.time) as total
			FROM `m_planing` WHERE 
			MONTH(`m_planing`.tanggal) = $bulan AND YEAR(`m_planing`.tanggal) = $tahun
		");

		$query_real_list = $this->db->query(
			"SELECT `m_activity_detail`.tanggal, `m_activity_detail`.no_wo, sum(`m_activity_detail`.realisasi)
			as total FROM `m_activity_detail` WHERE 
			MONTH(`m_activity_detail`.tanggal) = $bulan AND YEAR(`m_activity_detail`.tanggal) = $tahun
			group by m_activity_detail.tanggal, m_activity_detail.no_wo
		");

		$plan = array();
		foreach ($query_plan_list->result() as $row) {
			$plan[$row->no_wo][$row->tanggal] = $row->total;
		}

		$real = array();
		foreach ($query_real_list->result() as $row) {
			$real[$row->no_wo][$row->tanggal] = $row->total;
		}

		$phpExcel->getProperties()->setCreator('ANANTI')
					->setLastModifiedBy('ANANTI')
					->setTitle("PLANVSREAL-".$id_pabrik."-".$tahun."-".$bulan)
					->setSubject("PLAN VS REAL")
					->setDescription("Laporan Plan VS Real")
					->setKeywords("Plan VS Real");

		$nama_bulan = array(
			'01' => "Januari",
			'02' => "Februari",
			'03' => "Maret",
			'04' => "April",
			'05' => "Mei",
			'06' => "Juni",
			'07' => "Juli",
			'08' => "Agustus",
			'09' => "September",
			'10' => "Oktober",
			'11' => "November",
			'12' => "Desember",
		);

		$phpExcel->setActiveSheetIndex(0)->setCellValue('N5', $nama_bulan[$bulan]);
		$phpExcel->setActiveSheetIndex(0)->setCellValue('B1', $tahun);
		$phpExcel->setActiveSheetIndex(0)->setCellValue('D1', (int)$bulan);

		$i = 0;
		foreach ($query_wo_list->result() as $row){
			$numrow = $i+9;
			// $hour = round( $row->time / 60, 2);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $row->no_wo);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->tipe);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->status);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->station);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row->unit);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row->sub_unit);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row->problem);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row->kategori);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row->asal_wo);

			if(isset($plan[$row->no_wo])){
			foreach ($plan[$row->no_wo] as $tanggal => $value) {
				# code...
				$date = explode("-",$tanggal);
				$tgl = $date[2];
				switch ($tgl) {
				case '01': $phpExcel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, round($value/60,2)); break;
				case '02': $phpExcel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, round($value/60,2)); break;
				case '03': $phpExcel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, round($value/60,2)); break;
				case '04': $phpExcel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, round($value/60,2)); break;
				case '05': $phpExcel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, round($value/60,2)); break;
				case '06': $phpExcel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, round($value/60,2)); break;
				case '07': $phpExcel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, round($value/60,2)); break;
				case '08': $phpExcel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, round($value/60,2)); break;
				case '09': $phpExcel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, round($value/60,2)); break;
				case '10': $phpExcel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, round($value/60,2)); break;
				case '11': $phpExcel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, round($value/60,2)); break;
				case '12': $phpExcel->setActiveSheetIndex(0)->setCellValue('AK'.$numrow, round($value/60,2)); break;
				case '13': $phpExcel->setActiveSheetIndex(0)->setCellValue('AM'.$numrow, round($value/60,2)); break;
				case '14': $phpExcel->setActiveSheetIndex(0)->setCellValue('AO'.$numrow, round($value/60,2)); break;
				case '15': $phpExcel->setActiveSheetIndex(0)->setCellValue('AQ'.$numrow, round($value/60,2)); break;
				case '16': $phpExcel->setActiveSheetIndex(0)->setCellValue('AS'.$numrow, round($value/60,2)); break;
				case '17': $phpExcel->setActiveSheetIndex(0)->setCellValue('AU'.$numrow, round($value/60,2)); break;
				case '18': $phpExcel->setActiveSheetIndex(0)->setCellValue('AW'.$numrow, round($value/60,2)); break;
				case '19': $phpExcel->setActiveSheetIndex(0)->setCellValue('AY'.$numrow, round($value/60,2)); break;
				case '20': $phpExcel->setActiveSheetIndex(0)->setCellValue('BA'.$numrow, round($value/60,2)); break;
				case '21': $phpExcel->setActiveSheetIndex(0)->setCellValue('BC'.$numrow, round($value/60,2)); break;
				case '22': $phpExcel->setActiveSheetIndex(0)->setCellValue('BE'.$numrow, round($value/60,2)); break;
				case '23': $phpExcel->setActiveSheetIndex(0)->setCellValue('BG'.$numrow, round($value/60,2)); break;
				case '24': $phpExcel->setActiveSheetIndex(0)->setCellValue('BI'.$numrow, round($value/60,2)); break;
				case '25': $phpExcel->setActiveSheetIndex(0)->setCellValue('BK'.$numrow, round($value/60,2)); break;
				case '26': $phpExcel->setActiveSheetIndex(0)->setCellValue('BM'.$numrow, round($value/60,2)); break;
				case '27': $phpExcel->setActiveSheetIndex(0)->setCellValue('BO'.$numrow, round($value/60,2)); break;
				case '28': $phpExcel->setActiveSheetIndex(0)->setCellValue('BQ'.$numrow, round($value/60,2)); break;
				case '29': $phpExcel->setActiveSheetIndex(0)->setCellValue('BS'.$numrow, round($value/60,2)); break;
				case '30': $phpExcel->setActiveSheetIndex(0)->setCellValue('BU'.$numrow, round($value/60,2)); break;
				case '31': $phpExcel->setActiveSheetIndex(0)->setCellValue('BW'.$numrow, round($value/60,2)); break;					
				}
			}
			}

			if(isset($real[$row->no_wo])){
			foreach ($real[$row->no_wo] as $tanggal => $value) {
				# code...
				$date = explode("-",$tanggal);
				$tgl = $date[2];
				switch ($tgl) {

				case '01': $phpExcel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, round($value/60,2)); break;
				case '02': $phpExcel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, round($value/60,2)); break;
				case '03': $phpExcel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, round($value/60,2)); break;
				case '04': $phpExcel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, round($value/60,2)); break;
				case '05': $phpExcel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, round($value/60,2)); break;
				case '06': $phpExcel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, round($value/60,2)); break;
				case '07': $phpExcel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, round($value/60,2)); break;
				case '08': $phpExcel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, round($value/60,2)); break;
				case '09': $phpExcel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, round($value/60,2)); break;
				case '10': $phpExcel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, round($value/60,2)); break;
				case '11': $phpExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, round($value/60,2)); break;
				case '12': $phpExcel->setActiveSheetIndex(0)->setCellValue('AL'.$numrow, round($value/60,2)); break;
				case '13': $phpExcel->setActiveSheetIndex(0)->setCellValue('AN'.$numrow, round($value/60,2)); break;
				case '14': $phpExcel->setActiveSheetIndex(0)->setCellValue('AP'.$numrow, round($value/60,2)); break;
				case '15': $phpExcel->setActiveSheetIndex(0)->setCellValue('AR'.$numrow, round($value/60,2)); break;
				case '16': $phpExcel->setActiveSheetIndex(0)->setCellValue('AT'.$numrow, round($value/60,2)); break;
				case '17': $phpExcel->setActiveSheetIndex(0)->setCellValue('AV'.$numrow, round($value/60,2)); break;
				case '18': $phpExcel->setActiveSheetIndex(0)->setCellValue('AX'.$numrow, round($value/60,2)); break;
				case '19': $phpExcel->setActiveSheetIndex(0)->setCellValue('AZ'.$numrow, round($value/60,2)); break;
				case '20': $phpExcel->setActiveSheetIndex(0)->setCellValue('BB'.$numrow, round($value/60,2)); break;
				case '21': $phpExcel->setActiveSheetIndex(0)->setCellValue('BD'.$numrow, round($value/60,2)); break;
				case '22': $phpExcel->setActiveSheetIndex(0)->setCellValue('BF'.$numrow, round($value/60,2)); break;
				case '23': $phpExcel->setActiveSheetIndex(0)->setCellValue('BH'.$numrow, round($value/60,2)); break;
				case '24': $phpExcel->setActiveSheetIndex(0)->setCellValue('BJ'.$numrow, round($value/60,2)); break;
				case '25': $phpExcel->setActiveSheetIndex(0)->setCellValue('BL'.$numrow, round($value/60,2)); break;
				case '26': $phpExcel->setActiveSheetIndex(0)->setCellValue('BN'.$numrow, round($value/60,2)); break;
				case '27': $phpExcel->setActiveSheetIndex(0)->setCellValue('BP'.$numrow, round($value/60,2)); break;
				case '28': $phpExcel->setActiveSheetIndex(0)->setCellValue('BR'.$numrow, round($value/60,2)); break;
				case '29': $phpExcel->setActiveSheetIndex(0)->setCellValue('BT'.$numrow, round($value/60,2)); break;
				case '30': $phpExcel->setActiveSheetIndex(0)->setCellValue('BV'.$numrow, round($value/60,2)); break;					
				case '31': $phpExcel->setActiveSheetIndex(0)->setCellValue('BX'.$numrow, round($value/60,2)); break;
				}
			}
			}			
			$i++;
		}
					
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PLANVSREAL_'.$id_pabrik."_".$tahun."_".$bulan.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
		ob_end_clean();
		// $write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
		$write->save('php://output');



	}
}

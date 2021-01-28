<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordhm extends CI_Controller {

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
	
	public function index()
	{
		// $this->load->view('welcome_message');
		$output['content'] = "test";
		$output['main_title'] = "Data Hour Meter Mesin";
		$header['title'] = "Hour Meter";
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
			base_url("assets/mdp/recordhm.js"),
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
		$this->load->view('content-recordhm',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT id_unit,id_sub_unit,hm FROM m_recordhm where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];

		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
				$d[$i][0] = $row->id_unit;
				$d[$i][1] = $row->id_sub_unit;
				$d[$i++][2] = $row->hm;
			}
		}else{
			$query = $this->db->query("SELECT id_unit,nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND hourmeter_mod=1;");

			foreach ($query->result() as $row) {
				$d[$i][0] = $row->id_unit; // access attributes
				$d[$i++][1] = $row->nama; // access attributes
			}
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		// $unit = $_REQUEST['unit'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$this->db->query("DELETE FROM `m_recordhm` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal' ");

		// $query = $this->db->query("SELECT DISTINCT m_recordhm.unit,m_recordhm.hm FROM m_recordhm,m_recordhm_screwpress,master_unit WHERE m_recordhm.id_pabrik = '$pabrik' AND master_unit.screwpress_monitoring = 1 AND m_recordhm.unit = m_recordhm_screwpress.unit AND master_unit.nama = m_recordhm.unit	AND m_recordhm.tanggal = (SELECT max(tanggal) from m_recordhm_screwpress)");

		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			
			$data = array(
				'tanggal' => $tanggal,
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'id_unit' => $value[0],
				'id_sub_unit' => $value[1],
				'hm' => str_replace(",", ".", $value[2]),
				'sync' => "0",
			);
			// print_r($data);
			$this->db->insert('m_recordhm', $data);
		}
	}

	public function download_bulanan(){
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			// echo 'This is a server using Windows!';
			include APPPATH.'third_party\PHPExcel.php';
			// $fe = "template_planvsreal.xlsx";
			$fe = "template_00_hm.xls";
			$filex = dirname(__FILE__) .'\..\..\assets\excel\\'.$fe;

		} else {
			// echo 'This is a server not using Windows!';
			include APPPATH.'third_party/PHPExcel.php';

			$fe = "template_00_hm.xls";
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

		$query_hm_list = $this->db->query(
				"SELECT tanggal,id_pabrik,id_station,id_unit,id_sub_unit,hm FROM m_recordhm WHERE 
				MONTH (`m_recordhm`.tanggal) = $bulan AND
				YEAR (`m_recordhm`.tanggal) = $tahun AND
				id_pabrik = '$id_pabrik'
				ORDER BY id_station ASC
		");

		$query_equipment_hm_list = $this->db->query(
			"SELECT id_station,id_unit,nama as id_sub_unit
			FROM master_sub_unit
			WHERE id_pabrik = '$id_pabrik' AND hourmeter_mod=1
			ORDER BY id_station ASC
		");

		$hm = array();
		foreach ($query_hm_list->result() as $row) {
			$hm[$row->id_station."_".$row->id_unit."_".$row->id_sub_unit][$row->tanggal] = $row->hm;
		}

		$phpExcel->getProperties()->setCreator('ANANTI')
					->setLastModifiedBy('ANANTI')
					->setTitle("HM-".$id_pabrik."-".$tahun."-".$bulan)
					->setSubject("Hour Meter")
					->setDescription("Laporan Hour Meter Bulanan")
					->setKeywords("Hour Meter");

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

		$phpExcel->setActiveSheetIndex(0)->setCellValue('A2', $id_pabrik." - ".$nama_bulan[$bulan]." - ".$tahun);
		// $phpExcel->setActiveSheetIndex(0)->setCellValue('B1', $tahun);
		// $phpExcel->setActiveSheetIndex(0)->setCellValue('D1', (int)$bulan);

		$i = 0;
		foreach ($query_equipment_hm_list->result() as $row){
			$numrow = $i+4;
			// $hour = round( $row->time / 60, 2);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $row->id_station);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->id_unit);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->id_sub_unit);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->station);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row->unit);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row->sub_unit);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row->problem);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row->kategori);
			// $phpExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row->asal_wo);

			if(isset($hm[$row->id_station . "_" . $row->id_unit . "_" . $row->id_sub_unit])){
			foreach ($hm[$row->id_station . "_" . $row->id_unit . "_" . $row->id_sub_unit] as $tanggal => $value) {
				# code...
				$date = explode("-",$tanggal);
				$tgl = $date[2];
				switch ($tgl) {
				case '01': $phpExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $value); break;
				case '02': $phpExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $value); break;
				case '03': $phpExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $value); break;
				case '04': $phpExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $value); break;
				case '05': $phpExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $value); break;
				case '06': $phpExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $value); break;
				case '07': $phpExcel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $value); break;
				case '08': $phpExcel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $value); break;
				case '09': $phpExcel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $value); break;
				case '10': $phpExcel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $value); break;
				case '11': $phpExcel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $value); break;
				case '12': $phpExcel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $value); break;
				case '13': $phpExcel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $value); break;
				case '14': $phpExcel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $value); break;
				case '15': $phpExcel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $value); break;
				case '16': $phpExcel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $value); break;
				case '17': $phpExcel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $value); break;
				case '18': $phpExcel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $value); break;
				case '19': $phpExcel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $value); break;
				case '20': $phpExcel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $value); break;
				case '21': $phpExcel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $value); break;
				case '22': $phpExcel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $value); break;
				case '23': $phpExcel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $value); break;
				case '24': $phpExcel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $value); break;
				case '25': $phpExcel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $value); break;
				case '26': $phpExcel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $value); break;
				case '27': $phpExcel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $value); break;
				case '28': $phpExcel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $value); break;
				case '29': $phpExcel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $value); break;
				case '30': $phpExcel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $value); break;
				case '31': $phpExcel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $value); break;					
				}
			}
			}

			$i++;
		}
					
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="HM_'.$id_pabrik."_".$tahun."_".$bulan.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
		ob_end_clean();
		// $write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
		$write->save('php://output');

	}
}
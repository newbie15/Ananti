<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historical extends CI_Controller {

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
		$output['content'] = "test";
		$output['main_title'] = "Historical Card Machineries";
		
		$header['title'] = "Historical";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jexcel.css"),
			base_url("assets/jexcel/css/jsuites.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),

			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/jexcel/js/jexcel.js"),
			base_url("assets/jexcel/js/jsuites.js"),
			base_url("assets/mdp/historical.js"),
		];
			
		$query = $this->db->query("SELECT nama FROM master_pabrik;");

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
		$this->load->view('report-historical',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];
		$id_sub_unit = $_REQUEST['id_sub_unit'];

		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$query = $this->db->query("SELECT no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			$d[$i][0] = $row->no_wo; // or methods defined on the 'User' class
			$d[$i][1] = $row->problem; // or methods defined on the 'User' class
			$d[$i][2] = $row->desc_masalah; // or methods defined on the 'User' class
			$d[$i++][3] = $row->hm; // or methods defined on the 'User' class
			// $d[$i][4] = $row->kategori; // or methods defined on the 'User' class
			// $d[$i++][5] = $row->status; // or methods defined on the 'User' class
		}
		echo json_encode($d);
	}

	public function loadcsv()
	{
		$id_pabrik = $this->uri->segment(3);//['id_pabrik'];
		$id_station = urldecode($this->uri->segment(4));//['id_station'];
		$id_unit = urldecode($this->uri->segment(5)); //['id_unit'];
		$id_sub_unit = urldecode($this->uri->segment(6));//['id_unit'];
		// echo("SELECT no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit';");

		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$query = $this->db->query("SELECT no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit' AND sub_unit = '$id_sub_unit';");

		$i = 0;
		$d = [];
			
		echo "No WO,problem,desc_masalah,hm,kategori,status\n";

		foreach ($query->result() as $row)
		{
			echo $row->no_wo; echo ",";
			echo $row->problem; echo ",";
			echo $row->desc_masalah; echo ",";
			echo $row->hm; echo ",";
			echo $row->kategori; echo ",";
			echo $row->status; echo "\n";
		}
	}	

	public function mini_history_csv()
	{
		$id_pabrik = $this->uri->segment(3);//['id_pabrik'];
		$id_station = urldecode($this->uri->segment(4));//['id_station'];
		$id_unit = urldecode($this->uri->segment(5));//['id_unit'];
		$id_sub_unit = urldecode($this->uri->segment(6));//['id_sub_unit'];

		$query = $this->db->query("SELECT no_wo,problem,desc_masalah FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit' AND sub_unit = '$id_sub_unit';");

		$i = 0;
		$d = [];
			
		echo "No WO,problem,desc_masalah\n";

		foreach ($query->result() as $row)
		{
			echo $row->no_wo; echo ",";
			echo $row->problem; echo ",";
			echo $row->desc_masalah; echo "\n";
		}
	}


	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$this->db->query("DELETE FROM `m_wo` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'no_wo' => $value[0],
				'station' => $value[1],
				'unit' => $value[2],
				'problem' => $value[3],
				'desc_masalah' => $value[4],
				'hm' => $value[5],
				'kategori' => $value[6],
				'status' => $value[7],
				// 'date' => 'My date'
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('m_wo', $data);
			}
		}
	}
	
	public function ajax()
	{
		// $id_pabrik = $_REQUEST['id_pabrik'];
		$status = $this->uri->segment(3, 0);
		$id_pabrik = $this->uri->segment(4, 0);
		$query = $this->db->query("SELECT no_wo FROM m_wo where id_pabrik = '$id_pabrik' AND status='$status';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['name'] = $row->no_wo;
				$a['id'] = $row->no_wo;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}

	public function detail_wo()
	{
		// $id_pabrik = $_REQUEST['id_pabrik'];
		$no_wo = $this->uri->segment(3, 0);
		// $id_pabrik = $this->uri->segment(4, 0);
		// $no_wo = $_REQUEST['no_wo'];
		$query = $this->db->query("SELECT * FROM m_wo where no_wo='$no_wo';");

		$i = 0;
		$a = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['station'] = $row->station;
				$a['unit'] = $row->unit;
				$a['problem'] = $row->problem;
				$a['desc_masalah'] = $row->desc_masalah;
				// $d[$i++] = $a;
		}
		echo json_encode($a);
	}

	public function list_open(){
		$pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT CONCAT(no_wo,' - ',station,'-',unit,'-',problem) as daftar FROM m_wo where m_wo.status = 'open' AND m_wo.id_pabrik = '$pabrik'");
        echo(json_encode($query->result()));
	}

	public function download_excel()
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			// echo 'This is a server using Windows!';
			include APPPATH . 'third_party\PHPExcel.php';

			$fe = "template_00_historycard.xls";

			$filex = dirname(__FILE__) . '\..\..\assets\excel\\' . $fe;
		} else {
			// echo 'This is a server not using Windows!';
			include APPPATH . 'third_party/PHPExcel.php';

			$fe = "template_00_historycard.xls";

			$filex = dirname(__FILE__) . '/../../assets/excel/' . $fe;
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
		$station = urldecode($this->uri->segment(4));
		$unit = urldecode($this->uri->segment(5));
		$sub_unit = urldecode($this->uri->segment(6));

		$query_wo_list = $this->db->query(
			"	SELECT `m_activity`.tanggal,`m_wo`.no_wo, `m_wo`.problem,`m_activity`.perbaikan, `m_wo`.hm
				FROM m_wo LEFT JOIN `m_activity` 
				on `m_activity`.no_wo = m_wo.no_wo 
				WHERE m_wo.id_pabrik = '$id_pabrik'
				AND m_wo.station = '$station'
				AND m_wo.unit = '$unit'
				AND m_wo.sub_unit = '$sub_unit'
				ORDER BY `m_activity`.tanggal ASC
			"
		);

		$labour_list = $this->db->query(
			"SELECT `m_activity_detail`.tanggal,`m_wo`.no_wo, `m_activity_detail`.nama_teknisi, `m_activity_detail`.realisasi 
			FROM m_wo LEFT JOIN `m_activity_detail` 
			ON m_wo.no_wo = m_activity_detail.no_wo
			WHERE m_wo.id_pabrik = '$id_pabrik'
			AND m_wo.station = '$station'
			AND m_wo.unit = '$unit'
			AND m_wo.sub_unit = '$sub_unit'
		"
		);

		$part_list = $this->db->query(
			"SELECT `m_sparepart_usage`.tanggal,`m_wo`.no_wo,`m_sparepart_usage`.material,`m_sparepart_usage`.spek, `m_sparepart_usage`.satuan, `m_sparepart_usage`.qty, `m_sparepart_usage`.cost
			FROM `m_wo` LEFT JOIN `m_sparepart_usage`
			ON m_wo.no_wo = m_sparepart_usage.no_wo
			WHERE m_wo.id_pabrik = '$id_pabrik'
			AND m_wo.station = '$station'
			AND m_wo.unit = '$unit'
			AND m_wo.sub_unit = '$sub_unit'
		"
		);

		$labour = array();
		$inc = 0;
		$prev_no_wo = "";
		foreach($labour_list->result() as $row) {
			if ($prev_no_wo != $row->no_wo) {
				$prev_no_wo = $row->no_wo;
				$inc = 0;
			}		
			$labour[$row->no_wo][$row->tanggal][$inc]['mpp'] = 1;
			$labour[$row->no_wo][$row->tanggal][$inc]['mh'] = $row->realisasi;
			$labour[$row->no_wo][$row->tanggal][$inc]['name'] = $row->nama_teknisi;
			$inc++;
		}

		$part = array();
		$inc = 0;
		$prev_no_wo = "";
		foreach ($part_list->result() as $row) {
			if($prev_no_wo!= $row->no_wo){
				$prev_no_wo = $row->no_wo;
				$inc = 0;
			}
			$part[$row->no_wo][$row->tanggal][$inc]['material'] = $row->material;
			$part[$row->no_wo][$row->tanggal][$inc]['spek'] = $row->spek;
			$part[$row->no_wo][$row->tanggal][$inc]['um'] = $row->satuan;
			$part[$row->no_wo][$row->tanggal][$inc]['qty'] = $row->qty;
			$part[$row->no_wo][$row->tanggal][$inc]['cost'] = $row->cost;
			$inc++;
		}

		$phpExcel->getProperties()->setCreator('ANANTI')
			->setLastModifiedBy('ANANTI')
			->setTitle("HISTORYCARD-" . $id_pabrik . "-" . $station . "-" .$unit . "-" . $sub_unit)
			->setSubject("History Card")
			->setDescription("History Machineries Card")
			->setKeywords("History Card");

		$phpExcel->setActiveSheetIndex(0)->setCellValue('B3', $station);
		$phpExcel->setActiveSheetIndex(0)->setCellValue('B4', $unit);
		$phpExcel->setActiveSheetIndex(0)->setCellValue('B5', $sub_unit);
		$phpExcel->setActiveSheetIndex(0)->setCellValue('E1', "PABRIK ".$id_pabrik);

		$i = 0;
		$incp = 0;
		$incl = 0;
		foreach ($query_wo_list->result() as $row) {
			$numrow = $i + 11;
			// $hour = round( $row->time / 60, 2);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $row->tanggal);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $row->no_wo);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $row->problem);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $row->perbaikan);
			$phpExcel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $row->hm);

			if (isset($part[$row->no_wo])) {
				$incp = 0;
				foreach (@$part[$row->no_wo][$row->tanggal] as $value) {
					$phpExcel->setActiveSheetIndex(0)->setCellValue('E' . ($numrow + $incp), $value['material'] );//$value[$incp]['spec'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('F' . ($numrow + $incp), $value['spek'] );//$value[$incp]['spec'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('G' . ($numrow + $incp), $value['um'] );//$value[$incp]['spec'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('H' . ($numrow + $incp), $value['qty'] );//$value[$incp]['qty'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('I' . ($numrow + $incp), $value['cost'] );//$value[$incp]['cost'] );
					$incp++;
				}
			}


			if (isset($labour[$row->no_wo])) {
				$incl = 0;
				foreach (@$labour[$row->no_wo][$row->tanggal] as $value) {
					$phpExcel->setActiveSheetIndex(0)->setCellValue('L' . ($numrow + $incl), $value['mpp']); //$value[$incp]['spec'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('M' . ($numrow + $incl), $value['mh']); //$value[$incp]['qty'] );
					$phpExcel->setActiveSheetIndex(0)->setCellValue('N' . ($numrow + $incl), $value['name']); //$value[$incp]['cost'] );
					$incl++;
				}
			}

			$i+=max($incp,$incl);
		}

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="HISTORYCARD_'. $id_pabrik . "_" . $station . "_" . $unit . "_" . $sub_unit . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
		ob_end_clean();
		// $write = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
		$write->save('php://output');
	}	
}

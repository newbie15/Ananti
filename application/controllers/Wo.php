<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wo extends CI_Controller {

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
		$output['content'] = "Work Order";
		$output['main_title'] = "Work Order";
		
		$header['title'] = "Work Order";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
			base_url("assets/easyautocomplete/easy-autocomplete.min.css"),			
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/easyautocomplete/jquery.easy-autocomplete.min.js"),			
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/wo.js"),
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

		$this->load->view('header',$header);
		$this->load->view('content-wo',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,station,unit,sub_unit,problem,desc_masalah,hm,kategori,tipe,status,tanggal_closing FROM m_wo where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			// $d[$i][1] = $row->station;
			$d[$i][1] = $row->station ."\n". $row->unit . "\n" . $row->sub_unit;
			// $d[$i][2] = $row->unit;
			// $d[$i][3] = $row->sub_unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->desc_masalah;
			$d[$i][4] = $row->hm;
			$d[$i][5] = $row->kategori;
			$d[$i][6] = $row->tipe;
			$d[$i][7] = $row->status;
			$d[$i++][8] = $row->tanggal_closing;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$this->db->query("DELETE FROM `m_wo` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$eq = explode("\n",$value[1]); 
			@$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'no_wo' => $value[0],
				'station' => $eq[0],
				'unit' => $eq[1],
				'sub_unit' => $eq[2],
				'problem' => $value[2],
				'desc_masalah' => $value[3],
				'hm' => $value[4],
				'kategori' => $value[5],
				'tipe' => $value[6],
				'status' => $value[7],
				'tanggal_closing' => $value[8],
				// 'date' => 'My date'
			);
			// print_r($data);
			if($value[0]!=""){
				// $this->db->insert('m_wo', $data);
				array_push($datax,$data);
			}
		}

		if(count($datax)>0){
			@$this->db->insert_batch('m_wo', $datax);
		}
		// print_r($datax);
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
				$a['station'] = $row->station;
				$a['unit'] = $row->unit;
				$a['sub_unit'] = $row->sub_unit;
				$a['problem'] = $row->problem;
				// $a['desc_masalah'] = $row->desc_masalah;
		}
		echo json_encode($a);
	}

	public function list_open(){
		$pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT CONCAT(no_wo,' - ',station,' - ',unit,' - ',sub_unit,' - ',problem) as daftar FROM m_wo where m_wo.status = 'open' AND m_wo.id_pabrik = '$pabrik'");
        echo(json_encode($query->result()));
	}

	public function close_wo_unfinished(){
		$pabrik = $_REQUEST['id_pabrik'];
		$wo = $_REQUEST['wo'];
		$tanggal_close = date("Y-m-d");

		$sql = "UPDATE `ananti`.`m_wo` SET `status` = 'close', tanggal_closing = '$tanggal_close' ";
		$i = 0;
		foreach ($wo as $key => $value) {
			if($i==0){
				$sql = $sql . "WHERE `m_wo`.`no_wo` = '$value' ";
				$i++;
			}else{
				$sql = $sql . "OR `m_wo`.`no_wo` = '$value' ";
			}
		}

		if ($this->db->simple_query($sql)){
			echo "OK";
		}else{
			echo "NOK";
		}
		
	}


	public function unfinished(){

		$output['content'] = "test";
		$output['main_title'] = "Work Order";
		
		$header['title'] = "Unfinished Work Order";
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
			base_url("assets/mdp/wo_unfinished.js"),
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

		$this->load->view('header',$header);
		$this->load->view('content-wo-unfinished',$output);
		$this->load->view('footer',$footer);

	}

	public function load_unfinished(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$query = $this->db->query("SELECT no_wo,station,unit,sub_unit,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND status = 'open';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->station."\n".$row->unit."\n".$row->sub_unit;
			// $d[$i][2] = ;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->desc_masalah;
			$d[$i][4] = $row->hm;
			$d[$i][5] = $row->kategori;
			$d[$i++][6] = $row->status;
		}
		echo json_encode($d);

	}

	public function search(){
		$output['content'] = "test";
		$output['main_title'] = "Work Order";
		
		$header['title'] = "Search Work Order";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),

			base_url("assets/jexcel/css/jexcel.css"),
			base_url("assets/jexcel/css/jsuites.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/js/jexcel.js"),
			base_url("assets/jexcel/js/jsuites.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/wo_search.js"),
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

		$this->load->view('header',$header);
		$this->load->view('content-wo-search',$output);
		$this->load->view('footer',$footer);

	}

	public function loadcsv()
	{
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));

		// $id_unit = urldecode($this->uri->segment(5));//['id_unit'];
		// echo("SELECT no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit';");

		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$like = $id_pabrik."-".$tahun;
		$query = $this->db->query("SELECT no_wo,station,unit,sub_unit,problem,hm,kategori,tipe,status FROM m_wo where no_wo LIKE '%$like%';");

		$i = 0;
		$d = [];
			
		echo "No WO,Station,Unit,Sub Unit,problem,hm,kategori,tipe,status\n";

		foreach ($query->result() as $row)
		{
			echo $row->no_wo; echo ",";
			echo $row->station; echo ",";
			echo $row->unit; echo ",";
			echo $row->sub_unit; echo ",";
			echo $row->problem; echo ",";
			// echo $row->desc_masalah; echo ",";
			echo $row->hm; echo ",";
			echo $row->kategori; echo ",";
			echo $row->tipe; echo ",";
			echo $row->status; echo "\n";
			// echo $row->harga; echo ",";
			// echo $row->qty; echo ",";
			// echo $row->jumlah; echo "\n";
		}
	}

	public function download(){
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));

		$like = $id_pabrik."-".$tahun;
		$query = $this->db->query("
			SELECT id_pabrik,tanggal,no_wo,station,unit,sub_unit,problem,desc_masalah,hm,kategori,tipe,status,tanggal_closing FROM m_wo where no_wo LIKE '%$like%';
		");

		header('Content-Type: aplication/vnd-ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=WO_'.$id_pabrik.'_'.$tahun.'.xls');
		echo "SITE\tTANGGAL\tNO WO\tSTATION\tUNIT\tSUB UNIT\tPROBLEM\tKETERANGAN\tHM\tKATEGORI\tTIPE\tSTATUS\tTANGGAL CLOSING\n";

		foreach ($query->result() as $row)
		{
			echo $row->id_pabrik; echo "\t";
			echo $row->tanggal; echo "\t";
			echo $row->no_wo; echo "\t";
			echo $row->station; echo "\t";
			echo $row->unit; echo "\t";
			echo $row->sub_unit; echo "\t";
			echo $row->problem; echo "\t";
			echo $row->desc_masalah; echo "\t";
			echo $row->hm; echo "\t";
			echo $row->kategori; echo "\t";
			echo $row->tipe; echo "\t";
			echo $row->status; echo "\t";
			if($row->tanggal_closing == "00-00-0000" || $row->tanggal_closing == "0000-00-00"){
				echo ""; echo "\n";
			}else{
				echo $row->tanggal_closing; echo "\n";
			}
		}
	}

	public function generate_no_wo(){
		$id_pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['tanggal'];		
		$query = $this->db->query("SELECT no_wo FROM m_wo where id_pabrik = '$id_pabrik' AND tanggal='$tanggal' ORDER BY no_wo desc LIMIT 0,1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			echo $row->no_wo;
		}
		// echo json_encode($d);		
	}

	public function simpan_single()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['tanggal'];
		$no_wo = $_REQUEST['no_wo'];
		$station = $_REQUEST['station'];
		$unit = $_REQUEST['unit'];
		$sub_unit = $_REQUEST['sub_unit'];
		$problem = $_REQUEST['problem'];
		$tipe = $_REQUEST['tipe'];
		// $tanggal = $_REQUEST['desc_masalah'];
		
		$this->db->trans_start();
		// $this->db->query("DELETE FROM `m_wo` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		// $data_json = $_REQUEST['data_json'];
		$data = array(
			'id_pabrik' => $pabrik,
			'tanggal' => $tanggal,
			'no_wo' => $no_wo,
			'station' => $station,
			'unit' => $unit,
			'sub_unit' => $sub_unit,
			'problem' => $problem,
			'desc_masalah' => "",
			'hm' => "",
			'kategori' => "unplan",
			'tipe' => $tipe,
			'status' => "open",
			// 'tanggal_closing' => "",
			// 'date' => 'My date'
		);
			// print_r($data);
		// if($value[0]!=""){
		// 	// $this->db->insert('m_wo', $data);
		// 	array_push($datax,$data);
		// }
		// }
		$this->db->insert('m_wo', $data);
		// print_r($datax);
		$this->db->trans_complete();
	}




}

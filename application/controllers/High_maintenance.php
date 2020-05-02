<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class High_maintenance extends CI_Controller {

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
		$output['main_title'] = "High Maintenance Unit";
		
		$header['title'] = "High Maintenance";
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
			base_url("assets/adminlte/bower_components/Flot/jquery.flot.js"),
			base_url("assets/adminlte/bower_components/Flot/jquery.flot.pie.js"),
			base_url("assets/jexcel/js/jexcel.js"),
			base_url("assets/jexcel/js/jsuites.js"),
			base_url("assets/mdp/high_maintenance.js"),
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

		$this->load->view('header',$header);
		$this->load->view('report-high-maintenance',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];

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
		$id_unit = urldecode($this->uri->segment(5));//['id_unit'];
		$tahun = urldecode($this->uri->segment(6));
		$bulan = urldecode($this->uri->segment(7));
		// echo("SELECT no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND unit = '$id_unit';");

		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		if($bulan=="00"){
			if($id_unit=="-- ALL --"){
				$query = $this->db->query("SELECT unit,no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND tanggal LIKE '%$tahun-%';");
			}else{
				$query = $this->db->query("SELECT unit,no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND tanggal LIKE '%$tahun-%' AND unit = '$id_unit';");
			}
		}else{
			if($id_unit=="-- ALL --"){
				$query = $this->db->query("SELECT unit,no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND tanggal LIKE '%$tahun-$bulan%';");			
			}else{
				$query = $this->db->query("SELECT unit,no_wo,problem,desc_masalah,hm,kategori,status FROM m_wo where id_pabrik = '$id_pabrik' AND station = '$id_station' AND tanggal LIKE '%$tahun-$bulan%' AND unit = '$id_unit';");
			}
		}

		$i = 0;
		$d = [];
			
		echo "Unit,No WO,problem,desc_masalah,hm,kategori,status\n";

		foreach ($query->result() as $row)
		{
			echo $row->unit; echo ",";
			echo $row->no_wo; echo ",";
			echo $row->problem; echo ",";
			echo $row->desc_masalah; echo ",";
			echo $row->hm; echo ",";
			echo $row->kategori; echo ",";
			echo $row->status; echo "\n";
			// echo $row->harga; echo ",";
			// echo $row->qty; echo ",";
			// echo $row->jumlah; echo "\n";
		}
	}	

	public function statistik()
	{
		$tahun = $_REQUEST['tahun'];
		$id_pabrik = $_REQUEST['id_pabrik'];
		$bulan = $_REQUEST['bulan'];
		$station = $_REQUEST['id_station'];
		
		
		$i = 0;
		$station_list = [];
		// $query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `status`  = 'open' and id_pabrik = '$id_pabrik' GROUP by station");

		if($bulan=="00"){
			$query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `tanggal`  LIKE '%$tahun-%' and id_pabrik = '$id_pabrik' GROUP by station");
		}else{
			$query = $this->db->query("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `tanggal`  LIKE '%$tahun-".$bulan."-%' and id_pabrik = '$id_pabrik' GROUP by station");
			// echo ("SELECT station, COUNT(station) as jumlah FROM `m_wo` WHERE `tanggal`  LIKE '%$tahun-".$bulan."-%' and id_pabrik = '$id_pabrik' GROUP by station");

		}
		foreach ($query->result() as $row)
		{
			$station_list[$i][0] = $row->station;
			$station_list[$i++][1] = $row->jumlah;
		}

		$out['station_list'] = $station_list; 
		echo json_encode($out);

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
}

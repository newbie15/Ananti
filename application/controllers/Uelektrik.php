<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uelektrik extends CI_Controller {

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
		$output['main_title'] = "Data Asset Electromotor & Panel Starter";
		
		$header['title'] = "Unit Elektrik";
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

			base_url("assets/mdp/uelektrik.js"),
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
		$this->load->view('content-unit-elektrik',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
		SELECT unit,sub_unit,merk,kw,class,starter,mccb,kontaktor_line,kontaktor_delta,kontaktor_star,kabel,jumlah_kabel 
		FROM master_unit_elektrik 
		where master_unit_elektrik.id_pabrik = '$id_pabrik' AND master_unit_elektrik.id_station = '$id_station'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->unit;
			$d[$i][1] = $row->sub_unit;
			$d[$i][2] = $row->merk;
			$d[$i][3] = $row->kw;
			$d[$i][4] = $row->class;
			$d[$i][5] = $row->starter;
			$d[$i][6] = $row->mccb;
			$d[$i][7] = $row->kontaktor_line;
			$d[$i][8] = $row->kontaktor_delta;
			$d[$i][9] = $row->kontaktor_star;
			$d[$i][10] = $row->kabel;
			$d[$i++][11] = $row->jumlah_kabel;
		}

		if($i>0){
			echo json_encode($d);
		}else{
			$query = $this->db->query("SELECT id_unit,nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND electromotor_mod = 1;");

			$i = 0;
			$d = [];
			foreach ($query->result() as $row)
			{
				$d[$i][0] = $row->id_unit; 
				$d[$i++][1] = $row->nama; 
			}
			echo json_encode($d);
		}
	}

	// public function load()
	// {
	// 	$id_pabrik = $_REQUEST['id_pabrik'];
	// 	$query = $this->db->query("SELECT id_station,kode_asset,nama FROM master_unit where id_pabrik = '$id_pabrik';");

	// 	$i = 0;
	// 	$d = [];
	// 	foreach ($query->result() as $row)
	// 	{
	// 		// $d[$i][0] = $row->nama; // access attributes
	// 		$d[$i][0] = $row->id_station; // or methods defined on the 'User' class
	// 		$d[$i][1] = $row->kode_asset; // or methods defined on the 'User' class
	// 		$d[$i++][2] = $row->nama; // or methods defined on the 'User' class
	// 	}
	// 	echo json_encode($d);
	// }

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$this->db->query("DELETE FROM `master_unit_elektrik` where id_pabrik = '$pabrik' AND id_station = '$station' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'unit' => $value[0],
				'sub_unit' => $value[1],
				'merk' => $value[2],
				'kw' => $value[3],
				'class' => $value[4],
				'starter' => $value[5],
				'mccb' => $value[6],
				'kontaktor_line' => $value[7],
				'kontaktor_delta' => $value[8],
				'kontaktor_star' => $value[9],
				'kabel' => $value[10],
				'jumlah_kabel' => $value[11],

				// 'date' => 'My date'
			);
			print_r($data);
			$this->db->insert('master_unit_elektrik', $data);
		}
	}


	
	public function ajax()
	{
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

	public function ajax_default_list()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$query = $this->db->query("SELECT id_unit,nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND electromotor_mod = 1;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->id_unit; 
			$d[$i++][0] = $row->nama; 
		}
		echo json_encode($d);
	}
}

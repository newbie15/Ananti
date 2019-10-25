<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umekanik extends CI_Controller {

	public function index()
	{
		$output['content'] = "test";
		$output['main_title'] = "Data Asset Mesin";
		
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

			base_url("assets/mdp/umekanik.js"),
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
		$this->load->view('content-unit-mekanik',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
		SELECT nama,merk_gearbox,kapasitas_gearbox,rasio_gearbox,type_gearbox,pulley_motor,pulley_driven,pulley_type,merk_pompa,type_pompa,kapasitas_pompa
		FROM master_unit_mekanik RIGHT JOIN master_unit
		ON master_unit.id_pabrik = master_unit_mekanik.id_pabrik
		AND master_unit.id_station = master_unit_mekanik.id_station
		AND master_unit.nama = master_unit_mekanik.unit
		where master_unit.id_pabrik = '$id_pabrik' AND master_unit.id_station = '$id_station'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->nama;
			$d[$i][1] = $row->merk_gearbox;
			$d[$i][2] = $row->kapasitas_gearbox;
			$d[$i][3] = $row->rasio_gearbox;
			$d[$i][4] = $row->type_gearbox;
			$d[$i][5] = $row->pulley_motor;
			$d[$i][6] = $row->pulley_driven;
			$d[$i][7] = $row->pulley_type;
			$d[$i][8] = $row->merk_pompa;
			$d[$i][9] = $row->type_pompa;
			$d[$i++][10] = $row->kapasitas_pompa;
		}
		echo json_encode($d);
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
		$this->db->query("DELETE FROM `master_unit_mekanik` where id_pabrik = '$pabrik' AND id_station = '$station' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'unit' => $value[0],
				'merk_gearbox' => $value[1],
				'kapasitas_gearbox' => $value[2],
				'rasio_gearbox' => $value[3],
				'type_gearbox' => $value[4],
				'pulley_motor' => $value[5],
				'pulley_driven' => $value[6],
				'pulley_type' => $value[7],
				'merk_pompa' => $value[8],
				'type_pompa' => $value[9],
				'kapasitas_pompa' => $value[10],

				// 'date' => 'My date'
			);
			print_r($data);
			$this->db->insert('master_unit_mekanik', $data);
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
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i++][0] = $row->nama; 
		}
		echo json_encode($d);
	}
}

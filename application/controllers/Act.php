<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Act extends CI_Controller {

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
		$query = $this->db->query("SELECT nama FROM master_karyawan WHERE id_pabrik = 'SDI1' ORDER BY nama ASC;");

		$kategori = 0;
		$nama_mpp = "";

		$output['dropdown_mpp']= "";
		if($kategori<2){
			$output['dropdown_mpp']= "<select id=\"mpp\"><option>--PILIH SALAH SATU--</option>";
		}else{
			$output['dropdown_mpp']= "<select id=\"mpp\" disabled>";
		}
		
		foreach ($query->result() as $row)
		{
			if($nama_mpp==$row->nama){
				$output['dropdown_mpp'] = $output['dropdown_mpp']."<option selected=\"selected\">".$row->nama."</option>";
			}else{
				$output['dropdown_mpp'] = $output['dropdown_mpp']."<option>".$row->nama."</option>";
			}
		}
		$output['dropdown_mpp'] .= "/<select>";

		$this->load->view('welcome_message',$output);
	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$d = $_REQUEST['d'];
		$m = $_REQUEST['m'];
		$y = $_REQUEST['y'];
		$mpp = $_REQUEST['mpp'];

		// $tanggal = 
		$tanggal = $y."-".$m."-".$d;

		$query1 = $this->db->query("SELECT * FROM m_act WHERE
		id_pabrik = '$id_pabrik' AND tanggal = '$tanggal' AND mpp LIKE '%$mpp%'
		");

		$i = 0;

		$d = [];
		foreach ($query1->result() as $row){
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->id_station;
			$d[$i][1] .= "<br>".$row->id_unit;
			$d[$i][1] .= "<br>".$row->id_sub_unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->penyelesaian;
			$d[$i][4] = $row->start;
			$d[$i][5] = $row->stop;
			$d[$i++][6] = $row->status;
		}

		$nm = $query1->num_rows();
		if($nm>0){
			echo json_encode($d);
		}else{

			$query = $this->db->query("SELECT * FROM m_planing WHERE
			id_pabrik = '$id_pabrik' AND tanggal = '$tanggal' AND nama_mpp LIKE '%$mpp%'
			");
			$i = 0;

			$d = [];
			foreach ($query->result() as $row){
				$d[$i][0] = $row->no_wo;
				$d[$i][1] = $row->station;
				$d[$i][1] .= "<br>".$row->unit;
				$d[$i][1] .= "<br>".$row->sub_unit;
				$d[$i][2] = $row->problem;
				$d[$i][3] = $row->plan;
				$d[$i][4] = ""; //$row->start;
				$d[$i++][5] = ""; //$row->stop;
			}

			echo json_encode($d);
		}
	}

	public function simpan(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$mpp = $_REQUEST['mpp'];
		$data = $_REQUEST['data'];
		$d =[];
		$i = 0;
		$nama_id = "";

		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				# code...
				// echo $k; echo "="; echo $v; echo "\n";
				if($k == "name"){
					$n = explode("-", $v);
					$nama_id = $n[0];
				}else{
					// $x = explode("-", $v);
					if($nama_id=="area"){
						$x = explode("<br>", $v);

						$d[$i]['id_station'] = $x[0];
						$d[$i]['id_unit'] = $x[1];
						$d[$i]['id_sub_unit'] = $x[2];
					}else{
						$d[$i][$nama_id] = $v;
					}
				}
			}
			if($nama_id=="status"){ 
				$d[$i]['id_pabrik'] = $id_pabrik;
				$d[$i]['tanggal'] = $tanggal;
				$d[$i]['mpp'] = $mpp;
				$i++;
			}
		}

		// print_r($d);

		$query = $this->db->query("DELETE FROM m_act WHERE
		id_pabrik = '$id_pabrik' AND tanggal = '$tanggal' AND mpp LIKE '%$mpp%'
		");

		foreach ($d as $ky => $val) {
			$data = $val;
			$this->db->insert('m_act', $data);
		}

		echo "ok";

	}	


	public function station_ajax_dropdown(){
		$id_pabrik = $this->uri->segment(3, 0);
		$query = $this->db->query("SELECT nama FROM master_station where id_pabrik = '$id_pabrik';");
		foreach ($query->result() as $row)
		{
			echo "<option>".$row->nama."</option>";
		}
	}	

	public function unit_ajax_dropdown_sub(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode( $this->uri->segment(4, 0) );
		$query = $this->db->query("SELECT nama FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station';");
		foreach ($query->result() as $row)
		{
			echo "<option>".$row->nama."</option>";
		}
	}

	public function sub_unit_ajax_dropdown(){
		$id_pabrik = $this->uri->segment(3, 0);
		$id_station = urldecode($this->uri->segment(4, 0));
		$id_unit = urldecode($this->uri->segment(5, 0));

		$query = $this->db->query("SELECT nama FROM master_sub_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND id_unit = '$id_unit';");
		foreach ($query->result() as $row)
		{
			echo "<option>".$row->nama."</option>";
		}
	}

	public function ajax_load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$d = $_REQUEST['d'];
		$m = $_REQUEST['m'];
		$y = $_REQUEST['y'];
		// $mpp = $_REQUEST['mpp'];

		// $tanggal = 
		$tanggal = $y."-".$m."-".$d;

		$query1 = $this->db->query("SELECT * FROM m_act WHERE
		id_pabrik = '$id_pabrik' AND tanggal = '$tanggal'");

		$i = 0;

		$d = [];
		foreach ($query1->result() as $row){
			$d[$i][0] = $row->mpp;
			$d[$i][1] = $row->no_wo;
			$d[$i][2] = $row->id_station;
			$d[$i][2] .= "<br>".$row->id_unit;
			$d[$i][2] .= "<br>".$row->id_sub_unit;
			$d[$i][3] = $row->problem;
			$d[$i][4] = $row->penyelesaian;
			$d[$i][5] = $row->start;
			$d[$i][6] = $row->stop;
			$d[$i++][7] = $row->status;
		}

		$nm = $query1->num_rows();
		if($nm>0){
			echo json_encode($d);
		}else{

			// $query = $this->db->query("SELECT * FROM m_planing WHERE
			// id_pabrik = '$id_pabrik' AND tanggal = '$tanggal' AND nama_mpp LIKE '%$mpp%'
			// ");
			// $i = 0;

			// $d = [];
			// foreach ($query->result() as $row){
			// 	$d[$i][0] = $row->no_wo;
			// 	$d[$i][1] = $row->station;
			// 	$d[$i][1] .= "<br>".$row->unit;
			// 	$d[$i][1] .= "<br>".$row->sub_unit;
			// 	$d[$i][2] = $row->problem;
			// 	$d[$i][3] = $row->plan;
			// 	$d[$i][4] = ""; //$row->start;
			// 	$d[$i++][5] = ""; //$row->stop;
			// }

			// echo json_encode($d);
		}
	}


}

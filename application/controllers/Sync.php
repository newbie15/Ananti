<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync extends CI_Controller {

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

	}

	public function master_pabrik(){
		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			// $this->db->query("TRUNCATE TABLE `master_pabrik`");
			foreach ($data as $key => $value) {
				$this->db->set('nama', $value[1]);
				$this->db->set('kapasitas', $value[2]);
				$this->db->set('area', $value[3]);
				$this->db->set('sync', 2);
				$this->db->where('nama', $value[1]);
				$this->db->update('master_pabrik'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
				// $this->db->insert('master_pabrik', $data);
			}
		}
		echo "ok";
		// print_r($_REQUEST);
	}

	public function master_station(){
		$pabrik = $this->uri->segment(3, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $clone->transStart();

			$clone->query("DELETE FROM `master_station` where id_pabrik = '$pabrik' and sync=0");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $clone->insert
				$data = array(
					'id_pabrik' => $pabrik,
					'nama' => ucwords($value[2]),
					'sync' => 2,
				);
				// print_r($data);
				$clone->insert('master_station', $data);
			}
			
			// $clone->transComplete();
		}
		echo "ok";		
	}
	
	public function master_unit(){
		$pabrik = $this->uri->segment(3, 0);
		$station = $this->uri->segment(4, 0);


		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->trans_start();

			$this->db->query("DELETE FROM `master_unit` where id_pabrik = '$pabrik' and id_station = '$station' and sync=0 ");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $this->db->insert
				$data = array(
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'kode_asset' => $value[3],
					'nama' => ucwords($value[4]),
					'sync' => 2,
				);
				// print_r($data);
				$this->db->insert('master_unit', $data);
			}
			
			$this->db->trans_complete();
		}
		echo "ok";		
	}

	public function master_sub_unit(){
		$pabrik = $this->uri->segment(3, 0);
		$station = $this->uri->segment(4, 0);
		$unit = $this->uri->segment(5, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->trans_start();

			$this->db->query("DELETE FROM `master_sub_unit` where id_pabrik = '$pabrik' and id_station = '$station' and id_unit = '$unit' and sync=0 ");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $this->db->insert
				$data = array(
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'id_unit' => $unit,
					'nama' => ucwords($value[3]),
					'klasifikasi' => $value[4],
					'critical_unit' => $value[5],
					'hourmeter_mod' => $value[6],
					'vibration_mod' => $value[7],
					'temperature_mod' => $value[8],
					'oiling_mod' => $value[9],
					'electromotor_mod' => $value[10],
				);
				// print_r($data);
				$this->db->insert('master_sub_unit', $data);
			}
			
			$this->db->trans_complete();
		}
		echo "ok";

	}
	
	public function master_user(){}

	public function master_karyawan(){
		$pabrik = $this->uri->segment(3, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `master_karyawan` where id_pabrik = '$pabrik' and sync=0 ");
			$data_json = $_REQUEST['data_json'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $this->db->insert
				$data = array(
					'id_pabrik' => $pabrik,
					'nama' => ucwords($value[0]),
					'sync' => 2,
				);
				// print_r($data);
				$this->db->insert('master_karyawan', $data);
			}
			
			$this->db->transComplete();
		}
		echo "ok";

	}

	public function m_wo(){
		$pabrik = $this->uri->segment(3, 0);
		$tanggal = $this->uri->segment(4, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $this->db->transStart();

			$clone->query("DELETE FROM `m_wo` where id_pabrik = '$pabrik' and tanggal='$tanggal'");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $this->db->insert
				if($value[13]==null){
					$value[13] = "0000-00-00";
				}

				$data = array(
					'id_pabrik' => $value[1],
					'tanggal' => $value[2],
					'no_wo' => $value[3],
					'station' => $value[4],
					'unit' => $value[5],
					'sub_unit' => $value[6],
					'problem' => $value[7],
					'desc_masalah' => $value[8],
					'hm' => $value[9],
					'kategori' => $value[10],
					'tipe' => $value[11],
					'status' => $value[12],
					'tanggal_closing' => $value[13],
					'sync' => '1'
				);
				// print_r($data);
				$clone->insert('m_wo', $data);
			}
			
			// $this->db->transComplete();
		}
		echo "ok";

	}
	
	public function m_planing(){
		$pabrik = $this->uri->segment(3, 0);
		$tanggal = $this->uri->segment(4, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $this->db->transStart();

			$clone->query("DELETE FROM `m_planing` where id_pabrik = '$pabrik' and tanggal='$tanggal'");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				// $this->db->insert
				// if($value[13]==null){
				// 	$value[13] = "0000-00-00";
				// }

				$data = array(
					'tanggal' => $tanggal,
					'id_pabrik' => $pabrik,
					'no_wo' => $value[3],
					'station' => $value[4],
					'unit' => $value[5],
					'sub_unit' => $value[6],
					'problem' => $value[7],
					'plan' => $value[8],
					'mpp' => $value[9],
					'nama_mpp' => $value[10],
					'mek_el' => $value[11],
					'start' => $value[12],
					'stop' => $value[13],
					'time' => $value[14],
					'istirahat' => $value[15],
					'tipe' => $value[16],
					'ket' => $value[17],
					'sync' => 2,
				);
				// print_r($data);
				$clone->insert('m_planing', $data);
			}
			
			// $this->db->transComplete();
		}
		echo "ok";
	}

	public function m_activity(){
		$pabrik = $this->uri->segment(3, 0);
		$tanggal = $this->uri->segment(4, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $this->db->transStart();

			$clone->query("DELETE FROM `m_activity` where id_pabrik = '$pabrik' and tanggal='$tanggal'");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				$data = array(
					'id_pabrik' => $pabrik,
					'tanggal' => $tanggal,
					'no_wo' => $value[0],
					'perbaikan' => $value[1],
					'status_perbaikan' => $value[2],
					'sync' => 2,
				);
				if($value[0]!=""){
					$clone->insert('m_activity', $data);
					// array_push($datax,$data);
					
					if($value[2] == "Selesai"){
						$sql = "UPDATE
							m_wo
							SET 
							`status` = 'close',
							`sync` = 0,
							`tanggal_closing` = (CASE WHEN (`tanggal_closing` = '0000-00-00') THEN '$tanggal' ELSE `tanggal_closing` END)
							WHERE
							`no_wo` = '$value[0]'
						";
						$clone->query($sql);
					}
				}
			}
			
			// $this->db->transComplete();
		}
		echo "ok";		
	}

	public function m_activity_detail(){
		$pabrik = $this->uri->segment(3, 0);
		$tanggal = $this->uri->segment(4, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $this->db->transStart();

			$clone->query("DELETE FROM `m_activity_detail` where id_pabrik = '$pabrik' and tanggal='$tanggal'");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				$data = array(
					'id_pabrik' => $pabrik,
					'tanggal' => $tanggal,
					'no_wo' => $value[0],
					'nama_teknisi' => $value[1],
					'r_mulai' => $value[2],
					'r_selesai' => $value[3],
					'realisasi' => $value[4],
					'sync' => 2,
				);
				if($value[0]!=""){
					$clone->insert('m_activity_detail', $data);
				}
			}
			
			// $this->db->transComplete();
		}
		echo "ok";		
	}

	public function m_sparepart_usage(){
		$pabrik = $this->uri->segment(3, 0);
		$tanggal = $this->uri->segment(4, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		// print_r($data);

		$clone = $this->load->database('clone', TRUE);

		if(!empty($data)){
			// $this->db->transStart();

			$clone->query("DELETE FROM `m_sparepart_usage` where id_pabrik = '$pabrik' and tanggal='$tanggal'");
			$data_json = $_REQUEST['data'];
			$data = json_decode($data_json);
			foreach ($data as $key => $value) {
				$data = array(
					'id_pabrik' => $pabrik,
					'tanggal' => $tanggal,
					'no_wo' => $value[0],
					'material' => $value[1],
					'spek' => $value[2],
					'satuan' => $value[3],
					'qty' => $value[3],
					'cost' => $value[5],
					'sync' => 2,
				);
				if($value[0]!=""){
					$clone->insert('m_sparepart_usage', $data);
				}
			}
			
			// $this->db->transComplete();
		}
		echo "ok";		
	}

}

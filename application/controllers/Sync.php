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

	public function master_pabrik()
	{
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

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `master_unit` where id_pabrik = '$pabrik' and sync=0 ");
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
				$this->db->insert('master_unit', $data);
			}
			
			$this->db->transComplete();
		}
		echo "ok";		
	}

	public function master_sub_unit(){
		$pabrik = $this->uri->segment(3, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `master_sub_unit` where id_pabrik = '$pabrik' and sync=0 ");
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
				$this->db->insert('master_sub_unit', $data);
			}
			
			$this->db->transComplete();
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

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `m_wo` where id_pabrik = '$pabrik' and sync=0 ");
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
				$this->db->insert('m_wo', $data);
			}
			
			$this->db->transComplete();
		}
		echo "ok";

	}
	public function m_planing(){
		$pabrik = $this->uri->segment(3, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `m_planing` where id_pabrik = '$pabrik' and sync=0 ");
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
				$this->db->insert('m_planing', $data);
			}
			
			$this->db->transComplete();
		}
		echo "ok";
		
	}
	public function m_activity(){
		$pabrik = $this->uri->segment(3, 0);

		$data_json = $_REQUEST['data'];
		$data = json_decode($data_json);
		print_r($data);
		if(!empty($data)){
			$this->db->transStart();

			$this->db->query("DELETE FROM `m_activity` where id_pabrik = '$pabrik' and sync=0 ");
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
				$this->db->insert('m_activity', $data);
			}
			
			$this->db->transComplete();
		}
		echo "ok";		
	}

}

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
				// $this->db->insert
				// $data = array(
				// 	'nama' => $value[1],
				// 	'kapasitas' => $value[2],
				// 	'area' => $value[3],
				// 	'sync' => "2"
				// 	// 'date' => 'My date'
				// );
				// print_r($data);


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
	public function master_station(){}
	public function master_unit(){}
	public function master_sub_unit(){}
	public function master_user(){}
	public function master_karyawan(){}

	public function m_wo(){}
	public function m_planing(){}
	public function m_activity(){}

	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}
	// public function master_unit(){}


}

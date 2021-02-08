<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

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
	public function index(){
	}

	public function load(){
	}

	public function simpan(){
	}

	public function load_default(){
	}

	public function plan_schedule(){
		$id_pabrik = $this->uri->segment(3, 0);
		// echo $x = $this->uri->segment(4, 0);
		$tanggal = date("Y-m-");

		$query = $this->db->query(
			"SELECT `tanggal`,`no_wo`,
			-- `station`,`unit`,`sub_unit`,
			CONCAT(m_planing.station,'@',master_station.nama) AS station,
			CONCAT(m_planing.unit,'@',master_unit.nama) AS unit,
			CONCAT(m_planing.sub_unit,'@',master_sub_unit.nama) AS sub_unit,
			`problem`,`plan`,`start`,`stop`
			FROM `m_planing`,master_station,master_unit,master_sub_unit 
			WHERE m_planing.`id_pabrik` = '$id_pabrik' AND m_planing.`tanggal` LIKE '%$tanggal%'
			AND 		
			master_station.nomor = m_planing.station AND
			master_station.id_pabrik = m_planing.id_pabrik AND
			
			master_unit.nomor = m_planing.unit AND
			master_unit.id_pabrik = m_planing.id_pabrik AND
			master_unit.id_station = m_planing.station AND
			
			master_sub_unit.nomor = m_planing.sub_unit AND
			master_sub_unit.id_pabrik = m_planing.id_pabrik AND
			master_sub_unit.id_station = m_planing.station AND
			master_sub_unit.id_unit = m_planing.unit
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i]['title'] = $row->no_wo." / ".$row->station." | ".$row->unit." | ".$row->sub_unit."\n".$row->plan;

			if($row->start!=""){
				$d[$i]['start'] = $row->tanggal."T".$row->start.":00+07:00";
			}else{
				$d[$i]['start'] = $row->tanggal."";
			}
			if($row->stop!=""){
				$d[$i++]['end'] = $row->tanggal."T".$row->stop.":00+07:00";
			}else{
				$d[$i++]['end'] = $row->tanggal."";
			}
			// $d[$i++][10] = $row->ket;
		}
		echo json_encode($d);
	}
}

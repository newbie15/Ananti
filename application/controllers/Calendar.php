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
			"SELECT `tanggal`,`no_wo`,`station`,`unit`,`sub_unit`,`problem`,`plan`,`start`,`stop`
			FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND `tanggal` LIKE '%$tanggal%'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i]['title'] = $row->station." | ".$row->unit." | ".$row->sub_unit."\n".$row->plan;
			$d[$i]['start'] = $row->tanggal."T".$row->start.":00+07:00";
			$d[$i++]['end'] = $row->tanggal."T".$row->stop.":00+07:00";
			// $d[$i++][10] = $row->ket;
		}
		echo json_encode($d);
	}
}

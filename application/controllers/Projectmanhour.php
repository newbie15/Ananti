<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectmanhour extends CI_Controller {

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
		$output['content'] = "test";
		$output['main_title'] = "Planing Harian Maintenance";
		
		$header['css_files'] = [
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jcalendar.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jdropdown.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jdropdown.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/wbs/project-mh.js"),
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
		$this->load->view('content-project-manhour',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$query = $this->db->query(
			"SELECT `no_wo`,`station`,`unit`,`sub_unit`,`problem`,`plan`,`mpp`,`nama_mpp`,`mek_el`,`start`,`stop`,`tipe`,`ket`
			FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->station ."\n". $row->unit . "\n" . $row->sub_unit;
			$d[$i][2] = $row->problem;
			$d[$i][3] = $row->plan;
			$d[$i][4] = $row->mpp;
			$d[$i][5] = $row->nama_mpp;
			$d[$i][6] = $row->mek_el;
			$d[$i][7] = $row->start;
			$d[$i][8] = $row->stop;
			$d[$i][9] = $row->tipe;
			$d[$i++][10] = $row->ket;
		}
		echo json_encode($d);
	}

	public function load_mh(){
		$id_pabrik = $_REQUEST['id_pabrik'];

		$query = $this->db->query(
			"SELECT
			w_project.no_wo, w_project.project_id, w_project.pt, w_project.nama, w_project.deskripsi,
			(w_project.marking + w_project.cutting + w_project.machining + w_project.assembly + w_project.welding + w_project.painting + w_project.balancing + w_project.finishing + w_project.`install`) AS plan_mh
			,(SUM(w_activity.total_time)/60) AS real_mh 
			FROM w_project ,w_activity
			WHERE w_project.project_id = w_activity.project_id
			AND w_project.id_pabrik = '$id_pabrik' ;
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->project_id;
			$d[$i][2] = $row->pt;
			$d[$i][3] = $row->nama;
			$d[$i][4] = $row->deskripsi;
			$d[$i][5] = $row->plan_mh;
			$d[$i++][6] = round($row->real_mh,2);
		}
		echo json_encode($d);
	}

	


	public function download_plan_harian(){
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));
		$bulan = urldecode($this->uri->segment(5));
		$tanggal = urldecode($this->uri->segment(6));

		// $id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];

		$tanggal = $tahun."-".$bulan."-".$tanggal;


		$query = $this->db->query(
			"SELECT * FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");

		header('Content-Type: aplication/vnd-ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=PLAN_'.$id_pabrik.'_'.$tanggal.'.xls');

		echo "SITE\t";
		echo "TANGGAL\t";
		echo "NAMA KARYAWAN\t";
		echo "WO\t";
		echo "STATION\t";
		echo "UNIT\t";
		echo "SUB UNIT\t";
		echo "KATEGORI\t";
		echo "JAM START\t";
		echo "JAM STOP\t";
		echo "MAN HOUR\t";
		echo "SCOPE OF WORK";
		echo "\n";

		foreach ($query->result() as $row)
		{
			$nama = explode(";",$row->nama_mpp);
			foreach ($nama as $key => $value) {
				echo $row->id_pabrik; echo "\t";
				echo $row->tanggal; echo "\t";
				echo $value; echo "\t";
				echo $row->no_wo; echo "\t";
				echo $row->station; echo "\t";
				echo $row->unit; echo "\t";
				echo $row->sub_unit; echo "\t";
				echo $row->tipe; echo "\t";
				echo $row->start; echo "\t";
				echo $row->stop; echo "\t";
				echo $row->time; echo "\t";
				echo $row->plan; echo "\n";
			}
		}


	}
}

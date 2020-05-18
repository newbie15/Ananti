<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectactivity extends CI_Controller {

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
		$output['main_title'] = "Breakdown";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),

		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/wbs/project-activity.js"),
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
		
		$this->load->view('header',$header);
		$this->load->view('content-project-activity',$output);
		$this->load->view('footer',$footer);

	}



	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
			SELECT *
			FROM w_activity
			WHERE w_activity.id_pabrik = '$id_pabrik' AND w_activity.tanggal='$tanggal' 
			");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->project_id;
			$d[$i][1] = $row->pt;
			$d[$i][2] = $row->nama;
			$d[$i][3] = $row->activity;
			$d[$i][4] = $row->keterangan;
			$d[$i][5] = $row->mpp;
			$d[$i][6] = $row->start;
			$d[$i][7] = $row->stop;
			$d[$i++][8] = $row->total_time;
			// $d[$i++][3] = $row->jenis_problem;
		}
		echo json_encode($d);
	}

	public function load_detail()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,nama_teknisi,r_mulai,r_selesai,realisasi FROM m_activity_detail where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		$no_wo = "";
		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			if($no_wo!=$row->no_wo){
				$i = 0;
				$no_wo = $row->no_wo;
			}

			$jam = intval($row->realisasi / 60);
			$menit = ($row->realisasi % 60);

			if($jam<10){
				$jam = "0".$jam;
			}

			if($menit<10){
				$menit = "0".$menit;
			}

			$realisasi = $jam.":".$menit;

			$d[$row->no_wo][$i][0] = $row->nama_teknisi;
			// $d[$row->no_wo][$i][1] = $row->t_mulai;
			// $d[$row->no_wo][$i][2] = $row->t_selesai;
			$d[$row->no_wo][$i][1] = $row->r_mulai;
			$d[$row->no_wo][$i][2] = $row->r_selesai;
			$d[$row->no_wo][$i++][3] = $realisasi;

		}
		if($i>0){
			echo json_encode($d);
		}else{
			$query = $this->db->query("SELECT no_wo,nama_mpp FROM m_planing where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

			$no_wo = "";
			foreach ($query->result() as $row)
			{
				// $d[$i][0] = $row->nama; // access attributes
				if($no_wo!=$row->no_wo){
					$i = 0;
					$no_wo = $row->no_wo;
				}

				$nama = explode(";",$row->nama_mpp);
				$i = 0;
				foreach ($nama as $key => $value) {
					$d[$row->no_wo][$i][0] = $value;
					// $d[$row->no_wo][$i][1] = $row->t_mulai;
					// $d[$row->no_wo][$i][2] = $row->t_selesai;
					$d[$row->no_wo][$i][1] = "";
					$d[$row->no_wo][$i][2] = "";
					$d[$row->no_wo][$i++][3] = "";
				}
			}
			echo json_encode($d);
		}
	}

	public function load_sparepart()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,material,qty FROM m_sparepart_usage where no_wo LIKE '$id_pabrik%' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		$no_wo = "";
		foreach ($query->result() as $row)
		{
			if($no_wo!=$row->no_wo){
				$i = 0;
				$no_wo = $row->no_wo;
			}
			$d[$row->no_wo][$i][0] = $row->material;
			$d[$row->no_wo][$i++][1] = $row->qty;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$this->db->query("DELETE FROM `w_activity` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'project_id' => $value[0],
				'pt' => $value[1],
				'nama' => $value[2],
				'activity' => $value[3],
				'keterangan' => $value[4],
				'mpp' => $value[5],
				'start' => $value[6],
				'stop' => $value[7],
				'total_time' => $value[8],
				// 'status_perbaikan' => $value[3],
				// 'jenis_problem' => $value[3],
			);
			if($value[0]!=""){
				$this->db->insert('w_activity', $data);
			}
		}
	}
}

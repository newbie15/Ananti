<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

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
			base_url("assets/mdp/activity.js"),
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
		$this->load->view('content-activity',$output);
		$this->load->view('footer',$footer);

	}



	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
			SELECT m_activity.no_wo,
				CONCAT(station,'\n',unit,'\n',sub_unit,'\n',problem) as daftar,
				m_activity.perbaikan,
				m_activity.status_perbaikan
			FROM m_activity,m_wo
			WHERE m_activity.id_pabrik = '$id_pabrik' AND m_activity.tanggal='$tanggal' 
			AND m_activity.no_wo = m_wo.no_wo ;
			");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->daftar;
			$d[$i][2] = $row->perbaikan;
			$d[$i++][3] = $row->status_perbaikan;
			// $d[$i++][3] = $row->jenis_problem;
		}
		echo json_encode($d);
	}

	public function load_detail()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,nama_teknisi,t_mulai,t_selesai,r_mulai,r_selesai,realisasi FROM m_activity_detail where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

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
			$d[$row->no_wo][$i][0] = $row->nama_teknisi;
			// $d[$row->no_wo][$i][1] = $row->t_mulai;
			// $d[$row->no_wo][$i][2] = $row->t_selesai;
			$d[$row->no_wo][$i][1] = $row->r_mulai;
			$d[$row->no_wo][$i][2] = $row->r_selesai;
			$d[$row->no_wo][$i++][3] = $row->realisasi;
		}
		echo json_encode($d);
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
		$detail = json_decode($_REQUEST['detail']);
		$spare = json_decode($_REQUEST['sparepart']);

		$this->db->query("DELETE FROM `m_activity` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'no_wo' => $value[0],
				'perbaikan' => $value[2],
				'status_perbaikan' => $value[3],
				// 'jenis_problem' => $value[3],
			);
			if($value[0]!=""){
				$this->db->insert('m_activity', $data);
			}
		}

		$this->db->query("DELETE FROM `m_activity_detail` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		foreach ($detail as $key => $value) {
			if($key!="_empty_" && $key!="undefined"){
				foreach ($value as $ky => $val) {
					$data = array(
						'id_pabrik' => $pabrik,
						'tanggal' => $tanggal,
						'no_wo' => $key,
						'nama_teknisi' =>$val[0],
						't_mulai' => $val[1],
						't_selesai' => $val[2],
						// 'r_mulai' => $val[3],
						// 'r_selesai' => $val[4],
						'realisasi' => $val[3],
					);
					$this->db->insert('m_activity_detail', $data);
				}
			}
		}

		$this->db->query("DELETE FROM `m_sparepart_usage` where no_wo LIKE '$pabrik%' AND tanggal = '$tanggal' ");
		foreach ($spare as $key => $value) {
			if($key!="_empty_" && $key!="undefined"){
				foreach ($value as $ky => $val) {
					$data = array(
						'no_wo' => $key,
						'tanggal' =>$tanggal,
						'material' => $val[0],
						'qty' => $val[1],
					);
					$this->db->insert('m_sparepart_usage', $data);
				}
			}
		}
	}


}

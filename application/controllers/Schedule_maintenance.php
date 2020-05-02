<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_maintenance extends CI_Controller {

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
		$output['main_title'] = "Data Preventive Maintenance";
		
		$header['title'] = "Schedule Maintenance";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.css"),

			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),

			base_url("assets/fullcalendar-3.9.0/lib/moment.min.js"),
			base_url("assets/fullcalendar-3.9.0/fullcalendar.min.js"),
			base_url("assets/fullcalendar-3.9.0/locale-all.js"),

			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/schedule_maintenance.js"),
		];
		
		$output['content'] = '';
		
		$nama_pabrik = $this->session->user;
		$kategori = $this->session->kategori;

		$query = $this->db->query("SELECT nama FROM master_pabrik;");

		$output['dropdown_pabrik']= "";
		if($kategori<2){
			$output['dropdown_pabrik']= "<select style=\"width: -webkit-fill-available;\" id=\"pabrik\">";
		}else{
			$output['dropdown_pabrik']= "<select style=\"width: -webkit-fill-available;\" id=\"pabrik\" disabled>";
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
		$output['dropdown_station'] = "<select style=\"width: -webkit-fill-available;\" id=\"station\"></select>";		
		// $output['dropdown_unit'] = "<select style=\"width: -webkit-fill-available;\" id=\"unit\"></select>";		
		
		$this->load->view('header',$header);
		$this->load->view('content-schedule-maintenance',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$id_unit = $_REQUEST['id_unit'];

		$query = $this->db->query("SELECT monitoring_item,standard,parameter,frekuensi FROM master_schedule where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND id_unit = '$id_unit';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->monitoring_item;
			$d[$i][1] = $row->standard;
			$d[$i][2] = $row->parameter;
			$d[$i++][3] = $row->frekuensi;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$unit = $_REQUEST['unit'];

		$this->db->query("DELETE FROM `master_schedule` where id_pabrik = '$pabrik' AND id_station = '$station' AND id_unit = '$unit' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'id_station' => $station,
				'id_unit' => $unit,
				'monitoring_item' => $value[0],
				'standard' => $value[1],
				'parameter' => $value[2],
				'frekuensi' => $value[3],
			);
			// print_r($data);
			if($value[0]!=""){
				$this->db->insert('master_schedule', $data);
			}
		}
	}

	public function load_wo_unfinished()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $id_unit = $_REQUEST['id_unit'];

		$query = $this->db->query(
			"SELECT no_wo,station,unit,sub_unit,problem
			FROM m_wo
			where id_pabrik = '$id_pabrik' 
			AND station = '$id_station' 
			AND status = 'open';
		");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->station;
			$d[$i][2] = $row->unit;
			$d[$i][3] = $row->sub_unit;
			$d[$i++][4] = $row->problem;
		}
		echo json_encode($d);
	}

	public function event(){

	}
}

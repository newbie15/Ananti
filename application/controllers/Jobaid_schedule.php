<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobaid_schedule extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		// $this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
				// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Job Aid Schedule";
		
		$header['title'] = "Pabrik";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/jobaid_schedule.js"),
		];
		
		$output['content'] = '';

		$query = $this->db->query("SELECT * FROM aux_job_aid order by nomor asc;");

		$output['dropdown_jobaid']= "<select id=\"jobaid\">";
		
		foreach ($query->result() as $row)
		{
			$output['dropdown_jobaid'] = $output['dropdown_jobaid']."<option value=\"$row->nomor\">".$row->nomor." | ".$row->nama."</option>";
		}
		$output['dropdown_jobaid'] .= "/<select>";
		
		$this->load->view('header',$header);
		$this->load->view('content-job-aid-schedule',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$job_aid = $_REQUEST['jobaid'];
		$query = $this->db->query("SELECT * FROM aux_job_aid_schedule WHERE job_aid = '$job_aid'");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->work_exec; // access attributes
			$d[$i][1] = $row->frequency; // or methods defined on the 'User' class
			$d[$i][2] = $row->compliance; // or methods defined on the 'User' class
			$d[$i++][3] = $row->scope; // or methods defined on the 'User' class
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$job_aid = $_REQUEST['jobaid'];
		$this->db->query("DELETE FROM`aux_job_aid_schedule` WHERE `job_aid` = '$job_aid';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'job_aid' => $job_aid,
				'work_exec' => $value[0],
				'frequency' => $value[1],
				'compliance' => $value[2],
				'scope' => $value[3],
			);
			$this->db->insert('aux_job_aid_schedule', $data);
		}
	}

	public function ajax()
	{
		$query = $this->db->query("SELECT `nama`,`kategori`,`nomor` FROM aux_job_aid;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['name'] = $row->nomor." - [".$row->kategori."] ".$row->nama;
				$a['id'] = $row->nomor;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}		
}

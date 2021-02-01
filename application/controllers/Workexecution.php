<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workexecution extends CI_Controller {

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

		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
				// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Work Execution";
		
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

			base_url("assets/mdp/workexecution.js"),
		];
		
		$output['content'] = '';

		$crud = new grocery_CRUD();
 
		// Seriously! This is all the code you need!
		$crud->set_table('aux_work_execution'); 
		$output['crud'] = $crud->render();
		$header['crud'] = $output['crud']->css_files; 
		$footer['crud'] = $output['crud']->js_files; 		

		$this->load->view('header',$header);
		$this->load->view('content-work-execution',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$query = $this->db->query("SELECT nama,kapasitas,area FROM aux_work_execution;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->nama; // access attributes
			$d[$i][1] = $row->kapasitas; // or methods defined on the 'User' class
			$d[$i++][2] = $row->area; // or methods defined on the 'User' class
		}
		echo json_encode($d);


	}

	public function simpan()
	{
		$this->db->query("TRUNCATE TABLE `master_pabrik`");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'nama' => $value[0],
				'kapasitas' => $value[1],
				'area' => $value[2],
				// 'date' => 'My date'
			);
			// print_r($data);
			$this->db->insert('aux_work_execution', $data);
		}
	}

	public function ajax()
	{
		$query = $this->db->query("SELECT `nama`,`mode`,`nomor` FROM aux_work_execution;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
				// $d[$i][0] = $row->nama; // access attributes
				$a['name'] = $row->nomor." - [".$row->mode."] ".$row->nama;
				$a['id'] = $row->nomor;
				$d[$i++] = $a;
		}
		echo json_encode($d);
	}		
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pabrik extends CI_Controller {

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
		$output['main_title'] = "Data Pabrik Astra Agro Lestari";
		
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

			base_url("assets/mdp/pabrik.js"),
		];
		
		$output['content'] = '';
		
		$this->load->view('header',$header);
		$this->load->view('content-pabrik',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
		$query = $this->db->query("SELECT nama,tipe FROM master_pabrik;");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->nama; // access attributes
			$d[$i++][1] = $row->tipe; // or methods defined on the 'User' class
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
				'tipe' => $value[1],
				// 'date' => 'My date'
			);
			// print_r($data);
			$this->db->insert('master_pabrik', $data);
		}
	}
}

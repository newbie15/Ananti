<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasheet extends CI_Controller {

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
		$output['main_title'] = "Datasheet";
		
		$header['title'] = "Datasheet";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),

			base_url("assets/mdp/datasheet.js"),
		];
		
		$output['content'] = '';
		
		$this->load->view('header',$header);
		$this->load->view('content-datasheet',$output);
		$this->load->view('footer',$footer);
	}

	public function load()
	{
	}

	public function simpan()
	{
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contoh extends CI_Controller {

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
		// if($this->session->user == ""){
		// 	redirect('/login');		
		// }else{
		// 	redirect('/main');
		// }
		$header['css_files'] = [
			// base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/datatables/css/jquery.jexcel.css"),
			base_url("assets/datatables/css/jquery.jexcel.bootstrap.css"),
			base_url("assets/datatables/css/jquery.jcalendar.css"),
			base_url("assets/datatables/css/jquery.jexcel.green.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/js/jquery.csv.min.js"),
			base_url("assets/jexcel/js/numeral.min.js"),
			base_url("assets/jexcel/js/excel-formula.min.js"),
			base_url("assets/mdp/contoh.js"),
		];

		$this->load->view('header',$header);
		$this->load->view('contoh-jexcel');
		$this->load->view('footer',$footer);
	}
}

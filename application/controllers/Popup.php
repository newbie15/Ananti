<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends CI_Controller {

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
	}

	public function pick_wo()
	{
		$output['content'] = "test";
		$output['main_title'] = "Pilih WO / Buat WO";
		
		$header['title'] = "Realisasi";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
			// base_url("assets/datatables/css/jquery.dataTables.min.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			// base_url("assets/jexcel/js/jquery.mask.min.js"),
			// base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/pick_wo.js"),
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


		$output['dropdown_station'] = "<select id=\"station\"></select>";		
		$output['dropdown_unit'] = "<select id=\"unit\"></select>";		
		$output['dropdown_sub_unit'] = "<select id=\"sub_unit\"></select>";	

		$footer['js_tambahan'] = "
			
		";

		$this->load->view('header-less',$header);
		$this->load->view('content-pick_wo',$output);
		$this->load->view('footer-less',$footer);
	}

	public function simpan()
	{
	}

	public function load_problem(){
	}

	public function problem()
	{
	}

}

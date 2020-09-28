<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ik extends CI_Controller {

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
		// $this->load->helper('download');

	}
	
	public function index()
	{
		$output['content'] = "test";
		$output['main_title'] = "Instruksi Kerja";
		
		$header['title'] = "Instruksi Kerja";
		$header['css_files'] = [
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/ik.js"),
		];
		
		$output['content'] = '';
		
		$this->load->view('header',$header);
		$this->load->view('content-ik',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$filename = $this->uri->segment(3, 0);

		$output['config'] = base_url("assets/mdp/config.js");
		$output['global'] = base_url("assets/mdp/global.js");
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "ik";
		$output['filename'] = $filename;

		$this->load->view('pdf-viewer', $output);
	}

	public function upload(){
		if (!empty($_FILES['file']['name'])) {

			// Set preference
			$config['upload_path'] = 'assets/uploads/ik/';
			$config['allowed_types'] = 'pdf';
			// $config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}
	}

	public function list_ik(){
		$f = getcwd();

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$dir = $f . "\assets\uploads\ik";
		}else{
			$dir = $f . "/assets/uploads/ik";
		}

		// Sort in ascending order - this is default
		$a = scandir($dir);
		array_splice($a,0,2);
		echo (json_encode($a));
	}
}

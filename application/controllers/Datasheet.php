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
		// $this->load->helper('download');

	}
	
	public function index()
	{
		$output['content'] = "test";
		$output['main_title'] = "Datasheet";
		
		$header['title'] = "Datasheet";
		$header['css_files'] = [
			base_url("assets/datatables/css/jquery.dataTables.min.css"),
			base_url("assets/dropzonejs/dropzone.min.css"),
		];

		$footer['js_files'] = [
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/dropzonejs/dropzone.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/datasheet.js"),
		];
		
		$output['content'] = '';
		
		$this->load->view('header',$header);
		$this->load->view('content-datasheet',$output);
		$this->load->view('footer',$footer);
	}

	public function load(){
		$filename = $this->uri->segment(3, 0);

		$output['config'] = base_url("assets/mdp/config.js");
		$output['global'] = base_url("assets/mdp/global.js");
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "datasheet";
		$output['filename'] = $filename;

		$ext = explode(".", $filename);
		if (strtolower($ext[1]) == "pdf") {
			$this->load->view('pdf-viewer', $output);
		} else if (strtolower($ext[1]) == "jpeg" | strtolower($ext[1]) == "jpg" | strtolower($ext[1]) == "png" | strtolower($ext[1]) == "bmp") {
			$this->load->view('img-viewer', $output);
		} else {
			$this->load->view('file-downloader', $output);
		}
	}

	public function download()
	{
		$filename = $this->uri->segment(3, 0);

		$output['config'] = base_url("assets/mdp/config.js");
		$output['global'] = base_url("assets/mdp/global.js");
		$output['js'] = base_url("assets/pdfobject/pdfobject.min.js");
		$output['dokumen'] = "datasheet";
		$output['filename'] = $filename;

		$this->load->helper('download');

		$f = getcwd();
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$dir = $f . "\assets\uploads\datasheet\\" . $filename;
		} else {
			$dir = $f . "/assets/uploads/datasheet/" . $filename;
		}

		force_download($dir, NULL);
	}

	public function delete(){
		$filename = $this->uri->segment(3, 0);

		$path = "assets/uploads/datasheet/".$filename;
		unlink($path);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function upload(){
		if (!empty($_FILES['file']['name'])) {

			// Set preference
			$config['upload_path'] = 'assets/uploads/datasheet/';
			$config['allowed_types'] = 'pdf|jpeg|jpg|bmp|png|docx|xlsx|doc|xls|ppt|pptx';
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

	public function list_datasheet(){
		$f = getcwd();

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$dir = $f . "\assets\uploads\datasheet";
		}else{
			$dir = $f . "/assets/uploads/datasheet";
		}

		// Sort in ascending order - this is default
		$a = scandir($dir);
		array_splice($a,0,2);
		echo (json_encode($a));
	}
}

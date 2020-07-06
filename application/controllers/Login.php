<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('login');

	}

	public function signin()
	{
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user', $user);
		$this->db->where('password', $pass);
		$query = $this->db->get();

		@$row = $query->row();
		
		if($query->num_rows() > 0){
			if($row->user == $user AND $row->password == $pass){
				$u = explode("_",$user);
				if(count($u)>1){
					$this->session->user = $u[1];
					$this->session->kategori = $row->kategori;
					redirect("woprocess");
				}else{
					$this->session->user = $user;
					$this->session->kategori = $row->kategori;
					redirect("main");
				}
				// $this->session->kategori = $row->kategori;
				// redirect("main");
				// echo "redirect";
			}
		}else{
			// echo "gak redirect";
			redirect("login");
		}
	}

	public function signout(){
		$this->session->user = "";
		$this->session->kategori = "";
		redirect("login");
	}

	public function cek_session(){
		echo "?".$this->session->user;
	}
}

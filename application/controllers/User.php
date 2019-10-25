<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$output['main_title'] = "Data User";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/user.js"),
		];
		
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
		
		$this->load->view('header',$header);
		$this->load->view('content-user',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$kategori = $this->session->kategori;
		$user = $this->session->user;
		$query = "";

		if($kategori>1){
			$query = $this->db->query("SELECT user,password,kategori FROM user where user = '$user' AND kategori >= $kategori");
		}else{
			$query = $this->db->query("SELECT user,password,kategori FROM user where kategori >= $kategori");
		}

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->user;
			$d[$i][1] = $row->password;
			$d[$i++][2] = $row->kategori;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		echo $kategori = $this->session->kategori;
		$user = $this->session->user;
		$query = "";
		
		if($kategori=='0'){
			$this->db->query("DELETE FROM `user`");
			echo "DELETE FROM `user`";
		}else if($kategori=='1'){
			$this->db->query("DELETE FROM `user` where kategori >= $kategori");
			echo "DELETE FROM `user` where kategori >= $kategori";
		}else if($kategori=='2'){
			$this->db->query("DELETE FROM `user` where user = '$user' AND kategori >= $kategori");
			echo "DELETE FROM `user` where user = '$user' AND kategori >= $kategori";
		}

		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'user' => $value[0],
				'password' => $value[1],
				'kategori' => $value[2],
			);
			$this->db->insert('user', $data);
		}
	}

}

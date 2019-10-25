<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

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
		$output['main_title'] = "Inventory";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/numeral.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/inventory.js"),
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
		$this->load->view('content-inventory',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT bulan,norma_min,norma_max,nilai_stok,shortage,normal,excess,undefined FROM m_inventory where id_pabrik = '$id_pabrik' AND tahun='$tahun';");

		$i = 0;
		$d = [];

		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			$d[$i][0] = $row->bulan; 
			$d[$i][1] = $row->norma_min; 
			$d[$i][2] = $row->norma_max; 
			$d[$i][3] = $row->nilai_stok; 
			$d[$i][4] = $row->shortage; 
			$d[$i][5] = $row->normal; 
			$d[$i][6] = $row->excess; 
			$d[$i++][7] = $row->undefined; 
			// $d[$i][8] = $row->due_date; 
			// $d[$i][9] = $row->PIC; 
			// $d[$i][10] = $row->kategori_progress; 
			// $d[$i++][11] = $row->progress; 
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `m_inventory` where id_pabrik = '$pabrik' AND tahun='$tahun';");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'bulan' => $value[0], 
				'norma_min' => $value[1], 
				'norma_max' => $value[2], 
				'nilai_stok' => $value[3], 
				'shortage' => $value[4], 
				'normal' => $value[5], 
				'excess' => $value[6], 
				'undefined' => $value[7] 
			);
			if($value[0]!=""){
				$this->db->insert('m_inventory', $data);
			}
		}
	}


}

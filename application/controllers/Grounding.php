<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grounding extends CI_Controller {

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
	public function __construct($config = 'rest')
	{
 		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
	}

	public function index()
	{
		// $this->load->view('welcome_message');

		$output['content'] = "test";
		$output['main_title'] = "Data Grounding";
		
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
			base_url("assets/mdp/grounding.js"),
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
		// $output['dropdown_station'] = "<select id=\"station\"></select>";		
		
		$this->load->view('header',$header);
		$this->load->view('content-grounding',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT titik_pengukuran,bak_kontrol,jan,feb,mar,apr,mei,jun,jul,agt,sep,okt,nov,des,keterangan FROM m_grounding where id_pabrik = '$id_pabrik' AND tahun = '$tahun';");
		
		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->titik_pengukuran;
			$d[$i][1] = $row->bak_kontrol;
			$d[$i][2] = $row->jan;
			$d[$i][3] = $row->feb;
			$d[$i][4] = $row->mar;
			$d[$i][5] = $row->apr;
			$d[$i][6] = $row->mei;
			$d[$i][7] = $row->jun;
			$d[$i][8] = $row->jul;
			$d[$i][9] = $row->agt;
			$d[$i][10] = $row->sep;
			$d[$i][11] = $row->okt;
			$d[$i][12] = $row->nov;
			$d[$i][13] = $row->des;
			$d[$i++][14] = $row->keterangan;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `m_grounding` where id_pabrik = '$pabrik' AND tahun = '$tahun' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'titik_pengukuran' => $value[0],
				'bak_kontrol' => $value[1],
				'jan' => str_replace(',','.',$value[2]),
				'feb' => str_replace(',','.',$value[3]),
				'mar' => str_replace(',','.',$value[4]),
				'apr' => str_replace(',','.',$value[5]),
				'mei' => str_replace(',','.',$value[6]),
				'jun' => str_replace(',','.',$value[7]),
				'jul' => str_replace(',','.',$value[8]),
				'agt' => str_replace(',','.',$value[9]),
				'sep' => str_replace(',','.',$value[10]),
				'okt' => str_replace(',','.',$value[11]),
				'nov' => str_replace(',','.',$value[12]),
				'des' => str_replace(',','.',$value[13]),
				'keterangan' => $value[14],
			);
			$this->db->insert('m_grounding', $data);
		}
	}
}

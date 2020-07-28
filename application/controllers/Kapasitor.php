<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapasitor extends CI_Controller {

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
		$output['main_title'] = "Data Kapasitor Bank";
		
		$header['title'] = "Kapasitor";
		$header['css_files'] = [
			// base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/v2.1.0/css/jquery.jexcel.css"),
			base_url("assets/jquery-ui-1.12.1/jquery-ui.min.css")
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$header['customcss'] = "
.ui-dialog, .ui-dialog-content {
	box-sizing: content-box;
	border-color: red;
}		
";		
		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			// base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/v2.1.0/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/numeral.min.js"),
			base_url("assets/jquery-ui-1.12.1/jquery-ui.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/kapasitor.js"),
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
		$this->load->view('content-kapasitor',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tahun = $_REQUEST['tahun'];

		$query = $this->db->query("SELECT kapasitor,kvar,jan_r,jan_s,jan_t,feb_r,feb_s,feb_t,mar_r,mar_s,mar_t,apr_r,apr_s,apr_t,mei_r,mei_s,mei_t,jun_r,jun_s,jun_t,jul_r,jul_s,jul_t,agt_r,agt_s,agt_t,sep_r,sep_s,sep_t,okt_r,okt_s,okt_t,nov_r,nov_s,nov_t,des_r,des_s,des_t,keterangan FROM m_kapasitor where id_pabrik = '$id_pabrik' AND tahun = '$tahun';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->kapasitor;
			$d[$i][1] = $row->kvar;
			$d[$i][2] = $row->jan_r;
			$d[$i][3] = $row->jan_s;
			$d[$i][4] = $row->jan_t;
			$d[$i][5] = $row->feb_r;
			$d[$i][6] = $row->feb_s;
			$d[$i][7] = $row->feb_t;
			$d[$i][8] = $row->mar_r;
			$d[$i][9] = $row->mar_s;
			$d[$i][10] = $row->mar_t;
			$d[$i][11] = $row->apr_r;
			$d[$i][12] = $row->apr_s;
			$d[$i][13] = $row->apr_t;
			$d[$i][14] = $row->mei_r;
			$d[$i][15] = $row->mei_s;
			$d[$i][16] = $row->mei_t;
			$d[$i][17] = $row->jun_r;
			$d[$i][18] = $row->jun_s;
			$d[$i][19] = $row->jun_t;
			$d[$i][20] = $row->jul_r;
			$d[$i][21] = $row->jul_s;
			$d[$i][22] = $row->jul_t;
			$d[$i][23] = $row->agt_r;
			$d[$i][24] = $row->agt_s;
			$d[$i][25] = $row->agt_t;
			$d[$i][26] = $row->sep_r;
			$d[$i][27] = $row->sep_s;
			$d[$i][28] = $row->sep_t;
			$d[$i][29] = $row->okt_r;
			$d[$i][30] = $row->okt_s;
			$d[$i][31] = $row->okt_t;
			$d[$i][32] = $row->nov_r;
			$d[$i][33] = $row->nov_s;
			$d[$i][34] = $row->nov_t;
			$d[$i][35] = $row->des_r;
			$d[$i][36] = $row->des_s;
			$d[$i][37] = $row->des_t;
			$d[$i][38] = $row->keterangan;

			for($j=2;$j<=37;$j++){
				if($d[$i][$j]==0){
					$d[$i][$j] = "";
				}
			}
			$i++;

		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tahun = $_REQUEST['tahun'];

		$this->db->query("DELETE FROM `m_kapasitor` where id_pabrik = '$pabrik' AND tahun = '$tahun' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		foreach ($data as $key => $value) {
			$data = array(
				'id_pabrik' => $pabrik,
				'tahun' => $tahun,
				'kapasitor' => $value[0],
				'kvar' => $value[1],
				'jan_r' => str_replace(',','.',$value[2]),
				'jan_s' => str_replace(',','.',$value[3]),
				'jan_t' => str_replace(',','.',$value[4]),
				'feb_r' => str_replace(',','.',$value[5]),
				'feb_s' => str_replace(',','.',$value[6]),
				'feb_t' => str_replace(',','.',$value[7]),
				'mar_r' => str_replace(',','.',$value[8]),
				'mar_s' => str_replace(',','.',$value[9]),
				'mar_t' => str_replace(',','.',$value[10]),
				'apr_r' => str_replace(',','.',$value[11]),
				'apr_s' => str_replace(',','.',$value[12]),
				'apr_t' => str_replace(',','.',$value[13]),
				'mei_r' => str_replace(',','.',$value[14]),
				'mei_s' => str_replace(',','.',$value[15]),
				'mei_t' => str_replace(',','.',$value[16]),
				'jun_r' => str_replace(',','.',$value[17]),
				'jun_s' => str_replace(',','.',$value[18]),
				'jun_t' => str_replace(',','.',$value[19]),
				'jul_r' => str_replace(',','.',$value[20]),
				'jul_s' => str_replace(',','.',$value[21]),
				'jul_t' => str_replace(',','.',$value[22]),
				'agt_r' => str_replace(',','.',$value[23]),
				'agt_s' => str_replace(',','.',$value[24]),
				'agt_t' => str_replace(',','.',$value[25]),
				'sep_r' => str_replace(',','.',$value[26]),
				'sep_s' => str_replace(',','.',$value[27]),
				'sep_t' => str_replace(',','.',$value[28]),
				'okt_r' => str_replace(',','.',$value[29]),
				'okt_s' => str_replace(',','.',$value[30]),
				'okt_t' => str_replace(',','.',$value[31]),
				'nov_r' => str_replace(',','.',$value[32]),
				'nov_s' => str_replace(',','.',$value[33]),
				'nov_t' => str_replace(',','.',$value[34]),
				'des_r' => str_replace(',','.',$value[35]),
				'des_s' => str_replace(',','.',$value[36]),
				'des_t' => str_replace(',','.',$value[37]),
				'keterangan' => $value[38],
			);
			$this->db->insert('m_kapasitor', $data);
		}
	}
}

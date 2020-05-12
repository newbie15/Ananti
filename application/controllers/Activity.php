<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

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
		$output['main_title'] = "Breakdown";
		
		$header['title'] = "Realisasi";
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			// base_url("assets/jexcel/css/jquery.jcalendar.css"),
			base_url("assets/datatables/css/jquery.dataTables.min.css"),

		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			// base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/jexcel/js/jquery.mask.min.js"),
			base_url("assets/datatables/js/jquery.dataTables.min.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/activity.js"),
		];

		$footer['js_tambahan'] = "
			
		";
		
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
		
		$this->load->view('header',$header);
		$this->load->view('content-activity',$output);
		$this->load->view('footer',$footer);

	}



	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("
			SELECT m_activity.no_wo,
				CONCAT(station,'\n',unit,'\n',sub_unit,'\n',problem) as daftar,
				m_activity.perbaikan,
				m_activity.status_perbaikan
			FROM m_activity,m_wo
			WHERE m_activity.id_pabrik = '$id_pabrik' AND m_activity.tanggal='$tanggal' 
			AND m_activity.no_wo = m_wo.no_wo ;
			");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->no_wo;
			$d[$i][1] = $row->daftar;
			$d[$i][2] = $row->perbaikan;
			$d[$i++][3] = $row->status_perbaikan;
			// $d[$i++][3] = $row->jenis_problem;
		}
		echo json_encode($d);
	}

	public function load_detail()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,nama_teknisi,r_mulai,r_selesai,realisasi FROM m_activity_detail where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		$no_wo = "";
		foreach ($query->result() as $row)
		{
			// $d[$i][0] = $row->nama; // access attributes
			if($no_wo!=$row->no_wo){
				$i = 0;
				$no_wo = $row->no_wo;
			}

			$jam = intval($row->realisasi / 60);
			$menit = ($row->realisasi % 60);

			if($jam<10){
				$jam = "0".$jam;
			}

			if($menit<10){
				$menit = "0".$menit;
			}

			$realisasi = $jam.":".$menit;

			$d[$row->no_wo][$i][0] = $row->nama_teknisi;
			// $d[$row->no_wo][$i][1] = $row->t_mulai;
			// $d[$row->no_wo][$i][2] = $row->t_selesai;
			$d[$row->no_wo][$i][1] = $row->r_mulai;
			$d[$row->no_wo][$i][2] = $row->r_selesai;
			$d[$row->no_wo][$i++][3] = $realisasi;

		}
		// echo $i;
		$nm = $query->num_rows();
		if($nm>0){
			echo json_encode($d);
		}else{
			$query = $this->db->query("SELECT no_wo,nama_mpp,`start`,`stop`,`time` FROM m_planing where id_pabrik = '$id_pabrik' AND tanggal='$tanggal';");

			$no_wo = "";
			foreach ($query->result() as $row)
			{
				// $d[$i][0] = $row->nama; // access attributes
				if($no_wo!=$row->no_wo){
					$i = 0;
					$no_wo = $row->no_wo;
				}

				$nama = explode(";",$row->nama_mpp);
				$startx = $row->start;
				$stopx = $row->stop;

				$jam = intval($row->time / 60);
				$menit = $row->time % 60;
				
				$jam < 10 ? $jam = "0".$jam : null;
				$menit < 10 ? $menit = "0".$menit : null;

				$time = $jam.":".$menit;

				$i = 0;
				foreach ($nama as $key => $value) {
					$d[$row->no_wo][$i][0] = $value;
					// $d[$row->no_wo][$i][1] = $row->t_mulai;
					// $d[$row->no_wo][$i][2] = $row->t_selesai;
					$d[$row->no_wo][$i][1] = $startx;
					$d[$row->no_wo][$i][2] = $stopx;
					$d[$row->no_wo][$i++][3] = $time;
				}
			}
			echo json_encode($d);
		}
	}

	public function load_sparepart()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT no_wo,material,qty FROM m_sparepart_usage where no_wo LIKE '$id_pabrik%' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		$no_wo = "";
		foreach ($query->result() as $row)
		{
			if($no_wo!=$row->no_wo){
				$i = 0;
				$no_wo = $row->no_wo;
			}
			$d[$row->no_wo][$i][0] = $row->material;
			$d[$row->no_wo][$i++][1] = $row->qty;
		}
		echo json_encode($d);
	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];
		$detail = json_decode($_REQUEST['detail']);
		$spare = json_decode($_REQUEST['sparepart']);
		$this->db->trans_start();
		$this->db->query("DELETE FROM `m_activity` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$data_json = $_REQUEST['data_json'];
		$data = json_decode($data_json);
		$datax = array();
		foreach ($data as $key => $value) {
			// $this->db->insert
			$data = array(
				'id_pabrik' => $pabrik,
				'tanggal' => $tanggal,
				'no_wo' => $value[0],
				'perbaikan' => $value[2],
				'status_perbaikan' => $value[3],
			);
			if($value[0]!=""){
				// $this->db->insert('m_activity', $data);
				array_push($datax,$data);
				
				if($value[3] == "Selesai"){
					$sql = "UPDATE
						m_wo
						SET 
						`status` = 'close',
						`sync` = 0,
						`tanggal_closing` = (CASE WHEN (`tanggal_closing` = '0000-00-00') THEN '$tanggal' ELSE `tanggal_closing` END)
						WHERE
						`no_wo` = '$value[0]'
					";

					$this->db->query($sql);

				}
			}
		}
		$this->db->insert_batch('m_activity', $datax);


		$this->db->query("DELETE FROM `m_activity_detail` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' ");
		$datax = array();
		foreach ($detail as $key => $value) {
			if($key!="_empty_" && $key!="undefined"){
				foreach ($value as $ky => $val) {

					$tm = explode(":",$val[3]);
					$realisasi = ($tm[0] * 60) + $tm[1]; // jam dalam bentuk menit

					$data = array(
						'id_pabrik' => $pabrik,
						'tanggal' => $tanggal,
						'no_wo' => $key,
						'nama_teknisi' =>$val[0],
						// 't_mulai' => $val[1],
						// 't_selesai' => $val[2],
						'r_mulai' => $val[1],
						'r_selesai' => $val[2],
						'realisasi' => $realisasi,
					);
					// $this->db->insert('m_activity_detail', $data);
					array_push($datax,$data);
				}
			}
		}
		$this->db->insert_batch('m_activity_detail', $datax);


		$this->db->query("DELETE FROM `m_sparepart_usage` where no_wo LIKE '$pabrik%' AND tanggal = '$tanggal' ");
		$datax = array();
		foreach ($spare as $key => $value) {
			if($key!="_empty_" && $key!="undefined"){
				foreach ($value as $ky => $val) {
					$data = array(
						'id_pabrik' => $pabrik,
						'no_wo' => $key,
						'tanggal' =>$tanggal,
						'material' => $val[0],
						'qty' => $val[1],
					);
					// $this->db->insert('m_sparepart_usage', $data);
					array_push($datax,$data);
				}
			}
		}
		$this->db->insert_batch('m_sparepart_usage', $datax);
		$this->db->trans_complete();
	}


	public function download_activity_harian(){
		$id_pabrik = $this->uri->segment(3);
		$tahun = urldecode($this->uri->segment(4));
		$bulan = urldecode($this->uri->segment(5));
		$tanggal = urldecode($this->uri->segment(6));

		// $id_pabrik = $_REQUEST['id_pabrik'];
		// $id_station = $_REQUEST['id_station'];

		$tanggal = $tahun."-".$bulan."-".$tanggal;

		$statistik = array();

		$kquery = $this->db->query(
			"SELECT * FROM `master_karyawan` WHERE `id_pabrik` = '$id_pabrik' ORDER BY nama ASC
		");

		foreach ($kquery->result() as $row){
			$x = $row->nama;
			// array_push($statistik, "x" => ""); 
			$y = array(0,0,0);
			$statistik[$x] = $y;
		}

		// print_r($statistik);

		$query = $this->db->query(
			"SELECT 
			m_activity_detail.id_pabrik,
			m_activity_detail.tanggal,
			m_activity_detail.nama_teknisi,
			m_activity_detail.no_wo,
			m_wo.station,
			m_wo.unit,
			m_wo.sub_unit,
			m_wo.kategori,
			m_activity_detail.r_mulai,
			m_activity_detail.r_selesai,
			m_activity_detail.realisasi,
			m_activity.perbaikan
			FROM
			m_activity_detail
			RIGHT JOIN m_activity 
			ON m_activity_detail.no_wo = m_activity.no_wo
			AND m_activity_detail.tanggal = m_activity.tanggal
			LEFT JOIN m_wo
			ON m_activity.no_wo = m_wo.no_wo
			WHERE m_activity.`id_pabrik` = '$id_pabrik' AND m_activity.`tanggal` = '$tanggal'
			"
		);

		header('Content-Type: aplication/vnd-ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=REALISASI_'.$id_pabrik.'_'.$tanggal.'.xls');

		echo "SITE\t";
		echo "TANGGAL\t";
		echo "NAMA KARYAWAN\t";
		echo "WO\t";
		echo "STATION\t";
		echo "UNIT\t";
		echo "SUB UNIT\t";
		echo "KATEGORI\t";
		echo "JAM START\t";
		echo "JAM STOP\t";
		echo "MAN HOUR\t";
		echo "SCOPE OF WORK";
		echo "\n";

		foreach ($query->result() as $row)
		{
			// $nama = explode(";",$row->nama_mpp);

			$realisasi = round(($row->realisasi / 60),2);


			echo $row->id_pabrik; echo "\t";
			echo $row->tanggal; echo "\t";
			echo $row->nama_teknisi; echo "\t";
			echo $row->no_wo; echo "\t";
			echo $row->station; echo "\t";
			echo $row->unit; echo "\t";
			echo $row->sub_unit; echo "\t";
			echo $row->kategori; echo "\t";
			echo $row->r_mulai; echo "\t";
			echo $row->r_selesai; echo "\t";
			echo number_format($realisasi,2,",",""); echo "\t";
			echo $row->perbaikan; echo "\n";
		}

		// echo "\n\n";
		// // print_r($statistik);
		// echo "nama\t";
		// echo "preventive\t";
		// echo "corrective\t";
		// echo "predictive\t";
		// echo "total\n";

		// $cor = 0;
		// $prv = 0;
		// $pdc = 0;

		// foreach ($statistik as $key => $value) {
		// // 	# code...
		// 	echo $key; echo "\t";

		// 	echo number_format($value[0],2,",",""); echo "\t"; $cor+= $value[0];
		// 	echo number_format($value[1],2,",",""); echo "\t"; $prv+= $value[1];
		// 	echo number_format($value[2],2,",",""); echo "\t"; $pdc+= $value[2];
		// 	echo number_format(($value[0]+$value[1]+$value[2]),2,",","");

		// 	echo "\n";
		// }
		// echo "\t"; echo number_format($prv,2,",","");
		// echo "\t"; echo number_format($cor,2,",","");
		// echo "\t"; echo number_format($pdc,2,",","");
		// echo "\t"; echo number_format(($pdc+$prv+$cor),2,",","");

	}	

}

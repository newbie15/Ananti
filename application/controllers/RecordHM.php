<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordHM extends CI_Controller {

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
		// $this->load->view('welcome_message');
		$output['content'] = "test";
		$output['main_title'] = "Data Hour Meter Mesin";
		
		$header['css_files'] = [
			base_url("assets/jexcel/css/jquery.jexcel.css"),
			base_url("assets/jexcel/css/jquery.jcalendar.css"),
		];

		$footer['js_files'] = [
			// base_url('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'),
			base_url("assets/jexcel/js/jquery.jexcel.js"),
			base_url("assets/jexcel/js/jquery.jcalendar.js"),
			base_url("assets/mdp/config.js"),
			base_url("assets/mdp/global.js"),
			base_url("assets/mdp/recordhm.js"),
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
		$this->load->view('content-recordhm',$output);
		$this->load->view('footer',$footer);

	}

	public function load()
	{
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT unit,hm FROM m_recordhm where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND tanggal='$tanggal';");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			$d[$i][0] = $row->unit;
			$d[$i++][1] = $row->hm;
		}
		echo json_encode($d);
	}

	public function load_type_monitoring(){
		$id_pabrik = $_REQUEST['id_pabrik'];
		$id_station = $_REQUEST['id_station'];
		// $tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];		
		$query = $this->db->query("SELECT DISTINCT screwpress_monitoring,bunchpress_monitoring,hydrocyclone_monitoring,kcp_monitoring FROM master_unit where id_pabrik = '$id_pabrik' AND id_station = '$id_station' AND (screwpress_monitoring = 1 OR bunchpress_monitoring=1 OR hydrocyclone_monitoring=1 OR kcp_monitoring=1);");

		$i = 0;
		$d = [];
		foreach ($query->result() as $row)
		{
			if($row->screwpress_monitoring == 1){
				$d['screwpress'] = 1;
			}

			if($row->bunchpress_monitoring == 1){
				$d['bunchpress'] = 1;
			} 

			if($row->hydrocyclone_monitoring == 1){
				$d['hydrocyclone'] = 1;
			}

			if($row->kcp_monitoring == 1){
				$d['kcp'] = 1;
			}

		}
		echo json_encode($d);

	}

	public function simpan()
	{
		$pabrik = $_REQUEST['pabrik'];
		$station = $_REQUEST['station'];
		$tanggal = $_REQUEST['y']."-".$_REQUEST['m']."-".$_REQUEST['d'];

		$this->db->query("DELETE FROM `m_recordhm` where id_pabrik = '$pabrik' AND id_station = '$station' AND tanggal = '$tanggal' ");

		// $query = $this->db->query("SELECT DISTINCT m_recordhm.unit,m_recordhm.hm FROM m_recordhm,m_recordhm_screwpress,master_unit WHERE m_recordhm.id_pabrik = '$pabrik' AND master_unit.screwpress_monitoring = 1 AND m_recordhm.unit = m_recordhm_screwpress.unit AND master_unit.nama = m_recordhm.unit	AND m_recordhm.tanggal = (SELECT max(tanggal) from m_recordhm_screwpress)");

		$str_q = "";

		if($_REQUEST['screwpress']==1){
			$str_q = "master_unit.screwpress_monitoring = 1";
		}else if($_REQUEST['bunchpress']==1){
			$str_q = "master_unit.bunchpress_monitoring = 1";
		}else if($_REQUEST['hydrocyclone']==1){
			$str_q = "master_unit.hydrocyclone_monitoring = 1";
		}else if($_REQUEST['kcp']==1){
			$str_q = "master_unit.kcp_monitoring = 1";		
		}

		$query = $this->db->query(
			"SELECT DISTINCT nama,hm,tanggal 
			FROM `m_recordhm` RIGHT JOIN master_unit
			ON master_unit.nama = m_recordhm.unit
			WHERE m_recordhm.id_pabrik = '$pabrik'
			AND $str_q
			AND tanggal = (SELECT max(tanggal) from m_recordhm where tanggal < '$tanggal')"
		);

		echo "SELECT DISTINCT nama,hm,tanggal 
			FROM `m_recordhm` RIGHT JOIN master_unit
			ON master_unit.nama = m_recordhm.unit
			WHERE m_recordhm.id_pabrik = '$pabrik'
			AND $str_q
			AND tanggal = (SELECT max(tanggal) from m_recordhm where tanggal < '$tanggal')";

		// echo "SELECT DISTINCT nama,hm,tanggal 
		// 	FROM `m_recordhm` RIGHT JOIN master_unit
		// 	ON master_unit.nama = m_recordhm.unit
		// 	WHERE master_unit.screwpress_monitoring = 1
		// 	AND m_recordhm.id_pabrik = '$pabrik'
		// 	AND tanggal = (SELECT max(tanggal) from m_recordhm where tanggal < '$tanggal')";

		$screwpress = [];
		$part_screwpress = [];

		$bunchpress = [];
		$part_bunchpress = [];

		$hydrocyclone = [];
		$part_hydrocyclone = [];

		$kcp = [];
		$part_kcp = [];

		$data_json = $_REQUEST['data_json']; // data dari JSON
		$data = json_decode($data_json,TRUE);

		$counter = 0;

		if($_REQUEST['screwpress'] == 1){
			$i = 0;
			foreach ($query->result() as $row)
			{
				$screwpress[$row->nama] = $row->hm;
			}

			// print_r($screwpress);

			$query = $this->db->query(
				"SELECT DISTINCT `tanggal`,`unit`,`ab`,`cd`,`presscage`,`wearpipe`,`shaft`,`cone_guide`,`adjusting_cone_guide`
				FROM `m_recordhm_screwpress`
				WHERE id_pabrik = '$pabrik'
				AND tanggal = (SELECT max(tanggal) from m_recordhm_screwpress where tanggal < '$tanggal')
				"
			);

			$i = 0;
			foreach ($query->result() as $row)
			{
				$part_screwpress[$row->unit] = $row;
			}

			foreach ($data as $key => $value) {
				// echo "jalan";
				$data = array(
					'tanggal' => $tanggal,
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'unit' => $value[0],
					'hm' => $value[1],
				);
				if($value[0]!=""){
					$this->db->insert('m_recordhm', $data);
				}

				$next = 1;
				if(count($part_screwpress)>0){ // cek apakah ada data HM screw sebelumnya jika ada lanjut
					echo "ada data HM\n";
					// print_r($part_screwpress);
					foreach ($screwpress as $key => $val) {
						if($key==$value[0]){
							$counter++;
							echo "counter = $counter\n";
							// echo $value[0];
							$d = $part_screwpress[$value[0]];
							$t = ($value[1]-$val);

							$data = array(
								'tanggal' => $tanggal,
								'id_pabrik' => $pabrik,
								'unit' => $value[0],
								'ab' => $d->ab + $t,
								'cd' => $d->cd + $t,
								'presscage' => $d->presscage + $t,
								'wearpipe' => $d->wearpipe + $t,
								'shaft' => $d->shaft + $t,
								'cone_guide' => $d->cone_guide + $t,
								'adjusting_cone_guide' => $d->adjusting_cone_guide + $t,
							);
							$this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							$this->db->insert('m_recordhm_screwpress', $data);
						}
					}			
				}else{ // jika data tidak ada maka kesini
					echo "tidak ada data HM\n";
					// print_r($screwpress);
					// if(count($screwpress)>0){
					foreach ($screwpress as $key => $val) {
						if($key==$value[0]){
							echo "$value[0] penambahan =". $value[1] - $val ."<br>";
							$data = array(
								'tanggal' => $tanggal,
								'id_pabrik' => $pabrik,
								'unit' => $value[0],
								'ab' => $value[1]-$val,
								'cd' => $value[1]-$val,
								'presscage' => $value[1]-$val,
								'wearpipe' => $value[1]-$val,
								'shaft' => $value[1]-$val,
								'cone_guide' => $value[1]-$val,
								'adjusting_cone_guide' => $value[1]-$val,
							);
							$this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							$this->db->insert('m_recordhm_screwpress', $data);
						}else{
							echo "lari kesini";
							// $data = array(
							// 	'tanggal' => $tanggal,
							// 	'id_pabrik' => $pabrik,
							// 	'unit' => $value[0],
							// 	'ab' => $value[1],
							// 	'cd' => $value[1],
							// 	'presscage' => $value[1],
							// 	'wearpipe' => $value[1],
							// 	'shaft' => $value[1],
							// 	'cone_guide' => $value[1],
							// 	'adjusting_cone_guide' => $value[1],
							// );
							// $this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							// $this->db->insert('m_recordhm_screwpress', $data);
						}
					}
					// }else{
					// 	$data = array(
					// 		'tanggal' => $tanggal,
					// 		'id_pabrik' => $pabrik,
					// 		'unit' => $value[0],
					// 		'ab' => $value[1],
					// 		'cd' => $value[1],
					// 		'presscage' => $value[1],
					// 		'wearpipe' => $value[1],
					// 		'shaft' => $value[1],
					// 		'cone_guide' => $value[1],
					// 		'adjusting_cone_guide' => $value[1],
					// 	);
					// 	$this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
					// 	$this->db->insert('m_recordhm_screwpress', $data);
					// }
				}
			}

		}else if($_REQUEST['bunchpress'] == 1){
			echo "\n\nmasuk ke bunchpress\n\n";

			$i = 0;
			foreach ($query->result() as $row)
			{
				$bunchpress[$row->nama] = $row->hm;
			}

			print_r( $bunchpress);

			$query = $this->db->query(
				"SELECT DISTINCT `tanggal`,`unit`,`scroll`,`top_semi_cage_ring`,`bottom_semi_cage_ring`,`semi_press_cone`,`adjusting_knife`
				FROM `m_recordhm_bunchpress`
				WHERE id_pabrik = '$pabrik'
				AND tanggal = (SELECT max(tanggal) from m_recordhm_bunchpress where tanggal < '$tanggal')
				"
			);

			$i = 0;
			foreach ($query->result() as $row)
			{
				$part_bunchpress[$row->unit] = $row;
			}

			print_r($bunchpress);

			foreach ($data as $key => $value) {
				echo "jalan\n";
				$data = array(
					'tanggal' => $tanggal,
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'unit' => $value[0],
					'hm' => $value[1],
				);
				if($value[0]!=""){
					$this->db->insert('m_recordhm', $data);
				}

				$next = 1;
				if(count($part_bunchpress)>0){ // cek apakah ada data HM screw sebelumnya jika ada lanjut
					echo "ada data HM\n";
					// print_r($part_bunchpress);
					foreach ($bunchpress as $key => $val) {
						if($key==$value[0]){
							$counter++;
							echo "counter = $counter\n";
							// echo $value[0];
							$d = $part_bunchpress[$value[0]];
							$t = ($value[1]-$val);

							$data = array(
								'tanggal' => $tanggal,
								'id_pabrik' => $pabrik,
								'unit' => $value[0],
								'scroll' => $d->scroll + $t,
								'top_semi_cage_ring' => $d->top_semi_cage_ring + $t,
								'bottom_semi_cage_ring' => $d->bottom_semi_cage_ring + $t,
								'semi_press_cone' => $d->semi_press_cone + $t,
								'adjusting_knife' => $d->adjusting_knife + $t,
							);
							$this->db->query("DELETE FROM `m_recordhm_bunchpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							$this->db->insert('m_recordhm_bunchpress', $data);
						}
					}			
				}else{ // jika data tidak ada maka kesini
					echo "tidak ada data HM\n";
					// print_r($screwpress);
					if(count($bunchpress)>0){
						foreach ($bunchpress as $key => $val) {
							if($key==$value[0]){
								echo "$value[0] penambahan =". $value[1] - $val ."<br>";
								$t = ($value[1]-$val);
								
								$data = array(
									'tanggal' => $tanggal,
									'id_pabrik' => $pabrik,
									'unit' => $value[0],
									'scroll' => $t,
									'top_semi_cage_ring' => $t,
									'bottom_semi_cage_ring' => $t,
									'semi_press_cone' => $t,
									'adjusting_knife' => $t,
								);
								$this->db->query("DELETE FROM `m_recordhm_bunchpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								$this->db->insert('m_recordhm_bunchpress', $data);
							}else{
								echo "lari kesini";
								// $data = array(
								// 	'tanggal' => $tanggal,
								// 	'id_pabrik' => $pabrik,
								// 	'unit' => $value[0],
								// 	'ab' => $value[1],
								// 	'cd' => $value[1],
								// 	'presscage' => $value[1],
								// 	'wearpipe' => $value[1],
								// 	'shaft' => $value[1],
								// 	'cone_guide' => $value[1],
								// 	'adjusting_cone_guide' => $value[1],
								// );
								// $this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								// $this->db->insert('m_recordhm_screwpress', $data);
							}
						}
					}else{
						$data = array(
							'tanggal' => $tanggal,
							'id_pabrik' => $pabrik,
							'unit' => $value[0],
							'scroll' => $value[1],
							'top_semi_cage_ring' => $value[1],
							'bottom_semi_cage_ring' => $value[1],
							'semi_press_cone' => $value[1],
							'adjusting_knife' => $value[1],
						);
						$this->db->query("DELETE FROM `m_recordhm_bunchpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
						$this->db->insert('m_recordhm_bunchpress', $data);
					}
				}
			}
		}else if($_REQUEST['hydrocyclone'] == 1){
			echo "hydrocyclone\n\n";
			$i = 0;
			foreach ($query->result() as $row)
			{
				$hydrocyclone[$row->nama] = $row->hm;
			}

			// print_r($screwpress);

			$query = $this->db->query(
				"SELECT DISTINCT `tanggal`,`unit`,`cone`,`dome`
				FROM `m_recordhm_hydrocyclone`
				WHERE id_pabrik = '$pabrik'
				AND tanggal = (SELECT max(tanggal) from m_recordhm_hydrocyclone where tanggal < '$tanggal')
				"
			);

			$i = 0;
			foreach ($query->result() as $row)
			{
				$part_hydrocyclone[$row->unit] = $row;
			}

			foreach ($data as $key => $value) {
				// echo "jalan";
				$data = array(
					'tanggal' => $tanggal,
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'unit' => $value[0],
					'hm' => $value[1],
				);
				if($value[0]!=""){
					$this->db->insert('m_recordhm', $data);
				}

				$next = 1;
				if(count($part_hydrocyclone)>0){ // cek apakah ada data HM screw sebelumnya jika ada lanjut
					echo "ada data HM\n";
					// print_r($part_bunchpress);
					foreach ($hydrocyclone as $key => $val) {
						if($key==$value[0]){
							$counter++;
							echo "counter = $counter\n";
							// echo $value[0];
							$d = $part_hydrocyclone[$value[0]];
							$t = ($value[1]-$val);

							$data = array(
								'tanggal' => $tanggal,
								'id_pabrik' => $pabrik,
								'unit' => $value[0],
								'cone' => $d->scroll + $t,
								'dome' => $d->top_semi_cage_ring + $t,
							);
							$this->db->query("DELETE FROM `m_recordhm_hydrocyclone` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							$this->db->insert('m_recordhm_hydrocyclone', $data);
						}
					}			
				}else{ // jika data tidak ada maka kesini
					echo "tidak ada data HM\n";
					// print_r($screwpress);
					if(count($screwpress)>0){
						foreach ($hydrocyclone as $key => $val) {
							if($key==$value[0]){
								echo "$value[0] penambahan =". $value[1] - $val ."<br>";
								$t = ($value[1]-$val);
								
								$data = array(
									'tanggal' => $tanggal,
									'id_pabrik' => $pabrik,
									'unit' => $value[0],
									'cone' => $t,
									'dome' => $t,
								);
								$this->db->query("DELETE FROM `m_recordhm_hydrocyclone` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								$this->db->insert('m_recordhm_hydrocyclone', $data);
							}else{
								echo "lari kesini";
								// $data = array(
								// 	'tanggal' => $tanggal,
								// 	'id_pabrik' => $pabrik,
								// 	'unit' => $value[0],
								// 	'ab' => $value[1],
								// 	'cd' => $value[1],
								// 	'presscage' => $value[1],
								// 	'wearpipe' => $value[1],
								// 	'shaft' => $value[1],
								// 	'cone_guide' => $value[1],
								// 	'adjusting_cone_guide' => $value[1],
								// );
								// $this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								// $this->db->insert('m_recordhm_screwpress', $data);
							}
						}
					}else{
						$data = array(
							'tanggal' => $tanggal,
							'id_pabrik' => $pabrik,
							'unit' => $value[0],
							'cone' => $value[1],
							'dome' => $value[1],
						);
						$this->db->query("DELETE FROM `m_recordhm_hydrocyclone` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
						$this->db->insert('m_recordhm_hydrocyclone', $data);
					}
				}
			}

		}else if($_REQUEST['kcp'] == 1){
			$i = 0;
			foreach ($query->result() as $row)
			{
				$kcp[$row->nama] = $row->hm;
			}

			// print_r($screwpress);

			$query = $this->db->query(
				"SELECT DISTINCT `tanggal`,`unit`,`screw`,`body_cage`,`tupperhead`
				FROM `m_recordhm_kcp`
				WHERE id_pabrik = '$pabrik'
				AND tanggal = (SELECT max(tanggal) from m_recordhm_kcp where tanggal < '$tanggal')
				"
			);

			$i = 0;
			foreach ($query->result() as $row)
			{
				$part_kcp[$row->unit] = $row;
			}

			foreach ($data as $key => $value) {
				// echo "jalan";
				$data = array(
					'tanggal' => $tanggal,
					'id_pabrik' => $pabrik,
					'id_station' => $station,
					'unit' => $value[0],
					'hm' => $value[1],
				);
				if($value[0]!=""){
					$this->db->insert('m_recordhm', $data);
				}

				$next = 1;
				if(count($part_kcp)>0){ // cek apakah ada data HM screw sebelumnya jika ada lanjut
					echo "ada data HM\n";
					// print_r($part_bunchpress);
					foreach ($kcp as $key => $val) {
						if($key==$value[0]){
							$counter++;
							echo "counter = $counter\n";
							// echo $value[0];
							$d = $part_kcp[$value[0]];
							$t = ($value[1]-$val);

							$data = array(
								'tanggal' => $tanggal,
								'id_pabrik' => $pabrik,
								'unit' => $value[0],
								'screw' => $d->screw + $t,
								'body_cage' => $d->body_cage + $t,
								'tupperhead' => $d->tupperhead + $t,
							);
							$this->db->query("DELETE FROM `m_recordhm_kcp` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
							$this->db->insert('m_recordhm_kcp', $data);
						}
					}			
				}else{ // jika data tidak ada maka kesini
					echo "tidak ada data HM\n";
					// print_r($screwpress);
					if(count($kcp)>0){
						foreach ($kcp as $key => $val) {
							if($key==$value[0]){
								// echo "$value[0] penambahan =". $value[1] - $val ."<br>";
								$t = ($value[1]-$val);
								
								$data = array(
									'tanggal' => $tanggal,
									'id_pabrik' => $pabrik,
									'unit' => $value[0],
									'screw' => $t,
									'body_cage' => $t,
									'tupperhead' => $t,
								);
								$this->db->query("DELETE FROM `m_recordhm_kcp` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								$this->db->insert('m_recordhm_kcp', $data);
							}else{
								echo "lari kesini";
								// $data = array(
								// 	'tanggal' => $tanggal,
								// 	'id_pabrik' => $pabrik,
								// 	'unit' => $value[0],
								// 	'ab' => $value[1],
								// 	'cd' => $value[1],
								// 	'presscage' => $value[1],
								// 	'wearpipe' => $value[1],
								// 	'shaft' => $value[1],
								// 	'cone_guide' => $value[1],
								// 	'adjusting_cone_guide' => $value[1],
								// );
								// $this->db->query("DELETE FROM `m_recordhm_screwpress` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
								// $this->db->insert('m_recordhm_screwpress', $data);
							}
						}
					}else{
						$data = array(
							'tanggal' => $tanggal,
							'id_pabrik' => $pabrik,
							'unit' => $value[0],
							'screw' => $value[1],
							'body_cage' => $value[1],
							'tupperhead' => $value[1],
						);
						$this->db->query("DELETE FROM `m_recordhm_kcp` where id_pabrik = '$pabrik' AND tanggal = '$tanggal' AND unit = '$value[0]' ");
						$this->db->insert('m_recordhm_kcp', $data);
					}
				}
			}

		}
	}
}

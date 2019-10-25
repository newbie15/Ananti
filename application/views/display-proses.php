<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Maintenance And Services | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/skins/_all-skins.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/jexcel/css/jquery.jexcel.css'); ?>">
  
  <style>
  .n_success {
    position:fixed;
    width: 400px;
    height: 50px;
    z-index:10000000;
    top : 50px;
    right:calc(50% - 200px);
    display:none;
  }
  .hload {
    position:fixed;
    top:220px;
    right:calc(50% - 40px);

    width: 80px;
    height: 115px;    
    z-index:10000000;
    display:none;

    background-color:#3498db;
    border: 10px solid #3498db; 
    color : #fff;  
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    animation: spin 2s linear infinite;
    position:fixed;
    top:250px;
    right: calc(50% - 40px);
    z-index:10000000;
    display:none;
  }

  .tbl{  
    border-color: black;
    border-spacing: 10px;
  }

  .biggreen{
    background-color: green;
    color: white;
    vertical-align: top;
    text-align: center;
    font-size: xx-large;
  }

  .green{
    background-color: green;
    color: white;
    vertical-align: top;
    text-align: center;
    font-size: x-large;
  }

  .red{
    background-color: red;
    color: white;
    vertical-align: top;
    text-align: center;
    font-size: x-large;
  }

  h4 {
    color:white;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'); ?>"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js'); ?>"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<body style="background-color: black">
<div class="row">
  <div class="col-xs-4">
    <h4>Absolute Oil Loss</h4>
    <div id="g1" style="height:210px"></div>
    <h4>ODB Press</h4>
    <div id="g2" style="height:210px"></div>
    <h4>OWB Sludge Separator</h4>
    <div id="g3" style="height:210px"></div>
  </div>
  <div class="col-xs-8" id="app">
    <h1>
      <span style="color:white">Dashboard Pabrik :</span>
      <?php echo $dropdown_pabrik ?>
      <!-- <select id="pabrik">
        <option>GSDI</option>
      </select> -->
    </h1>
    <table class="tbl" width="100%" border="5" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="3" class="biggreen">Rencana Kerja <span id="today"></span></td>
      </tr>
      <tr>
        <td class="green">Taksasi (KG)<br><span id="taksasi_t"></span></td>
        <td class="green">Start Olah<br><span id="start_t"></span></td>
        <td class="green">Jam Olah<br><span id="jam_t"></span></td>
      </tr>
    </table>

    <table class="tbl" width="100%" border="5" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="3" class="biggreen">Laporan Proses <span id="yesterday"></span></td>
      </tr>
      <tr>
        <td class="green">FFA<br><span id="ffa_hi"><br><span id="ffa_shi"></span></td>
        <td class="green">Taksasi (KG)<br><span id="taksasi_y"></span></td>
        <td class="green">Taksasi vs Real<br><span id="taksasi_vs_real"></span></td>
      </tr>
      <tr>
        <td class="green">ER CPO<br><span id="er_cpo_hi"><br><span id="er_cpo_shi"></span></td>
        <td class="green">TBS Terima<br><span id="tbs_terima_hi"><br><span id="tbs_terima_shi"></span></td>
        <td class="green">TBS Olah<br><span id="tbs_olah_hi"><br><span id="tbs_olah_shi"></span></td>
      </tr>
      <tr>
        <td class="green">ER Kernel<br><span id="er_kernel_hi"><br><span id="er_kernel_shi"></span></td>
        <td class="green">Throughput<br><span id="throughput_hi"><br><span id="throughput_shi"></span></td>
        <td class="green">Breakdown<br><span id="breakdown_hi"><br><span id="breakdown_shi"></span></td>
      </tr>
      <tr>
        <td rowspan ="2" class="green">ER PKO<br><span id="er_pko_hi"><br><span id="er_pko_shi"></span></td>
        <td class="green">Stock CPO (KG)<br><span id="stok_cpo"></span></td>
        <td class="green">Stock Kernel (KG)<br><span id="stok_kernel"></span></td>
      </tr>
      <tr>
        <td class="green">Stock PKO (KG)<br><span id="stok_pko"></span></td>
        <td class="green">Stock PKE (KG)<br><span id="stok_pke"></span></td>
      </tr>
    </table>
  </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/vue/vue.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/bower_components/Flot/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/bower_components/Flot/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('assets/mdp/config.js'); ?>"></script>
<script src="<?php echo base_url('assets/mdp/global.js'); ?>"></script>

<script>
var  x_taksasi_t = '<?php echo $taksasi_t; ?>';
var  x_start_t = '<?php echo $start_t ?>';
var  x_jam_t = '<?php echo $jam_t; ?>';

var  x_ffa_hi = '<?php echo $ffa_hi ?>';
var  x_ffa_shi = '<?php echo $ffa_shi ?>';
var  x_taksasi_y = '<?php echo $taksasi_y ?>';
var  x_taksasi_vs_real = '<?php echo $taksasi_vs_real ?>';

var  x_er_cpo_hi = '<?php echo $er_cpo_hi ?>';
var  x_er_cpo_shi = '<?php echo $er_cpo_shi ?>';

var  x_tbs_terima_hi  = '<?php echo $tbs_terima_hi ?>';
var  x_tbs_terima_shi = '<?php echo $tbs_terima_shi ?>';

var  x_tbs_olah_hi  = '<?php echo $tbs_olah_hi ?>';
var  x_tbs_olah_shi = '<?php echo $tbs_olah_shi ?>';

var  x_er_kernel_hi  = '<?php echo $er_kernel_hi ?>';
var  x_er_kernel_shi = '<?php echo $er_kernel_shi ?>';

var  x_throughput_hi = '<?php echo $throughput_hi ?>';
var  x_throughput_shi = '<?php echo $throughput_shi ?>';

var  x_throughput_hi = '<?php echo $throughput_hi ?>';
var  x_throughput_shi = '<?php echo $throughput_shi ?>';

var  x_breakdown_hi = '<?php echo $breakdown_hi ?>';
var  x_breakdown_shi = '<?php echo $breakdown_shi ?>';

var  x_er_pko_hi = '<?php echo $er_pko_hi ?>';
var  x_er_pko_shi = '<?php echo $er_pko_shi ?>';

var  x_stok_cpo = '<?php echo $stok_cpo ?>';
var  x_stok_kernel = '<?php echo $stok_kernel ?>';

var  x_stok_pko = '<?php echo $stok_pko ?>';
var  x_stok_pke = '<?php echo $stok_pke ?>';

</script>

<script src="<?php echo base_url('assets/process/display.js'); ?>"></script>
</body>
</html>
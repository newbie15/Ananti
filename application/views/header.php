<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> | Analisa Maintenance Terkini</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <?php if (isset($css_files)) { ?>
    <?php foreach ($css_files as $file) : ?>
      <link rel="stylesheet" href="<?php echo $file; ?>">
  <?php endforeach;
  } ?>

<?php if (isset($crud)) { ?>
<?php foreach($crud as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach;
} ?>

  <style>
    .n_success {
      position: fixed;
      width: 400px;
      height: 50px;
      z-index: 10000000;
      top: 50px;
      right: calc(50% - 200px);
      display: none;
    }

    .hload {
      position: fixed;
      top: 220px;
      right: calc(50% - 40px);

      width: 80px;
      height: 115px;
      z-index: 10000000;
      display: none;

      background-color: #3498db;
      border: 10px solid #3498db;
      color: #fff;
    }

    .loader {
      border: 16px solid #f3f3f3;
      border-top: 16px solid #3498db;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      animation: spin 2s linear infinite;
      position: fixed;
      top: 250px;
      right: calc(50% - 40px);
      z-index: 10000000;
      display: none;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  <div class="hload">
    <div class="loader"></div>
    Loading
  </div>

  <div class="n_success">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Sukses</h4>
      Data Anda Telah Berhasil Disimpan..
    </div>
  </div>

  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url(); ?>" class="logo">
        <span class="logo-mini"><b>ANT</b></span>
        <span class="logo-lg"><b>ANANTI</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="https://www.youtube.com/playlist?list=PL03CFJjwWWtY9a5ymqlvFw3zQg2V_dCSr" target="_blank"><i class="fa fa-youtube-play"></i> Watch Tutorial</a>
            </li>
            <li>
              <a href="<?php echo site_url("login/signout"); ?>">
                <span class="hidden-xs">
                  <?php
                  if ($this->session->kategori == 3) {
                    echo "PRO_";
                  }
                  echo $this->session->user;
                  ?> | Logout
                </span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>App Config</span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?php echo site_url("user"); ?>"><i class="fa fa-user"></i>User</a></li>
          </ul>
        </li> -->
          <?php
          if ($this->session->kategori == 3) {
          ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i> <span>Process</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("woprocess"); ?>"><i class="fa fa-file"></i>Laporan Kerusakan <span class="pull-right-container"><small class="label pull-right label-primary">Harian</small></span> </a></li>
              </ul>
            </li>
          <?php
          } else {
          ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Master</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <?php if ($this->session->kategori <= 1) { ?>
                  <li><a><i class="fa fa-circle-o text-red"></i>Prerequisite</a></li>
                  <li><a href="<?php echo site_url("pabrik"); ?>"><i class="fa fa-industry"></i>Pabrik</a></li>
                  <li><a href="<?php echo site_url("jobaid"); ?>"><i class="fa fa-list-ol"></i>Job Aid</a></li>
                  <li><a href="<?php echo site_url("workexecution"); ?>"><i class="fa fa-list-ol"></i>Work Execution</a></li>
                  <li><a href="<?php echo site_url("unittype"); ?>"><i class="fa fa-list-ol"></i>Unit Type</a></li>
                  <li><a><i class="fa fa-circle-o text-green"></i>Preset</a></li>
                <?php } ?>
                <li><a href="<?php echo site_url("station"); ?>"><i class="fa fa-industry"></i>Station</a></li>
                <li><a href="<?php echo site_url("unit"); ?>"><i class="fa fa-calendar-check-o"></i>Unit</a></li>
                <li><a href="<?php echo site_url("sub_unit"); ?>"><i class="fa fa-calendar-check-o"></i>Sub Unit</a></li>
                <li><a href="<?php echo site_url("attachment"); ?>"><i class="fa fa-calendar-check-o"></i>Attachment</a></li>
                <li><a href="<?php echo site_url("part"); ?>"><i class="fa fa-calendar-check-o"></i>Part</a></li>
                <li><a href="<?php echo site_url("partcatalog"); ?>"><i class="fa fa-calendar-check-o"></i>Part Catalog</a></li>
                <li><a href="<?php echo site_url("grouping"); ?>"><i class="fa fa-object-group"></i>Group Unit</a></li>
                <li><a href="<?php echo site_url("uelektrik"); ?>"><i class="fa fa-bolt"></i>Unit Elektrik</a></li>
                <li><a href="<?php echo site_url("umekanik"); ?>"><i class="fa fa-wrench"></i>Unit Mekanik</a></li>
                <li><a href="<?php echo site_url("schedule"); ?>"><i class="fa fa-calendar"></i>PM Schedule</a></li>
                <li><a href="<?php echo site_url("karyawan"); ?>"><i class="fa fa-group"></i>Karyawan</a></li>
                <li><a href="<?php echo site_url("vendor"); ?>"><i class="fa fa-group"></i>Vendor</a></li>
                <li><a href="<?php echo site_url("user"); ?>"><i class="fa fa-user"></i>User</a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Maintenance</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("wo"); ?>"><i class="fa fa-industry"></i>Work Order <span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <li><a href="<?php echo site_url("schedule_maintenance"); ?>"><i class="fa fa-calendar"></i>Schedule Maintenance<span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <li><a href="<?php echo site_url("planing"); ?>"><i class="fa fa-calendar-plus-o"></i>Planning MTC<span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <li><a href="<?php echo site_url("activity"); ?>"><i class="fa fa-calendar-check-o"></i>Activity / Realisasi MTC<span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <li><a href="<?php echo site_url("breakdown"); ?>"><i class="fa fa-industry"></i>Breakdown Pabrik & Downtime Unit <span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <!-- <li><a href="<?php echo site_url("monitoring"); ?>"><i class="fa fa-calendar"></i>Monitoring MTC <span class="pull-right-container"><small class="label pull-right bg-green">Mingguan</small></span> </a></li> -->
                <li><a href="<?php echo site_url("acm"); ?>"><i class="fa fa-warning"></i>Avaibility Critical Machine <span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <li><a href="<?php echo site_url("recordhm"); ?>"><i class="fa fa-line-chart"></i>Hour Meter Alat <span class="pull-right-container"><small class="label pull-right bg-red">Harian</small></span> </a></li>
                <!-- <li><a href="<?php echo site_url("highlight"); ?>"><i class="fa fa-thumbs-o-down"></i>Highlight Problem <span class="pull-right-container"><small class="label pull-right bg-green">Mingguan</small></span> </a></li> -->
                <!-- <li><a href="<?php echo site_url("lkpmp"); ?>"><i class="fa fa-file"></i>LKPMP <span class="pull-right-container"><small class="label pull-right bg-green">Mingguan</small></span> </a></li> -->
                <!-- <li><a href="<?php echo site_url("capex"); ?>"><i class="fa fa-file"></i>CAPEX <span class="pull-right-container"><small class="label pull-right bg-green">Mingguan</small></span> </a></li> -->
                <!-- <li><a href="<?php echo site_url("inventory"); ?>"><i class="fa fa-file"></i>Inventory <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li> -->
              </ul>
            </li>
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-bolt"></i> <span>Monitoring Elektrik</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("grounding"); ?>"><i class="fa fa-file"></i>Grounding <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("kapasitor"); ?>"><i class="fa fa-file"></i>Kapasitor <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("motor"); ?>"><i class="fa fa-file"></i>Motor Inspection <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("megger"); ?>"><i class="fa fa-file"></i>Megger <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("polarisasi"); ?>"><i class="fa fa-file"></i>Indeks Polarisasi <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
              </ul>
            </li> -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bolt"></i> <span>Electrical Maintenance Program</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <!-- <li><a href="<?php echo site_url("grounding"); ?>"><i class="fa fa-file"></i>Grounding <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("kapasitor"); ?>"><i class="fa fa-file"></i>Kapasitor <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("motor"); ?>"><i class="fa fa-file"></i>Motor Inspection <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("megger"); ?>"><i class="fa fa-file"></i>Megger <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
                <li><a href="<?php echo site_url("polarisasi"); ?>"><i class="fa fa-file"></i>Indeks Polarisasi <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li> -->
                <li class="treeview" style="height: auto;">
                  <a href="#"><i class="fa fa-circle-o"></i>High Voltage<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                  <ul class="treeview-menu" style="display: none;">

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Transformer<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j4"); ?>"><i class="fa fa-circle-o"></i>J4 <?php echo job_name('J4');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j5"); ?>"><i class="fa fa-circle-o"></i>J5 <?php echo job_name('J5');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j6"); ?>"><i class="fa fa-circle-o"></i>J6 <?php echo job_name('J6');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j7"); ?>"><i class="fa fa-circle-o"></i>J7 <?php echo job_name('J7');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Switches<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j16"); ?>"><i class="fa fa-circle-o"></i>J16 <?php echo job_name('J16');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j17"); ?>"><i class="fa fa-circle-o"></i>J17 <?php echo job_name('J17');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Switchgear/-board<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j18"); ?>"><i class="fa fa-circle-o"></i>J18 <?php echo job_name('J18');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j45"); ?>"><i class="fa fa-circle-o"></i>J45 <?php echo job_name('J45');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j41"); ?>"><i class="fa fa-circle-o"></i>J41 <?php echo job_name('J41');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j44"); ?>"><i class="fa fa-circle-o"></i>J44 <?php echo job_name('J44');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j43"); ?>"><i class="fa fa-circle-o"></i>J43 <?php echo job_name('J43');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Cables<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j60"); ?>"><i class="fa fa-circle-o"></i>J60 <?php echo job_name('J60');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j62"); ?>"><i class="fa fa-circle-o"></i>J62 <?php echo job_name('J62');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Motor Starter<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j42"); ?>"><i class="fa fa-circle-o"></i>J46 <?php echo job_name('J46');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j47"); ?>"><i class="fa fa-circle-o"></i>J47 <?php echo job_name('J47');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j48"); ?>"><i class="fa fa-circle-o"></i>J48 <?php echo job_name('J48');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Rotating Machine<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j50"); ?>"><i class="fa fa-circle-o"></i>J50 <?php echo job_name('J50');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j51"); ?>"><i class="fa fa-circle-o"></i>J51 <?php echo job_name('J51');?></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>


                <li class="treeview" style="height: auto;">
                  <a href="#"><i class="fa fa-circle-o"></i>Low Voltage<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                  <ul class="treeview-menu" style="display: none;">

                    <!-- Low voltage -->
                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Switches<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j8"); ?>"><i class="fa fa-circle-o"></i>J8 <?php echo job_name('J8');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j9"); ?>"><i class="fa fa-circle-o"></i>J9 <?php echo job_name('J9');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j10"); ?>"><i class="fa fa-circle-o"></i>J10 <?php echo job_name('J10');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j11"); ?>"><i class="fa fa-circle-o"></i>J11 <?php echo job_name('J11');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Switchgear/-board<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j19"); ?>"><i class="fa fa-circle-o"></i>J19 <?php echo job_name('J19');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j40"); ?>"><i class="fa fa-circle-o"></i>J40 <?php echo job_name('J40');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j42"); ?>"><i class="fa fa-circle-o"></i>J42 <?php echo job_name('J42');?></a></li>
                      </ul>
                    </li>
                  
                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Motor starters<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j20"); ?>"><i class="fa fa-circle-o"></i>J20 <?php echo job_name('J20');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j21"); ?>"><i class="fa fa-circle-o"></i>J21 <?php echo job_name('J21');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j24"); ?>"><i class="fa fa-circle-o"></i>J24 <?php echo job_name('J24');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j25"); ?>"><i class="fa fa-circle-o"></i>J25 <?php echo job_name('J25');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Cables<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j61"); ?>"><i class="fa fa-circle-o"></i>J61 <?php echo job_name('J61');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j62"); ?>"><i class="fa fa-circle-o"></i>J62 <?php echo job_name('J62');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Back-up Power<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j12"); ?>"><i class="fa fa-circle-o"></i>J12 <?php echo job_name('J12');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j13"); ?>"><i class="fa fa-circle-o"></i>J13 <?php echo job_name('J13');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j14"); ?>"><i class="fa fa-circle-o"></i>J14 <?php echo job_name('J14');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j15"); ?>"><i class="fa fa-circle-o"></i>J15 <?php echo job_name('J15');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Grounding / Earthing System<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j29"); ?>"><i class="fa fa-circle-o"></i>J29 <?php echo job_name('J29');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j30"); ?>"><i class="fa fa-circle-o"></i>J30 <?php echo job_name('J30');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j31"); ?>"><i class="fa fa-circle-o"></i>J31 <?php echo job_name('J31');?></a></li>
                      </ul>
                    </li>                                

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Field Installation<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j1");?>"><i class="fa fa-circle-o"></i>J1 RCDs /GFCIs</a></li>
                        <li><a href="<?php echo site_url("job_aid/j22"); ?>"><i class="fa fa-circle-o"></i>J22 <?php echo job_name('J22');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j32"); ?>"><i class="fa fa-circle-o"></i>J32 <?php echo job_name('J32');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j34"); ?>"><i class="fa fa-circle-o"></i>J34 <?php echo job_name('J34');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j35"); ?>"><i class="fa fa-circle-o"></i>J35 <?php echo job_name('J35');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j36"); ?>"><i class="fa fa-circle-o"></i>J36 <?php echo job_name('J36');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Heating<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j70"); ?>"><i class="fa fa-circle-o"></i>J70 <?php echo job_name('J70');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j71"); ?>"><i class="fa fa-circle-o"></i>J71 <?php echo job_name('J71');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Portable/Temporary Devices<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j2"); ?>"><i class="fa fa-circle-o"></i>J2 <?php echo job_name('J2');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j3"); ?>"><i class="fa fa-circle-o"></i>J3 <?php echo job_name('J3');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Electrical Rooms<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j23"); ?>"><i class="fa fa-circle-o"></i>J23 <?php echo job_name('J23');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Lighting<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j33"); ?>"><i class="fa fa-circle-o"></i>J33 <?php echo job_name('J33');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j37"); ?>"><i class="fa fa-circle-o"></i>J37 <?php echo job_name('J37');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Fire Detection System<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="#"><i class="fa fa-circle-o"></i>-</a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Rotating machines<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="<?php echo site_url("job_aid/j52"); ?>"><i class="fa fa-circle-o"></i>J52 <?php echo job_name('J52');?></a></li>
                        <li><a href="<?php echo site_url("job_aid/j53"); ?>"><i class="fa fa-circle-o"></i>J53 <?php echo job_name('J53');?></a></li>
                      </ul>
                    </li>

                    <li class="treeview" style="height: auto;">
                      <a href="#"><i class="fa fa-circle-o"></i>Instrumentation<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="#"><i class="fa fa-circle-o"></i>-</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i> <span>Monitoring Mekanik</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("vibration"); ?>"><i class="fa fa-file"></i>Vibration<span class="pull-right-container"><small class="label pull-right label-primary">Mingguan</small></span> </a></li>
                <li><a href="<?php echo site_url("temperature"); ?>"><i class="fa fa-file"></i>Temperature<span class="pull-right-container"><small class="label pull-right label-primary">Mingguan</small></span> </a></li>
                <li><a href="<?php echo site_url("oiling"); ?>"><i class="fa fa-file"></i>Oiling<span class="pull-right-container"><small class="label pull-right label-primary">Mingguan</small></span> </a></li>
                <!-- <li><a href="<?php echo site_url("hydrocyclone"); ?>"><i class="fa fa-file"></i>Hydrocyclone<span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li>
            <li><a href="<?php echo site_url("kcp"); ?>"><i class="fa fa-file"></i>KCP <span class="pull-right-container"><small class="label pull-right label-primary">Bulanan</small></span> </a></li> -->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i> <span>Gudang</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("mr"); ?>"><i class="fa fa-file"></i>Material Requisition<span class="pull-right-container"><small class="label pull-right label-primary">Harian</small></span> </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Dokumen</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("sop"); ?>"><i class="fa fa-file-pdf-o"></i>SOP<span class="pull-right-container"></span> </a></li>
                <li><a href="<?php echo site_url("ik"); ?>"><i class="fa fa-file-pdf-o"></i>Instruksi Kerja<span class="pull-right-container"></span> </a></li>
                <li><a href="<?php echo site_url("drawing"); ?>"><i class="fa fa-file-pdf-o"></i>Drawing<span class="pull-right-container"></span> </a></li>
                <li><a href="<?php echo site_url("datasheet"); ?>"><i class="fa fa-file-pdf-o"></i>Datasheet<span class="pull-right-container"></span> </a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>Report</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url("historical"); ?>"><i class="fa fa-thumbs-o-down"></i>Historycal Machineries Card</a></li>
                <li><a href="<?php echo site_url("high_maintenance"); ?>"><i class="fa fa-thumbs-o-down"></i>High Maintenance Unit</a></li>
                <!-- <li><a href="<?php echo site_url("costrm"); ?>"><i class="fa fa-money"></i>Cost RM Pabrik</a></li>
            <li><a href="<?php echo site_url("costrm"); ?>"><i class="fa fa-money"></i>Distribusi Man Hour</a></li>
            <li><a href="<?php echo site_url("costrm"); ?>"><i class="fa fa-money"></i>Plan vs Real (CM MM)</a></li>
            <li><a href="<?php echo site_url("costrm"); ?>"><i class="fa fa-money"></i>Inventory</a></li>
            <li><a href="<?php echo site_url("costrm"); ?>"><i class="fa fa-money"></i>Potret Pabrik</a></li>
            <li><a href="<?php echo site_url("display/proses"); ?>"><i class="fa fa-money"></i>Potret Proses</a></li>
            <li><a href="<?php echo site_url("display/maintenance"); ?>"><i class="fa fa-money"></i>Potret Maintenance</a></li> -->
              </ul>
            </li>
          <?php
          }
          ?>

        </ul>
      </section>
    </aside>
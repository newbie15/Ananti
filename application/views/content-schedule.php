  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$main_title?>
        <small>Input Jadwal</small>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <?php //echo $content; ?>
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          Station :
          <?php echo $dropdown_station; ?>
          Unit :
          <?php echo $dropdown_unit; ?>
        </div>
        <div class="col-xs-3">
          <br>
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-check"></i>

              <h3 class="box-title">List Umum Perawatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul>
                <li>Untuk Elektromotor</li>
                  <ul>
                    <li>Cek Temperature</li>
                    <li>Cek kebersihan, Fan</li>
                    <li>Cek Bearing</li>
                    <li>Megger setiap 2 tahun sekali</li>
                  </ul>
                <li>Untuk Gearbox</li>
                  <ul>
                    <li>Cek Level Oli</li>
                    <!-- <li>Cek kebersihan, Fan</li>
                    <li>Cek Bearing</li>
                    <li>Megger setiap 2 tahun sekali</li> -->
                  </ul>
                <li>Untuk Powerpack</li>
                  <ul>
                    <li>Cek Level Oli</li>
                    <li>Cek Filter Oli</li>
                    <li>Cek Temperature Oli</li>
                    <!-- <li>Megger setiap 2 tahun sekali</li> -->
                  </ul>
                <!-- <li>Untuk Sensor</li>
                  <ul>
                    <li>Cek Temperature</li>
                    <li>Cek kebersihan, Fan</li>
                    <li>Cek Bearing</li>
                    <li>Megger setiap 2 tahun sekali</li>
                  </ul> -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-9">
          <br>
          <div style="
						height: 500px;
						width: 100%;
						overflow: auto;
					">
            <div id='my-spreadsheet'></div>              
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
          Tahun : <select id="tahun"></select>
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
              <h3 class="box-title">Daftar Perawatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="external-events">
                <div class="external-event bg-green">Lunch</div>
                <div class="external-event bg-yellow">Go home</div>
                <div class="external-event bg-aqua">Do homework</div>
                <div class="external-event bg-light-blue">Work on UI design</div>
                <div class="external-event bg-red">Sleep tight</div>
                <!-- <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                    remove after drop
                  </label>
                </div> -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-9">
          <br>
          <!-- <div style="
						height: 500px;
						width: 100%;
						overflow: auto;
					">
            <div id='my-spreadsheet'></div>              
          </div> -->
          <div id='calendar' style="background-color:white;"></div>              
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

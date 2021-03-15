  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$main_title?>
        <small>Control panel</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          Tahun : 
          <select id="tahun">
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
          </select>
          Bulan : 
          <select id="bulan">
            <option value="00">== ALL ==</option>
            <option value="01">januari</option>
            <option value="02">februari</option>
            <option value="03">maret</option>
            <option value="04">april</option>
            <option value="05">mei</option>
            <option value="06">juni</option>
            <option value="07">juli</option>
            <option value="08">agustus</option>
            <option value="09">september</option>
            <option value="10">oktober</option>
            <option value="11">november</option>
            <option value="12">desember</option>
          </select>
          <br><br>      
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Station</h3>
              <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div id="bar-chart" style="height: 400px; padding: 0px; position: relative;">
                <!-- <div id="placeholder" style="height: 250px; padding: 0px; position: relative;"> -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Percentage</h3>
              <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div id="donut-chart" style="height: 250px; padding: 0px; position: relative;">
                <!-- <div id="placeholder" style="height: 250px; padding: 0px; position: relative;"> -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <div class="col-md-7">
          Station :
          <?php echo $dropdown_station; ?>
          Unit :
          <?php echo $dropdown_unit; ?>

          <div style="
            height: 500px;
            width: 100%;
            overflow: auto;
          ">
          <div id='my-spreadsheet'></div>
        </div>
      </div>


      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

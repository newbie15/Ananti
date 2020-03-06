  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#" aria-expanded="true">Schedule</a></li>
          <li class=""><a href="<?php echo base_url("planing")?>"" aria-expanded="false">Plan</a></li>
          <li class=""><a href="<?php echo base_url("activity")?>" aria-expanded="false">Realisasi</a></li>
          <li class=""><a href="<?php echo base_url("planvsreal")?>" aria-expanded="false">Plan VS Real</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
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
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-check"></i>
              <h3 class="box-title">Daftar WO Unfinished</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="external-events">
                <div class="external-event bg-green">Lunch</div>
                <div class="external-event bg-yellow">Go home</div>
                <div class="external-event bg-aqua">Do homework</div>
                <div class="external-event bg-light-blue">Work on UI design</div>
                <div class="external-event bg-red">Sleep tight</div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-9">
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

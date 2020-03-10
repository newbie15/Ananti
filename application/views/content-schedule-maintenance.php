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
        <!-- <div class="col-xs-12">

        </div> -->
        <div class="col-lg-3">
          <div style="height: 49px;">
            <div style="width:25%;float: left;margin-bottom: 3px;">Tahun : </div>
            <div style="width:25%;float: left;margin-bottom: 3px;"><select id="tahun"></select></div>
            <div style="width:25%;float: left;margin-bottom: 3px;">Pabrik : </div>
            <div style="width:25%;float:right;margin-bottom: 3px;"><?php echo $dropdown_pabrik ?></div>                      
            <div style="width:25%;margin-bottom: 3px;float: left;">Station :</div>
            <div style="width:75%;margin-bottom: 3px;float:right;"><?php echo $dropdown_station; ?></div>
          </div>
          <div id="list_wo" class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-check"></i>
              <h3 class="box-title">Daftar WO Unfinished</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="external-events" >
                <div class="external-event bg-green">Lunch</div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div id="delete_area" class="box box-solid" style="display: none;">
            <div class="box-header with-border">
              <i class="fa fa-trash"></i>
              <h3 class="box-title">Delete Event</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h2 style="text-align: center;color: lightgray;">
                <div class="fa fa-trash">
                </div>
                <br>
                Drag & Drop Here To Delete Event
              </h2>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-lg-9">
          <div id='calendar' style="background-color:white;"></div>              
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

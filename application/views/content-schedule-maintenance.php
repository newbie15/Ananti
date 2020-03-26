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
        <!-- <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- <div class="col-xs-12">

        </div> -->
        <div class="col-lg-3">
          <table width="100%" cellspacing="10" cellpadding="10" border="0">
            <tr>
              <td width="25%" style="padding: 2px;">Tahun : </td>
              <td width="25%"><select id="tahun"></select></td>
              <td width="25%">Pabrik : </td>
              <td width="25%"><?php echo $dropdown_pabrik ?></td>
            </tr>
            <tr>
              <td style="padding: 2px;">Station :</td>
              <td colspan="3"><?php echo $dropdown_station; ?></td>
            </tr>
          </table>
          <div id="list_wo" class="box box-solid" style="
						height: 450px;
						width: 100%;
						overflow-y: auto;
						overflow-x: hidden;
					">
            <div class="box-header with-border">
              <i class="fa fa-check"></i>
              <h3 class="box-title">Daftar WO Unfinished</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="external-events" style="font-size: 10px;">
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

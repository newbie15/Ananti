  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo base_url("schedule/monitoring_item")?>" aria-expanded="true">Monitoring Item</a></li>
          <li class="active"><a href="#" aria-expanded="false">Schedule</a></li>
          <!-- <li class=""><a href="<?php echo base_url("planvsreal")?>" aria-expanded="false">Plan VS Real</a></li> -->
        </ul>
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
          Sub Unit :
          <?php echo $dropdown_sub_unit; ?>
        </div>
        <div class="col-xs-12">
          <br>
          <div id="dp"></div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

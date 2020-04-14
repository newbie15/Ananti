  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo base_url("wo")?>" aria-expanded="true">Work Order</a></li>
          <li class="active"><a href="#" aria-expanded="false">Unfinished WO</a></li>
          <li class=""><a href="<?php echo base_url("wo/search")?>" aria-expanded="false">Search WO</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-download"></i> Download
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php  ?>
        <div class="col-xs-12">
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          <br><br>
          <div id='my-spreadsheet'></div>
          <!-- <button id="simpan" class="btn btn-small btn-danger">Simpan</button> -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

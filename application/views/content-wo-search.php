  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- Create Work Order | Unfinished WO | Search WO -->
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo site_url("woprocess")?>" aria-expanded="true">Laporan Kerusakan</a></li>
          <li class=""><a href="<?php echo site_url("wo")?>" aria-expanded="true">Work Order</a></li>
          <li class=""><a href="<?php echo site_url("wo/unfinished")?>" aria-expanded="false">Unfinished WO</a></li>
          <li class="active"><a href="#" aria-expanded="false">Search WO</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <a class="btn btn-app btn-success" id="downloadcsv">
          <i class="fa fa-file-excel-o"></i> Download
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
          Tahun : 
          <select id="tahun">
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
          </select>
          
          <div style="
						height: 470px;
						width: 100%;
						overflow: auto;
					">
          <div id='my-spreadsheet'></div>
          </div>
          <!-- <button id="simpan" class="btn btn-small btn-danger">Simpan</button> -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

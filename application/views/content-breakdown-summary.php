  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo site_url("breakdown")?>" aria-expanded="true">Breakdown</a></li>
          <li class="active"><a href="" aria-expanded="false">Summary</a></li>
          <!-- <li class=""><a href="<?php echo base_url("wo/search")?>" aria-expanded="false">Search WO</a></li> -->
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-success" id="downloadcsv">
          <i class="fa fa-file-excel-o"></i> Download
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="modal fade in" id="modal-default" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Tambah Breakdown / Problem</h4>
            </div>
            <div class="modal-body">
              <h3 id="dpabrik"></h3>
              Station : <select id="station"><option></option></select>
              <br>
              <br>
              Unit : <select id="unit"><option></option></select>
              <br>
              <br>
              Sub Unit : <select id="sub_unit"><option></option></select>
              <br>
              <hr>
              <span style="float:right;">
                <button id="tplus">Tambah</button>              
              </span>
              <table id="dt-table" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-7">
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
          <div id='my-spreadsheet'></div>      
        </div>
        <div class="col-xs-5" id="history" style="display:none;">
          <h4>Work Order History</h4>
          <span id="ar"></span>
          <div id='my-history'></div>      
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

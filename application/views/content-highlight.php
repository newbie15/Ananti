  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$main_title?>
        <small>Control panel</small>
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
        <br><br>
        <div id='my-PRPO'></div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

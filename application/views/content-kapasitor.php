  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$main_title?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <a class="btn btn-app btn-warning" id="sync">
          <i class="fa fa-refresh"></i> Sync w/ Monalisa
        </a>
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol>
    </section>
    <div id="dialog" title="Data Kapasitor | Monalisa | Internet" width="1200" style="display:none; border-color: red;">
      <div data-role="header" style="float:right;">
        <button type="button" class="btn btn-primary" id="m2a">Monalisa -> Ananti</button>
        <br><br>
      </div>
      <div data-role="body">
        <div id="monalisa"></div>
      </div>
    </div>  
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
          <br><br>
          <div id='my-G'></div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

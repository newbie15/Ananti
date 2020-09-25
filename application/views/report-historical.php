  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $main_title ?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <div class="btn-group" style="margin-left: 10px;">
          <a class="btn btn-app btn-success" id="download" href="#" role="button">
            <i class="fa fa-file-excel-o"></i> Download
          </a>
          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="height: 60px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="download_all">Download All History</a></li>
          </ul>
        </div>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          Pabrik :
          <?php echo $dropdown_pabrik ?>
          Station :
          <?php echo $dropdown_station; ?>
          Unit :
          <?php echo $dropdown_unit; ?>
          Sub Unit :
          <?php echo $dropdown_sub_unit; ?>

          <br><br>
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
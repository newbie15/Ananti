  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        Pabrik : <?php echo $dropdown_pabrik ?>

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><span id="unit_problem"></span> Unit</h3>
              <p>Bermasalah</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo base_url("wo/unfinished")?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><span id="wo_unfinished"></span> WO</h3>

              <p>Belum Terselesaikan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url("wo/unfinished")?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><span id="wo_baru"></span> WO</h3>

              <p>Baru di bulan ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><span id="mill_avaibility"></span><sup style="font-size: 20px">%</sup></h3>
              <p>Mill Avaibility</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url("acm/problem")?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Plan Job Hari</h3> &nbsp;&nbsp;
              <input type="date" id="tgl_job"/>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="j_today"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-xs-6">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-xs-6">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-xs-6">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>





      </div> -->

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

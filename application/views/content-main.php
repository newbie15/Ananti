  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        Pabrik : <?php echo $dropdown_pabrik ?>
        <?php if (isset($dropdown_tahun)) { ?>
          Tahun : <?php echo $dropdown_tahun ?>
        <?php } ?>
        <?php if (isset($dropdown_bulan)) { ?>
          Bulan : <?php echo $dropdown_bulan ?>
        <?php } ?>

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row" id="all-site" style="display:none">
        <div class="col-lg-6 col-xs-6">
          <b>Breakdown Total</b>
          <div id="bdt-all-site">table breakdown ada disini</div>
          <br>
          <b>Breakdown Line</b>
          <div id="bdl-all-site">table breakdown ada disini</div>
          <!-- <br>
          <b>Breakdown Unit</b>
          <div id="bdu-all-site">table breakdown ada disini</div> -->
        </div>
        <div class="col-lg-6 col-xs-6">
          <b>Work Order</b>
          <div id="wo-all-site">table wo ada disini</div>
        </div>
      </div>

      <div id="per-site" style="display:none">
        <div class="row">
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><span id="breakdown">0</span> Jam<sup style="font-size: 20px"></sup></h3>
                <p>Breakdown</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url("breakdown/summary") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><span id="unit_problem"></span> Unit</h3>
                <p>Perlu Maintenance</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url("wo/unfinished") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><span id="wo_unfinished"></span> WO</h3>

                <p>Belum Terselesaikan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url("wo/unfinished") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><span id="wo_baru"></span> WO</h3>
                <p>Baru di bulan ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><span id="mill_avaibility"></span><sup style="font-size: 20px">%</sup></h3>
                <p>Mill Avaibility</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url("acm/problem") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><span id="electric_score"></span><sup style="font-size: 20px">%</sup></h3>
                <p>Electric Score</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url("acm/problem") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->

        </div>

        <div class="row">
          <div class="col-lg-6">
            <div id="calendar" style="background-color:#fff"></div>
          </div>
          <div class="col-lg-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Plan Job Hari</h3> &nbsp;&nbsp;
                <input type="date" id="tgl_job" />
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="j_today"></div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Mill Problem</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div id="donut-chart" style="height: 250px; padding: 0px; position: relative;"><canvas class="flot-base" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas><canvas class="flot-overlay" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 71px; left: 313.352px;">
                      <div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">Series2<br>30%</div>
                    </span><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 211px; left: 291.352px;">
                      <div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">Series3<br>20%</div>
                    </span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 130px; left: 132.352px;">
                      <div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">Series4<br>50%</div>
                    </span></div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">High Maintenance Unit</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <ul class="products-list product-list-in-box">
                  <li class="item">
                    <div>
                      <a href="" class="product-title">
                        <span id="n1"></span> <span class="label label-danger pull-right" id="v1"></span></a>
                    </div>
                  </li>
                  <li class="item">
                    <div>
                      <a href="" class="product-title">
                        <span id="n2"> </span> <span class="label label-warning pull-right" id="v2"></span></a>
                    </div>
                  </li>
                  <li class="item">
                    <div>
                      <a href="" class="product-title">
                        <span id="n3"></span> <span class="label label-info pull-right" id="v3"></span></a>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="<?php echo base_url("high_maintenance"); ?>" class="uppercase">View All Rank</a>
              </div>
              <!-- /.box-footer -->
            </div>
          </div>





        </div>
      </div>
  </div>

  <!-- /.row -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
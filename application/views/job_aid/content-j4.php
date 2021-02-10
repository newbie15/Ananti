  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#" aria-expanded="true">J4</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j4/a1") ?>" aria-expanded="false">A1 - Visual Inspection</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j4/a3") ?>" aria-expanded="false">A3 - Infrared Inspection</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <!-- <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="row">
        <div class="col-xs-12">
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          <!-- Station :
          <?php echo $dropdown_equipment; ?> -->
          Tahun : 
          <select id="tahun">
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
          </select>
          <br><br>
          <div class="col-xs-6">
            <div style="
              height: 500px;
              width: 100%;
              overflow: auto;
            ">
              <div id="viewer" style="height: 100%;">
              </div>
            </div>
            <hr/> 
              <strong>Comment :</strong><br/>
              <?php echo $comment; ?>
          </div>
          <div class="col-xs-6">
            <b>Progress : <span id="progress"></span></b>
            <br>
            <br>
            <div id="resume">

            </div>
          </div>

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo base_url("schedule_maintenance")?>" aria-expanded="false">Schedule</a></li>
          <li class=""><a href="<?php echo base_url("planing")?>">Plan</a></li>
          <li class="active"><a href="">Realisasi</a></li>
          <li class=""><a href="<?php echo base_url("planvsreal")?>" aria-expanded="false">Plan VS Real</a></li>
        </ul>
        <!-- Activity Maintenance
        <small>Input Harian</small> -->
      </h1>
      <ol class="breadcrumb">
        <!-- <a class="btn btn-app btn-warning" id="sync_activity" href="#modal-sync" role="button" data-toggle="modal" data-backdrop="false"> -->
        <a class="btn btn-app btn-success" id="sharewa" href="#modal-wa" data-toggle="modal">
          <i class="fa fa-whatsapp"></i> Share
        </a>
        <a class="btn btn-app btn-warning" id="sync_activity">
          <i class="fa fa-refresh"></i> Sync w/ Louhan
        </a>
        <div class="btn-group" style="margin-left: 10px;">
          <a class="btn btn-app btn-success" id="download_activity" href="#" role="button">
            <i class="fa fa-file-excel-o"></i> Download
          </a>
          <!-- <button type="button" class="btn btn-success">Action</button> -->
          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="height: 60px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="download_activity_bulanan">Download 1 Month</a></li>
            <!-- <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li> -->
          </ul>
        </div>       
        <!-- <a class="btn btn-app btn-success" id="download_activity" href="#" role="button">
          <i class="fa fa-file-excel-o"></i> Download
        </a> -->
        <a class="btn btn-app btn-danger" id="tambah" href="#modal-default" role="button" data-toggle="modal">
          <i class="fa fa-search-plus"></i> Cari WO
        </a>
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="modal fade in" id="modal-default" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Daftar WO belum selesai</h4>
            </div>
            <div class="modal-body">
              <table id="dt-table" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade in" id="modal-wa" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">WA Laporan Realisasi Job</h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" rows="20" placeholder="Enter ..." id="generatewa"></textarea>
              <br>
              <button class="btn bg-orange" id="bcopy"><i class="fa fa-copy"></i> Copy</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <a class="btn btn-success" id="bwaweb"><i class="fa fa-whatsapp"></i> Share Via WA web</a>&nbsp;&nbsp;&nbsp;&nbsp;
              <a class="btn btn-success" id="bwaapp"><i class="fa fa-whatsapp"></i> Share Via WA App</a>
              <table id="dt-table" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade in" id="modal-create-wo" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Pilih WO / Buat WO</h4>
            </div>
            <div class="modal-body">
              content
            </div>
          </div>
        </div>
      </div>

      <div id="dialog" title="Daftar Realisasi Job Harian" width="1024" style="display:none; border-color: red;">
        <div data-role="body">
          <!-- <div class="box-body no-padding" style="
            height: 450px;
            width: 100%;
            overflow: auto;
          "> -->
            <table class="table table-striped" id="ui-louhan">
              <tbody><tr>
                <th>No WO</th>
                <th>Area</th>
                <th>Perbaikan</th>
                <th style="width: 40px">Status</th>
              </tr>
              <tr>
                <td>1.</td>
                <td>Update software</td>
                <td></td>
                <td><span class="badge bg-red">55%</span></td>
              </tr>

            </tbody></table>
          <!-- </div> -->
        </div>
        <div data-role="footer">

        </div>
      </div>      

      <!-- <div class="modal fade in" id="modal-sync" style="display: none;">
        <div class="modal-dialog" style="width :90%;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Daftar Realisasi Job Harian</h4>
            </div>
            <div class="modal-body">
              <div class="box-body no-padding" style="
                height: 450px;
                width: 100%;
                overflow: auto;
              ">
                <table class="table table-striped" id="ui-louhan">
                  <tbody><tr>
                    <th>No WO</th>
                    <th>Area</th>
                    <th>Perbaikan</th>
                    <th style="width: 40px">Status</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td></td>
                    <td><span class="badge bg-red">55%</span></td>
                  </tr>

                </tbody></table>
              </div>
            </div>
          </div>
        </div>
      </div> -->

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
          Tanggal : 
          <select id="tanggal">
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Filter by MPP : 
          <select id="mpp"></select>
          <br><br>
        </div>
        <div class="col-xs-8">
          <div id="scrll" style="
						height: 410px;
						width: 100%;
						overflow: auto;
					">
            <div id='my-spreadsheet'></div>      
          </div>
        </div>
        <div class="col-xs-4" id="side-note">
          <div style="
						height: 410px;
						width: 100%;
						overflow: auto;
					">
            <div id="keterangan">
              Station<br>
              Unit<br>
              Problem<br>
              Desc masalah 
            </div><br>
            <div id='my-spreadsheet2'></div><br>
            <div id='my-spare'></div>
          </div>
        </div>
      </div>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo base_url("schedule_maintenance")?>" aria-expanded="false">Schedule</a></li>
          <li class=""><a href="<?php echo base_url("planing")?>" aria-expanded="true">Plan</a></li>
          <li class=""><a href="<?php echo base_url("activity")?>" aria-expanded="false">Realisasi</a></li>
          <li class="active"><a href="<?php echo base_url("planvsreal")?>" aria-expanded="false">Plan VS Real</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <!-- <a class="btn btn-app btn-danger" id="tambah" href="#modal-default" role="button" data-toggle="modal"> -->
          <!-- <i class="fa fa-search-plus"></i> Cari WO -->
        <!-- </a> -->
        <!-- <a class="btn btn-app btn-success" id="sharewa">
          <i class="fa fa-whatsapp"></i> Share
        </a>
        <a class="btn btn-app btn-info" id="tambahwo" href="#modal-wo" role="button" data-toggle="modal">
          <i class="fa fa-industry"></i> WO
        </a> -->
        <a class="btn btn-app btn-success" id="download_excel" href="#" role="button" data-toggle="modal">
          <i class="fa fa-file-excel-o"></i> Download
        </a>
        <!-- <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a> -->
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
              <h4 class="modal-title">Tambah Plan Harian</h4>
            </div>
            <div class="modal-body">
              <h3 id="dpabrik"></h3>
              Station : <select id="station"><option></option></select>
              Unit : <select id="unit"><option></option></select>
              <br>
              <hr>
              <button id="tplus">Tambah</button>
              <table id="dt-table" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          <!-- Station : -->
          <!-- <?php echo $dropdown_station; ?> -->
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
            <option>--ALL--</option>
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
          <br><br>
          <div style="
						height: 450px;
						width: 100%;
						overflow: auto;
					">
            <div id='my-spreadsheet'></div> 
            <!-- <div class="loader"></div>              -->

          </div>
        </div>
      </div>
      </div>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- Create Work Order | Unfinished WO | Search WO -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#" aria-expanded="true">Create Work Order</a></li>
          <li class=""><a href="<?php echo base_url("wo/unfinished")?>" aria-expanded="false">Unfinished WO</a></li>
          <li class=""><a href="#tab_3" aria-expanded="false">Search WO</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-danger" id="tambah" href="#modal-default" role="button" data-toggle="modal">
          <i class="fa fa-plus"></i> Tambah
        </a>

        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
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
              <h4 class="modal-title">Tambah Work Order</h4>
            </div>
            <div class="modal-body">
              <h3 id="dpabrik"></h3>
              No WO  &nbsp;&nbsp; : <input type="text" id="no_wo_auto"/>
              <br><br>
              Station &nbsp;&nbsp;&nbsp;&nbsp;: <select id="station"><option></option></select>
              <br>
              <br>
              Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <select id="unit"><option></option></select>
              <br>
              <br>
              Sub Unit &nbsp;: <select id="sub_unit"><option></option></select>
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
          <br><br>
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

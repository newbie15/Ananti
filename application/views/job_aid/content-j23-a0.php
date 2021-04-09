  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo site_url("job_aid/j23") ?>" aria-expanded="true">J23</a></li>
          <li class="active"><a href="<?php echo site_url("job_aid/j23/a0") ?>" aria-expanded="false">A0 - Visual Inspection</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <a class="btn btn-app btn-danger" id="tambah" href="#modal-j23" role="button" data-toggle="modal">
          <i class="fa fa-plus"></i> Tambah
        </a>
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="modal fade in" id="modal-j23" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Daftar Attachment dengan Job Aid J23</h4>
            </div>
            <div class="modal-body">
              <table id="dt-table-j23" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>
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
          <h4>Point Inspeksi</h4>
          <div class="col-xs-6">
          <strong>A</strong> HouseKeeping<br>
          <strong>B</strong> Tanda-tanda tikus, Penetrasi tertutup<br>
          <strong>C</strong> Tidak ada tanda-tanda basah, lembab dan berdebu. (seal sudah)<br>
          <strong>D</strong> Terdapat label Arcflash/Safety/statutary<br>
          <strong>E</strong> Sudah menggunakan PPE yang sesuai dan kondisi baik<br>
          <strong>F</strong> Remote switching bisa memungkinkan<br>
          <strong>G</strong> Firestop pada MCC penetration (fire proofing)<br>
          </div>
          <div class="col-xs-6">
          <strong>H</strong> Pintu bisa terkunci dan tertutup<br>
          <strong>I</strong> Tidak ada jendela kaca<br>
          <strong>J</strong> Akses tidak terhalang<br>
          <strong>K</strong> Terdapat AC dan kondisi  suhu ruangan normal<br>
          <strong>L</strong> Terdapat Fire & Smoke detector/Fire Extinguisher<br>
          <strong>M</strong> Lampu Ruang/Lampu Emergency dan Exit dalam kondisi baik<br>
          <strong>N</strong> Single Line drawing sesuai dan dapat terbaca<br>
          </div>          
          <div style="height: 500px;width: 100%;overflow: auto;">
            <br>
            <div id='my-spreadsheet'>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

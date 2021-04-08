  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
        <li class=""><a href="<?php echo site_url("job_aid/j20") ?>" aria-expanded="true">J20</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j20/a0") ?>" aria-expanded="false">A0 - Visual Inspection</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j20/a3") ?>" aria-expanded="false">A3 - Infrared Inspection</a></li>
          <li class="active"><a href="<?php echo site_url("job_aid/j20/a14") ?>" aria-expanded="false">A14 - Electrical Operability Test</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <a class="btn btn-app btn-danger" id="tambah" href="#modal-j20" role="button" data-toggle="modal">
          <i class="fa fa-plus"></i> Tambah
        </a>
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="modal fade in" id="modal-j20" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Daftar Attachment dengan Job Aid J20</h4>
            </div>
            <div class="modal-body">
              <table id="dt-table-j20" class="display" width="100%"></table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          Pabrik : 
          <?php echo $dropdown_pabrik ?>
          Station :
          <?php echo $dropdown_station; ?>
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
          <div class="col-xs-6">
            <h2>Item Pemeliharaan</h2>
            <strong>PEMBERSIHAN</strong><br>
            A) Pembersihan Unit sesuai rekomendasi manufaktur<br>
            B) Pembersihan lubang-lubang ventilasi menggunakan vacuum cleaner<br>
            C) Pembersihan permukaan kontak/terminal termasuk jika ada grease sisa<br>
            D) Pembersihan permukaan insulasi<br>
            E) Pembersihan permukaan Arc chute (Arc chamber jika dalam Schneider ACB atau Arc Extinguishers jika MCCB)), gunakan denatured alcohol<br>
            F) Pembersihan spring dan bagian mekanikal (gunakan denatured alcohol)<br>
            <strong>ARC Chute</strong><br>
            G) inspeksi adanya keretakan atau tanda-tanda overheating pada arc chute, Jika ada maka perlu diganti<br>
            H) Pembersihan rumah/wadah arc chute (arc chamber) dan permukaannya<br>
            <strong>LUBRIKASI</strong><br>
            I) Lakukan lubrikasi yang di rekomendasikan oleh manufaktur<br>
            <strong>Contact Wipe (pressure) or Contact Erosion, and Contact Gap</strong><br>
            J) Contact Wipe-Defleksi pada stasioner kontak (breaker kondisi close)<br>
            K) Contact Erosion (*Lakukan hanya pada Vaccum Breaker)<br>
            L) Contact Gap-Ukur Jarak antara stationer kontak dengan moving kontak (Breaker kondisi Open)<br>
          </div>
          <div class="col-xs-6">
            <h2>Item Pengetesan</h2>
            <strong>Injeksi Arus</strong><br>
            Inspeksi trip unit breaker dan masukkan setting sebagai AS-FOUND<br>
            A) Tes fungsi "Long Time Trip"<br>
            B) Tes fungsi "Short Time Trip"<br>
            C) Tes fungsi "Instanteneous Trip"<br>
            D) Tes fungsi "Ground Fault"<br>
            <strong>Pick Up Voltage</strong><br>
            E) Sudah menggunakan Variac untuk variable voltage<br>
            F) Tes fungsi "Pick-up voltage"<br>
            <strong>Operational Test</strong><br>
            G) Fuse power kontrol terpasang dan ukurannya sesuai<br>
            H) Charge motorized (MCH) berfungsi dengan baik<br>
            I) Test Fungsi Open dan Close berfungsi dengan baik<br>
            J) Cek motorized breaker OFF setelah charging<br>
            K) Operasional breaker dari remote devices berfungsi dengan baik<br>
            L) Manual charging (menggunakan tuas) berfungsi dengan baik<br>
          </div>

          <br>
          <div style="height: 500px;width: 100%;overflow: auto;">
            <div class="col-xs-6">
              <div id='my-spreadsheet'>
              </div>
            </div>
            <div class="col-xs-6">
              <div id='my-spreadsheet2'>
              </div>
            </div>

            <br/>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

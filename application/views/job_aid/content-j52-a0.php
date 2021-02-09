  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ul class="nav nav-tabs">
          <li class=""><a href="<?php echo site_url("job_aid/j52") ?>" aria-expanded="true">J52</a></li>
          <li class="active"><a href="<?php echo site_url("job_aid/j52/a0") ?>" aria-expanded="false">A0 - Visual Inspection</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j52/a8") ?>" aria-expanded="false">A8 - Insulation Resistance Testing</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j52/a12") ?>" aria-expanded="false">A12 - Winding Resistance Testing</a></li>
          <li class=""><a href="<?php echo site_url("job_aid/j52/a18") ?>" aria-expanded="false">A18 - Grounding Continuity Testing</a></li>
        </ul>
      </h1>
      <ol class="breadcrumb">
        <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-primary" id="simpan">
          <i class="fa fa-save"></i> Simpan
        </a>
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
						height: 500px;
						width: 100%;
						overflow: auto;
					">
            <p id='my-content'>
              <?php echo $content; ?>
            </p>
          </div>
          <hr/> 
            <strong>Comment :</strong><br/>
            <?php echo $comment; ?>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

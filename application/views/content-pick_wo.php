<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin:0px;">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#pck" data-toggle="tab" aria-expanded="true">Pick WO</a></li>
        <li class=""><a href="#crt" data-toggle="tab" aria-expanded="false">Tambah WO</a></li>
      </ul>
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xs-12">
        <div class="tab-content">
          <div class="tab-pane active" id="pck">
            Pabrik : 
            <?php echo $dropdown_pabrik ?>
            Station :
            <?php echo $dropdown_station; ?>
            Unit :
            <?php echo $dropdown_unit; ?>
            Sub Unit :
            <?php echo $dropdown_sub_unit; ?>
            <br><br>
            <strong>Problem</strong> : <span id="problem"></span><br>
            <strong>Penyelesaian</strong> : <span id="penyelesaian"></span><br><br>
            <table id="my-table" class="table" width="100%" style="background-color: white;"></table>    
          </div>
          <div class="tab-pane" id="crt">

            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Buat WO Baru</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-6">
                      <input type="date" class="form-control" id="inp_tanggal" placeholder="Tanggal">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">No WO</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inp_no_wo" placeholder="Nomor Work Order">
                    </div>
                    <div class="col-sm-4">
                      <a class="btn btn-danger pull-left" id="gen_no_wo">Generate No WO</a>
                      <!-- <input type="text" class="form-control" id="inp_no_wo" placeholder="Nomor Work Order"> -->
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Station</label>
                    <div class="col-sm-6">
                      <select id="inp_station" class="form-control"></select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-6">
                      <select id="inp_unit" class="form-control"></select>
                    </div>
                  </div>                  

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Sub Unit</label>
                    <div class="col-sm-6">
                      <select id="inp_sub_unit" class="form-control"></select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Problem</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inp_problem" placeholder="Problem">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="no_wo" class="col-sm-2 control-label">Tipe</label>
                    <div class="col-sm-6">
                      <select id="inp_tipe" class="form-control">
                        <option>Pilih Salah Satu</option>
                        <option value="M">Mekanik</option>
                        <option value="E">Elektrik</option>
                      </select>
                    </div>
                  </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button onclick="window.close()" class="btn btn-default">Cancel</button>
                  <button class="btn btn-primary pull-right" id="savenchoose">Simpan & Pilih</button>
                </div>
                <!-- /.box-footer -->
              </form>
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

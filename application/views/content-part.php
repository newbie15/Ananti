    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <ul class="nav nav-tabs">
                    <li class=""><a href="<?php echo site_url("station") ?>" aria-expanded="true">Station</a></li>
                    <li class=""><a href="<?php echo site_url("unit") ?>" aria-expanded="false">Unit</a></li>
                    <li class=""><a href="<?php echo site_url("sub_unit") ?>" aria-expanded="false">Sub Unit</a></li>
                    <li class=""><a href="<?php echo site_url("attachment") ?>" aria-expanded="false">Attachment</a></li>
                    <li class="active"><a href="" aria-expanded="false">Part</a></li>
                </ul>
            </h1>
            <ol class="breadcrumb">
                <!-- <button id="simpan">Simpan</button> -->
                <a class="btn btn-app btn-danger" id="tambahpart" href="#modal-part-katalog" role="button" data-toggle="modal">
                    <i class="fa fa-plus"></i> Tambah
                </a>
                <a class="btn btn-app btn-primary" id="simpan">
                    <i class="fa fa-save"></i> Simpan
                </a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="modal fade in" id="modal-part-katalog" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Daftar Part</h4>
                        </div>
                        <div class="modal-body">
                            <table id="dt-table-part" class="display" width="100%"></table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <?php //echo $content; 
                    ?>
                    Pabrik :
                    <?php echo $dropdown_pabrik ?>
                    Station :
                    <?php echo $dropdown_station; ?>
                    Unit :
                    <?php echo $dropdown_unit; ?>
                    Sub Unit :
                    <?php echo $dropdown_sub_unit; ?>
                    Attachment :
                    <?php echo $dropdown_attachment; ?>
                    <br><br>
                    <!-- <button id="simpan">Simpan</button> -->
                    <div id='my-spreadsheet'></div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
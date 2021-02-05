<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <ul class="nav nav-tabs">
                <li class=""><a href="<?php echo site_url("sop") ?>" aria-expanded="true">SOP</a></li>
                <li class="active"><a href="<?php echo site_url("ik") ?>" aria-expanded="false">Instruksi Kerja</a></li>
                <li class=""><a href="<?php echo site_url("drawing") ?>" aria-expanded="false">Drawing</a></li>
                <li class=""><a href="<?php echo site_url("datasheet") ?>" aria-expanded="false">Datasheet</a></li>
            </ul>
        </h1>
        <ol class="breadcrumb">
            <!-- <button id="simpan">Simpan</button> -->
            <!-- <a class="btn btn-app btn-danger" id="cari" href="#modal-default" role="button" data-toggle="modal">
                <i class="fa fa-search"></i> Cari Datasheet
            </a> -->
            <a class="btn btn-app btn-primary" id="simpan" href="#modal-default" role="button" data-toggle="modal">
                <i class="fa fa-upload"></i> Upload
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
                        <h4 class="modal-title">Upload Instruksi Kerja</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= site_url("ik/upload") ?>" class="dropzone needsclick dz-clickable" id="dropzones">
                            <div class="dz-message needsclick">
                                <button type="button" class="dz-button">Drop files here or click to upload.</button><br>
                                (Please Refresh page. After upload complete to see your file on the list.)
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <table id="d-datasheet" class="table table-bordered table-striped"></table>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <ul class="nav nav-tabs">
        <li class=""><a href="<?php echo base_url("sop") ?>" aria-expanded="true">SOP</a></li>
        <li class=""><a href="<?php echo base_url("ik") ?>" aria-expanded="false">Instruksi Kerja</a></li>
        <li class=""><a href="<?php echo base_url("drawing") ?>" aria-expanded="false">Drawing</a></li>
        <li class="active"><a href="<?php echo base_url("datasheet") ?>" aria-expanded="false">Datasheet</a></li>
    </ul>
    </h1>
    <ol class="breadcrumb">
    <!-- <button id="simpan">Simpan</button> -->
        <a class="btn btn-app btn-danger" id="cari" href="#modal-default" role="button" data-toggle="modal">
            <i class="fa fa-search"></i> Cari Datasheet
        </a>
    <a class="btn btn-app btn-primary" id="simpan">
        <i class="fa fa-upload"></i> Upload
    </a>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-xs-12">
        <div id='my-spreadsheet'></div>
    </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
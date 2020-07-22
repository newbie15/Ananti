    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <ul class="nav nav-tabs">
            <li class=""><a href="<?php echo base_url("grouping")?>" aria-expanded="true">Grouping</a></li>
            <li class="active"><a href="" aria-expanded="false">Grouping Unit</a></li>
            <!-- <li class=""><a href="<?php echo base_url("sub_unit")?>" aria-expanded="false">Sub Unit</a></li>
            <li class=""><a href="<?php echo base_url("attachment")?>" aria-expanded="false">Attachment</a></li> -->
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
                <h4 class="modal-title">Tambah Grouping Unit</h4>
            </div>
            <div class="modal-body">
                Station &nbsp;&nbsp;&nbsp;&nbsp;: <select id="station"><option></option></select>
                <br>
                <br>
                Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <select id="unit"><option></option></select>
                <br>
                <br>
                Sub Unit &nbsp;: <select id="sub_unit"><option></option></select>
                <br>
                <span style="float:right;">
                    <button id="tplus">Tambah</button>              
                </span>
                <!-- <hr> -->
                <table id="dt-table" class="display" width="100%"></table>
            </div>
            </div>
        </div>
        </div>    
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-xs-12">
            <?php //echo $content; ?>
            Pabrik : 
            <?php echo $dropdown_pabrik ?>
            Group Unit : 
            <?php echo $dropdown_group_unit ?>
            <br><br>
            <!-- <button id="simpan">Simpan</button> -->
            <div id="scrll" style="overflow: true; height: 450px;">
                <div id='my-spreadsheet'></div>
            </div>      
        </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

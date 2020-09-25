<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <?=$main_title?>
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
        <br><br>
        <div id='my-spreadsheet'></div>      
        </div>
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

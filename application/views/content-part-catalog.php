    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=$main_title?>
                <small>Pastikan nomor part sama untuk semua pabrik</small>
            </h1>
            <ol class="breadcrumb">
                <a class="btn btn-app btn-success" id="tambah" href="#modal-default" role="button" data-toggle="modal">
                    <i class="fa fa-upload"></i> Upload
                </a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <br>
                    <div id='my-spreadsheet'>
                        <?php echo $crud->output; ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
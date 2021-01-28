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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin:0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <?=$main_title?>
    </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
        <?php //echo $content; ?>
        Pabrik : 
        <?php echo $dropdown_pabrik ?>
        Station :
        <?php echo $dropdown_station; ?>
        Unit :
        <?php echo $dropdown_unit; ?>
        Sub Unit :
        <?php echo $dropdown_sub_unit; ?>
        <br><br>
        <table id="my-table" class="table" width="100%"></table>    
        </div>
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

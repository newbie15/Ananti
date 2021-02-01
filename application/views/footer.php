  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; 2018 <a href="http://twitter.com/fajarrukmo">Fajar Rukmo</a>.</strong> All rights
    reserved.
  </footer> -->


</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- jQuery UI 1.11.4 -->
<!-- <script src="<?php echo base_url();?>assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<?php if(isset($js_files)){ ?>
<?php foreach($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; 
}?>

<?php if (isset($crud)) { ?>
<?php foreach($crud as $file): ?>
  <script src="<?php echo $file; ?>"></script>
<?php endforeach;
}?>
</body>
</html>
<div id="viewer">
</div>

<script src="<?php echo $config; ?>"></script>
<script src="<?php echo $js; ?>"></script>
<script>
    PDFObject.embed(BASE_URL + "/assets/uploads/" + "<?php echo $dokumen; ?>" + "/" + "<?php echo $filename; ?>", "#viewer");
</script>
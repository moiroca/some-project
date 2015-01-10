</div>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src=<?php echo base_url("public/js/jquery.min.js"); ?>></script>
    <!-- Bootstrap Core JavaScript -->
    <script src=<?php echo base_url("public/js/bootstrap.min.js"); ?>></script>
    <script>
		var base_url = "<?php echo base_url(); ?>";
    </script>
    <?php customLoader::js(isset($js)?$js:array()); ?>
</body>
</html>

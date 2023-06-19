<?php
$classColor = $_SESSION['restaurante']['class_color'];
?>
<script>
    const base_url = "<?= base_url(); ?>";
    const web_url = "<?= web_url(); ?>";
    const statusCarrito = "<?= $_SESSION['carrito']['status']; ?>";
    const class_color = "<?= $classColor; ?>";
</script>
<!-- Essential javascripts for application to work-->
<!-- JAVA SCRIPTS -->
<script src="<?= media(); ?>/menu/js/jquery.min.js"></script>
<script src="<?= media(); ?>/menu/js/popper.min.js"></script>
<script src="<?= media(); ?>/menu/js/bootstrap.min.js"></script>
<script src="<?= media(); ?>/menu/js/slick.min.js"></script>
<script src="<?= media(); ?>/menu/js/jquery.sticky-sidebar.min.js"></script>
<script type="text/javascript" src="<?= media(); ?>/menu/js/functions_<?= $data['page_name']; ?>.js?v=<?= time(); ?>"></script>
<script src="<?= media(); ?>/menu/js/custom.js?v=<?= time(); ?>"></script>
</body>

</html>
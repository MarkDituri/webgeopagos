<!-- Javascript Files -->
<script src="<?= media();?>/web/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= media();?>/web/js/bootstrap.min.js"></script>
<!-- Swiper Slider -->
<script src="<?= media();?>/web/js/swiper.min.js"></script>
<!-- OWL Carousel -->
<!-- <script src="<?= media();?>/web/js/owl.carousel.min.js"></script> -->
<!-- Waypoint -->
<script src="<?= media();?>/web/js/jquery.waypoints.min.js"></script>
<!-- Easy Waypoint -->
<script src="<?= media();?>/web/js/easy-waypoint-animate.js"></script>
<!-- Scripts -->
<script src="<?= media();?>/web/js/scripts.js?v=<?php echo time(); ?>"></script>
<!-- Carousel Features 1 -->
<script src="<?= media();?>/web/js/carousel-features1.js"></script>
<!-- Carousel App Screen 1 -->
<!-- <script src="<?= media();?>/web/js/carousel-appscreen1.js"></script> -->
<!-- Carousel Testimonial 1 -->
<!-- <script src="<?= media();?>/web/js/carousel-testimonial1.js"></script> -->

<?php
    $pagina = $data['page_name'];
    $host = $_SERVER["HTTP_HOST"];
?>

<?php if(!empty($data['page_js'])) { ?>
    <script src="<?= media();?>/web/js/<?= $data['page_js'];?>?v=<?php echo time(); ?>"></script>
<?php } ?>

<?php if($host == "qudimar.com"){ ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFX7GX7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php };?>

<?php if($host == "qudimar.com" || $host == "dev.qudimar.com"){ ?>
    <?php if($pagina == "empezar"){ ?>
    <!-- recaptchaResponse  -->
    <script src='https://www.google.com/recaptcha/api.js?render=6LeFReUiAAAAALs3pDHwsfqQfBl27cEcZ6xk7brY'> </script>
    <script>
        grecaptcha.ready(function() {
        grecaptcha.execute('6LeFReUiAAAAALs3pDHwsfqQfBl27cEcZ6xk7brY', {action: 'ejemplo'})
        .then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
        });});
    </script>
    <?php };?>
<?php };?>
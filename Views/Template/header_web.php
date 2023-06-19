<?php 
    $titulo = "Qudimar | Tu carta online lista para escanear";
    $descripcion = "Software para locales gastronómicos, bares y restaurantes. ¡Crea tu menú QR para tus mesas, 30 días de prueba gratis!";
    $image = base_url().'/assets/images/og-image.jpg';
    $url = base_url().'/';    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Uniocde -->
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <![endif]-->
    <!-- First Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- Page Kewords -->
    <meta name="keywords" content="Qudimar">
    <!-- Site Author -->
    <meta name="author" content="Qudimar">        
    <!-- SEO -->    
    <!-- HTML Meta Tags -->
    <title><?= $titulo; ?></title>
    <meta name="description" content="<?= $descripcion; ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?= $url;?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $titulo; ?>">
    <meta property="og:description" content="<?= $descripcion; ?>">
    <meta property="og:image" content="<?= $image; ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="qudimar.com">
    <meta property="twitter:url" content="<?= $url;?>">
    <meta name="twitter:title" content="<?= $titulo; ?>">
    <meta name="twitter:description" content="<?= $descripcion; ?>">
    <meta name="twitter:image" content="<?= $image; ?>">
    <!-- Meta Tags Generated via https://www.opengraph.xyz -->        
    <!-- Canonical URL -->
    <link rel="canonical" href="<?= base_url();?>/<?= $data['page_canonical'];?>">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= media();?>/web/images/favicon.png">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= media();?>/web/css/bootstrap.min.css" type="text/css">
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="<?= media();?>/web/css/swiper.min.css" type="text/css">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= media();?>/web/fonts/fontawesome/font-awesome.min.css">
    <!-- OWL Carousel -->
    <link rel="stylesheet" href="<?= media();?>/web/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= media();?>/web/css/owl.theme.default.min.css" type="text/css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="<?= media();?>/web/css/animate.min.css" type="text/css">
    <!-- Style -->
    <link rel="stylesheet" href="<?= media();?>/web/css/style.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="<?= media();?>/web/css/succes.css?v=<?php echo time(); ?>" type="text/css">    
    <?php if($_SERVER["HTTP_HOST"] == "qudimar.com"){ ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-T12GBWX2SC"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-T12GBWX2SC');
        </script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MFX7GX7');</script>
        <!-- End Google Tag Manager -->
    <?php };?>
</head>
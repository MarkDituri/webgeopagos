<?php
  $arrRest = $_SESSION['restaurante'];  
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php
  $titulo = "Menú Digital | " . $arrRest['nombre_rest'];
  $descripcion = "Visitá nuestro menú online y ordená lo que quieras, tenemos Take Away y Delivery, rápido y fácil!";
  $image = media() . '/menu/images/meta_img.jpg';
  $url = base_url() . '/';
  ?>
  <!-- Primary Meta Tags -->
  <title><?= $titulo; ?></title>
  <meta name="title" content="<?= $titulo; ?>">
  <meta name="description" content="<?= $descripcion; ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $url; ?>">
  <meta property="og:title" content="<?= $titulo; ?>">
  <meta property="og:description" content="<?= $descripcion; ?>">
  <meta property="og:image" content="<?= $image; ?>">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?= $url; ?>">
  <meta property="twitter:title" content="<?= $titulo; ?>">
  <meta property="twitter:description" content="<?= $descripcion; ?>">
  <meta property="twitter:image" content="<?= $image; ?>">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="<?= media(); ?>/menu/images/favicon.png">

  <!-- STYLES -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="<?= media(); ?>/menu/css/bootstrap.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?= media(); ?>/menu/css/slick.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?= media(); ?>/menu/css/style.css?v=<?php echo time(); ?>" type="text/css" media="all">
  <link rel="stylesheet" href="<?= media(); ?>/menu/css/custom.css?v=<?php echo time(); ?>" type="text/css" media="all">

  <?php
  // dep($_SESSION);
  $dark = $_SESSION['restaurante']['dark_mode'];
  if ($dark == 1) { ?>
    <link rel="stylesheet" href="<?= media(); ?>/menu/css/dark.css?v=<?php echo time(); ?>" type="text/css" media="all">
  <?php } ?>
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="app sidebar-mini">
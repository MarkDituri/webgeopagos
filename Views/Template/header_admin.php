<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Admin Qudimar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Qudimar">
    <meta name="theme-color" content="#64caac">
    <link rel="shortcut icon" href="<?= base_url(); ?>/Assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title><?= $data['page_tag'] ?> | Qudimar</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/bootstrap-select.min.css">     
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/style.css?v=<?php echo time(); ?>">
    <?php        
    if ($data['page_title'] == "Pagos"){        
        $preference = MercadoPago(); ?>    
        <script src="https://sdk.mercadopago.com/js/v2"></script>
    <?php } ?>
  </head>
  <body class="app sidebar-mini">
    <div id="divLoading" >
      <div>
        <img src="<?= base_url(); ?>/Assets/images/loading.svg" alt="Loading">
      </div>
    </div>
    <!--Notificaciones-->
    <!-- <div class="app-notificacion">
      <div class="cont-notificacion">
        <h2>Contenido de l anotificacion</h2>
      </div>
    </div> -->
    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="<?= base_url(); ?>/dashboard">
        <img src="<?= media(); ?>/web/images/logo.png" alt="">
      </a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar">
        <i class="fas fa-bars"></i>
      </a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown li-guia"><a class="app-nav__item" href="<?= web_url(); ?>/guia" target="_blank"><i class="fa fa-book"></i> Ver Guía</a></li>
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">        
            <li><a class="dropdown-item" href="<?= base_url(); ?>/usuarios/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/usuarios/perfil"><i class="fa-solid fa-gear fa-lg"></i> Opciones</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="fa fa-sign-out fa-lg"></i> Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <?php 
      require_once("nav_admin.php"); 
      getModal('modalGuia', $data);
      getModal('modalQR', $data);
    ?> 

    
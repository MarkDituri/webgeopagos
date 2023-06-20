<?php
$titulo = "Qudimar | Tu carta online";
$descripcion = "¡Crea tu menú QR para tus mesas, 30 días de prueba gratis!";
$image = media() . '/menu/images/og-image.jpg';
$url = base_url() . '/';

/* - Dar respuesta a tipo de ERROR */
if($_GET){
    if (isset($_GET['msg'])){
        $msg = $_GET["msg"];
        if ($msg == "singet") {
            $viewError = "Debe escanear un código QR para ingresar.";
        } if ($msg == "sinrest") {
            $viewError = "No encontramos ningún restaurante activo.";
        } if ($msg == "srv") {
            $viewError = "Ha ocurrido un error.";
        } if($msg == 'nocat'){
            $viewError = "Debe contar con al menos 1 categoría activa";
        }
        if ($msg == "nopay") {
            $viewError = "Cuenta temporalmente inactiva.";
        }
    } else {
        $viewError = "Ha ocurrido un error desconocido.";
    }
} else {
    $viewError = "Ha ocurrido un error desconocido.";
}

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
    <meta property="og:url" content="<?= $url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $titulo; ?>">
    <meta property="og:description" content="<?= $descripcion; ?>">
    <meta property="og:image" content="<?= $image; ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="qudimar.com">
    <meta property="twitter:url" content="<?= $url; ?>">
    <meta name="twitter:title" content="<?= $titulo; ?>">
    <meta name="twitter:description" content="<?= $descripcion; ?>">
    <meta name="twitter:image" content="<?= $image; ?>">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap");

        body {
            color: #;
            font-family: "Roboto", sans-serif;
            font-size: 15px;
            line-height: 1.2 !important;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cont-msgError {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="cont-msgError">
        <a href="<?= base_url(); ?>">
            <img src="<?= media(); ?>/menu/images/logo-2.png" alt="logo" />
        </a>
        <h2><?= $viewError; ?></h2>
    </div>
</body>

</html>
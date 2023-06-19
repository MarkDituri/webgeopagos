<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Qudimar">    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/Assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/style.css">
    
    <title><?= $data['page_tag']; ?> - Qudimar</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="login-box flipped" style="border-radius: 0;">
        <div id="divLoading" >
          <div>
            <img src="<?= base_url(); ?>/Assets/images/loading.svg" alt="Loading">
          </div>
        </div>
        <a href="<?= base_url(); ?>" class="cont-logo-login">
          <img style="width: 200px!important;" src="<?= base_url(); ?>/Assets/images/portada_logo.png" alt="Logo Qudimar">
        </a>  
        <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">
          <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $data['id_restaurante']; ?>" required >
          <input type="hidden" id="txtEmail" name="txtEmail" value="<?= $data['email']; ?>" required >
          <input type="hidden" id="txtToken" name="txtToken" value="<?= $data['token']; ?>" required >
          <h3 class="login-head"><i class="fas fa-key"></i> Cambiar contraseña</h3>
          <div class="form-group col-sm-12 col-md-12 col-lg-12" id="msg-gral">						
          </div>
          <div class="form-group col-12">
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Nueva contraseña" >
            <div class="Mensaje" id="msg-txtPassword"></div>
          </div>
          <div class="form-group col-12">
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Confirmar contraseña" >
            <div class="Mensaje" id="msg-txtPassword-2"></div>
          </div>
          <div class="form-group btn-container col-12">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Reiniciar</button>
          </div>
        </form>
      </div>
    </section>
    <script>
        const base_url = "<?= base_url(); ?>";        
        const page_name = "<?= $data['page_name'];?>";  
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= base_url(); ?>/Assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/fontawesome.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= base_url(); ?>/Assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/sweetalert.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/<?= $data['page_functions_js']; ?>"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Admin Qudimar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Marcos Dituri">
    <meta name="theme-color" content="#64caac">
    <link rel="shortcut icon" href="<?= base_url(); ?>/Assets/images/favicon.png">
    <title><?= $data['page_tag'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/bootstrap-select.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/js/datepicker/jquery-ui.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/style.css">
  </head>

  <body id="login-body" style="background: url(<?= base_url(); ?>/Assets/images/login.jpg); background-size: cover; background-position: center;">

    <section class="col-lg-5 col-xl-4 login-content">

      <div class="login-box">
  
        <div id="divLoading" >
          <div>
            <img src="<?= base_url(); ?>/Assets/images/loading.svg" alt="Loading">
          </div>
        </div>

        <a href="<?= base_url(); ?>" class="cont-logo-login">
          <img src="<?= base_url(); ?>/Assets/images/portada_logo.png" alt="Logo Qudimar">
        </a>        

        <!-- Envio de email mensaje -->        
        <div id="mensajeMailSned" class="login-form cont-boxSucces">
          <h2>Se ha enviado un email</h2>
          <p class="p-1">Ingrese a tu cuenta de correo para cambiar tu contraseña.<p>
          <div class="alert"><i class="fa fa-envelope"></i> Revise su bandeja de entrada.</div>
        </div>        

        <!-- Formulario de inicio -->
        <form class="login-form" name="formLogin" id="formLogin" action="">          
          <h3 class="login-head">Iniciar sesión</h3>
          <div id="msgAlert" class="col-12 msg-gral"></div>        
          <div class="form-group">
            <label class="control-label">Usuario</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
            </div>
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
          <br>
          <div class="form-group">
            <div class="utility">
              <p class="mb-2">¿No tenes cuenta? <a class="semibold-text mb-2" href="../../empezar"> Registrarme</a></p>
            </div>
          </div>
        </form>

        <!-- Formulario de reset -->
        <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div id="msgAlert2" class="col-12 msg-gral"></div>        
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Reiniciar clave</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
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
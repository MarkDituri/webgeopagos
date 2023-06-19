<?php
headerWeb($data);
$token = $data['token'];
$email = $data['email'];
?>

<body>
    <?php
    // Section Preloader	
    loadingWeb();
    ?>
    <!-- Section Navbar -->
    <nav class="navbar-1 navbar navbar-expand-lg navbar-black">
        <div class="container navbar-container">
            <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= media(); ?>/web/images/logo-2.png" alt="logo-qudimar"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link scroll-down" href="<?= base_url(); ?>">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/#section-features1" class="nav-link scroll-down">Caracteristicas</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/#section-pricing1" class="nav-link scroll-down">Precios</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/guia" class="nav-link scroll-down"><i class="fa fa-book"></i> Guia</a>
                    </li>
                    <li class="nav-item soloMob">
						<a href="<?= base_url(); ?>/login" class="nav-link scroll-down ">
							<i class="fa-solid fa-right-to-bracket"></i>
							Ingresar
						</a>
					</li>
                    <li class="nav-item contRedSocial">
                        <a target="_blank" href="https://www.instagram.com/qudimar/" class="btnSocial insta">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <a href="empezar" class="btn-1 style3 bgscheme"><b>Crear cuenta</b></a>
            <a href="login" class="soloDesk btn-1 btn-2-off style3 brscheme" style="max-width: 125px;"><b>Ingresar</b></a>
            <button type="button" id="sidebarCollapse" class="navbar-toggler active" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!-- container -->
    </nav>
    <!-- /.Section Navbar -->

    <div class="container section_clave" id="section-action">
        <?php
        if ($data['value'] == 'error') { ?>
            <div class="col-12 cont-boxSucces">
                <img src="<?= media(); ?>/web/images/error-icon.png" alt="">
                <h2><?= $data['msg'] ?></h2>
                <h5 class="p-1"><?= $data['p']; ?></h5>
            </div>
        <?php }
        if ($data['value'] == 'activa') { ?>

            <form class="col-12" id="formCrear" method="POST" action="<?= base_url() ?>/empezar/guardar_clave">
                <div class="row">
                    <div class="col-12 cont-info">
                        <h2><i class="fa-solid fa-key"></i> Creá tu contraseña</h2>
                        <p>La contraseña debe tener un mínimo de 6 caracteres, con letras y números.</p>
                        <!-- <p class="p-1">Contraseña vacia.</p>		 -->
                    </div>
                </div>

                <div class="row" id="cont-formClave">
                    <div class=" form-group col-sm-12 col-md-12 col-lg-12" id="msg-gral"></div>
                    <label class="col-12">Nueva contraseña</label>
                    <!--Email-->
                    <input type="hidden" class="form-control" name="email" id="email" value="<?= $email; ?>">
                    <input type="hidden" class="form-control" name="token" id="token" value="<?= $token; ?>">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <input type="password" class="form-control" name="clave_1" id="clave_1" placeholder="Ingrese una clave">
                        <div class="Mensaje" id="msg-clave_1"></div>
                    </div>
                    <label class="col-12">Repetir la contraseña</label>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <input type="password" class="form-control" name="clave_2" id="clave_2" placeholder="Repita la clave">
                        <div class="Mensaje" id="msg-clave_2"></div>
                    </div>
                </div>

                <div class="cont-btns-form row">
                    <div class="form-group col-md-6 col-12">
                        <button type="submit" class="shadow1 style3 input-btn bgscheme">Crear cuenta</button>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <a href="<?= base_url();?>/login" target="_blank" type="button" class="shadow1 btn style3 input-btn brscheme">Ya tengo cuenta</a>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
    <!-- /.Section Slider 1 -->
    <?php
    footerWeb();
    scriptsWeb($data);
    ?>
</body>

</html>
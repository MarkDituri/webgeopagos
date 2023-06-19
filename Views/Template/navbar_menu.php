<?php
$dataRestaurante = $_SESSION['restaurante'];
$classColor =      $_SESSION['restaurante']['class_color'];
?>
<!-- preloader -->
<div id="preloader">
	<div class="loader loader_<?= $classColor; ?>"></div>
</div>

<div class="main-overlay"></div>

<header class="header-default">
	<nav class="navbar navbar-expand-lg">
		<input type="hidden" name="id_restaurante" id="id_restaurante" value="<?= $_SESSION['restaurante']['id_restaurante']; ?>">
		<div class="container-xl">
			<!-- site logo -->
			<a href="<?= base_url(); ?>/menu/id/<?= $dataRestaurante['url']; ?>" id="logoCont" class="navbar-brand" href="home" style="background: url(<?= media(); ?>/images/uploads/<?= $dataRestaurante['url_logo']; ?>)no-repeat; background-position: center; background-size: contain;">
			</a>
			<!-- header right section -->
			<div class="header-right">
				<!-- header buttons -->
				<div class="header-buttons">
					<?php
					if ($_SESSION['carrito']['status'] == 0) {
						if (!empty($_SESSION['carrito']['modo'])) {
							$dataModo = getIconModo($_SESSION['carrito']['modo']);
							print '<a class="' . $classColor . '_color search icon-button icon-modo" href="' . base_url() . '/menu/modos">'
								. $dataModo['icono'] . "<span>" .
								$dataModo['texto'] . '</span></a>';
						}
					}

					if ($dataRestaurante['instagram'] != '') {
						print '<a class="icon-circle ' . $classColor . '_color search icon-button" target="_blank" href="https://www.instagram.com/' . $dataRestaurante['instagram'] . '"><i class="fab fa-instagram"></i></a>';
					} ?>
					<button class="icon-circle burger-menu <?= $classColor; ?>_color icon-button">
						<i class="fa-solid fa-bars"></i>
					</button>
				</div>
			</div>
		</div>
	</nav>
</header>

<!-- Menu Desplegable -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close">
		<i class="fa-solid fa-xmark"></i>
	</button>

	<!-- logo -->
	<div id="logo-menu" class="logo" style="background: url(<?= media(); ?>/images/uploads/<?= $dataRestaurante['url_logo']; ?>)no-repeat; background-position: center; background-size: contain;">
	</div>

	<ul class="vertical-menu">
		<li>¡Gracias por visitar <b><?= $dataRestaurante['nombre_rest']; ?> </b>!</li>
	</ul>

	<!-- Sesion  -->
	<?php if (isset($_SESSION['comensal'])) { ?>
		<ul class="cont-userComensal list-unstyled list-inline w-100">
			<li class="text-title-white <?= $classColor;?>_i"><b><i class="fa-solid fa-user"></i> Sesión activa:</b></li>

			<li><b>Nombre: </b> <?= $_SESSION['comensal']['nombre']; ?></li>
			<?php if ($_SESSION['comensal']['telefono'] != '') { ?>
				<li><b>Teléfono: </b> <?= $_SESSION['comensal']['telefono']; ?></li>
			<?php }
			$piso = '';
			if ($_SESSION['comensal']['direccion'] != '') {
				if ($_SESSION['comensal']['piso'] != '') {
					$piso = ' (Piso/Dpto: ' . $_SESSION['comensal']['piso'] . ')';
				}
				$direccionCom = $_SESSION['comensal']['direccion'] . ' ' . $_SESSION['comensal']['numero'] . ', ' . $_SESSION['comensal']['localidad'] . $piso;
			?>
				<li><b>Dirección: </b> <?= $direccionCom; ?></li>
			<?php } ?>
			<li class="text-title-white btn-logout-comensal"><a href="<?= base_url() . '/menu/logout/' ?>">
					<i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
			</li>
		</ul>
	<?php } ?>


	<ul class="vertical-menu">
		<?php
		if ($dataRestaurante['direccion'] == '' || $dataRestaurante['numero'] == 0 || $dataRestaurante['localidad'] == '') {
			$direccion = '';
		} else {
			$direccion = $dataRestaurante['direccion'] . " " . $dataRestaurante['numero'] . ", " . $dataRestaurante['localidad'];
			$dataMap = str_replace(" ", "+", $direccion);
			$linkMap = "https://www.google.com.ar/maps/place/$dataMap";
			print '<li><a class="text-cap btn-mob-soc ' . $classColor . '_i" href="' . $linkMap . '" target="_blank"><i class="fa-solid fa-location-dot"></i>' . " " . $direccion . '</a></li>';
		}
		?>
		<li><a class="btn-mob-soc <?= $classColor; ?>_i" href="tel:<?= $dataRestaurante['telefono']; ?>"><i class="fa-solid fa-phone"></i> <?= $dataRestaurante['telefono']; ?></a></li>
	</ul>


	<!-- social icons -->
	<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100 <?= $classColor; ?>_i">
		<?php
		if ($dataRestaurante['facebook'] != '') {
			print '<li class="list-inline-item"><a class="btn-mob-soc" target="_blank" href="https://www.facebook.com/' . $dataRestaurante['facebook'] . '"><i class="fab fa-facebook-f"></i>' . $dataRestaurante['facebook'] . '</a></li>';
		}
		if ($dataRestaurante['instagram'] != '') {
			print '<li class="list-inline-item"><a class="btn-mob-soc" target="_blank" href="https://www.instagram.com/' . $dataRestaurante['instagram'] . '"><i class="fab fa-instagram"></i>' . $dataRestaurante['instagram'] . '</a></li>';
		} ?>
	</ul>

</div>
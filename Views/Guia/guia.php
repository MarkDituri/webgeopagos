<?php
headerWeb($data);
?>

<body>
	<?php
	// Section Preloader	
	loadingWeb();
	?>
	<!-- Section Navbar -->
	<nav class="navbar-1 navbar navbar-expand-lg">
		<div class="container navbar-container">
			<a class="navbar-brand soloDesk" href="<?= base_url(); ?>"><img src="<?= media(); ?>/web/images/logo.png" alt="logo-qudimar"></a>
			<a class="navbar-brand soloMob" href="<?= base_url(); ?>"><img src="<?= media(); ?>/web/images/logo-2.png" alt="logo-qudimar"></a>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link scroll-down" href="<?= base_url(); ?>/">
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

			<a href="<?= base_url(); ?>/empezar" class="btn-1 style3 bgscheme"><b>Crear cuenta</b></a>
			<a href="<?= base_url(); ?>/login" class="soloDesk btn-1 btn-2-off style3 brscheme" style="max-width: 125px;"><b>Ingresar</b></a>
			<button type="button" id="sidebarCollapse" class="navbar-toggler active" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
		<!-- container -->
	</nav>
	<!-- /.Section Navbar -->
	<!-- Section Slider 1 -->
	<!-- Section Features 2 -->
	<div class="section-features2 cont-guia">
		<div class="container">
			<div class="row cont-row-feractures2">
				<div class="cont-info right my-auto col-sm-12 col-md-8">
					<br><br>
					<h1 class="ez-animate" data-animation="fadeInLeft"><i class="fa fa-book"></i> Guia instructiva de uso recomendado para la Terminal</h1>
					<p class="ez-animate" data-animation="fadeInLeft">Aprenderás el paso a paso de una forma visual y didáctica, para que puedas sacarle el mayor provecho a la plataforma y de esta manera crear una Carta QR Profesional.</p>
				</div>
				<div class="soloDesk left col-sm-12 col-md-4">
					<div class="img-container">
						<img class="soloDesk img-fluid ez-animate" src="<?= media(); ?>/web/images/img-3.png" alt="Qudimar" data-animation="fadeInRight">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.Section Features 2 -->

	<!-- Features Wrap -->
	<div class="features-wrap features-wrap-guia">
		<!-- Section Features 2 -->
		<div id="section-features2" class="section-cont-videolist">
			<div class="container">
				<div class="row cont-videolist">
					<div class="col-12">
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_1_sliders.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 1 - Creando un Slider</h2>
								<p class="p-1">Para empezar deberías ir a: Tu menú. Sliders. Aquí podrás cargar un slider de índole promocional como portada de tu menú. Vamos a “Nuevo slider”, agregamos un título, un tag y por último la imagen, guardamos y listo.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_2_categorias.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 2 - Creando una Categoria</h2>
								<p class="p-1">Luego podrías crear tu primer categoría, para eso ve a: Tu menú. Categorías, desde aquí podrás dar de alta por ejemplo una categoría titulada: Helados o postres.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_3_productos.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 3 - Creando un Productos</h2>
								<p class="p-1">Una vez hayas creado las categorías que necesites, podrás empezar a cargar los productos, con título, descripción, precio y una imagen, la vinculamos a su categoría correspondiente y ya podremos interactuar con ella desde nuestro menú.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_4_perfil.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 4 - Tu Perfil y Configuración</h2>
								<p class="p-1">Es recomendable que edites tu perfil y lo configures a tu gusto, ve a: Perfil, Aquí podremos completar nuestros datos que mostraremos a nuestros clientes. como redes sociales, dirección y teléfono, y no te olvides de cargar el logo de tu restaurante. También desde aquí podremos activar el modo oscuro y elegir un color principal para tu menú.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_5_miqr.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 5 - Mi codigo QR</h2>
								<p class="p-1">Aquí veremos nuestro código. El cual podrás imprimir para adherirlo en las mesas o donde creas necesario para el posible escaneo de tus comensales.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web/videos/paso_6_pedidos.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 6 - Pedidos y comandas</h2>
								<p class="p-1">En esta instancia ya podrás generar un pedido desde tu menú. escaneá el QR y ordená algo. La orden llegará por medio de una alerta a tu terminal, ve a: Pedidos. Y encontrarás el listado de pedidos ordenados, con la posibilidad de imprimir la comanda, y así facilitarlo en tu cocina o despacho.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web//videos/paso_7_dashboard.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 7 - Dashboard y Estadísticas</h2>
								<p class="p-1">En él podrás ver datos, estadísticas y novedades relevantes para la gestión y administración de tu menú.</p>
							</div>
						</section>
						<section class="cardVideo">
							<div class="embed-container">
								<video width="360" height="400" controls>
									<source src="<?= media(); ?>/web//videos/paso_8_pagos.mp4" type="video/mp4">
								</video>
							</div>
							<div class="cont-info">
								<h2 class="">Paso 8 - Pagos</h2>
								<p class="p-1">Aquí podrás ver y realizar los pagos que te correspondan a tu tipo de plan, recordá que tenés 30 días de prueba gratuitos.</p>
							</div>
						</section>


					</div>
				</div>
			</div>
		</div>
		<!-- /.Section Features 2 -->
		<!-- Section Features 2 -->
		<!-- /.Section Features 2 -->
	</div>
	<!-- /.Features Wrap -->
	<!-- /.Section Download 1 -->
	<!-- Section Footer -->
	<?php
	footerWeb();
	scriptsWeb($data);
	?>
</body>

</html>
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
						<a class="nav-link scroll-down" href="#">
							Home
						</a>
					</li>
					<li class="nav-item">
						<a href="#section-features1" class="nav-link scroll-down">Caracteristicas</a>
					</li>
					<li class="nav-item">
						<a href="#section-pricing1" class="nav-link scroll-down">Precios</a>
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
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
		<!-- container -->
	</nav>
	<!-- /.Section Navbar -->
	<!-- Section Slider 1 -->
	<div id="section-slider1">
		<div class="swiper-container">
			<div class="swiper-wrapper d-none">
				<!-- Item -->
				<div class="swiper-slide" id="section-main">
					<div class="slider-content">

						<div class="container soloDesk">
							<div class="row">
								<div class="left col-12 col-sm-12 col-md-7">
									<h1 class="ez-animate" data-animation="fadeInLeft">Tu carta online lista<br class="soloDesk"> para escanear</h1>
									<p class="ez-animate" data-animation="fadeInLeft">Esta tecnología te permite vincular a tus clientes con un menú interactivo de manera fácil y rápida.</p>
									<p class="ez-animate div-web-modo " data-animation="fadeInLeft">Compatible:									
										<span class="web-modo"><i class="fa-solid fa-utensils perfil_red_color"></i>
											En salon</span>
										<span class="web-modo"><i class="fa-solid fa-motorcycle perfil_red_color"></i>
											Delivery</span>
										<span class="web-modo"><i class="fa-solid fa-bag-shopping perfil_red_color"></i>
											Takeaway</span>										
									</p>
								
									<div class="cont-info right my-auto col-sm-12 col-md-12" id="cont-btns-main">
										<a href="empezar" class="ez-animate btn-2 style3 bgscheme" data-animation="fadeIn">Empezar gratis</a>
										<a href="<?= base_url();?>/menu/id/qudimar?adm" target="_blank" class="ez-animate btn-2 btn-2-off style3 brscheme" data-animation="fadeIn"><i class="icon-btn fa-solid fa-play"></i> Probar Demo</a>
									</div>
								</div>
								<div class="right ez-animate col-12 col-sm-12 col-md-5" data-animation="fadeInRight">
									<img id="mobMainImage" class="img-fluid" src="<?= media(); ?>/web/images/img-1.png" alt="Qudimar">
								</div>
							</div>
						</div>
						<div class="container soloMob">
							<div class="row contMainMobile ">
								<div class="col-12">
									<img src="<?= media(); ?>/web/images/main-mobile.jpg" alt="">
								</div>
								<div class="contMainMobileText left col-12 col-sm-12 col-md-10">
									<h1>Tu carta online lista<br class="soloDesk"> para escanear</h1>
									<p>Esta tecnología te permite vincular a tus clientes con un menú interactivo de manera fácil y rápida.</p>
									<div class="cont-info right my-auto col-sm-12 col-md-12">
										<a href="empezar" class="btn-2 style3 bgscheme">Empezar gratis</a>
										<a href="<?= base_url();?>/menu/id/qudimar?adm" target="_blank" class="btn-2 btn-2-off style3 brscheme"><i class="icon-btn fa-solid fa-play"></i> Probar Demo</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.Item -->
			</div>
		</div>
	</div>
	<!-- /.Section Slider 1 -->
	<!-- Section Features 1 -->
	<div id="section-features1">
		<div class="container">
			<div class="row">
				<div class="left">
					<h6 class="clscheme">Empeza ahora</h6>
					<h2>¡30 días de prueba gratis!</h2>
					<ul>
						<li><i class="fa fa-long-arrow-left clscheme"></i></li>
						<li><i class="fa fa-long-arrow-right clscheme"></i></li>
					</ul>
				</div>
				<div class="soloDesk right">
					<div class="swiper-container features1">
						<div class="swiper-wrapper">
							<!-- Item -->
							<div class="swiper-slide">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon1.png" alt="Qudimar" loading="lazy">
									<h3>Ofrecé tu Menu QR Profesional</h3>
									<p>A través del código QR, tus clientes podrán ingresar a tu menú online, una carta personalizable y original. </p>
								</div>
							</div>
							<!-- /.Item -->
							<!-- Item -->
							<div class="swiper-slide">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon2.png" alt="Qudimar" loading="lazy">
									<h3>Tus clientes podrán ordenar desde su celular</h3>
									<p>Al ingresar a tu menú, ellos podrán generar una orden desde ahí, de una manera fácil, y ágil.</p>
								</div>
							</div>
							<!-- /.Item -->
							<!-- Item -->
							<div class="swiper-slide">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon3.png" alt="Qudimar" loading="lazy">
									<h3>Recibís las comandas a tu Central</h3>
									<p>Realizado el pedido, esa orden llegará a tu terminal, desde la cual podrás crear y gestionar tu menú.</p>
								</div>
							</div>
							<!-- /.Item -->
						</div>
					</div>
				</div>

				<div class="soloMob right">
					<div class="features1">
						<div class="">
							<!-- Item -->
							<div class="">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon1.png" alt="Qudimar" loading="lazy">
									<h3>Ofrecé tu Menu QR Profesional</h3>
									<p>A través del código QR, tus clientes podrán ingresar a tu menú online, una carta personalizable y original. </p>
								</div>
							</div>
							<!-- /.Item -->
							<!-- Item -->
							<div class="">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon2.png" alt="Qudimar" loading="lazy">
									<h3>Tus clientes podrán ordenar desde su celular</h3>
									<p>Al ingresar a tu menú, ellos podrán generar una orden desde ahí, de una manera fácil, y ágil.</p>
								</div>
							</div>
							<!-- /.Item -->
							<!-- Item -->
							<div class="">
								<div class="item">
									<img src="<?= media(); ?>/web/images/img-icon3.png" alt="Qudimar" loading="lazy">
									<h3>Recibís las comandas a tu Central</h3>
									<p>Realizado el pedido, esa orden llegará a tu terminal, desde la cual podrás crear y gestionar tu menú.</p>
								</div>
							</div>
							<!-- /.Item -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.Section Features 1 -->
	<!-- Features Wrap -->
	<div class="features-wrap">
		<!-- Section Features 2 -->
		<div id="section-features2">
			<div class="container">
				<div class="row">
					<div class="left col-sm-12 col-md-6">
						<div class="img-container">
							<img class="soloMob img-fluid ez-animate" src="<?= media(); ?>/web/images/img-0-mob.png" alt="Qudimar" data-animation="fadeInLeft" loading="lazy">
							<img class="soloDesk img-fluid ez-animate" src="<?= media(); ?>/web/images/img-0.png" alt="Qudimar" data-animation="fadeInLeft" loading="lazy">
						</div>
					</div>
					<div class="cont-info right my-auto col-sm-12 col-md-6">
						<h2 class="">Menú interactivo</h2>
						<p class="p-1">No solo enlista todos tus productos, sino que también tus clientes podrán armar y confirmar la orden desde la misma carta online.</p>
						<p class="p-2">Hemos diseñado el menú pensando especialmente en tus comensales, interfaz moderna y eficiente. .</p>
						<a href="<?= base_url();?>/menu/id/qudimar?adm" target="_blank" class="btn-2 style3 bgscheme"><i class="icon-btn fa-solid fa-play"></i> Probar Demo</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /.Section Features 2 -->
		<!-- Section Features 2 -->
		<div class="section-features2">
			<div class="container">
				<div class="row cont-row-feractures2">
					<div class="soloMob left col-sm-12 col-md-6">
						<div class="img-container">
							<img class="img-fluid ez-animate" src="<?= media(); ?>/web/images/img-3-mob.png" alt="Qudimar" data-animation="fadeInRight" loading="lazy">
						</div>
					</div>
					<div class="cont-info right my-auto col-sm-12 col-md-6">
						<h2>Gestioná todo desde la Terminal <b>Qudimar</b></h2>
						<p class="p-1">
							Creá las categorías de tus productos, cargá imágenes, textos y precios, lo verán tus clientes al escanear el código QR,
							tambien recibirás las comandas de los pedidos en la Terminal, listas para imprimir.
							<i class="fa-solid fa-print"></i>
						</p>
						<p class="p-2">
							- Solo necesitas una PC y conexión a internet.<br>
							- Podes gestionar o imprimir los pedidos en comanda.
						</p>
						<a href="empezar" class="btn-2 style3 bgscheme">Empezar gratis</a>
					</div>
					<div class="soloDesk left col-sm-12 col-md-6">
						<div class="img-container">
							<img class="soloDesk img-fluid ez-animate" src="<?= media(); ?>/web/images/img-3.png" alt="Qudimar" data-animation="fadeInRight" loading="lazy">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.Section Features 2 -->
	</div>
	<!-- /.Features Wrap -->

	<!-- Section Pricingn 1 -->
	<div id="section-pricing1">
		<div class="container">
			<div class="row cont-all-precios">
				<div class="title1 col-12">
					<h6 class="clscheme">Precios</h6>
					<h2>Construido para tu comercio</h2>
				</div>
				<!-- Item -->
				<div class="item ez-animate active selected col-md-4" data-animation="fadeInUp">
					<div class="title">Demo 30 dias</div>
					<ul>
						<li>3O días</li>
						<li>QR automático</li>
						<li>Carta online</li>
						<li>40 Productos</li>
						<li>Pedidos ilimitados</li>
						<li style="text-decoration:line-through">Soporte gratuito</li>
					</ul>
					<div class="price clscheme"><span class="currency">$</span> 0 <span class="duration">/m</span></div>
					<div class="cta">
						<a href="empezar" class="btn-1 style3 bgscheme">Comenzar Prueba</a>
					</div>
				</div>
				<!-- /.Item -->
				<!-- Item -->
				<div class="item ez-animate col-md-4" data-animation="fadeInLeft">
					<div class="title">Plan inicial</div>
					<ul>
						<li>30 días</li>
						<li>QR automatico</li>
						<li>Carta online</li>
						<li>100 Productos</li>
						<li>Pedidos ilimitados</li>
						<li>Soporte gratuito</li>
					</ul>
					<div class="price clscheme"><span class="currency">$</span> 1690 <span class="duration">/m</span></div>
					<div class="cta">
						<a href="empezar" class="btn-1 btn-2-off style3 brscheme">Comenzar Plan</a>
					</div>
				</div>
				<!-- /.Item -->

				<!-- Item -->
				<!-- <div class="item ez-animate col-md-4" data-animation="fadeInRight">					
					<div class="title">Startup Plan</div>
					<ul>
						<li>10 pages</li>
						<li>500 gb storage</li>
						<li>10 sdd Database</li>
						<li>Free coustom domain</li>
						<li>24/7 free support</li>
					</ul>
					<div class="price clscheme"><span class="currency">$</span> 45 <span class="duration">/m</span></div>
					<div class="cta">
						<a href="#" class="btn-1 shadow1 style3 bgscheme">START FREE TRIAL</a>
					</div>
				</div> -->
				<!-- /.Item -->
			</div>
		</div>
	</div>
	<!-- /.Section Pricingn 1 -->

	<!-- Section Subscribe 1 -->
	<div id="section-subscribe1">
		<div class="container">
			<div class="row">
				<div class="title1 col-12">
					<h6 class="clscheme">NEWSLETTER</h6>
					<h2>Suscríbete a nuestro newsletter</h2>
				</div>
				<div class="form col-12 ez-animate" data-animation="fadeInUp">
					<form action="#" id="SubscribeForm">
						<input type="email" name="yourEmail" placeholder="Ingrese tu correo eléctronico" required="">
						<button type="submit" class="bgscheme">Suscribirme</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.Section Subscribe 1 -->
	<!-- Section Download 1 -->
	<div id="section-download1">
		<div class="container">
			<div class="row">
				<div class="cont-prefoot col-12">
					<h1>Registrá tu comercio</h1>
					<p>Y comenzá con una prueba gratuita de 30 días para tu negocio</p>
					<div class="cont-info cont-info-final right my-auto col-sm-12 col-md-6">
						<a href="empezar" class="btn-2 style3 bgscheme">Empezar gratis</a>
						<a href="<?= base_url();?>/menu/id/qudimar?adm" target="_blank" class="btn-2 btn-2-off style3 brscheme"><i class="icon-btn fa-solid fa-play"></i> Probar Demo</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.Section Download 1 -->
	<?php
	footerWeb();
	scriptsWeb($data);
	?>
</body>

</html>
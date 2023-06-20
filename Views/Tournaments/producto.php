<?php
headerMenu($data);
navbarMenu($data);
$dataCarrito =    $_SESSION['carrito'];
$classColor =     $_SESSION['restaurante']['class_color'];
$dataProducto =   $data['producto'];
?>
<!-- section main content -->
<section class="main-content mt-3">
	<div class="container-xl">

		<div class="row gy-4">

			<div class="col-lg-12">
				<!-- Producto -->
				<div class="cont-onlyProd comments bordered padding-15 rounded">

					<ul class="comments">
						<!-- Producto item -->
						<?php
						//Enviando ID y trayendo array                        
						if (count($data['producto']) > 0) { ?>
							<li class="comment rounded">
								<!-- Detalle Form -->
								<form class="cont-productos-det" action="<?= base_url(); ?>/menu/addproducto/<?= $data['producto']['id_producto']; ?>" method="POST">
									<div class="thumb contImg-producto cont-img-prod" style="background: url(<?= media(); ?>/images/uploads/<?= $data['producto']['url_img']; ?>)no-repeat; background-size:cover; background-position: center">
										<a class="" href="" id="">
										</a>
									</div>
									<div class="details">
										<h4 class="name"><a href="#"><?= $data['producto']['titulo']; ?></a></h4>
										<span class="date"></span>
										<p><?= $data['producto']['descripcion']; ?></p>
									</div>

									<?php
									//Solo Poder agregar si no se confirmo
									if ($_SESSION['carrito']['status'] == 0) { ?>
										<!-- Cantidad input -->
										<div id="detalle-cantidad" class="contPrecio-producto">
											<h4>Cantidad</h4>
											<div class="cont-detalle-cantidad form-group">
												<button id="menos" type="button">-</button>
												<input type="text" name="cantidad" id="contador" class="form-control" value="1" min="1" />
												<button id="mas" type="button">+</button>
											</div>
										</div>
										<!-- Name input -->
										<div id="detalle-pt" class="contPrecio-producto">
											<h4>Detalles</h4>
										</div>
										<div class="cont-detalle-prod form-group">
											<input type="text" class="input-detalle form-control" name="detalle" id="detalle" placeholder="Gustos, salsas, expeciones, etc">
										</div>

										<div class="contPrecio-producto">
											<h4>Precio</h4>
											<h5>$<span id="cont-total-prod"><?= $data['producto']['precio'] ?></span></h5>
											<input type="hidden" name="precio" id="precio" value='<?= $data['producto']['precio']; ?>'>
										</div>
										<div class="cont-producto">
											<button type="submit" id="<?= $data['producto']['id_producto']; ?>" onclick="disableBtn()" style="margin-top: 15px;" class="btn-disabled btn-agregar-pedido <?= $classColor; ?>">Agregar al pedido</button>
										</div>
									<?php } ?>
								</form>
							</li>
						<?php
						} ?>
					</ul>
				</div>
				<?php

				//Sugerir QR si ya ordeno
				if ($_SESSION['carrito']['status'] != 0) { ?>
					<div class="con-qr-detalle">
						<div class="img-qr"></div>
						<h2 class="">Si deseas seguir ordenando, puede hacer
							<a href="<?= base_url(); ?>/menu/resetmenu">Clic aquí</a>
							para crear un nuevo pedido
						</h2>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</section>

<footer>
	<div class="container-xl">
		<div class="footer-inner">
			<div class="row d-flex align-items-center gy-4">
				<div style="height: 30px">

				</div>
			</div>
		</div>
	</div>
</footer>

<?php
CarritoMenu($data);
scriptsMenu($data);
?>
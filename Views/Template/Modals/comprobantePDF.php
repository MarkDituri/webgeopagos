<?php 
	$restaurante = $data['restaurante'];
	$pago = $data['pago'];
	
	// Direccion
	$direccion = $restaurante['direccion'] == '' ? false : true;
	$numero = $restaurante['numero'] == '' ? false : true;	
	$localidad = $restaurante['localidad'] == '' ? 'N/A' : $restaurante['localidad'];	

	if($direccion == true && $numero == true){		
		$direccion = $restaurante['direccion'] .' '. $restaurante['numero'];
	} else {
		$direccion = 'N/A';
	}

	//Montos y pagos
	$precioOriginal = $pago['precio'];
	$comisionMP = 6.40;
	$montoImpuesto =  porcentaje($precioOriginal,$comisionMP,2);
	$montoServicio = $pago['precio'] - $montoImpuesto;
	$totalFinal = $montoServicio + $montoImpuesto;

	function porcentaje($cantidad,$porciento,$decimales){
		return number_format($cantidad*$porciento/100 ,$decimales);
	}	
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		body {
			width: 40%;
		}

		table {
			width: 100%;
		}

		table td,
		table th {
			font-size: 12px;
		}

		h2 {
			font-size: 24px;
		}

		h3 {
			font-size: 16px;
			line-height: 22px;
		}

		h4 {
			margin-bottom: 0px;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.wd20{
			width: 20%;
		}
		.wd23 {
			width: 23%;
		}

		.wd25 {
			width: 25%;
		}

		.wd33 {
			width: 33.33%;
		}

		.wd2 {
			width: 2%;
		}

		.wd4 {
			width: 4.3%;
		}
		.wd5 {
			width: 5%;
		}

		.wd10 {
			width: 10%;
		}

		.wd15 {
			width: 15%;
		}

		.wd40 {
			width: 40%;
		}

		.wd45 {
			width: 45%;
		}

		.wd48 {
			width: 48%;
		}

		.wd50 {
			width: 50%;
		}

		.wd55 {
			width: 55%;
		}
		.wd60{
			width: 60%;
		}
		.wd100 {
			width: 100%;
		}

		.wd90 {
			display: flex;
			justify-content: center;
			align-items: center;
			margin: auto;
			width: 90%;
		}

		.tbl-border{
			border-bottom: 1px solid #CCC;
		}
		.tbl-detalle {
			border-collapse: collapse;
		}
		.tbl-cliente {
			border: 1px solid #CCC;
			border-radius: 10px;
			padding: 5px;
		}
		.tbl-detalle thead th {
			padding: 5px;
			background-color: red;
			color: #FFF;
		}

		.tbl-detalle thead td {
			background-color: #f6f6f6;
			padding: 15px;
		}

		.tbl-detalle tbody td {
			padding: 15px;
		}

		.tbl-detalle tfoot td {
			padding: 5px;
		}

		.txtSmall {
			font-weight: normal;
			color: gray;
		}

		.h3-line {
			line-height: 10px;
		}

		.h3-table {
			margin: 0;
		}
	</style>
</head>

<body>
	<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd4">
				</td>
				<td class="wd90">
					<table class="tbl-hader tbl-border">
						<tbody>
							<tr>
								<td class="wd50">
									<h2><strong>Comprobante N° </strong><span class="txtSmall">#FQ<?=$pago['id_pago'];?> </span></h2>
								</td>
								<td class="wd50 text-right">								
									<img src="<?= base_url(); ?>/Assets/images/logo-pdf.png" alt="Logo">									
								</td>
							</tr>
						</tbody>
					</table>
					<table class="tbl-hader">
						<tbody>
							<tr>
								<td class="wd50">
									<h3>
										<span style="line-height: 30px;"><strong> Cliente</strong></span><br>
										<span class="txtSmall"><?=$restaurante['nombres'];?>  <?=$restaurante['apellidos'];?></span><br>
										<span class="txtSmall"><?=$direccion;?></span><br>
										<span class="txtSmall"><?=$localidad;?></span><br>
										<span class="txtSmall">Argentina</span><br>
									</h3>
								</td>
								<td class="wd50 text-right">
									<h3>
										<span style="line-height: 30px; text-transform: uppercase;"><strong> <?= NOMBRE_EMPESA ?></strong></span><br>
										<span class="txtSmall"><?= DIRECCION ?></span><br>
										<span class="txtSmall">Argentina</span><br>
										<span class="txtSmall"><?= EMAIL_EMPRESA ?></span><br>
										<span class="txtSmall"><?= TELEMPRESA ?></span><br>
									</h3>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<table class="tbl-cliente">
						<tbody>
							<tr>
								<td class="wd2"></td>
								<td class="wd48">
									<h3 class="h3-line"><span class="txtSmall">Plan:</span> <strong style="text-transform:capitalize;"><?=$pago['plan']?></strong></h3>
									<h3 class="h3-line"><span class="txtSmall">N° de operación:</span> <strong><?= $pago['mp_payment_id']?></strong></h3>
									<h3 class="h3-line"><span class="txtSmall">ID Orden:</span> <strong><?= $pago['mp_order_id']?></strong></h3>
									
								</td>
								<td class="wd48">
									<h3 class="h3-line"><span class="txtSmall">Fecha de Ven.</span> <strong><?=$pago['fechaVen']?></strong></h3>
									<h3 class="h3-line"><span class="txtSmall">Fecha de pago:</span> <strong><?=$pago['fechaPago'];?></strong></h3>
									<h3 class="h3-line"><span class="txtSmall">Monto:</span> <strong><?=SMONEY.' '.formatMoney($precioOriginal)?></strong></h3>
								</td>
								<td class="wd2"></td>
							</tr>
						</tbody>
					</table>


					<br>
					<br>
					<table class="tbl-detalle">
						<thead>
							<tr>
								<td class="w40" style="padding-left: 12px;">
									<h3 class="h3-table"><strong>Description</strong></h3>
								</td>
								<td class="wd20">
									<h3 class="h3-table"><strong>Precio</strong></h3>
								</td>
								<td class="wd20">
									<h3 class="h3-table"><strong>Impuestos</strong></h3>
								</td>
								<td class="wd20 text-right">
									<h3 class="h3-table"><strong>Total</strong></h3>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="wd40" style="padding-left: 12px;">
									<h3 class="txtSmall">Plan Estandar (30 días)</h3>
								</td>
								<td class="wd20">
									<h3 class="txtSmall"><?=SMONEY.' '.formatMoney($montoServicio)?></h3>
								</td>
								<td class="wd20">
									<h3 class="txtSmall"><?=SMONEY.' '.formatMoney($montoImpuesto)?></h3>
								</td>
								<td class="wd20 text-right">
									<h3 class="txtSmall"><?=SMONEY.' '.formatMoney($totalFinal)?></h3>
								</td>
							</tr>
						</tbody>	
					</table>

					<table class="tbl-detalle">
						<tbody>
							<tr>
								<td class="wd60" style="padding-left: 12px;">
									<h4 class="txtSmall"><i>*El pago ha sido efectuado el <?=$pago['fechaPago'];?></i></h4>
								</td>			
								<td class="wd40 text-right">
								<h3 class="h3-table"><strong>TOTAL: <?=SMONEY.' '.formatMoney($totalFinal)?></strong></h3>
								</td>
							</tr>
						</tbody>	
					</table>

					<br><br>
					<div class="text-center">
						<p class="txtSmall">Si tienes preguntas sobre tu pago, <br> póngase en contacto con <?= EMAIL_EMPRESA ?></p>
						<h4>¡Gracias por tu compra!</h4>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

</body>

</html>
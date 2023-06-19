<?php
class Pagos extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
	}

	public function Pagos()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/prodcutos');
		}
		$data['page_tag'] = "Pagos";
		$data['page_title'] = "Pagos";
		$data['page_name'] = "Pagos";
		$data['page_functions_js'] = "functions_pagos.js";
		$this->views->getView($this, "pagos", $data);
	}

	public function getPagos()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectPagos();
			// dep($epa);	
			// die();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnPDF = '';
				$arrData[$i]['precio'] = SMONEY . ' ' . formatMoney($arrData[$i]['precio']);

				if ($arrData[$i]['status'] == 1) {
					if ($arrData[$i]['plan'] == 'Demo') {
						// Cuenta Demo - status = 1
						$arrData[$i]['status'] = '<span class="pago"><i class="fa-solid fa-circle-check"></i>&nbsp;Demo</span>';
						$arrData[$i]['precio'] = "Gratis";
						$btnPDF = '';
					} else {
						// Cuenta Plan - status = 1
						$arrData[$i]['status'] = '<span class="pago"><i class="fa-solid fa-circle-check"></i>&nbsp;Pago</span>';
						$btnPDF = '<a target="_blank" href="' . base_url() . '/factura/generarFactura/' . $arrData[$i]['id_pago'] . '" class="btn btn-pdf-sm" title="PDF"><i class="fas fa-file-pdf"></i> &nbspComprobante </a>';
					}
					// PD: Raro, el anteultimo deberia ser solo pago -> DB
				} else {
					if (compararFechas($arrData[$i]['fechaFin'], getHoy()) <= 0) {
						// Cuenta vencida	
						$arrData[$i]['status'] = '<span class="inpago"><i class="fa-solid fa-circle-exclamation"></i>&nbsp;Vencido</span>';
					} else if (compararFechas($arrData[$i]['fechaInicio'], getHoy()) <= 0) {
						// Mostrar proximo pago					
						$arrData[$i]['status'] = '<span class="porvencer"><i class="fa-solid fa-circle-exclamation"></i>&nbsp;Por vencer</span>';
					} else {
						// Mostrar por vencer
						$arrData[$i]['status'] = '<span class="proximopago"><i class="fa-solid fa-clock"></i>&nbsp;Proximo pago</span>';
					}
				}
				$arrData[$i]['options'] = '<div class="text-center table-options">' . $btnPDF . '</div>';
				unset($arrData[$i]['fechaInicio']); //Elimina array position
			}
			$remove = array_pop($arrData); // Exxt
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUltimoPago()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectUltimoPago();
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				if ($arrData['status'] == 'demo') {
					$arrData['precio'] = "Gratis";
					$btnPagar = '<span class="pago"><i class="fa-solid fa-circle-check"></i> Demo: Activa</span>';
				} else {
					if ($arrData['status'] == 'pagado') {
						$btnPagar = '<span class="pago"><i class="fa-solid fa-circle-check"></i> Estado: Pagado</span>';
					} else if ($arrData['status'] == 'pagar') {
						$btnPagar = '<span class="porvencer"><i class="fa-solid fa-circle-exclamation"></i> Por vencer</span>';
					} else if ($arrData['status'] == 'vencido') {
						$btnPagar = '<span class="inpago"><i class="fa-solid fa-circle-exclamation"></i> Estado: Vencido</span>';
					}
				}

				$arrResponse = array('status' => true, 'data' => $arrData, 'btnPagar' => $btnPagar);
			}
			// dep($arrResponse);
			// die();
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setPago()
	{
		if ($_GET) {
			$id_pago = $_GET['id_pago'];
			$precio_pago = $_GET['precio'];
			// Mercado Pago
			$payment = $_GET['payment_id'];
			$status = $_GET['status'];
			$payment_type = $_GET['payment_type'];
			$order_id = $_GET['merchant_order_id'];

			$arrData = $this->model->updatePago($id_pago, $status, $precio_pago, $payment, $payment_type, $order_id);

			if (empty($arrData)) {
				header("location: " . base_url() . "/Pagos/error");
			} else {
				header("location: " . base_url() . "/Pagos");
			}
		}
		die();
	}

	public function falloPago()
	{
		if ($_GET) {
			header("location: " . base_url() . "/Pagos");
		}
		die();
	}

	public function getPago($id_pago)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdpago = intval($id_pago);
			if ($intIdpago > 0) {
				$arrData = $this->model->selectPago($intIdpago);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrData['url_portada'] = base_url() . '/Assets/images/uploads/' . $arrData['img_pago'];
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delPago()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intIdpago = intval($_POST['id_pago']);
				$requestDelete = $this->model->deletepago($intIdpago);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el pago');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el pago.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function notificacionesmp()
	{			
		require_once 'vendor/autoload.php';
		MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
	  
		$merchant_order = null;
	  
		switch($_GET["topic"]) {
			case "payment":
				$payment = MercadoPago\Payment::find_by_id($_GET["id"]);
				// Get the payment and the corresponding merchant_order reported by the IPN.
				$merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
				break;
			case "merchant_order":
				$merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
				break;
		}
	  
		$paid_amount = 0;
		foreach ($merchant_order->payments as $payment) {  
			if ($payment['status'] == 'approved'){
				$paid_amount += $payment['transaction_amount'];
			}
		}
	   
		// If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
		if($paid_amount >= $merchant_order->total_amount){
			if (count($merchant_order->shipments)>0) { // The merchant_order has shipments
				if($merchant_order->shipments[0]->status == "ready_to_ship") {
					print_r("Totally paid. Print the label and release your item.");
				}
			} else { // The merchant_order don't has any shipments
				print_r("Totally paid. Release your item.");
			}
		} else {
			print_r("Not paid yet. Do not release your item.");
		}	   	 
	}
}

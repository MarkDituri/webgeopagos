<?php
// require_once("Models/TLoginTournament.php");
// require_once("Models/TRestaurante.php");
// require_once("Models/TCarrito.php");
// require_once("Models/TSliders.php");
// require_once("Models/TCategoria.php");
// require_once("Models/TProducto.php");
// require_once("Models/TCliente.php");

class Tournaments extends Controllers
{
	// use TRestaurante, TCarrito, TSliders, TCategoria, TProducto, TCliente;

	public function __construct()
	{
		parent::__construct();		
	}

	public function Tournaments()
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Torneos";				
		$this->views->getView($this, "home", $data);
	}

	public function players()
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Jugadores";		
		
		// Consulta a la API
		$url = 'http://127.0.0.1:8000/api/v2/players/';				
		$json = file_get_contents($url);
		$data = json_decode($json, true);

		$this->views->getView($this, "players", $data);
	}

	public function player($slug)
	{
		if (empty($slug)) {
			header("Location:" . base_url().'/tournaments/players');
		} else {
			$data['page_tag'] = NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "Jugador";			
	
			 // Consulta a la API
			$url = 'http://127.0.0.1:8000/api/v2/players/'.$slug;				
			$json = file_get_contents($url);
			$data = json_decode($json, true);
	
			$this->views->getView($this, "player", $data);
		}
	}

	public function id($params)
	{
		if (empty($params)) {
			header("Location:" . base_url());
		} else {
			$arrParams = explode(",", $params);
			$url_restaurante = strClean($arrParams[0]);
			// TRAE INFO CON URL
			$data['restaurante'] =  $this->getRestauranteUrl($url_restaurante);
			$id_restaurante =       $data['restaurante']['id_restaurante'];			
			$data['ultimoPago'] =   $this->selectUltimoPagoModel($id_restaurante);			
			if (empty($data['restaurante'])) {
				header("Location:" . base_url() . '/tournament/error/?msg=sinrest');
			} else if($data['ultimoPago']['status'] == 'vencido') {
				header("Location:" . base_url() . '/tournament/error/?msg=nopay');
			}				
			// LOGIN CON RESTAURANTE 	
			$this->loginUserTournament($id_restaurante);			
			$this->getColor($data['restaurante']['id_color']);	
			$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $_SESSION['code_session']);		
			//Si aun no se selecciono el modo, redirigir
			if(empty($_SESSION['carrito']['modo'])){				
				header("Location:" . base_url() . '/tournament/modos/');
			}
			$data['sliders'] =      $this->getSliders($id_restaurante);
			$data['categorias'] =   $this->getCategorias($id_restaurante);		
			if (empty($data['categorias'])) {
				header("Location:" . base_url() . '/tournament/error/?msg=nocat');
			}	
			$data['productoBest'] = $this->getProductoBest($id_restaurante);
			// data view		
			$data['page_name'] = "tournament";			
			$this->views->getView($this, "tournament", $data);
		}
		die();
	}

	public function modos()
	{
		$sesion = $this->sesionTournament();		
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}		
		$this->getColor($sesion['restaurante']['id_color']);	
		if($_SESSION['carrito']['status'] == 1){	
			header("Location:" . base_url() . '/tournament/id/' . $_SESSION['restaurante']['url']);
		} 
		$data['page_title'] = 'Modos';
		$data['page_name'] = "modos";		
		$this->views->getView($this, "modos", $data);	
		die();
	}

	public function setmodo()
	{
		$sesion = $this->sesionTournament();	
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];		
	
		if(isset($_GET['mod'])){						
			$dataModo = $this->updateModo($_GET['mod'], $id_restaurante, $SESSION_code);		
			if (!empty($dataModo)) {						
				header("Location:" . base_url() . '/tournament/id/' . $_SESSION['restaurante']['url']);
			} else {
				header("Location:" . base_url() . '/tournament/error');
			}
		}											
		die();
	}


	public function carrito()
	{					
		$sesion = $this->sesionTournament();		
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$this->getColor($sesion['restaurante']['id_color']);	
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];
		$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $SESSION_code);
		$data['productos_carrito'] = $this->getProductosCarrito($id_restaurante, $SESSION_code);				
		$data['page_title'] = 'Carrito';
		$data['page_name'] = "carrito";		
		$this->views->getView($this, "carrito", $data);	
		die();
	}
	
	public function producto($params)
	{
		if (empty($params)) {
			header("Location:" . base_url());
		} else {
			$arrParams = explode(",", $params);
			$id_producto = intval($arrParams[0]);
			$sesion = $this->sesionTournament();
			if (!$sesion) {
				header("Location:" . base_url() . '/tournament/error');
			}
			$this->getColor($sesion['restaurante']['id_color']);			
			$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];

			$dataProducto =         $this->getProducto($id_producto);
			if (empty($dataProducto)) {
				header("Location:" . base_url() . '/tournament/error');
			}			
			$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $_SESSION['code_session']);			
			// data view			
			$data['page_title'] = $dataProducto['titulo'];
			$data['page_name'] = "producto";
			$data['producto'] = $dataProducto;
			$this->views->getView($this, "producto", $data);
		}
		die();
	}	

	public function addproducto($params)
	{
		$arrParams = explode(",", $params);
		$id_producto = intval($arrParams[0]);
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];
		$SESSION_code =         $_SESSION['code_session'];
		$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $SESSION_code);
		$responseAddCarrito =   $this->addCarrito($id_producto);
		$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $SESSION_code);
		
		if ($responseAddCarrito) {
			header("Location:" . base_url() . '/tournament/id/' . $_SESSION['restaurante']['url']);
		} else {
			return false;
		}
		die();
	}

	public function delproducto($params)
	{
		$arrParams = explode(",", $params);
		$id_pedido = intval($arrParams[0]);
		$precio_producto = intval($arrParams[1]);

		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];
		$responseDelCarrito =   $this->delCarrito($id_pedido, $precio_producto, $id_restaurante, $SESSION_code);
		if ($responseDelCarrito) {
			header("Location:" . base_url() . '/tournament/carrito');
		}
		die();    
	}


	function validateNumPrimo($num) {
		for ($i = 2; $i < $num; $i++) {
			if ($num % $i == 0) {
				return "$num no es un número primo.";
			}
		}
	
		return "$num es un número primo.";
	}
	

	public function detalle($params)
	{
		$arrParams = explode(",", $params);
		$id_pedido = intval($arrParams[0]);		
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];
		$data['detalle'] =  $this->getDetalle($id_pedido, $id_restaurante, $SESSION_code);
		die();
	}

	public function editardetalle()
	{		
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];

		$data['detalle'] =      $this->updateDetalle($id_restaurante, $SESSION_code);		
		if ($data['detalle']) {
			header("Location:" . base_url() . '/tournament/carrito');
		}		
		die();
	}

	public function confirmarPedido()
	{		
		$id_comensal = '';
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}		
		$id_restaurante =      	$_SESSION['restaurante']['id_restaurante'];		
		$SESSION_code =         $_SESSION['code_session'];				
		$sesionComensal = isset($_SESSION['comensal']) ? $_SESSION['comensal'] : false;	
		if (empty($_POST['comensal_nombre'])) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$data['saveComensal'] = $this->saveComensal($_POST, $sesionComensal, $id_restaurante, $SESSION_code);	
		if($data['saveComensal']['status']){
			$id_comensal = $data['saveComensal']['id_comensal'];				
			$_SESSION['comensal'] = $this->getComensal($id_comensal, $id_restaurante);					
		}					
		$data['pedidoConfirm'] = $this->updateCarritoConfirm($id_comensal, $id_restaurante, $SESSION_code);	
		$_SESSION['carrito'] =  $this->getCarrito($id_restaurante, $SESSION_code);	

		if ($data['pedidoConfirm']) {
			$arrResponse = array('status' => true);
		}
		
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);		
		die();
	}

	public function confirmado()
	{
		$sesion = $this->sesionTournament();		
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}						
		$this->getColor($sesion['restaurante']['id_color']);	
		$data['page_title'] = 'Pedido confirmado';
		$data['page_name'] = "confirmado";		
		$this->views->getView($this, "confirmado", $data);
		die();
	}

	public function resettournament()
	{
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$url_restaurante = $_SESSION['restaurante']['url'];
		$sesionOut = $this->sesionTournamentReset();
		if ($sesionOut) {
			header("Location:" . base_url() . '/tournament/id/'.$url_restaurante);
		}	
		die();
	}

	public function logout()
	{		
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}
		$url_restaurante = $_SESSION['restaurante']['url'];
		$sesionOut = $this->sesionTournamentCerrar();
		if ($sesionOut) {
			header("Location:" . base_url() . '/tournament/id/'.$url_restaurante);
		}	
		die();
	}

	public function getStatusPedido()
	{
		$sesion = $this->sesionTournament();
		if (!$sesion) {
			header("Location:" . base_url() . '/tournament/error');
		}		
		$id_restaurante = $_SESSION['restaurante']['id_restaurante'];
		$SESSION_code = $_SESSION['carrito']['code_session'];
		$id_carrito = $_SESSION['carrito']['id_carrito_temp'];		
		$arrData = $this->refreshStatus($id_carrito, $id_restaurante, $SESSION_code);		
		if(empty($arrData) || $arrData['status'] == 0)
		{
			$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
		} else {
			$arrResponse = array('status' => true, 'data' => $arrData);
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);			
	}

	public function error()
	{
		// data view			
		$data['page_title'] = 'Error';
		$data['page_name'] = "error";		
		$this->views->getView($this, "error", $data);
		die();
	}

	public function registro()
	{
		error_reporting(0);
		if ($_POST) {
			if (empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmailCliente'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				$strApellido = ucwords(strClean($_POST['txtApellido']));
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strEmail = strtolower(strClean($_POST['txtEmailCliente']));
				$intTipoId = RCLIENTES;
				$request_user = "";

				$strPassword =  passGenerator();
				$strPasswordEncript = hash("SHA256", $strPassword);
				$request_user = $this->insertCliente(
					$strNombre,
					$strApellido,
					$intTelefono,
					$strEmail,
					$strPasswordEncript,
					$intTipoId
				);
				if ($request_user > 0) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					$nombreUsuario = $strNombre . ' ' . $strApellido;
					$dataUsuario = array(
						'nombreUsuario' => $nombreUsuario,
						'email' => $strEmail,
						'password' => $strPassword,
						'asunto' => 'Bienvenido a tu tienda en línea'
					);
					$_SESSION['idUser'] = $request_user;
					$_SESSION['login'] = true;
					$this->login->sessionLogin($request_user);
					sendEmail($dataUsuario, 'email_bienvenida');
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function procesarVenta()
	{
		if ($_POST) {
			$idtransaccionpaypal = NULL;
			$datospaypal = NULL;
			$personaid = $_SESSION['idUser'];
			$monto = 0;
			$tipopagoid = intval($_POST['inttipopago']);
			$direccionenvio = strClean($_POST['direccion']) . ', ' . strClean($_POST['ciudad']);
			$status = "Pendiente";
			$subtotal = 0;
			$costo_envio = COSTOENVIO;

			if (!empty($_SESSION['arrCarrito'])) {
				foreach ($_SESSION['arrCarrito'] as $pro) {
					$subtotal += $pro['cantidad'] * $pro['precio'];
				}
				$monto = $subtotal + COSTOENVIO;
				//Pago contra entrega
				if (empty($_POST['datapay'])) {
					//Crear pedido
					$request_pedido = $this->insertPedido(
						$idtransaccionpaypal,
						$datospaypal,
						$personaid,
						$costo_envio,
						$monto,
						$tipopagoid,
						$direccionenvio,
						$status
					);
					if ($request_pedido > 0) {
						//Insertamos detalle
						foreach ($_SESSION['arrCarrito'] as $producto) {
							$productoid = $producto['idproducto'];
							$precio = $producto['precio'];
							$cantidad = $producto['cantidad'];
							$this->insertDetalle($request_pedido, $productoid, $precio, $cantidad);
						}

						$infoOrden = $this->getPedido($request_pedido);
						$dataEmailOrden = array(
							'asunto' => "Se ha creado la orden No." . $request_pedido,
							'email' => $_SESSION['userData']['email_user'],
							'emailCopia' => EMAIL_PEDIDOS,
							'pedido' => $infoOrden
						);
						sendEmail($dataEmailOrden, "email_notificacion_orden");

						$orden = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
						$transaccion = openssl_encrypt($idtransaccionpaypal, METHODENCRIPT, KEY);
						$arrResponse = array(
							"status" => true,
							"orden" => $orden,
							"transaccion" => $transaccion,
							"msg" => 'Pedido realizado'
						);
						$_SESSION['dataorden'] = $arrResponse;
						unset($_SESSION['arrCarrito']);
						session_regenerate_id(true);
					}
				} else { //Pago con PayPal
					$jsonPaypal = $_POST['datapay'];
					$objPaypal = json_decode($jsonPaypal);
					$status = "Aprobado";
					if (is_object($objPaypal)) {
						$datospaypal = $jsonPaypal;
						$idtransaccionpaypal = $objPaypal->purchase_units[0]->payments->captures[0]->id;
						if ($objPaypal->status == "COMPLETED") {
							$totalPaypal = formatMoney($objPaypal->purchase_units[0]->amount->value);
							if ($monto == $totalPaypal) {
								$status = "Completo";
							}
							//Crear pedido
							$request_pedido = $this->insertPedido(
								$idtransaccionpaypal,
								$datospaypal,
								$personaid,
								$costo_envio,
								$monto,
								$tipopagoid,
								$direccionenvio,
								$status
							);
							if ($request_pedido > 0) {
								//Insertamos detalle
								foreach ($_SESSION['arrCarrito'] as $producto) {
									$productoid = $producto['idproducto'];
									$precio = $producto['precio'];
									$cantidad = $producto['cantidad'];
									$this->insertDetalle($request_pedido, $productoid, $precio, $cantidad);
								}
								$infoOrden = $this->getPedido($request_pedido);
								$dataEmailOrden = array(
									'asunto' => "Se ha creado la orden No." . $request_pedido,
									'email' => $_SESSION['userData']['email_user'],
									'emailCopia' => EMAIL_PEDIDOS,
									'pedido' => $infoOrden
								);

								sendEmail($dataEmailOrden, "email_notificacion_orden");

								$orden = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
								$transaccion = openssl_encrypt($idtransaccionpaypal, METHODENCRIPT, KEY);
								$arrResponse = array(
									"status" => true,
									"orden" => $orden,
									"transaccion" => $transaccion,
									"msg" => 'Pedido realizado'
								);
								$_SESSION['dataorden'] = $arrResponse;
								unset($_SESSION['arrCarrito']);
								session_regenerate_id(true);
							} else {
								$arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
							}
						} else {
							$arrResponse = array("status" => false, "msg" => 'No es posible completar el pago con PayPal.');
						}
					} else {
						$arrResponse = array("status" => false, "msg" => 'Hubo un error en la transacción.');
					}
				}
			} else {
				$arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
			}
		} else {
			$arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
		}

		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function page($pagina = null)
	{

		$pagina = is_numeric($pagina) ? $pagina : 1;
		$cantProductos = $this->cantProductos();
		$total_registro = $cantProductos['total_registro'];
		$desde = ($pagina - 1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);
		$data['productos'] = $this->getProductosPage($desde, PROPORPAGINA);
		//dep($data['productos']);exit;
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "tienda";
		$data['pagina'] = $pagina;
		$data['total_paginas'] = $total_paginas;
		$data['categorias'] = $this->getCategorias();
		$this->views->getView($this, "tienda", $data);
	}

	public function search()
	{
		if (empty($_REQUEST['s'])) {
			header("Location: " . base_url());
		} else {
			$busqueda = strClean($_REQUEST['s']);
		}

		$pagina = empty($_REQUEST['p']) ? 1 : intval($_REQUEST['p']);
		$cantProductos = $this->cantProdSearch($busqueda);
		$total_registro = $cantProductos['total_registro'];
		$desde = ($pagina - 1) * PROBUSCAR;
		$total_paginas = ceil($total_registro / PROBUSCAR);
		$data['productos'] = $this->getProdSearch($busqueda, $desde, PROBUSCAR);
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = "Resultado de: " . "'" . $busqueda . "'";
		$data['page_name'] = "tienda";
		$data['pagina'] = $pagina;
		$data['total_paginas'] = $total_paginas;
		$data['busqueda'] = $busqueda;
		$data['categorias'] = $this->getCategorias();
		$this->views->getView($this, "search", $data);
	}

	public function suscripcion()
	{
		if ($_POST) {
			$nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));
			$email  = strtolower(strClean($_POST['emailSuscripcion']));

			$suscripcion = $this->setSuscripcion($nombre, $email);
			if ($suscripcion > 0) {
				$arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción.");
				//Enviar correo
				$dataUsuario = array(
					'asunto' => "Nueva suscripción",
					'email' => EMAIL_SUSCRIPCION,
					'nombreSuscriptor' => $nombre,
					'emailSuscriptor' => $email
				);
				sendEmail($dataUsuario, "email_suscripcion");
			} else {
				$arrResponse = array('status' => false, 'msg' => "El email ya fue registrado.");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function contacto()
	{
		if ($_POST) {
			//dep($_POST);
			$nombre = ucwords(strtolower(strClean($_POST['nombreContacto'])));
			$email  = strtolower(strClean($_POST['emailContacto']));
			$mensaje  = strClean($_POST['mensaje']);
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$ip        = $_SERVER['REMOTE_ADDR'];
			$dispositivo = "PC";

			if (preg_match("/mobile/i", $useragent)) {
				$dispositivo = "Movil";
			} else if (preg_match("/tablet/i", $useragent)) {
				$dispositivo = "Tablet";
			} else if (preg_match("/iPhone/i", $useragent)) {
				$dispositivo = "iPhone";
			} else if (preg_match("/iPad/i", $useragent)) {
				$dispositivo = "iPad";
			}

			$userContact = $this->setContacto($nombre, $email, $mensaje, $ip, $dispositivo, $useragent);
			if ($userContact > 0) {
				$arrResponse = array('status' => true, 'msg' => "Su mensaje fue enviado correctamente.");
				//Enviar correo
				$dataUsuario = array(
					'asunto' => "Nueva Usuario en contacto",
					'email' => EMAIL_CONTACTO,
					'nombreContacto' => $nombre,
					'emailContacto' => $email,
					'mensaje' => $mensaje
				);
				sendEmail($dataUsuario, "email_contacto");
			} else {
				$arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}

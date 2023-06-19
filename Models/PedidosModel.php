<?php 
	class PedidosModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectPedidos($id_restaurante = null){
			$idRest = $_SESSION['idRest'];
			$sql = "SELECT id_carrito_temp,
							status,
							code_session,
							modo,
							total,
							activo,
							DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
							DATE_FORMAT(datecreated, '%H:%i') as hora,
							id_restaurante
					FROM carrito_temp
					WHERE id_restaurante = $idRest AND status != 0 AND activo = 'si'
					ORDER BY id_carrito_temp DESC
					LIMIT 500";
			$request = $this->select_all($sql);
			return $request;
		}	

		public function selectPedido(int $id_carrito_temp){
			$idRest = $_SESSION['idRest'];
			$this->intIdProducto = $id_carrito_temp;
			$request = array();
			$sql = "SELECT id_carrito_temp,
						status,
						code_session,
						modo,
						mesa,
						total,
						activo,
						DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
						DATE_FORMAT(datecreated, '%H:%i') as hora,
						id_restaurante,
						id_comensal
				FROM carrito_temp
				WHERE id_carrito_temp = $id_carrito_temp AND id_restaurante = $idRest AND status != 0";
			$carrito_resp = $this->select($sql);
			$id_comensal = $carrito_resp['id_comensal'];

			if(!empty($carrito_resp)){
				$code_session = $carrito_resp['code_session'];		
				$sql = "SELECT p.id_producto,
								p.titulo,
								p.status,
								p.descripcion,
								p.url_img,
								p.precio,
								d.id_pedido,
								d.status,
								d.id_producto,
								d.id_restaurante,
								d.detalle,
								d.cantidad,
								d.precio,
								p.activo
						FROM pedidos d 
						INNER JOIN productos p 
						ON d.id_producto = p.id_producto 
						WHERE d.code_session = '$code_session' AND d.id_restaurante = $idRest";				
				$pedidos_resp = $this->select_all($sql);

				$sql = "SELECT id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante
							FROM comensales 
							WHERE id_comensal = '$id_comensal' AND id_restaurante = $idRest";				
				$comensal_resp = $this->select($sql);

				$request = array('carrito' => $carrito_resp,'detalle' => $pedidos_resp, 'comensal' => $comensal_resp);
			}					
			return $request;	
		}

		public function selectComanda(int $id_carrito_temp){
			$idRest = $_SESSION['idRest'];
			$this->intIdProducto = $id_carrito_temp;
			$request = array();
			$sql = "SELECT id_carrito_temp,
							status,
							code_session,
							modo,
							mesa,
							total,
							activo,
							DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
							DATE_FORMAT(datecreated, '%H:%i') as hora,
							id_restaurante,
							id_comensal
					FROM carrito_temp
					WHERE id_carrito_temp = $id_carrito_temp AND id_restaurante = $idRest AND status != 0";
			$carrito_resp = $this->select($sql);
			$id_comensal = $carrito_resp['id_comensal'];

			if(!empty($carrito_resp)){
				$code_session = $carrito_resp['code_session'];
		
				$sql = "SELECT p.id_producto,
								p.titulo,
								p.status,
								p.descripcion,
								p.url_img,
								p.precio,
								d.id_pedido,
								d.status,
								d.id_producto,
								d.id_restaurante,
								d.detalle,
								d.cantidad,
								d.precio,
								p.activo
						FROM pedidos d 
						INNER JOIN productos p 
						ON d.id_producto = p.id_producto 
						WHERE d.code_session = '$code_session' AND d.id_restaurante = $idRest";				
				$pedidos_resp = $this->select_all($sql);
				
				$sql = "SELECT id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante
						FROM comensales 
					WHERE id_comensal = '$id_comensal' AND id_restaurante = $idRest";				
				$comensal_resp = $this->select($sql);

				$request = array('carrito' => $carrito_resp,'detalle' => $pedidos_resp, 'comensal' => $comensal_resp);
			}


			$request = require_once('./Views/Template/Others/comanda.php');	
			return $request;	
		}

		public function selectTransPaypal(string $idtransaccion, $id_restaurante = NULL){
			$busqueda = "";
			if($id_restaurante != NULL){
				$busqueda = " AND personaid =".$id_restaurante;
			}
			$objTransaccion = array();
			$sql = "SELECT datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}' ".$busqueda;
			$requestData = $this->select($sql);
			if(!empty($requestData)){
				$objData = json_decode($requestData['datospaypal']);
				//$urlOrden = $objData->purchase_units[0]->payments->captures[0]->links[2]->href;
				$urlOrden = $objData->links[0]->href;
				$objTransaccion = CurlConnectionGet($urlOrden,"application/json",getTokenPaypal());
			}
			return $objTransaccion;
		}

		public function reembolsoPaypal(string $idtransaccion, string $observacion){
			$response = false;
			$sql = "SELECT idpedido,datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}' ";
			$requestData = $this->select($sql);
			if(!empty($requestData)){
				$objData = json_decode($requestData['datospaypal']);
				$urlReembolso = $objData->purchase_units[0]->payments->captures[0]->links[1]->href;
				$objTransaccion = CurlConnectionPost($urlReembolso,"application/json",getTokenPaypal());
				if(isset($objTransaccion->status) and  $objTransaccion->status == "COMPLETED"){
					$idpedido = $requestData['idpedido'];
					$idtrasaccion = $objTransaccion->id;
					$status = $objTransaccion->status;
					$jsonData = json_encode($objTransaccion);
					$observacion = $observacion;
					$query_insert  = "INSERT INTO reembolso(pedidoid,
														idtransaccion,
														datosreembolso,
														observacion,
														status) 
								  	VALUES(?,?,?,?,?)";
					$arrData = array($idpedido,
	        						$idtrasaccion,
	        						$jsonData,
	        						$observacion,
	        						$status
	        					);
					$request_insert = $this->insert($query_insert,$arrData);
					if($request_insert > 0){
	        			$updatePedido  = "UPDATE pedido SET status = ? WHERE idpedido = $idpedido";
			        	$arrPedido = array("Reembolsado");
			        	$request = $this->update($updatePedido,$arrPedido);
			        	$response = true;
	        		}
				}
				return $response;
			}
		}

		// public function updatePedido(int $idpedido, $transaccion = NULL, $idtipopago = NULL, string $estado){
		// 	if($transaccion == NULL){
		// 		$query_insert  = "UPDATE pedido SET status = ?  WHERE idpedido = $idpedido ";
	    //     	$arrData = array($estado);
		// 	}else{
		// 		$query_insert  = "UPDATE pedido SET referenciacobro = ?, tipopagoid = ?,status = ? WHERE idpedido = $idpedido";
	    //     	$arrData = array($transaccion,
	    //     					$idtipopago,
	    // 						$estado
	    // 					);
		// 	}
		// 	$request_insert = $this->update($query_insert,$arrData);
        // 	return $request_insert;
		// }

		public function updateStatus(int $id_carrito_temp, int $estado){
			$idRest = $_SESSION['idRest'];
			$this->intId_carrito_temp = $id_carrito_temp;
			$query_insert  = "UPDATE carrito_temp SET status = ? WHERE id_carrito_temp = $this->intId_carrito_temp AND activo = 'si' AND id_restaurante = $idRest;";
			$arrData = array($estado);
			
			$request_insert = $this->update($query_insert, $arrData);
        	return $request_insert;
		}

		public function deletePedido(int $id_carrito_temp)
		{
			$idRest = $_SESSION['idRest'];
			$this->intId_carrito_temp = $id_carrito_temp;
			$sql = "SELECT * FROM carrito_temp WHERE id_carrito_temp = $this->intId_carrito_temp AND activo = 'no' AND id_restaurante = $idRest";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE carrito_temp SET activo = 'no' WHERE id_carrito_temp = $this->intId_carrito_temp AND id_restaurante = $idRest;";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}	

		public function selectNotificacion()
		{
			$idRest = $_SESSION['idRest'];			
			$sql = "SELECT * FROM notificaciones WHERE status = 0 AND id_restaurante = $idRest";
			$request = $this->select_all($sql);
			if(empty($request))
			{		
				$request = 'vacio';	
			} else {
				$request = $request;

				$sql = "UPDATE notificaciones SET status = 1 WHERE status = 0 AND id_restaurante = $idRest;";
				$arrData = array(0);
				$update = $this->update($sql, $arrData);
			}
			return $request;
		}	
	}

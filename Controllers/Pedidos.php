<?php 
class Pedidos extends Controllers{
	
	public function __construct()
	{
		parent::__construct();
		session_start();
		$arrPago = selectUltimoPago();
		//session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		if($arrPago['status'] == 'vencido'){
			header('Location: '.base_url().'/Pagos');
			die();
		};
		getPermisos(MPEDIDOS);
	}

	public function Pedidos()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Pedidos";
		$data['page_title'] = "Pedidos";
		$data['page_name'] = "pedidos";
		$data['page_functions_js'] = "functions_pedidos.js";
		$this->views->getView($this,"pedidos",$data);
	}

	public function getPedidos(){
		if($_SESSION['permisosMod']['r']){
			$id_restaurante = "";	
			if( $_SESSION['userData']['idrol'] == RCLIENTES ){
				$id_restaurante = $_SESSION['userData']['id_restaurante'];
			}
			$arrData = $this->model->selectPedidos($id_restaurante);
			//dep($arrData);
			for ($i=0; $i < count($arrData); $i++) {
				$arrData[$i]['total'] = SMONEY.' '.formatMoney($arrData[$i]['total']);
				$fecha = $arrData[$i]['fecha'];
				$modo = $arrData[$i]['modo'];
				$btnView = '';
				$btnPrint = '';
				$btnDelete = '';

				$arrData[$i]['status'] = getStatusCarrito($arrData[$i]['status']);
		
				$options = createDropdownMenu($arrData[$i]['id_carrito_temp'], $modo);

				$arrData[$i]['status'] 
				= '<div class="dropdown">
				<button class="badge '.$arrData[$i]['status']['clase'].' dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span>'.$arrData[$i]['status']['texto'].'</span>
				</button>'
					.$options.
				'</div>';			
		
				$dataModo = getIconModo($arrData[$i]['modo']);		
				$arrData[$i]['modo'] = 	
				'<div class="contModo">'
					.$dataModo['icono']."<span>". $dataModo['texto'].'</span>
				</div>';

				if($_SESSION['permisosMod']['r']){					
					$btnView = '<button class="btn-primary-sm" onClick="fntViewInfo('.$arrData[$i]['id_carrito_temp'].')" title="Ver pedido"><i class="far fa-eye"></i></button>';
					$btnPrint = '<button class="btn-print-sm" onClick="printComanda('.$arrData[$i]['id_carrito_temp'].')" title="Imprimir Comanda"><i class="fa fa-print"></i></button>';
					$btnDelete = '<button class="btn-borrar-sm" onClick="fntDelInfo('.$arrData[$i]['id_carrito_temp'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
				}			
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnPrint.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function getPedido(string $id_carrito_temp){
		if($_SESSION['permisosMod']['r']){
			$intIdCarrito = intval($id_carrito_temp);
			if($intIdCarrito > 0)
			{
				$arrData = $this->model->selectPedido($intIdCarrito);

				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{				
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function getComanda(string $id_carrito_temp){
		if($_SESSION['permisosMod']['r']){
			$intIdCarrito = intval($id_carrito_temp);
			$arrData = $this->model->selectComanda($intIdCarrito);		
		}
		die();
	}

	public function setPedido(){
		if($_POST){
			if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){

				$idpedido = !empty($_POST['idpedido']) ? intval($_POST['idpedido']) : "";
				$estado = !empty($_POST['listEstado']) ? strClean($_POST['listEstado']) : "";
				$idtipopago =  !empty($_POST['listTipopago']) ? intval($_POST['listTipopago']) : "";
				$transaccion = !empty($_POST['txtTransaccion']) ? strClean($_POST['txtTransaccion']) : "";

				if($idpedido == ""){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					if($idtipopago == ""){
						if($estado == ""){
							$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						}else{
							$requestPedido = $this->model->updatePedido($idpedido,"","",$estado);
							if($requestPedido){
								$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
							}else{
								$arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
							}
						}
					}else{
						if($transaccion == "" or $idtipopago =="" or $estado == ""){
							$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						}else{
							$requestPedido = $this->model->updatePedido($idpedido,$transaccion,$idtipopago,$estado);
							if($requestPedido){
								$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
							}else{
								$arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
							}
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delPedido()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intId_carrito_temp = intval($_POST['id_carrito_temp']);
				$requestDelete = $this->model->deletePedido($intId_carrito_temp);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function changeStatus()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intId_carrito_temp = intval($_POST['id_carrito_temp']);
				$intStatus_pedido = intval($_POST['status']);

				$requestDelete = $this->model->updateStatus($intId_carrito_temp, $intStatus_pedido);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true);
				}else{
					$arrResponse = array('status' => false);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function getNotificacion()
	{
		if($_SESSION['permisosMod']['r']){			
			$arrData = $this->model->selectNotificacion();
			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);			
		}
		die();
	}
}
 ?>
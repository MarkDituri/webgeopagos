<?php

class PagosModel extends Mysql
{
	private $intIdPago;
	private $intStatus;
	private $fechaInicio;
	private $fechaFin;
	private $strMonto;

	public function __construct()
	{
		parent::__construct();
	}

	public function selectPagos()
	{
		$idRest = $_SESSION['idRest'];
		$sql = "SELECT p.id_pago,
							p.status,		
							DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio,
							DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,
							DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,							
                            c.nombre as plan,								
							p.precio                         							
					FROM pagos p
                    INNER JOIN planes c
                    ON p.id_plan = c.id_plan
					WHERE p.id_restaurante = $idRest AND activo = 'si'
                    ORDER BY id_pago asc";
		$request = $this->select_all($sql);

		return $request;
	}

	public function selectUltimoPago()
	{				
		require_once("Libraries/Core/Mysql.php");
		$idRest = $_SESSION['idRest'];
		$dataPlan = getUsuario();		
		$id_plan = $dataPlan['id_plan'];				
		if($id_plan == 0){ // Si es Plan							
			$where = "WHERE activo = 'si' AND p.status = 1 AND p.id_plan = 1 AND p.id_restaurante = " . $idRest;	
			$order = "ORDER BY id_pago ASC LIMIT 1";
		} else {						
			$where = "WHERE activo = 'si' AND p.status = 1 AND p.id_restaurante = " . $idRest;	
			$order = "ORDER BY id_pago DESC LIMIT 1";
		}						                  
		$con = new Mysql();
		$sql = "SELECT p.id_pago, p.status,                            						
				DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio,
				DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,
				DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,
				DATE_FORMAT(p.fechaPago, '%d/%m/%Y') as fechaPago,		
				c.nombre as plan, c.id_plan as id_plan, c.precio as precio_plan,							
				p.precio                         							
		FROM pagos p INNER JOIN planes c ON p.id_plan = c.id_plan";
		$sqlComplete = $sql . " " . $where . " " . $order;
		$request = $con->select($sqlComplete);
	
		if ($request['plan'] == 'Demo') { // Logica si es Demo						
			if (compararFechas($request['fechaFin'], getHoy()) <= 0) { // si vencio demo, Muestra sig Pago																		
				$con = new Mysql();
				$where = "WHERE activo = 'si' AND p.status = 0 AND p.id_restaurante = " . $idRest;
				$order = "ORDER BY id_pago DESC LIMIT 1";
				$sqlComplete = $sql . " " . $where . " " . $order;
				$request = $con->select($sqlComplete);
				if ($request['status'] == 1) {
					$request = array("status" => "pagado") + $request;
				} else {
					if (compararFechas($request['fechaVen'], getHoy()) <= 0) {
						$request = array("status" => "vencido") + $request;
					} else if (compararFechas($request['fechaInicio'], getHoy()) <= 0) {
						$request = array("status" => "pagar") + $request;
					}
				}
			} else {
				$request = array("status" => "demo") + $request;
			}
		} else { // Logica si es Plan								
			$con = new Mysql();
			$where = "WHERE activo = 'si' AND p.status = 0 AND p.id_restaurante = " . $idRest;			
			$order = "ORDER BY id_pago DESC LIMIT 1";
			$sqlComplete = $sql . " " . $where . " " . $order;
			$request = $con->select($sqlComplete);
	
			if (compararFechas($request['fechaVen'], getHoy()) <= 0) {            
				$request = array("status" => "vencido") + $request;
			} else if (compararFechas($request['fechaInicio'], getHoy()) <= 0) {
				$request = array("status" => "pagar") + $request;		            
			} else {			            
				$where = "WHERE activo = 'si' AND p.status = 1 AND p.id_restaurante = " . $idRest;			
				$order = "ORDER BY id_pago DESC LIMIT 1";
				$sqlComplete = $sql . " " . $where . " " . $order;
				$request = $con->select($sqlComplete);
				$request = array("status" => "pagado") + $request;							
			}
		}		
		return $request;
	}

	public function selectIdUltimoPago()
	{
		$idRest = $_SESSION['idRest'];
		$sql = "SELECT p.id_pago,							                         	
                            c.nombre as plan							                  							
					FROM pagos p
                    INNER JOIN planes c
                    ON p.id_plan = c.id_plan
					WHERE p.id_restaurante = $idRest AND activo = 'si'
                    ORDER BY DATE_FORMAT(p.fechaFin, '%d/%m/%Y') DESC LIMIT 1";
		$request = $this->select_all($sql);
		return $request;
	}

	public function insertPago(string $titulo, string $portada, string $tag, int $status)
	{
		$idRest = $_SESSION['idRest'];
		$this->strTitulo = $titulo;
		$this->strPortada = $portada;
		$this->strTag = $tag;
		$this->strActivo = 'si';
		$this->intStatus = $status;
		$this->intIdRest = $_SESSION['idRest'];
		$return = 0;
		// Limitar Pagos consuñta
		$sql = "SELECT id_pago, COUNT(*) as total_pago FROM pagos WHERE id_restaurante = $idRest AND activo =	'si';";
		$request = $this->select_all($sql);
		$request = $request[0]['total_pago'];

		if ($request < 3) {
			$sql = "SELECT * FROM pagos WHERE titulo = '{$this->strTitulo}' AND id_restaurante = $idRest AND activo = 'si';";
			$request = $this->select_all($sql);


			if (empty($request)) {
				$query_insert  = "INSERT INTO pagos ( status,								
														titulo,                                                
														img_pago,
														tag,                                             	
														activo,
														id_restaurante)
										VALUES(?,?,?,?,?,?)";
				$arrData = array(
					$this->intStatus,
					$this->strTitulo,
					$this->strPortada,
					$this->strTag,
					$this->strActivo,
					$this->intIdRest
				);
				$request_insert = $this->insert($query_insert, $arrData);
				$return = $request_insert;
			} else {
				$return = "exist";
			}
		} else {
			$return = "limite";
		}
		return $return;
	}

	public function updatePago($id_pago, $status, $precio_plan, $payment, $payment_type, $order_id)
	{	
		$dataPlan = getUsuario();
		$id_plan = $dataPlan['id_plan'];
		$return = '';
		$idRest = $_SESSION['idRest'];
		$this->intIdPago = $id_pago;
		$this->intPayment = $payment;
		$this->intPayment_type = $payment_type;
		$this->intOrder_id = $order_id;
		$this->status = $status == 'approved' ? 1 : 0;
		$id_plan = $id_plan == 1 ? $id_plan = 2 : $id_plan = $id_plan;

		$sql = "UPDATE pagos
			SET status = ?, mp_payment_id = ?, mp_payment_type = ?, mp_order_id = ?
			WHERE id_pago = ? AND id_restaurante = ?";
		$arrData = array(
			$this->status,
			$payment,
			$payment_type,
			$order_id,
			$id_pago,
			$idRest
		);		
		$request = $this->update($sql, $arrData);

		if($request == true){ // Si actualizo Pago actualizar restaurante plan			
			$sql = "UPDATE restaurantes
				SET id_plan = ?
				WHERE id_restaurante = ?";
			$arrData = array(
				$id_plan,	
				$idRest
			);
			$request = $this->update($sql, $arrData);		
			
			$hoy = getHoyDB(); 
			$sql = "UPDATE pagos
				SET fechaPago = ?
				WHERE id_restaurante = ? AND id_pago = ?";
			$arrData = array(
				$hoy,				
				$idRest,
				$id_pago
			);
			$request = $this->update($sql, $arrData);	

			if ($request == true) { // Si actualizo el restaurante logica siguiente pago
				// Seleccionar el creado
				$select = "SELECT p.id_pago,
								p.status,             
								DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio,			               
								DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,
								DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,								
								DATE_FORMAT(p.fechaInicio, '%Y-%m-%d') as fechaInicioDB,		
								DATE_FORMAT(p.fechaVen, '%Y-%m-%d') as fechaVenDB,
								DATE_FORMAT(p.fechaFin, '%Y-%m-%d') as fechaFinDB,										
								c.nombre as plan,								
								p.precio                         							
						FROM pagos p
						INNER JOIN planes c
						ON p.id_plan = c.id_plan
						WHERE p.id_restaurante = $idRest AND activo = 'si' AND id_pago = $id_pago;";
				$request = $this->select_all($select);	
				$fechaVen = $request[0]['fechaVen'];
				$fechaFin = $request[0]['fechaFin'];
				$fechaFinSelectDB = $request[0]['fechaFinDB'];
				$fechaVenSelectDB = $request[0]['fechaVenDB'];
								
				if (compararFechas($fechaFin, getHoy()) <= 0) { //Si vencio la cuenta crear con desde fecha actual
					//Vencio - Tomar fecha actual	
					$fechaFin = date("Y-m-d", strtotime(getHoyDB() . "+ 30 days"));
					$fechaInicio = date("Y-m-d", strtotime($fechaFin . "- 30 days"));
					$fechaVen = date("Y-m-d", strtotime($fechaInicio . "+ 15 days"));					
				} else {
					//Pago a tiempo					
					$myDateTime = DateTime::createFromFormat('Y-m-d', $fechaFinSelectDB);
					$formattedweddingdate = $myDateTime->format('Y-m-d');
					$fechaFin = date("Y-m-d", strtotime($formattedweddingdate . "+ 30 days"));
	
					$myDateTime = DateTime::createFromFormat('Y-m-d', $fechaFin);
					$formattedweddingdate = $myDateTime->format('Y-m-d');
					$fechaInicio = date("Y-m-d", strtotime($formattedweddingdate . "- 30 days"));
	
					$myDateTime = DateTime::createFromFormat('Y-m-d', $fechaInicio);
					$formattedweddingdate = $myDateTime->format('Y-m-d');
					$fechaVen = date("Y-m-d", strtotime($formattedweddingdate . "+ 15 days"));					
				}
				// Crear proxima cuota					
				$status = 0;
				$sql = "INSERT INTO pagos (status,
												fechaInicio,
												fechaFin,
												fechaVen,
												fechaPago,
												precio,
												activo,
												id_plan,
												id_restaurante)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
				$arrData = array(
					$status,
					$fechaInicio,
					$fechaFin,
					$fechaVen,
					null,
					$precio_plan,
					"si",
					$id_plan,
					$idRest
				);
				$requestIns = $this->update($sql, $arrData);										
				if ($requestIns == true) {
					$return = $requestIns;
				}
			}
		}

		return $return;
	}

	public function selectPago(int $id_pago)
	{
		$idRest = $_SESSION['idRest'];
		$this->intIdPago = $id_pago;
		$sql = "SELECT id_pago,							
							titulo,							
							img_pago,
							tag,														
							status,
                            activo
					FROM pagos										
					WHERE id_pago = $this->intIdPago AND id_restaurante = $idRest";
		$request = $this->select($sql);
		return $request;
	}

	public function insertImage(int $idpago, string $imagen)
	{
		$this->intIdPago = $idpago;
		$this->strImagen = $imagen;
		$query_insert  = "INSERT INTO imagen(pagoid,img) VALUES(?,?)";
		$arrData = array(
			$this->intIdPago,
			$this->strImagen
		);
		$request_insert = $this->insert($query_insert, $arrData);
		return $request_insert;
	}

	public function selectImages(int $idpago)
	{
		$this->intIdPago = $idpago;
		$sql = "SELECT pagoid,img
					FROM imagen
					WHERE pagoid = $this->intIdPago";
		$request = $this->select_all($sql);
		return $request;
	}

	public function deleteImage(int $idpago, string $imagen)
	{
		$this->intIdPago = $idpago;
		$this->strImagen = $imagen;
		$query  = "DELETE FROM imagen 
						WHERE pagoid = $this->intIdPago 
						AND img = '{$this->strImagen}'";
		$request_delete = $this->delete($query);
		return $request_delete;
	}

	public function deletePago(int $id_pago)
	{
		$idRest = $_SESSION['idRest'];
		$this->intIdPago = $id_pago;
		$sql = "UPDATE pagos SET activo = ? WHERE id_pago = $this->intIdPago AND id_restaurante = $idRest";
		$arrData = array('no');
		$request = $this->update($sql, $arrData);
		return $request;
	}
}

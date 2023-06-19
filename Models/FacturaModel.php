<?php 
	class FacturaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function selectPedido(int $id_pago){
            $idRest = $_SESSION['idRest'];
			$request = array();
			$sql = "SELECT p.id_pago,
                            p.status,                                           
                            DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio,
							DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,
							DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,
							DATE_FORMAT(p.fechaPago, '%d/%m/%Y') as fechaPago,
                            p.mp_payment_id,
                            p.mp_payment_type,
                            p.mp_order_id,
                            p.precio,
                            p.id_restaurante,
                            c.nombre as plan
                    FROM pagos p
                    INNER JOIN planes c
                    ON p.id_plan = c.id_plan
                    WHERE p.id_restaurante = $idRest AND p.id_pago = $id_pago AND activo = 'si'";

			$requestPedido = $this->select($sql);    	

			if(!empty($requestPedido)){				
				$sql_cliente = "SELECT id_restaurante,
										identificacion,
										nombres,
										nombre_rest,
										apellidos,
										telefono,
										email_user,
										direccion,
										numero,
										localidad
								FROM restaurantes WHERE id_restaurante = $idRest ";
				$requestcliente = $this->select($sql_cliente);			
		
				$request = array('restaurante' => $requestcliente,
								'pago' => $requestPedido,								
							);
			}
			
			return $request;
		}		

	}
 ?>
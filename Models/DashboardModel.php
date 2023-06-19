<?php 
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function cantQR(){
			$idRest = $_SESSION['userData']['id_restaurante'];
			$sql = "SELECT COUNT(*) as total FROM carrito_temp WHERE id_restaurante = $idRest AND qr = 'si'";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantCategorias(){
			$idRest = $_SESSION['userData']['id_restaurante'];
			$sql = "SELECT COUNT(*) as total FROM categorias WHERE status != 0  AND activo = 'si' AND id_restaurante = $idRest";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantProductos(){
			$idRest = $_SESSION['userData']['id_restaurante'];
			$sql = "SELECT COUNT(*) as total FROM productos WHERE status != 0 AND activo = 'si' AND id_restaurante = $idRest";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantPedidos(){			
			$idRest = $_SESSION['userData']['id_restaurante'];
			$where = " WHERE activo = 'si' AND status = 2 AND id_restaurante = ".$idRest;
			$sql = "SELECT COUNT(*) as total FROM carrito_temp ".$where;						
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function losMasPedidos(){			
			$idRest = $_SESSION['userData']['id_restaurante'];
			// Los mas elegidos
			
			$query ="SELECT id_producto, COUNT(*)
					FROM pedidos
					WHERE id_restaurante = $idRest
					GROUP BY id_producto ORDER BY COUNT(id_producto) DESC 
					LIMIT 5;";

			$stmt = conexion()->prepare($query);
			$stmt->execute();        

			$id_tops = array();        
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){        
				$id_tops[] = $row['id_producto'];           
			}
			$cnt_restul = count($id_tops);

			if($cnt_restul >= 4){
				//Crear where con arrays de productos
				$id_TOP = '';
				foreach ($id_tops as &$valor) {     
					$id_TOP = $id_TOP .$valor.",";
				}
				$where_q2 = trim($id_TOP,",");           
				$query2 ="SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
					FROM productos 
					WHERE id_producto IN($where_q2) AND status = 1 AND activo = 'si'
					ORDER BY FIND_IN_SET(id_producto, '$where_q2');";                

				$stmt2 = conexion()->prepare($query2);
				$stmt2->execute();

				$dataProductos = array();        
				while($row=$stmt2->fetch(PDO::FETCH_ASSOC)){
					$dataProductos['productos'][] = $row;
				}        
				
				return $dataProductos;    
			} else {
				return false;
			}    
		}
		public function lastOrders(){
			$rolid = $_SESSION['userData']['idrol'];
			$idRest = $_SESSION['userData']['id_restaurante'];
			$where = "";
			if($rolid == RCLIENTES ){
				$where = " WHERE p.id_restaurante = ".$idRest;
			}

			$sql = "SELECT id_carrito_temp,
						status,
						code_session,
						total,
						activo,
						DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
						DATE_FORMAT(datecreated, '%H:%i') as hora,
						id_restaurante
				FROM carrito_temp			
				WHERE status != 0 AND id_restaurante = $idRest AND activo = 'si'  ORDER BY datecreated DESC LIMIT 6";
			$request = $this->select_all($sql);
			return $request;
		}	
		public function creacion(){			
			$idRest = $_SESSION['userData']['id_restaurante'];
			$sql = "SELECT * FROM restaurantes WHERE id_restaurante = $idRest";
			$request = $this->select_all($sql);
			return $request;
		}	   

		public function selectVentasMes(int $anio, int $mes){
			$rolid = $_SESSION['userData']['idrol'];
			$idRest = $_SESSION['userData']['id_restaurante'];
			$where = "";
			if($rolid == RCLIENTES ){
				$where = " AND id_restaurante = ".$idRest;
			}

			$totalVentasMes = 0;
			$arrVentaDias = array();
			$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
			$n_dia = 1;
			for ($i=0; $i < $dias ; $i++) { 
				$date = date_create($anio."-".$mes."-".$n_dia);
				$fechaVenta = date_format($date,"Y-m-d");
				$sql = "SELECT DAY(fecha) AS dia, COUNT(idpedido) AS cantidad, SUM(monto) AS total 
						FROM pedidos 
						WHERE DATE(fecha) = '$fechaVenta' AND status = 'Completo' ".$where;
				$ventaDia = $this->select($sql);
				$ventaDia['dia'] = $n_dia;
				$ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];
				$totalVentasMes += $ventaDia['total'];
				array_push($arrVentaDias, $ventaDia);
				$n_dia++;
			}
			$meses = Meses();
			$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes,'ventas' => $arrVentaDias );
			return $arrData;
		}
		public function selectVentasAnio(int $anio){
			$arrMVentas = array();
			$arrMeses = Meses();
			for ($i=1; $i <= 12; $i++) { 
				$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');
				$sql = "SELECT $anio AS anio, $i AS mes, SUM(monto) AS venta 
						FROM pedidos 
						WHERE MONTH(fecha)= $i AND YEAR(fecha) = $anio AND status = 'Completo' 
						GROUP BY MONTH(fecha) ";
				$ventaMes = $this->select($sql);
				$arrData['mes'] = $arrMeses[$i-1];
				if(empty($ventaMes)){
					$arrData['anio'] = $anio;
					$arrData['no_mes'] = $i;
					$arrData['venta'] = 0;
				}else{
					$arrData['anio'] = $ventaMes['anio'];
					$arrData['no_mes'] = $ventaMes['mes'];
					$arrData['venta'] = $ventaMes['venta'];
				}
				array_push($arrMVentas, $arrData);
				# code...
			}
			$arrVentas = array('anio' => $anio, 'meses' => $arrMVentas);
			return $arrVentas;
		}
		public function productosTen(){
			$sql = "SELECT * FROM producto WHERE status = 1 ORDER BY idproducto DESC LIMIT 10 ";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>
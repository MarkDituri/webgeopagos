<?php
require_once("Libraries/Core/Mysql.php");

trait TProducto
{
	private $con;
	private $strCategoria;
	private $intIdcategoria;
	private $intIdProducto;
	private $strProducto;
	private $cant;
	private $option;
	private $strRuta;
	private $strRutaCategoria;

	public function getProductoCatJSON($params)
	{
		$arrParams = explode("-", $params);
		$id_categoria = strClean($arrParams[0]);
		$id_restaurante = strClean($arrParams[1]);
		$this->con = new Mysql();
		// Si es 0 es porque busca la categoria primera
		if ($id_categoria == 0) {
			// Traer primer categoria activa
			$sqlCat = "SELECT id_categoria FROM categorias WHERE status = 1 AND id_restaurante = $id_restaurante  ORDER BY id_categoria ASC LIMIT 1;";
			$requestCat = $this->con->select($sqlCat);						
			$id_categoria_0 = $requestCat['id_categoria'];

			if (!empty($requestCat)) {

				$sql = "SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
					FROM productos 
				WHERE id_categoria = $id_categoria_0 AND status = 1 AND activo = 'si';";
			}
			// traer productos de la categoria del $param
		} else {
			$sql = "SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
				FROM productos 
			WHERE id_categoria = $id_categoria AND status = 1 AND activo = 'si';";
		}

		$request = $this->con->select_all($sql);

		if (!empty($request)) {
			$arrResponse = array('status' => true, 'productos' => $request);
		} else {
			$arrResponse = array('status' => false);
		}

		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
	}

	public function getProductoBestJSON($id_restaurante)
	{				
		$this->con = new Mysql();
		$sql = "SELECT id_producto, COUNT(*)
					FROM pedidos
					WHERE id_restaurante = $id_restaurante
					GROUP BY id_producto
					ORDER BY COUNT(id_producto) DESC 
					LIMIT 5;";
		$request = $this->con->select_all($sql);
		$cnt_restul = count($request);

		if (!empty($request)) {
			if($cnt_restul > 4) {
				$where = '';
				for ($i = 0; $i <= 4; $i++) {
					$where = $where . $request[$i]['id_producto'] . ",";
				}
				$where = trim($where, ",");
				$sql = "SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
							FROM productos 
							WHERE id_producto IN($where) AND status = 1 AND activo = 'si' AND id_restaurante = $id_restaurante
							ORDER BY FIND_IN_SET(id_producto, '$where');";
	
				$request = $this->con->select_all($sql);				
				$arrResponse = array('status' => true, 'productos' => $request);
			} else {
				$arrResponse = array('status' => false);
			}
		} else {
			$arrResponse = array('status' => false);
		}

		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
	}

	public function getProductoBest($id_restaurante)
	{
		$this->con = new Mysql();
		$sql = "SELECT id_producto, COUNT(*)
					FROM pedidos
					WHERE id_restaurante = $id_restaurante
					GROUP BY id_producto
					ORDER BY COUNT(id_producto) DESC 
					LIMIT 5;";
		$request = $this->con->select_all($sql);
		$cnt_restul = count($request);

		if (!empty($request)) {
			if($cnt_restul > 4) {
				$where = '';
				for ($i = 0; $i <= 4; $i++) {
					$where = $where . $request[$i]['id_producto'] . ",";
				}
				$where = trim($where, ",");
				$sql = "SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
							FROM productos 
							WHERE id_producto IN($where) AND status = 1 AND activo = 'si' AND id_restaurante = $id_restaurante
							ORDER BY FIND_IN_SET(id_producto, '$where');";

				$request = $this->con->select_all($sql);

				return $request;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getProducto(int $id_producto)
	{
		$this->con = new Mysql();
		$this->intIdProducto = $id_producto;

		$sql = "SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
			FROM productos 
			WHERE id_producto = $this->intIdProducto AND status = 1 AND activo = 'si';";

		$request = $this->con->select($sql);

		return $request;
	}

	public function addCarrito(int $id_producto)
	{
		// Capturar datos POST
		$detalle = trim($_POST['detalle']);
		$precio_producto = $_POST['precio'];
		$cantidad_producto = $_POST['cantidad'];
		$precio = $precio_producto * $cantidad_producto;

		// Declarar variables de SESSION
		$SESSION_id_rest = $_SESSION['restaurante']['id_restaurante'];
		$SESSION_code = $_SESSION['code_session'];
	
		$sql = "INSERT INTO pedidos (id_pedido, id_producto, id_restaurante, detalle, code_session, cantidad, precio)
			VALUES (?, ?, ?, ?, ?, ?, ?);";
		$arrData = array(
			NULL,
			$id_producto,
			$SESSION_id_rest,
			$detalle,
			$SESSION_code,
			$cantidad_producto,
			$precio
		);

		$request = $this->con->insert($sql, $arrData);

		if (!empty($request)) {			
			//sumar para total
			$sql = "SELECT p.id_producto, p.titulo, p.status, p.descripcion, p.url_img, d.precio,
				d.code_session, d.cantidad, d.id_producto, d.id_restaurante 
			FROM pedidos d 
			INNER JOIN productos p 
			ON d.id_producto = p.id_producto 
			WHERE d.code_session = '$SESSION_code' 
			AND d.id_restaurante = $SESSION_id_rest;";

			$request = $this->con->select_all($sql);
			$dataProductos = $request; // actualiza carrito session con ultimo insert								
			$total = 0;

			for ($i = 0; $i < count($dataProductos); $i++) {
				$precio_producto =    $dataProductos[$i]['precio'];
				$cantidad_producto =    $dataProductos[$i]['cantidad'];
				$total = $total + $precio_producto;
			}

			//Actualizar total en DB
			$sql = "UPDATE carrito_temp
						SET total = ?
					WHERE code_session = '$SESSION_code' AND id_restaurante = $SESSION_id_rest 
					AND activo = 'si';";
			$arrData = array($total);

			$request = $this->con->update($sql, $arrData);

			if (!empty($request)) {
				return true;
			}
		} else {			
			return false;
		}
	}

	public function delCarrito(int $id_pedido, int $precio, int $id_restaurante, string $SESSION_code)
	{
		$this->con = new Mysql();
		// Borrando pedido 
		$sql = "DELETE FROM pedidos
					WHERE id_pedido = $id_pedido
				AND id_restaurante = $id_restaurante AND code_session = '$SESSION_code';";

		$request = $this->con->delete($sql);

		if (!empty($request)) {
			// Traer total actualizado
			$sql = "SELECT total FROM carrito_temp 
						WHERE id_restaurante = $id_restaurante
					AND code_session = '$SESSION_code';";

			$request = $this->con->select($sql);

			if (!empty($request)) {
				$total_carrito =  $request['total'];
				$total_carrito = $total_carrito - $precio;

				//Actualizar total
				$sql = "UPDATE carrito_temp
							SET total = ?
						WHERE code_session = '$SESSION_code' AND id_restaurante = $id_restaurante;";

				$arrData = array($total_carrito);
				$request = $this->con->update($sql, $arrData);

				// Se guardo el total en carrito en la DB
				if (!empty($request)) {
					return true;
				}
			} else {
				return false;
			}
		}
	}

	public function updateDetalle(int $id_restaurante, string $SESSION_code)
	{
		$detalle = trim($_POST['detalle']);
		$id_pedido = trim($_POST['id_pedido']);

		$this->con = new Mysql();
		$sql = "UPDATE pedidos
			SET detalle = ?
			WHERE id_pedido = $id_pedido AND id_restaurante = $id_restaurante
			AND code_session = '$SESSION_code';";
		$arrData = array($detalle);
		$request = $this->con->update($sql, $arrData);

		if (!empty($request)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateCarritoConfirm(int $id_comensal, int $id_restaurante, string $SESSION_code)
	{
		$datecreated = getDatacreatedDB();

		$this->con = new Mysql();
		$sql = "UPDATE carrito_temp
			SET status = ?, datecreated = ?, id_comensal = ?
			WHERE id_restaurante = $id_restaurante
			AND code_session = '$SESSION_code'
			AND activo = 'si';";
		$arrData = array(1, $datecreated, $id_comensal);
		$request = $this->con->update($sql, $arrData);

		if (!empty($request)) {
			$sql = "INSERT INTO notificaciones (id_notificacion, status, tipo, code_session, id_restaurante)
			VALUES (?, ?, ?, ?, ?);";
			$arrData = array(
				NULL, 0, 'PUSH', $SESSION_code, $id_restaurante
			);
			$request = $this->con->insert($sql, $arrData);

			if (!empty($request)) {
				return true;
			}
		} else {
			return false;
		}
	}



	public function cantProductos($categoria = null)
	{
		$where = "";
		if ($categoria != null) {
			$where = " AND categoriaid = " . $categoria;
		}
		$this->con = new Mysql();
		$sql = "SELECT COUNT(*) as total_registro FROM producto WHERE status = 1 " . $where;
		$result_register = $this->con->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

	public function cantProdSearch($busqueda)
	{
		$this->con = new Mysql();
		$sql = "SELECT COUNT(*) as total_registro FROM producto WHERE nombre LIKE '%$busqueda%' AND status = 1 ";
		$result_register = $this->con->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

	public function getProdSearch($busqueda, $desde, $porpagina)
	{
		$this->con = new Mysql();
		$sql = "SELECT p.idproducto,
						p.codigo,
						p.nombre,
						p.descripcion,
						p.categoriaid,
						c.nombre as categoria,
						p.precio,
						p.ruta,
						p.stock
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE p.status = 1 AND p.nombre LIKE '%$busqueda%' ORDER BY p.idproducto DESC LIMIT $desde,$porpagina";
		$request = $this->con->select_all($sql);
		if (count($request) > 0) {
			for ($c = 0; $c < count($request); $c++) {
				$intIdProducto = $request[$c]['idproducto'];
				$sqlImg = "SELECT img
								FROM imagen
								WHERE productoid = $intIdProducto";
				$arrImg = $this->con->select_all($sqlImg);
				if (count($arrImg) > 0) {
					for ($i = 0; $i < count($arrImg); $i++) {
						$arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
					}
				}
				$request[$c]['images'] = $arrImg;
			}
		}
		return $request;
	}
}

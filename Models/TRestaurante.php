<?php
require_once("Libraries/Core/Mysql.php");
trait TRestaurante
{
	private $con;

	public function getRestauranteUrl($url_restaurante)
	{
		$this->con = new Mysql();
		$sql = "SELECT id_restaurante, identificacion, nombres, apellidos, nombre_rest, telefono, email_user, direccion, numero, localidad, id_color, dark_mode, url_logo, url, facebook, instagram, status, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha 
        			FROM restaurantes 
				WHERE url = '$url_restaurante';";
		$request = $this->con->select($sql);

		return $request;
	}

	public function getRestauranteID($id_restaurante)
	{
		$this->con = new Mysql();
		$sql = "SELECT id_restaurante, identificacion, nombres, apellidos, nombre_rest, telefono, email_user, direccion, numero, localidad, id_color, dark_mode, url_logo, url, facebook, instagram, status, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha 
					FROM restaurantes 
				WHERE id_restaurante = '$id_restaurante';";
		$request = $this->con->select($sql);

		return $request;
	}

	public function getColor(int $id_color)
	{
		$this->con = new Mysql();
		$sql = "SELECT class_name    
					FROM colores
				WHERE id_color = $id_color";
		$request = $this->con->select($sql);
		$arrayColor = array("class_color" => $request['class_name']);

		return $_SESSION['restaurante'] = array_merge($_SESSION['restaurante'], $arrayColor);
	}

	public function selectUltimoPagoModel(int $id_restaurante)
	{
		$this->con = new Mysql();
		$sql = "SELECT p.id_pago,
					p.status,                            
					DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,
					DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,
					DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio           									  
				FROM pagos p
				INNER JOIN planes c
				ON p.id_plan = c.id_plan
				WHERE p.id_restaurante = $id_restaurante AND activo = 'si'
				-- ORDER BY DATE_FORMAT(p.fechaFin, '%d/%m/%Y') DESC 
				ORDER BY id_pago DESC 
				LIMIT 1";
		$request = $this->con->select($sql);

		if ($request['status'] == 1) {
			$dataPago = array("status" => "pagado");
		} else {
			if (compararFechas($request['fechaVen'], getHoy()) <= 0) {
				$dataPago = array("status" => "vencido");
			} else if (compararFechas($request['fechaInicio'], getHoy()) <= 0) {
				$dataPago = array("status" => "pagar");
			} else {
				$dataPago = array("status" => "pagado");
			}
		}
		$request = $dataPago;

		return $request;
	}

	public function updateModo(string $modo, int $id_restaurante, string $SESSION_code)
	{
		$this->con = new Mysql();

		$sql = "UPDATE carrito_temp SET modo = ? 
			WHERE id_restaurante = $id_restaurante AND code_session = '$SESSION_code';";
		$arrData = array($modo);

		$request = $this->con->update($sql, $arrData);
		
		if (!empty($request)) {
			$arrayModo = array("modo" => $modo);		
				
			return $_SESSION['carrito'] = array_merge($_SESSION['carrito'], $arrayModo);	
		}
		
	}

	public function refreshStatus(int $id_carrito, int $id_restaurante, string $SESSION_code) {			
		$this->con = new Mysql();
		$sql = "SELECT id_carrito_temp, status, code_session, modo, mesa, total, activo, qr, 
					DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
					DATE_FORMAT(datecreated, '%H:%i') as hora,
					id_restaurante, id_comensal 
					FROM carrito_temp 
				WHERE id_carrito_temp = $id_carrito AND id_restaurante = $id_restaurante AND code_session = '$SESSION_code';";

		$request = $this->con->select($sql);		

		return $request;
	}
}

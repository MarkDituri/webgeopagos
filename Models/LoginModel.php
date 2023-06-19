<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT id_restaurante,status FROM restaurantes WHERE 
					email_user = '$this->strUsuario' and 
					password = '$this->strPassword' and 
					status != 0 ";
			$request = $this->select($sql);
			return $request;
		}
		public function ultimoPago()
		{
			$sql = "SELECT id_pago
					FROM pagos 
					WHERE id_restaurante = 1 AND activo = 'si'";
			$request = $this->select($sql);
			return $request;
		}
		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE 
			$sql = "SELECT p.id_restaurante,
							p.identificacion,
							p.nombres,
							p.nombre_rest,
							p.apellidos,
							p.telefono,
							p.email_user,
							p.password,
							p.nit,
							p.nombrefiscal,
							p.direccionfiscal,
							r.idrol,r.nombrerol,
							p.status,
							p.url_logo,
							p.url,
							p.direccion,
							p.numero,
							p.id_color,
							p.dark_mode,
							p.localidad,
							p.facebook,
							p.instagram,
							p.id_admin,
							p.id_plan
					FROM restaurantes p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.id_restaurante = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		// public function sessionPago(int $idPago){
		// 	$idRest = $_SESSION['idRest'];
		// 	$this->intIdPago = $idPago;
		// 	//BUSCAR ROLE 
		// 	$sql = "SELECT p.id_pago,
		// 					p.status,                            
		// 					DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fecha,
		// 					DATE_FORMAT(p.fechaFin, '%H:%i:%s') as hora,				
		// 					c.nombre as plan,	
		// 					c.id_plan as id_plan,		
		// 					c.precio as precio_plan							
		// 			FROM pagos p
		// 			INNER JOIN planes c
		// 			ON P.id_plan = c.id_plan
		// 			WHERE p.id_restaurante = $idRest AND activo = 'si'
		// 			ORDER BY DATE_FORMAT(p.fechaFin, '%d/%m/%Y') DESC LIMIT 1";
		// 	$request = $this->select($sql);
		// 	$_SESSION['userDataPago'] = $request;
		// 	return $request;
		// }		

		public function getUserEmail(string $strEmail){
			$this->strUsuario = $strEmail;
			$sql = "SELECT id_restaurante,nombres,apellidos,status FROM restaurantes WHERE 
					email_user = '$this->strUsuario' and  
					status != 0";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $id_restaurante, string $token){
			$this->intIdUsuario = $id_restaurante;
			$this->strToken = $token;
			$sql = "UPDATE restaurantes SET token = ? WHERE id_restaurante = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT id_restaurante FROM restaurantes WHERE 
					email_user = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status != 0 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE restaurantes SET password = ?, token = ? WHERE id_restaurante = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>
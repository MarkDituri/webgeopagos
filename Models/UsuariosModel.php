<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $strNit;
		private $strNomFiscal;
		private $strDirFiscal;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM persona WHERE 
					email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO persona(identificacion,nombres,apellidos,telefono,email_user,password,rolid,status) 
								  VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function insertPassword(string $password)
		{
			$idRest = $_SESSION['idRest'];
			$this->strPassword = $password;
			$sql = "UPDATE restaurantes SET password = ?
			WHERE id_restaurante = $idRest";
			$arrData = array($this->strPassword);
			$request = $this->update($sql, $arrData);
			return $request;
		}

		public function selectUsuarios()
		{
			$whereAdmin = "";
			if($_SESSION['idRest'] != 1 ){
				$whereAdmin = " and p.id_restaurante != 1 ";
			}
			$sql = "SELECT p.id_restaurante,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.url_logo,p.status,r.idrol,r.nombrerol 
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectUsuario(int $id_restaurante){
			$this->intIdUsuario = $id_restaurante;
			$sql = "SELECT p.id_restaurante,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.url_logo,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM restaurantes p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.id_restaurante = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;

			$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND id_restaurante != $this->intIdUsuario)
										  OR (identificacion = '{$this->strIdentificacion}' AND id_restaurante != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, rolid=?, status=? 
							WHERE id_restaurante = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus);
				}else{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, rolid=?, status=? 
							WHERE id_restaurante = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intTipoId,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE id_restaurante = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $nombre, string $apellido, int $telefono, string $nombreRest, string $portada, string $direccion, string $numero, string $localidad, string $facebook, string $instagram){			
			$this->intIdUsuario = $idUsuario;			
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strNombreRest = $nombreRest;
			$this->strPortada = $portada;
			$this->strDireccion = $direccion;
			$this->strNumero = $numero;
			$this->strLocalidad = $localidad;
			$this->strFacebook = $facebook;
			$this->strInstagram = $instagram;

			$sql = "UPDATE restaurantes SET nombres=?, apellidos=?, telefono=?, nombre_rest=?, url_logo=?, direccion=?, numero=?, localidad=?, facebook=?, instagram=?
					WHERE id_restaurante = $this->intIdUsuario ";
			$arrData = array($this->strNombre,						
							$this->strApellido,
							$this->intTelefono,
							$this->strNombreRest,
							$this->strPortada,
							$this->strDireccion,
							$this->strNumero,
							$this->strLocalidad,
							$this->strFacebook,
							$this->strInstagram);				
			
			//Actuaslizar datos de session
			$_SESSION['userData']['nombres'] = $this->strNombre;
			$_SESSION['userData']['apellidos'] = $this->strApellido;
			$_SESSION['userData']['telefono'] = $this->intTelefono;
			$_SESSION['userData']['nombre_rest'] = $this->strNombreRest;		
			$_SESSION['userData']['url_logo'] = $this->strPortada;			
			$_SESSION['userData']['direccion'] = $this->strDireccion;		
			$_SESSION['userData']['numero'] = $this->strNumero;		
			$_SESSION['userData']['localidad'] = $this->strLocalidad;		
			$_SESSION['userData']['facebook'] = $this->strFacebook;		
			$_SESSION['userData']['instagram'] = $this->strInstagram;		
			
			$request = $this->update($sql,$arrData);
		    return $request;
		}

		public function updateDataFiscal(int $idUsuario, string $strNit, string $strNomFiscal, string $strDirFiscal){
			$this->intIdUsuario = $idUsuario;
			$this->strNit = $strNit;
			$this->strNomFiscal = $strNomFiscal;
			$this->strDirFiscal = $strDirFiscal;
			$sql = "UPDATE persona SET nit=?, nombrefiscal=?, direccionfiscal=? 
						WHERE id_restaurante = $this->intIdUsuario ";
			$arrData = array($this->strNit,
							$this->strNomFiscal,
							$this->strDirFiscal);
			$request = $this->update($sql,$arrData);
		    return $request;
		}

		public function selectColores()
		{
			$sql = "SELECT id_color, nombre, class_name
					FROM colores";			
			$request = $this->select_all($sql);
			return $request;
		}
		public function updateColor(int $id_color)
		{			
			$idRest = $_SESSION['idRest'];
			$this->intIdColor = $id_color;

			$sql = "UPDATE restaurantes SET id_color = ?
						WHERE id_restaurante = $idRest";
			$arrData = array($this->intIdColor);
			$request = $this->update($sql,$arrData);

			$_SESSION['userData']['id_color'] = $this->intIdColor;
		    return $request;
		}
		
		public function updateDarkMode(int $boolDark)
		{			
			$idRest = $_SESSION['idRest'];
			$this->boolDark = $boolDark;

			$sql = "UPDATE restaurantes SET dark_mode = $boolDark
						WHERE id_restaurante = $idRest";
			$arrData = array($this->boolDark);
			$request = $this->update($sql,$arrData);

			$_SESSION['userData']['dark_mode'] = $this->boolDark;
		    return $request;
		}
	}
 ?>
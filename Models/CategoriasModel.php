<?php 

	class CategoriasModel extends Mysql
	{
		public $intIdcategoria;
		public $strCategoria;
		public $strDescripcion;
		public $intStatus;
		public $strPortada;
		public $strRuta;

		public function __construct()
		{
			parent::__construct();
		}

		public function inserCategoria(string $nombre, int $status){
			$idRest = $_SESSION['idRest'];
			$return = 0;
			$this->strCategoria = $nombre;									
			$this->intStatus = $status;

			$sql = "SELECT * FROM categorias WHERE nombre = '{$this->strCategoria}' AND activo != 'no' AND id_restaurante = $idRest";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO categorias(status, nombre, id_restaurante, activo) VALUES(?,?,?,'si')";
	        	$arrData = array($this->intStatus, 
								$this->strCategoria,
								$idRest
								);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function selectCategorias()
		{
			$idRest = $_SESSION['idRest'];
			$sql = "SELECT * FROM categorias
					WHERE activo = 'si' AND id_restaurante = $idRest";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCategoria(int $idcategoria){
			$idRest = $_SESSION['idRest'];
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM categorias
					WHERE id_categoria = $this->intIdcategoria AND id_restaurante = $idRest;";
			$request = $this->select($sql);
			return $request;
		}

		public function updateCategoria(int $id_categoria, string $categoria, int $status){
			$idRest = $_SESSION['idRest'];
			$this->intIdcategoria = $id_categoria;
			$this->strCategoria = $categoria;
			$this->intStatus = $status;

			$sql = "SELECT * FROM categorias WHERE nombre = '{$this->strCategoria}' AND activo != 'no' AND id_categoria != $this->intIdcategoria AND id_restaurante = $idRest;";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE categorias SET nombre = ?, status = ? WHERE id_categoria = $this->intIdcategoria and id_restaurante = $idRest;";
				$arrData = array($this->strCategoria, 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCategoria(int $id_categoria)
		{
			$idRest = $_SESSION['idRest'];
			$this->intIdcategoria = $id_categoria;
			$sql = "SELECT * FROM productos WHERE id_categoria = $this->intIdcategoria AND activo = 'si' AND id_restaurante = $idRest";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE categorias SET activo = 'no' WHERE id_categoria = $this->intIdcategoria AND id_restaurante = $idRest;";
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

	}
 ?>
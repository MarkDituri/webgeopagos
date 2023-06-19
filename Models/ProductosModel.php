<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;		
		private $intCategoriaId;
		private $intPrecio;		
		private $intStatus;		
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectProductos(){
			$idRest = $_SESSION['idRest'];

			$sql = "SELECT p.id_producto,
							p.status,					
							p.url_img,
							p.titulo,	
							p.descripcion,
							c.nombre as categorias,							
							p.precio
					FROM productos p 
					INNER JOIN categorias c
					ON p.id_categoria = c.id_categoria
					WHERE p.activo = 'si' AND p.id_restaurante = $idRest";

			$request = $this->select_all($sql);

			return $request;
		}	

		public function insertProducto(string $nombre, string $descripcion, string $portada, int $categoriaid, int $precio, int $status){		
			$idRest = $_SESSION['idRest'];
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->intCategoriaId = $categoriaid;
			$this->intPrecio = $precio;			
			$this->strActivo = 'si';
			$this->intStatus = $status;		
			$this->intIdRest = $_SESSION['idRest'];
			$return = 0;
			$sql = "SELECT * FROM productos WHERE titulo = '{$this->strNombre}' AND activo != 'no' AND id_restaurante = $idRest;";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO productos (id_categoria,													
														titulo,
														descripcion,
														url_img,
														precio,														
														activo,												
														status,
														id_restaurante) 
									VALUES(?,?,?,?,?,?,?,?)";
				$arrData = array($this->intCategoriaId,
							$this->strNombre,
							$this->strDescripcion,
							$this->strPortada,
							$this->intPrecio,							
							$this->strActivo,
							$this->intStatus,
							$this->intIdRest);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;			
			} else {
				$return = "exist";
			}			
	        return $return;
		}
	
		public function updateProducto(int $id_producto, string $nombre, string $descripcion, string $imgPortada, int $categoriaid, string $precio, int $status){
			$idRest = $_SESSION['idRest'];
			$this->intIdproducto = $id_producto;
			$this->strProducto = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $imgPortada;
			$this->intIdcategoria = $categoriaid;
			$this->intPrecio = $precio;			
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM productos WHERE titulo = '{$this->strProducto}' AND activo != 'no' AND id_producto != $this->intIdproducto AND id_restaurante = $idRest";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE productos SET titulo = ?, descripcion = ?, url_img = ?, id_categoria = ?, precio = ?, status = ? WHERE id_producto = $this->intIdproducto AND id_restaurante = $idRest;";
				$arrData = array($this->strProducto, 
								 $this->strDescripcion, 
								 $this->strPortada,
								 $this->intIdcategoria, 
								 $this->intPrecio,								 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
				$return = $request;
			}else{
				$return = "exist";
			}
			return $return;		
		}

		public function selectProducto(int $id_producto){
			$idRest = $_SESSION['idRest'];
			$this->intIdProducto = $id_producto;
			$sql = "SELECT p.id_producto,							
							p.titulo,
							p.descripcion,
							p.url_img,
							p.precio,							
							p.id_categoria,
							c.nombre as categoria,
							p.status
					FROM productos p
					INNER JOIN categorias c
					ON p.id_categoria = c.id_categoria
					WHERE id_producto = $this->intIdProducto AND p.id_restaurante = $idRest";
			$request = $this->select($sql);
			return $request;	
		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(id_producto,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT id_producto,img
					FROM imagen
					WHERE id_producto = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE id_producto = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $id_producto){
			$idRest = $_SESSION['idRest'];
			$this->intIdProducto = $id_producto;
			$sql = "UPDATE productos SET activo = ? WHERE id_producto = $this->intIdProducto AND id_restaurante = $idRest";
			$arrData = array('no');
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}

<?php 
require_once("Libraries/Core/Mysql.php");
trait TCategoria{
	private $con;

	public function getCategoriasT(string $categorias){
		$this->con = new Mysql();
		$sql = "SELECT id_categoria, status, nombre, activo, id_restaurante
				 FROM categorias WHERE status != 0 AND id_categoria IN ($categorias)";
		$request = $this->con->select_all($sql);		
		return $request;
	}

	public function getCategorias(int $id_restaurante){
		$this->con = new Mysql();
		$sql = "SELECT * FROM categorias
					WHERE id_restaurante = $id_restaurante    
				AND status = 1 AND activo = 'si';";
		$request = $this->con->select_all($sql);		
		return $request;
	}

	// public function getCategorias(int $id_restaurante){
	// 	$this->con = new Mysql();
	// 	$sql = "SELECT c.id_categoria, c.status, c.nombre, c.activo, c.id_restaurante, count(p.id_categoria) AS cantidad
	// 			FROM productos p 
	// 			INNER JOIN categorias c
	// 			ON p.id_categoria = c.id_categoria
	// 			WHERE c.status = 1 AND c.id_restaurante = $id_restaurante
	// 			GROUP BY p.id_categoria, c.id_categoria";
	// 			dep($sql);
	// 	$request = $this->con->select_all($sql);		
	// 	return $request;
	// }
	function getProdPrimerCat(int $id_categoria){
		$this->con = new Mysql();
		$sql ="SELECT id_producto, status, titulo, descripcion, precio, url_img, id_categoria, id_restaurante 
			FROM productos 
			WHERE id_categoria = $id_categoria AND status = 1 AND activo = 'si';";        
		$request = $this->con->select_all($sql);		
		
		return $request;        
	}
}

 ?>
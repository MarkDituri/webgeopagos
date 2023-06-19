<?php 
require_once("Libraries/Core/Mysql.php");
trait TSliders{
	private $con;

	public function getSliders($id_restaurante){
		$this->con = new Mysql();
		$sql = "SELECT * FROM sliders
        WHERE id_restaurante = $id_restaurante AND activo = 'si' AND status = 1;";
		$request = $this->con->select_all($sql);
			
		return $request;
	}
}

 ?>
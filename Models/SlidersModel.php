<?php 

	class SlidersModel extends Mysql
	{
		private $intIdSlider;
		private $strTitulo;
		private $strTag;
		private $intStatus;		
		private $strImagen;
		private $strPortada;
		private $strActivo;
		private $intIdRest;
		private $intIdslider;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectSliders(){
			$idRest = $_SESSION['idRest'];
			$sql = "SELECT id_slider,
							status,					
							img_slider,
							titulo,														
							tag,
                            activo							
					FROM sliders
					WHERE activo = 'si' AND id_restaurante = $idRest";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function insertSlider(string $titulo, string $portada, string $tag, int $status){		
			$idRest = $_SESSION['idRest'];
			$this->strTitulo = $titulo;			
			$this->strPortada = $portada;			
			$this->strTag = $tag;			
			$this->strActivo = 'si';
			$this->intStatus = $status;		
			$this->intIdRest = $_SESSION['idRest'];
			$return = 0;
			// Limitar Sliders consuñta
			$sql = "SELECT id_slider, COUNT(*) as total_slider FROM sliders WHERE id_restaurante = $idRest AND activo =	'si';";
			$request = $this->select_all($sql);
			$request = $request[0]['total_slider'];
						
			if($request < 3)
			{
				$sql = "SELECT * FROM sliders WHERE titulo = '{$this->strTitulo}' AND id_restaurante = $idRest AND activo = 'si';";				
				$request = $this->select_all($sql);
	
	
				if(empty($request))
				{
					$query_insert  = "INSERT INTO sliders ( status,								
														titulo,                                                
														img_slider,
														tag,                                             	
														activo,
														id_restaurante)
										VALUES(?,?,?,?,?,?)";
					$arrData = array($this->intStatus,
								$this->strTitulo,
								$this->strPortada,                                        
								$this->strTag,                        
								$this->strActivo,               
								$this->intIdRest);
					$request_insert = $this->insert($query_insert,$arrData);
					$return = $request_insert;										
				} else {
					$return = "exist";
				}
			} else {
				$return = "limite";
			}		
			return $return;
		}
		
		public function updateSlider(int $id_slider, string $titulo, string $imgPortada, string $tag, int $status){
			$idRest = $_SESSION['idRest'];
			$this->intIdslider = $id_slider;
			$this->strTitulo = $titulo;			
			$this->strPortada = $imgPortada;			
			$this->strTag = $tag;			
			$this->intStatus = $status;
			$return = 0;			
			$sql = "UPDATE sliders SET titulo = ?,  img_slider = ?, tag = ?, status = ? WHERE id_slider = $this->intIdslider AND id_restaurante = $idRest;";
			$arrData = array($this->strTitulo, 								 
								$this->strPortada,								 
								$this->strTag,								 
								$this->intStatus);
			$request = $this->update($sql,$arrData);
			$return = $request;
			
			return $return;		
		}

		public function selectSlider(int $id_slider){
			$idRest = $_SESSION['idRest'];
			$this->intIdSlider = $id_slider;
			$sql = "SELECT id_slider,							
							titulo,							
							img_slider,
							tag,														
							status,
                            activo
					FROM sliders										
					WHERE id_slider = $this->intIdSlider AND id_restaurante = $idRest";
			$request = $this->select($sql);
			return $request;	
		}

		public function insertImage(int $idslider, string $imagen){
			$this->intIdSlider = $idslider;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(sliderid,img) VALUES(?,?)";
	        $arrData = array($this->intIdSlider,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idslider){
			$this->intIdSlider = $idslider;
			$sql = "SELECT sliderid,img
					FROM imagen
					WHERE sliderid = $this->intIdSlider";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idslider, string $imagen){
			$this->intIdSlider = $idslider;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE sliderid = $this->intIdSlider 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteSlider(int $id_slider){
			$idRest = $_SESSION['idRest'];
			$this->intIdSlider = $id_slider;
			$sql = "UPDATE sliders SET activo = ? WHERE id_slider = $this->intIdSlider AND id_restaurante = $idRest";
			$arrData = array('no');
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}

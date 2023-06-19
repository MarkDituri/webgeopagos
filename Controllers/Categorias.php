<?php
	class Categorias extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();			
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MCATEGORIAS);
		}

		public function Categorias()
		{
			//Comprobar Pago
			$arrPago = selectUltimoPago();		
			if($arrPago['status'] == 'vencido'){
				header('Location: '.base_url().'/Pagos');
				die();
			}	
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Categorias";
			$data['page_title'] = "Categorias";
			$data['page_name'] = "categorias";
			$data['page_functions_js'] = "functions_categorias.js";
			$this->views->getView($this,"categorias",$data);
		}

		public function setCategoria(){
			if($_POST){
				if(empty($_POST['txtNombre']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				} else {
					
					$intid_categoria = intval($_POST['id_categoria']);
					$strCategoria =  strClean($_POST['txtNombre']);	
					$intStatus = intval(!empty($_POST['listStatus']) ? 1 : 2);

					if($intid_categoria == 0)
					{
						//Crear
						if($_SESSION['permisosMod']['w']){
							$request_cateria = $this->model->inserCategoria($strCategoria, $intStatus);
							$option = 1;
						}
					}else{
						//Actualizar
						if($_SESSION['permisosMod']['u']){
							$request_cateria = $this->model->updateCategoria($intid_categoria,$strCategoria,$intStatus);
							$option = 2;
						}
					}
					if($request_cateria > 0 )
					{
						if($option == 1)
						{
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

						}
					}else if($request_cateria == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategorias()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectCategorias();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activado</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Desactivado</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn-primary-sm" onClick="fntViewInfo('.$arrData[$i]['id_categoria'].')" title="Ver producto"><i class="far fa-eye"></i> &nbspVer </button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn-edit-sm btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['id_categoria'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i> &nbspEditar</button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn-borrar-sm" onClick="fntDelInfo('.$arrData[$i]['id_categoria'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center table-options">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategoria($id_categoria)
		{
			if($_SESSION['permisosMod']['r']){
				$intid_categoria = intval($id_categoria);
				if($intid_categoria > 0)
				{
					$arrData = $this->model->selectCategoria($intid_categoria);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{	
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delCategoria()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intid_categoria = intval($_POST['id_categoria']);
					$requestDelete = $this->model->deleteCategoria($intid_categoria);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getSelectCategorias(){
			$htmlOptions = "";
			$arrData = $this->model->selectCategorias();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option class='.$arrData[$i]['nombre'].'" value="'.$arrData[$i]['id_categoria'].'">'.$arrData[$i]['nombre'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	
		}

	}


 ?>
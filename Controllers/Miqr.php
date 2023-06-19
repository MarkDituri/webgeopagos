<?php 
	class Miqr extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			$arrPago = selectUltimoPago();			
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			if($arrPago['status'] == 'vencido'){
				header('Location: '.base_url().'/Pagos');
				die();
			};
		}

		public function Miqr()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Mi QR";
			$data['page_title'] = "Mi QR";
			$data['page_name'] = "miqr";
			$data['page_functions_js'] = "functions_miqr.js";
			$this->views->getView($this,"miqr",$data);
		}

		public function getMiqr()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectMiqr();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}
				
					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn-primary-sm" onClick="fntViewInfo('.$arrData[$i]['id_miqr'].')" title="Ver miqr"><i class="far fa-eye"></i> &nbspVer </button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn-edit-sm" onClick="fntEditInfo(this,'.$arrData[$i]['id_miqr'].')" title="Editar miqr"><i class="fas fa-pencil-alt"></i> &nbspEditar</button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn-borrar-sm" onClick="fntDelInfo('.$arrData[$i]['id_miqr'].')" title="Eliminar miqr"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}

 ?>
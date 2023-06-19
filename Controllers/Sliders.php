<?php
class Sliders extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		//session_regenerate_id(true);
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
	}

	public function Sliders()
	{
		//Comprobar Pago
		$arrPago = selectUltimoPago();
		if ($arrPago['status'] == 'vencido') {
			header('Location: ' . base_url() . '/Pagos');
			die();
		}
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/prodcutos');
		}
		$data['page_tag'] = "Sliders";
		$data['page_title'] = "Sliders";
		$data['page_name'] = "Sliders";
		$data['page_functions_js'] = "functions_sliders.js";
		$this->views->getView($this, "sliders", $data);
	}

	public function getSliders()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectSliders();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activado</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Desactivado</span>';
				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn-primary-sm" onClick="fntViewInfo(' . $arrData[$i]['id_slider'] . ')" title="Ver slider"><i class="far fa-eye"></i> &nbspVer </button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn-edit-sm" onClick="fntEditInfo(this,' . $arrData[$i]['id_slider'] . ')" title="Editar slider"><i class="fas fa-pencil-alt"></i> &nbspEditar</button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn-borrar-sm" onClick="fntDelInfo(' . $arrData[$i]['id_slider'] . ')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center table-options">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setSlider()
	{
		if ($_POST) {
			if (empty($_POST['txtTitulo']) || empty($_POST['txtTag'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {

				$idSlider = intval($_POST['id_slider']);
				$strTitulo = strClean($_POST['txtTitulo']);
				$strTag = strClean($_POST['txtTag']);
				$intStatus = intval(!empty($_POST['listStatus']) ? 1 : 2);
				$request_slider = "";

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPortada 	= 'portada_slider.png';
				$request_cateria = "";

				if ($nombre_foto != '') {
					$imgPortada = 'img_' . md5(date('d-m-Y H:i:s')) . '.jpg';
				}

				if ($idSlider == 0) {
					//Crear
					if ($_SESSION['permisosMod']['w']) {
						$request_slider = $this->model->insertSlider($strTitulo, $imgPortada, $strTag, $intStatus);
						$option = 1;

						if ($request_slider == 'limite') {
							$option = 0;
						} else {
							$option = 1;
						}
					}
				} else {
					//Actualizar
					if ($_SESSION['permisosMod']['u']) {
						if ($nombre_foto == '') {
							if ($_POST['foto_actual'] != 'portada_slider.png' && $_POST['foto_remove'] == 0) {
								$imgPortada = $_POST['foto_actual'];
							}
						}
						$request_slider = $this->model->updateSlider($idSlider, $strTitulo, $imgPortada, $strTag, $intStatus);
						$option = 2;
					}
				}
				if ($request_slider > 0) {
					if ($option == 0) {
						$arrResponse = array('status' => false, 'msg' => 'Has superado el limite de sliders.');
					}
					if ($option == 1) {
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						if ($nombre_foto != '') {
							uploadImage($foto, $imgPortada);
						}
					} else {
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						if ($nombre_foto != '') {
							uploadImage($foto, $imgPortada);
						}

						if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_slider.png')
							|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_slider.png')
						) {
							deleteFile($_POST['foto_actual']);
						}
					}
				} else if ($request_slider == 'limite') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! Has superado el limite de sliders.');
				} else if ($request_slider == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el slider ya existe!.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getSlider($id_slider)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdslider = intval($id_slider);
			if ($intIdslider > 0) {
				$arrData = $this->model->selectSlider($intIdslider);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrData['url_portada'] = base_url() . '/Assets/images/uploads/' . $arrData['img_slider'];
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delSlider()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intIdslider = intval($_POST['id_slider']);
				$requestDelete = $this->model->deleteslider($intIdslider);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el slider');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el slider.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
}

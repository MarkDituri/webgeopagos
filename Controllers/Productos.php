<?php
class Productos extends Controllers
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
		getPermisos(MPRODUCTOS);
	}

	public function Productos()
	{
		//Comprobar Pago
		$arrPago = selectUltimoPago();
		if ($arrPago['status'] == 'vencido') {
			header('Location: ' . base_url() . '/Pagos');
			die();
		}
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Productos";
		$data['page_title'] = "Productos";
		$data['page_name'] = "productos";
		$data['page_functions_js'] = "functions_productos.js";
		$this->views->getView($this, "productos", $data);
	}

	public function getProductos()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectProductos();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activado</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Desactivado</span>';
				}

				$arrData[$i]['precio'] = SMONEY . ' ' . formatMoney($arrData[$i]['precio']);
				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn-primary-sm" onClick="fntViewInfo(' . $arrData[$i]['id_producto'] . ')" title="Ver producto"><i class="far fa-eye"></i> &nbspVer </button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn-edit-sm" onClick="fntEditInfo(this,' . $arrData[$i]['id_producto'] . ')" title="Editar producto"><i class="fas fa-pencil-alt"></i> &nbspEditar</button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn-borrar-sm" onClick="fntDelInfo(' . $arrData[$i]['id_producto'] . ')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div  class="text-center table-options">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setProducto()
	{
		if ($_POST) {

			if (empty($_POST['txtNombre']) || empty($_POST['listCategoria']) || empty($_POST['txtPrecio'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {

				$idProducto = intval($_POST['id_producto']);
				$strNombre = strClean($_POST['txtNombre']);
				$strDescripcion = strClean($_POST['txtDescripcion']);
				$intCategoriaId = intval($_POST['listCategoria']);
				$intPrecio = strClean($_POST['txtPrecio']);
				$intStatus = intval(!empty($_POST['listStatus']) ? 1 : 2);

				$request_producto = "";

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPortada 	= 'portada_prod.png';
				$request_cateria = "";

				if ($nombre_foto != '') {
					$imgPortada = 'img_' . md5(date('d-m-Y H:i:s')) . '.jpg';
				}

				if ($idProducto == 0) {
					//Crear
					if ($_SESSION['permisosMod']['w']) {
						$request_producto = $this->model->insertProducto($strNombre, $strDescripcion, $imgPortada, $intCategoriaId, $intPrecio, $intStatus);
						$option = 1;
					}
				} else {
					//Actualizar
					if ($_SESSION['permisosMod']['u']) {
						if ($nombre_foto == '') {
							if ($_POST['foto_actual'] != 'portada_prod.png' && $_POST['foto_remove'] == 0) {
								$imgPortada = $_POST['foto_actual'];
							}
						}
						$request_producto = $this->model->updateProducto($idProducto, $strNombre, $strDescripcion, $imgPortada, $intCategoriaId, $intPrecio, $intStatus);
						$option = 2;
					}
				}
				if ($request_producto > 0) {
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

						if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_prod.png')
							|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_prod.png')
						) {
							deleteFile($_POST['foto_actual']);
						}
					}
				} else if ($request_producto == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el producto ya existe!.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getProducto($id_producto)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdproducto = intval($id_producto);
			if ($intIdproducto > 0) {
				$arrData = $this->model->selectProducto($intIdproducto);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrData['url_portada'] = base_url() . '/Assets/images/uploads/' . $arrData['url_img'];
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delProducto()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intIdproducto = intval($_POST['id_producto']);
				$requestDelete = $this->model->deleteProducto($intIdproducto);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
}

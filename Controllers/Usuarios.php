<?php
class Usuarios extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
		getPermisos(MUSUARIOS);
	}

	public function Usuarios()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Usuarios";
		$data['page_title'] = "USUARIOS <small>Tienda Virtual</small>";
		$data['page_name'] = "usuarios";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "usuarios", $data);
	}

	public function setUsuario()
	{
		if ($_POST) {
			if (empty($_POST['txtNombres']) || empty($_POST['txtApellidos']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = intval($_POST['idUsuario']);
				$strIdentificacion = strClean($_POST['txtIdentificacion']);
				$strNombre = ucwords(strClean($_POST['txtNombres']));
				$strApellido = ucwords(strClean($_POST['txtApellidos']));
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strEmail = strtolower(strClean($_POST['txtEmail']));
				$intTipoId = intval(strClean($_POST['listRolid']));
				$intStatus = intval(strClean($_POST['listStatus']));
				$request_user = "";
				if ($idUsuario == 0) {
					$option = 1;
					$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);

					if ($_SESSION['permisosMod']['w']) {
						$request_user = $this->model->insertUsuario(
							$strIdentificacion,
							$strNombre,
							$strApellido,
							$intTelefono,
							$strEmail,
							$strPassword,
							$intTipoId,
							$intStatus
						);
					}
				} else {
					$option = 2;
					$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
					if ($_SESSION['permisosMod']['u']) {
						$request_user = $this->model->updateUsuario(
							$idUsuario,
							$strIdentificacion,
							$strNombre,
							$strApellido,
							$intTelefono,
							$strEmail,
							$strPassword,
							$intTipoId,
							$intStatus
						);
					}
				}

				if ($request_user > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUsuarios()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectUsuarios();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario(' . $arrData[$i]['id_restaurante'] . ')" title="Ver usuario"><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					if (($_SESSION['idRest'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1)
					) {
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario(this,' . $arrData[$i]['id_restaurante'] . ')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					} else {
						$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if ($_SESSION['permisosMod']['d']) {
					if (($_SESSION['idRest'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
						($_SESSION['userData']['id_restaurante'] != $arrData[$i]['id_restaurante'])
					) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario(' . $arrData[$i]['id_restaurante'] . ')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
					} else {
						$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
					}
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUsuario($id_restaurante)
	{
		if ($_SESSION['permisosMod']['r']) {
			$idusuario = intval($id_restaurante);
			if ($idusuario > 0) {
				$arrData = $this->model->selectUsuario($idusuario);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrData['url_portada'] = base_url() . '/Assets/images/uploads/' . $arrData['url_logo'];
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delUsuario()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intIdpersona = intval($_POST['idUsuario']);
				$requestDelete = $this->model->deleteUsuario($intIdpersona);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function perfil()
	{
		$data['page_tag'] = "Perfil";
		$data['page_title'] = "Perfil de usuario";
		$data['page_name'] = "perfil";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "perfil", $data);
	}

	public function putPerfil()
	{
		if ($_POST) {
			if (empty($_POST['txtNombres']) || empty($_POST['txtApellidos']) || empty($_POST['txtTelefono']) || empty($_POST['txtNombreRest'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = $_SESSION['idRest'];
				$strNombre = strClean($_POST['txtNombres']);
				$strApellido = strClean($_POST['txtApellidos']);
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strNombreRest = strClean($_POST['txtNombreRest']);
				$strDireccion = strClean($_POST['txtDireccion']);
				$strNumero =  strClean($_POST['txtNumero']);
				$strLocalidad = strClean($_POST['txtLocalidad']);
				$strFacebook = strClean($_POST['txtFacebook']);
				$strInstagram = strClean($_POST['txtInstagram']);

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPortada 	= 'portada_logo.png';
				$request_cateria = "";

				if ($nombre_foto != '') {
					$imgPortada = 'img_' . md5(date('d-m-Y H:i:s')) . '.jpg';
				}

				//Actualizar
				if ($_SESSION['permisosMod']['u']) {
					if ($nombre_foto == '') {
						if ($_POST['foto_actual'] != 'portada_logo.png' && $_POST['foto_remove'] == 0) {
							$imgPortada = $_POST['foto_actual'];
						}
					}
					$request_user = $this->model->updatePerfil($idUsuario, $strNombre, $strApellido, $intTelefono, $strNombreRest, $imgPortada, $strDireccion, $strNumero, $strLocalidad, $strFacebook, $strInstagram);
					$option = 2;
				}

				if ($request_user > 0) {
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

						if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_logo.png')
							|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_logo.png')
						) {
							deleteFile($_POST['foto_actual']);
						}
					}
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el slider ya existe!.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function putDFical()
	{
		if ($_POST) {
			if (empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = $_SESSION['idRest'];
				$strNit = strClean($_POST['txtNit']);
				$strNomFiscal = strClean($_POST['txtNombreFiscal']);
				$strDirFiscal = strClean($_POST['txtDirFiscal']);
				$request_datafiscal = $this->model->updateDataFiscal(
					$idUsuario,
					$strNit,
					$strNomFiscal,
					$strDirFiscal
				);
				if ($request_datafiscal) {
					sessionUser($_SESSION['idRest']);
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function cambiarClave()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$data['page_name'] = "cambiar_clave";
				$strPassword = hash("SHA256", $_POST['txtPassword']);
				$request_user = $this->model->insertPassword($strPassword);
				if ($request_user) {
					$arrResponse = array('status' => true, 'msg' => 'La contraseña ah sido actualizada');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al cambiar la contraseña');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function getColores()
	{
		if ($_SESSION['permisosMod']['r']) {

			$arrData = $this->model->selectColores();
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function changeColor()
	{
		if ($_GET) {
			if ($_SESSION['permisosMod']['d']) {
				$intId_color = $_GET['id_color'];
				$request_user = $this->model->updateColor($intId_color);
				if ($request_user) {
					$arrResponse = array('status' => true, 'msg' => 'Color actualizado con exito!');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al cambiar el color');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function swichDarkMode()
	{
		if ($_GET) {
			if ($_SESSION['permisosMod']['d']) {
				$boolDark = $_GET['boolDark'];
				$request_user = $this->model->updateDarkMode($boolDark);
				if ($request_user) {
					$arrResponse = array('status' => true, 'msg' => 'Modo actualizado con éxito!');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al cambiar modo');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
}

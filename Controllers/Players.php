<?php
class Players extends Controllers
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

    public function Players()
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

    public function getPlayers()
    {
        if ($_SESSION['permisosMod']['r']) {
            $apiUrl = 'http://127.0.0.1:8000/api/v2/players/';
            $response = file_get_contents($apiUrl);

            if ($response !== false) {
                // Decodificar la respuesta JSON obtenida de la API
                $arrData = json_decode($response, true);

                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al obtener los datos de la API.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }



    public function start($gender)
    {
        // Llamar a la API para obtener los datos del jugador
        $apiUrl = 'http://127.0.0.1:8000/api/v2/start/' . $gender;
        $response = file_get_contents($apiUrl);

        if ($response !== false) {
            // Decodificar la respuesta JSON obtenida de la API
            $arrData = json_decode($response, true);

            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error al obtener los datos de la API.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    

        die();
    }



    public function getPlayer($id_player)
    {
        if ($_SESSION['permisosMod']['r']) {
            $intIdPlayer = intval($id_player);
            if ($intIdPlayer > 0) {
                // Llamar a la API para obtener los datos del jugador
                $apiUrl = 'http://127.0.0.1:8000/api/v2/players/' . $intIdPlayer;
                $response = file_get_contents($apiUrl);

                if ($response !== false) {
                    // Decodificar la respuesta JSON obtenida de la API
                    $arrData = json_decode($response, true);

                    if (empty($arrData)) {
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    } else {
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al obtener los datos de la API.');
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
                $intIdPlayer = intval($_POST['id_producto']);
                $requestDelete = $this->model->deleteProducto($intIdPlayer);
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

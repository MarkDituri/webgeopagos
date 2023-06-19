<?php
class Empezar extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function empezar()
    {
        $data['page_name'] = "empezar";
        $data['page_js'] = "empezar.js";
        $data['page_canonical'] = "empezar";
        $this->views->getView($this, "empezar", $data);
    }

    public function crear_cuenta()
    {
        $data['page_name'] = "crear_cuenta";
        $data['page_js'] = "crear_cuenta.js";
        $data['page_canonical'] = "crear_cuenta";
        //Para Captcha
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LeFReUiAAAAAGixjEecbBK0oBXq6EF-15la78Ht';
        $recaptcha_response = $_POST['recaptcha_response'];
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if ($_POST) {
            // if ($recaptcha->score >= 0.5) {
            // Añade aquí el código que desees en el caso de que la validación sea correcta
            if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['telefono']) || empty($_POST['negocio']) || empty($_POST['url_menu'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $strNombre = strClean($_POST['nombre']);
                $strApellido = strClean($_POST['apellido']);
                $strNombreRest = strClean($_POST['negocio']);
                $strEmail = strClean($_POST['email']);
                $intTelefono = intval($_POST['telefono']);
                $strNegocio = strClean($_POST['negocio']);
                $url_menu = strClean($_POST['url_menu']);
                $url_menu = strtolower($url_menu); // Pasar todo a minisculas
                $request = 0;

                //Validar Email
                $this->con = new Mysql();
                $sql = "SELECT email_user FROM restaurantes WHERE email_user = '$strEmail';";
                $request = $this->con->select_all($sql);

                if (!empty($request)) {
                    $request = "mail_exist";
                }
                if ($request === "mail_exist") {
                    $arrResponse = array('status' => false, 'msg' => '¡Este <b>email</b> ya esta en uso!', 'input' => 'email');
                } else {
                    //Validar URL menu
                    $this->con = new Mysql();
                    $sql = "SELECT url FROM restaurantes WHERE url = '$url_menu';";
                    $request = $this->con->select_all($sql);

                    if (!empty($request)) {
                        $request = "url_exist";
                    }
                    if ($request === "url_exist") {
                        $arrResponse = array('status' => false, 'msg' => '¡La <b>URL</b> ingresada para tu menú ya está en uso!', 'input' => 'url_menu');
                    }
                }

                if (empty($request)) {
                    // Setteando datos de guardado
                    $codeIndex = GenerarCodeIndex();
                    $token = generarToken(20);
                    // Generar Codigos
                    // https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://qudimar.com/menu/id/qudimar
                    // https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https://qudimar.com/menu/id/qudimar
                    // Genera QR jpg (2 medidas)
                    $qr_size_1 = file_get_contents("https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" . base_url() . "/menu/id/$url_menu");
                    file_put_contents('Assets/images/uploads/qr/qr_' . $url_menu . '_150x150.jpg', $qr_size_1);
                    $qr_size_2 = file_get_contents("https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=" . base_url() . "/menu/id/$url_menu");
                    file_put_contents('Assets/images/uploads/qr/qr_' . $url_menu . '_200x200.jpg', $qr_size_2);

                    $this->con = new Mysql();
                    $query_insert = "INSERT INTO restaurantes (
                                id_restaurante,                                    
                                nombres,
                                apellidos,
                                identificacion,     
                                nombre_rest,                            
                                telefono,
                                email_user,
                                id_color,
                                dark_mode,
                                password,
                                token,
                                rolid,
                                url_logo,      
                                url,                                 
                                status,
                                id_plan,
                                id_admin
                            ) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                    $arrData = array(null, $strNombre, $strApellido, $codeIndex, $strNombreRest, $intTelefono, $strEmail, 7, 0, '', $token, 1, 'portada.png', $url_menu, 0, 1, '');
                    $request_insert = $this->con->insert($query_insert, $arrData);
                    // Si se inserto el restaurante
                    if (!empty($request_insert)) {
                        $id_restaurante = $request_insert;
                        $hoy = getHoyDB();
                        $fechaFin = date("Y-m-d", strtotime($hoy . "+ 30 days"));
                        $fechaInicio = date("Y-m-d", strtotime($fechaFin . "- 30 days"));
                        $fechaVen = date("Y-m-d", strtotime($fechaInicio . "+ 30 days"));
                        $query_insert = "INSERT INTO pagos (
                                                id_pago,
                                                status,
                                                fechaInicio,
                                                fechaVen,
                                                fechaFin,
                                                precio,
                                                activo,
                                                id_plan,
                                                id_restaurante
                                            ) 
                                VALUES (?,?,?,?,?,?,?,?,?);";
                        $arrData = array(null, 1, $fechaInicio, $fechaVen, $fechaFin, 0, 'si', 1, $id_restaurante);
                        $request_insert = $this->con->insert($query_insert, $arrData);
                        // Settea las fechas para el pago 2
                        $fechaFinPago = date("Y-m-d", strtotime($fechaFin . "+ 30 days"));
                        $fechaVenPago = date("Y-m-d", strtotime($fechaFin . "+ 15 days"));
                        $fechaInicioPago = date("Y-m-d", strtotime($fechaFin));
                        // Verificar si guardo PAGO 1
                        if (!empty($request_insert)) {
                            // Seleccionar precio de plan actual
                            $this->con = new Mysql();
                            $sql = "SELECT precio, id_plan FROM planes WHERE id_plan = 2;";
                            $request = $this->con->select_all($sql);

                            if (!empty($request)) {
                                $precio_plan = $request[0]['precio'];
                            }
                            $query_insert = "INSERT INTO pagos (
                                                id_pago,
                                                status,
                                                fechaInicio,
                                                fechaVen,
                                                fechaFin,
                                                precio,
                                                activo,
                                                id_plan,
                                                id_restaurante
                                            ) 
                                            VALUES (?,?,?,?,?,?,?,?,?);";
                            $arrData = array(null, 0, $fechaInicioPago, $fechaVenPago, $fechaFinPago, $precio_plan, 'si', 2, $id_restaurante);
                            $request_insert = $this->con->insert($query_insert, $arrData);

                            if (!empty($request_insert)) {
                                $request = 0;
                            }
                        } else {
                            $request = 1;
                        }
                    } else {
                        $request = 1;
                    }

                    // Enviar respuesta
                    if ($request > 0) {
                        $arrResponse = array('status' => false, 'msg' => '¡Ah ocurrido un error!.');
                    } else {
                        $arrResponse = array("status" => true, "msg" => 'Datos Guardados');
                        $url_recovery = base_url() . '/empezar/crear_clave?token=' . $token . '&email=' . $strEmail;

                        //Enviar Mail                                         
                        $dataUsuario = array(
                            'nombreUsuario' => $strNombre,
                            'email' => $strEmail,
                            'negocio' => $strNegocio,
                            'url_recovery' => $url_recovery,
                            'url' => base_url(),
                            'asunto' => 'Se ha creado con éxito tu cuenta en Qudimar.'
                        );

                        $sendEmail = sendEmail($dataUsuario, 'key_confirm');

                        if ($sendEmail) {
                            $arrResponse = array(
                                'status' => true,
                                'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.',
                                'input' => 'email'
                            );
                        } else {
                            $arrResponse = array(
                                'status' => false,
                                'msg' => 'No es posible realizar el proceso, intenta más tarde.',
                                'input' => 'email'
                            );
                        }
                    }
                }
            }

            // } 
            // else {
            //     // Añade aquí el código que desees en el caso de que la validación no sea correcta
            //     $arrResponse = array('status' => false, 'msg' => 'Hubo un error en la validacion reCaptcha!.');
            // }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
    }

    public function crear_clave()
    {
        $data['page_name'] = "crear_clave";
        $data['page_js'] = "crear_clave.js";
        $data['page_canonical'] = "crear_clave";

        if ($_GET) {
            if (isset($_GET["token"]) && isset($_GET["email"])) {
                $data['token'] = $_GET["token"];
                $data['email'] = $_GET["email"];
                $token = $_GET["token"];
                $email = $_GET["email"];

                //Comprobar si existe una cuenta con estos datos
                $this->con = new Mysql();
                $sql = "SELECT * FROM restaurantes WHERE email_user = '$email' AND token = '$token' AND status != 2;";
                $request = $this->con->select_all($sql);

                if (!empty($request)) {
                    // Actualizar status a 1 (email confimado)                                
                    $this->con = new Mysql();
                    $sql = "UPDATE restaurantes SET status = 1
                            WHERE email_user = '$email' AND token = '$token' AND status < 2;";
                    $arrData = array(1);
                    $request = $this->con->update($sql, $arrData);

                    if (!empty($request)) {
                        $request = array('status' => true, 'value' => 'activa', 'msg' => '¡Mostrar Crear contraseña!.', 'p' => 'Debera crear una contraseña para poder ingresar');
                    } else {
                        $request = array('status' => false, 'value' => 'sql', 'msg' => 'Hubo un error', 'p' => 'Hubo un error en el servidor');
                    }
                } else {
                    $request = array('status' => false, 'value' => 'error', 'msg' => 'Hubo un error', 'p' => 'No existe ninguna cuenta para activar<br> con estos datos.');
                }
            } else {
                $request = array('status' => false, 'value' => 'error', 'msg' => 'No hay datos para procesar',  'p' => '');
            }
        } else {
            $request = array('status' => false, 'value' => 'error', 'msg' => 'No hay datos para procesar', 'p' => '');
        }

        $data = $data + $request;
        $this->views->getView($this, "crear_clave", $data);
    }

    function guardar_clave()
    {
        if ($_POST) {
            if (empty($_POST['email']) || empty($_POST['clave_1']) || empty($_POST['clave_2']) || empty($_POST['token'])) {
                $request = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $email = $_POST["email"];
                $clave = hash("SHA256", $_POST['clave_1']);
                $token = $_POST["token"];
                // Guarda clave con MD5 y status 2 login                       
                $this->con = new Mysql();
                $sql = "UPDATE restaurantes 
                            SET status = 2, password = '$clave'
                        WHERE email_user = '$email' AND token = '$token' AND status = 1;";
                $arrData = array(1, $clave);
                $request = $this->con->update($sql, $arrData);

                if ($request > 0) {
                    header("location:" . base_url() . "/login");
                    $request = array('status' => true, 'value' => 'activa', 'msg' => '¡Su contraseña ah sido guardadad con exito.', 'p' => 'Sera redirijido al Login...');
                } else {
                    $request = array('status' => false, 'value' => 'preactiva', 'msg' => '¡Su cuenta ya fue activada!.',  'p' => 'Al parecer su cuenta ya se activo previamente');
                    return false;
                }
            }
        }
    }
}

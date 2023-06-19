<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'Libraries/phpmailer/Exception.php';
include 'Libraries/phpmailer/PHPMailer.php';
include 'Libraries/phpmailer/SMTP.php';

function host(){
    return $_SERVER["HTTP_HOST"];
}

// if (isset($sendMail)) {
//     if ($sendMail == true) {
//         include 'sendMail.php';
//     }
// }
//Retorla la url del proyecto
function base_url()
{
    return BASE_URL;
}
function web_url()
{
    return WEB_URL;
}
function mp_access_token()
{
    return MP_ACCESS_TOKEN;
}
function mp_public_key()
{
    return MP_PUBLIC_KEY;
}
//Retorla la url de Assets
function media()
{
    return BASE_URL . "/Assets";
}
function linkMenu(){
    $linkMenu = base_url().'/menu/id/'.$_SESSION['userData']['url'];
    $linkMenuVista = preg_replace('/^(https?:\/\/)/', '', $linkMenu);
    $linkMenuVista = 'http://'.$linkMenuVista.'/';

    return $linkMenuVista;
}
function headerAdmin($data = "")
{
    $view_header = "Views/Template/header_admin.php";
    require_once($view_header);
}
function footerAdmin($data = "")
{
    $view_footer = "Views/Template/footer_admin.php";
    require_once($view_footer);
}
function headerMenu($data = "")
{
    $view_header = "Views/Template/header_menu.php";
    require_once($view_header);
}
function navbarMenu($data = ""){
    $view_navbar = "Views/Template/navbar_menu.php";
    require_once($view_navbar);
}
function losMasPedidosMenu($data = ""){
    $view_best = "Views/Template/losmaspedidos_menu.php";
    require_once($view_best);
}
function CarritoMenu($data = ""){
    $view_carrito = "Views/Template/carrito_menu.php";
    require_once($view_carrito);
}
function scriptsMenu($data = "")
{
    $view_scripts = "Views/Template/scripts_menu.php";
    require_once($view_scripts);
}
function headerWeb($data = "")
{
    $view_header = "Views/Template/header_web.php";
    require_once($view_header);
}
function footerTienda($data = "")
{
    $view_footer = "Views/Template/footer_tienda.php";
    require_once($view_footer);
}
function footerWeb()
{
    $view_footer = "Views/Template/footer_web.php";
    require_once($view_footer);
}
function scriptsWeb($data = "")
{
    $view_scripts = "Views/Template/scripts_web.php";
    require_once($view_scripts);
}


function loadingWeb()
{
    $view_loading = "Views/Template/Others/loading_web.php";
    require_once($view_loading);
}
//Muestra información formateada
function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}
function getModal(string $nameModal, $data)
{
    $view_modal = "Views/Template/Modals/{$nameModal}.php";
    require_once $view_modal;
}
function getFile(string $url, $data)
{
    ob_start();
    require_once("Views/{$url}.php");
    $file = ob_get_clean();
    return $file;
}
//Envio de correos

function getUsuario()
{
    require_once("Libraries/Core/Mysql.php");
    $idRest = $_SESSION['idRest'];
    $con = new Mysql();
    $sql = "SELECT * FROM restaurantes WHERE id_restaurante = $idRest AND status = 2;";
    $request = $con->select($sql);

    return $request;
}

function getPermisos(int $idmodulo)
{
    require_once("Models/PermisosModel.php");
    $objPermisos = new PermisosModel();
    if (!empty($_SESSION['userData'])) {
        $idrol = $_SESSION['userData']['idrol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        $permisos = '';
        $permisosMod = '';
        if (count($arrPermisos) > 0) {
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;
    }
}

function sendEmail($data, $template)
{    
    if (ENVIRONMENT == 1) {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        $de .= "Bcc: $emailCopia\r\n";
        ob_start();
        require_once("Views/Template/Email/" . $template . ".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    } else {        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        ob_start();
        require_once("Views/Template/Email/" . $template . ".php");
        $mensaje = ob_get_clean();

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'no_reply@qudimar.com';          //SMTP username
            $mail->Password   = 'Qudimark2022!!';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('no_reply@qudimar.com', 'Qudimar');
            $mail->addAddress($data['email']);     //Add a recipient
            if (!empty($data['emailCopia'])) {
                $mail->addBCC($data['emailCopia']);
            }
            $mail->CharSet = 'UTF-8';
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $data['asunto'];
            $mail->Body    = $mensaje;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

// function sendMailLocal($data, $template)
// {
//     //Create an instance; passing `true` enables exceptions
//     $mail = new PHPMailer(true);
//     ob_start();
//     require_once("Views/Template/Email/" . $template . ".php");
//     $mensaje = ob_get_clean();

//     try {
//         //Server settings
//         $mail->SMTPDebug = 1;                      //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = 'toolsfordeveloper@gmail.com';                     //SMTP username
//         $mail->Password   = '';                               //SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//         $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//         //Recipients
//         $mail->setFrom('toolsfordeveloper@gmail.com', 'Servidor Local');
//         $mail->addAddress($data['email']);     //Add a recipient
//         if (!empty($data['emailCopia'])) {
//             $mail->addBCC($data['emailCopia']);
//         }

//         //Content
//         $mail->isHTML(true);                                  //Set email format to HTML
//         $mail->Subject = $data['asunto'];
//         $mail->Body    = $mensaje;

//         $mail->send();
//         echo 'Mensaje enviado';
//     } catch (Exception $e) {
//         echo "Error en el envío del mensaje: {$mail->ErrorInfo}";
//     }
// }


function sessionUser(int $id_restaurante)
{
    require_once("Models/LoginModel.php");
    $objLogin = new LoginModel();
    $request = $objLogin->sessionLogin($id_restaurante);
    return $request;
}

function uploadImage(array $data, string $name)
{
    $url_temp = $data['tmp_name'];
    $destino    = 'Assets/images/uploads/' . $name;
    $move = move_uploaded_file($url_temp, $destino);
    return $move;
}

function deleteFile(string $name)
{
    unlink('Assets/images/uploads/' . $name);
}

//Elimina exceso de espacios entre palabras
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

function clear_cadena(string $cadena)
{
    //Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç', ',', '.', ';', ':'),
        array('N', 'n', 'C', 'c', '', '', '', ''),
        $cadena
    );
    return $cadena;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass = $length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}
//Genera un token
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
}
//Formato para valores monetarios
function formatMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}

function getTokenPaypal()
{
    $payLogin = curl_init(URLPAYPAL . "/v1/oauth2/token");
    curl_setopt($payLogin, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($payLogin, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($payLogin, CURLOPT_USERPWD, IDCLIENTE . ":" . SECRET);
    curl_setopt($payLogin, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $result = curl_exec($payLogin);
    $err = curl_error($payLogin);
    curl_close($payLogin);
    if ($err) {
        $request = "CURL Error #:" . $err;
    } else {
        $objData = json_decode($result);
        $request =  $objData->access_token;
    }
    return $request;
}

function CurlConnectionGet(string $ruta, string $contentType = null, string $token)
{
    $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";
    if ($token != null) {
        $arrHeader = array(
            'Content-Type:' . $content_type,
            'Authorization: Bearer ' . $token
        );
    } else {
        $arrHeader = array('Content-Type:' . $content_type);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ruta);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        $request = "CURL Error #:" . $err;
    } else {
        $request = json_decode($result);
    }
    return $request;
}

function CurlConnectionPost(string $ruta, string $contentType = null, string $token)
{
    $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";
    if ($token != null) {
        $arrHeader = array(
            'Content-Type:' . $content_type,
            'Authorization: Bearer ' . $token
        );
    } else {
        $arrHeader = array('Content-Type:' . $content_type);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ruta);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        $request = "CURL Error #:" . $err;
    } else {
        $request = json_decode($result);
    }
    return $request;
}

function Meses()
{
    $meses = array(
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    return $meses;
}

function mesesEspa(int $mesNum)
{
    switch ($mesNum) {
        case "01":
            $mes = "Enero";
            break;
        case "02":
            $mes = "Febrero";
            break;
        case "03":
            $mes = "Mazo";
            break;
        case "04":
            $mes = "Abril";
            break;
        case "05":
            $mes = "Mayo";
            break;
        case "06":
            $mes = "Junio";
            break;
        case "07":
            $mes = "Julio";
            break;
        case "08":
            $mes = "Agosto";
            break;
        case "09":
            $mes = "Septiembre";
            break;
        case "10":
            $mes = "Octubre";
            break;
        case "11":
            $mes = "Novimebre";
            break;
        case "12":
            $mes = "Diciembre";
            break;
    }

    return $mes;
}

function getInfoPage(int $idpagina)
{
    require_once("Libraries/Core/Mysql.php");
    $con = new Mysql();
    $sql = "SELECT * FROM post WHERE idpost = $idpagina";
    $request = $con->select($sql);
    return $request;
}

function getPageRout(string $ruta)
{
    require_once("Libraries/Core/Mysql.php");
    $con = new Mysql();
    $sql = "SELECT * FROM post WHERE ruta = '$ruta' AND status != 0 ";
    // $sql = "SELECT * FROM restaurantes WHERE id_restaurante = '$id_Rest' AND status != 0";
    $request = $con->select($sql);
    if (!empty($request)) {
        $request['portada'] = $request['portada'] != "" ? base_url() . "/Assets/images/uploads/" . $request['portada'] : "";
    }
    return $request;
}

function viewPage(int $idpagina)
{
    require_once("Libraries/Core/Mysql.php");
    $con = new Mysql();
    $sql = "SELECT * FROM post WHERE idpost = $idpagina ";
    $request = $con->select($sql);
    if (($request['status'] == 2 and isset($_SESSION['permisosMod']) and $_SESSION['permisosMod']['u'] == true) or $request['status'] == 1) {
        return true;
    } else {
        return false;
    }
}

function countPedidos()
{
    $idRest = $_SESSION['idRest'];
    require_once("Libraries/Core/Mysql.php");
    $con = new Mysql();
    $sql = "SELECT COUNT(*) as totalPedidos
            FROM carrito_temp
            WHERE status = 1 AND activo = 'si' AND id_restaurante = $idRest";
    $request = $con->select($sql);
    return $request;
}

function selectUltimoPago()
{
    require_once("Libraries/Core/Mysql.php");
    $idRest = $_SESSION['idRest'];
    $dataPlan = getUsuario();
    $id_plan = $dataPlan['id_plan'];
    if ($id_plan == 0) { // Si es Plan							
        $where = "WHERE activo = 'si' AND p.status = 1 AND p.id_plan = 1 AND p.id_restaurante = " . $idRest;
        $order = "ORDER BY id_pago ASC LIMIT 1";
    } else {
        $where = "WHERE activo = 'si' AND p.status = 1 AND p.id_restaurante = " . $idRest;
        $order = "ORDER BY id_pago DESC LIMIT 1";
    }
    $con = new Mysql();
    $sql = "SELECT p.id_pago, p.status,                            						
            DATE_FORMAT(p.fechaInicio, '%d/%m/%Y') as fechaInicio,
            DATE_FORMAT(p.fechaVen, '%d/%m/%Y') as fechaVen,
            DATE_FORMAT(p.fechaFin, '%d/%m/%Y') as fechaFin,
            DATE_FORMAT(p.fechaPago, '%d/%m/%Y') as fechaPago,		
            c.nombre as plan, c.id_plan as id_plan, c.precio as precio_plan,							
            p.precio                         							
    FROM pagos p INNER JOIN planes c ON p.id_plan = c.id_plan";
    $sqlComplete = $sql . " " . $where . " " . $order;
    $request = $con->select($sqlComplete);

    if ($request['plan'] == 'Demo') { // Logica si es Demo						
        if (compararFechas($request['fechaFin'], getHoy()) <= 0) { // si vencio demo, Muestra sig Pago																		
            $con = new Mysql();
            $where = "WHERE activo = 'si' AND p.status = 0 AND p.id_restaurante = " . $idRest;
            $order = "ORDER BY id_pago DESC LIMIT 1";
            $sqlComplete = $sql . " " . $where . " " . $order;
            $request = $con->select($sqlComplete);
            if ($request['status'] == 1) {
                $request = array("status" => "pagado") + $request;
            } else {
                if (compararFechas($request['fechaVen'], getHoy()) <= 0) {
                    $request = array("status" => "vencido") + $request;
                } else if (compararFechas($request['fechaInicio'], getHoy()) <= 0) {
                    $request = array("status" => "pagar") + $request;
                }
            }
        } else {
            $request = array("status" => "demo") + $request;
        }
    } else { // Logica si es Plan								
        $con = new Mysql();
        $where = "WHERE activo = 'si' AND p.status = 0 AND p.id_restaurante = " . $idRest;
        $order = "ORDER BY id_pago DESC LIMIT 1";
        $sqlComplete = $sql . " " . $where . " " . $order;
        $request = $con->select($sqlComplete);

        if (compararFechas($request['fechaVen'], getHoy()) <= 0) {
            $request = array("status" => "vencido") + $request;
        } else if (compararFechas($request['fechaInicio'], getHoy()) <= 0) {
            $request = array("status" => "pagar") + $request;
        } else {
            $where = "WHERE activo = 'si' AND p.status = 1 AND p.id_restaurante = " . $idRest;
            $order = "ORDER BY id_pago DESC LIMIT 1";
            $sqlComplete = $sql . " " . $where . " " . $order;
            $request = $con->select($sqlComplete);
            $request = array("status" => "pagado") + $request;
        }
    }
    return $request;
}

function MercadoPago()
{
    $idRest = $_SESSION['userData']['id_restaurante'];
    $request = selectUltimoPago();
    $status = $request['status'];
    $plan = $request['plan'];
    $id_pago = $request['id_pago'];
    $precio_pago = $request['precio'];

    if ($status == 0) {
        // Mercado Pago        
        require 'vendor/autoload.php';
        MercadoPago\SDK::SetAccessToken(MP_ACCESS_TOKEN);
        $preference = new MercadoPago\Preference();

        $item = new MercadoPago\Item();
        $item->id = $id_pago;
        $item->title = "Plan: $plan";
        $item->quantity = 1;
        $item->unit_price = "$precio_pago";
        $item->currency_id = 'ARS';
        $item->external_reference = '250';

        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => base_url() . "/pagos/setPago?id_pago=$id_pago&precio=$precio_pago",
            "failure" => base_url() . "/pagos/falloPago"
        );

        // $preference->notification_url = base_url() . "/pagos/notificacionesmp";
        $preference->auto_return = "all";
        $preference->binary_mode = true;

        $preference->save();

        return $preference;
    } else {
        return true;
    }
}

function compararFechas($primera, $segunda)
{
    $valoresPrimera = explode("/", $primera);
    $valoresSegunda = explode("/", $segunda);

    $diaPrimera    = $valoresPrimera[0];
    $mesPrimera  = $valoresPrimera[1];
    $anyoPrimera   = $valoresPrimera[2];

    $diaSegunda   = $valoresSegunda[0];
    $mesSegunda = $valoresSegunda[1];
    $anyoSegunda  = $valoresSegunda[2];

    $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
    $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

    if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
        // "La fecha ".$primera." no es v&aacute;lida";
        return 0;
    } else if (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
        // "La fecha ".$segunda." no es v&aacute;lida";
        return 0;
    } else {
        return  $diasPrimeraJuliano - $diasSegundaJuliano;
    }
}

function getHoy()
{
    // $hoy = date('26/10/2022');
    $hoy = date('d/m/Y');

    return $hoy;
}

function getHoyDB()
{
    // $hoyDB = date('2022/10/26');
    $hoyDB = date("Y-m-d");

    return $hoyDB;
}

function getHora()
{
    // $hoy = date('19/09/2022');    
    $hoy = date('H:i:s');

    return $hoy;
}

function getHoraDB()
{
    // $hoyDB = date("2022-08-20");
    $hoyDB = date("H:i:s");

    return $hoyDB;
}

function getDatacreatedDB()
{
    $datecreated = getHoyDB() . ' ' . getHoraDB();
    return $datecreated;
}


//Funciones
function GenerarCodeIndex()
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $ala_code = substr(str_shuffle($permitted_chars), 0, 5);

    $time = time();
    $more_code = date("is", $time);

    $codeIndex = "$ala_code$more_code";

    return $codeIndex;
}

function generarToken($longitud)
{
    if ($longitud < 4) {
        $longitud = 4;
    }

    return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
}

function getPagina($position)
{
    $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
    $arrUrl = explode("/", $url);

    return $arrUrl[$position];
}

function getIconModo($modo){
    $dataModo = array();
    $dataModo['icono'] = '';
    $dataModo['texto'] = '';
    switch ($modo) {
        case 'SITE':
            $dataModo['icono'] = '<i class="fa-solid fa-utensils"></i>'; // Icono para el caso 1
            $dataModo['texto'] = "En salón";
            break;
        case 'DELI':
            $dataModo['icono'] = '<i class="fa-solid fa-motorcycle"></i>'; // Icono para el caso 2
            $dataModo['texto'] = "Delivery";
            break;
        case 'TAKE':
            $dataModo['icono'] = '<i class="fa-solid fa-bag-shopping"></i>'; // Icono para el caso 3
            $dataModo['texto'] = "Takeaway";
            break;
        default:
            $dataModo['icono'] = '<i class="fas fa-question"></i>'; // Icono por defecto
            break;
    }
    return $dataModo;
}


function createDropdownMenu($id_carrito_temp, $modo) {
    $options = '';
    $option1 = createOption($id_carrito_temp, $modo, 2, "Entregado", "badge-success");
    $option2 = createOption($id_carrito_temp, $modo, 1, "En cola", "badge-primary");
    $option3 = createOption($id_carrito_temp, $modo, 3, "Preparando", "badge-primary");
    $option4 = createOption($id_carrito_temp, $modo, 4, "En camino", "badge-especial");
    $option5 = createOption($id_carrito_temp, $modo, 5, "Para retirar", "badge-especial");
    $option6 = createOption($id_carrito_temp, $modo, 6, "Cancelado", "badge-danger");

    switch ($modo) {
        case 'SITE':
            $options = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                      . $option1
                      . $option2
                      . $option3
                      . $option6
                      . '</div>';
            break;
        case 'DELI':
            $options = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                      . $option1
                      . $option2
                      . $option3
                      . $option4
                      . $option6
                      . '</div>';
            break;
        case 'TAKE':
            $options = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                      . $option1
                      . $option2
                      . $option3                      
                      . $option5          
                      . $option6
                      . '</div>';
            break;
        default:
            $options = '';
            break;
    }

    return $options;
}

function createOption($id, $modo, $status, $text, $clase) {
    return '<a onClick="fntStatusPedido(' . $id . ', \'' . $modo . '\', ' . $status . ', this)" class="dropdown-item badge ' . $clase . '" href="#">
              <span>' . $text . '</span>
            </a>';
}

function getStatusCarrito($data){
    $dataCarrito = array();
    $dataCarrito['clase'] = '';
    $dataCarrito['texto'] = '';
    $dataCarrito['claseMenu'] = '';
    $dataCarrito['leyenda'] = '';
    $dataCarrito['icono'] = '';

    switch($data) {
        case 1:
            $dataCarrito['clase'] ="badge-primary";
            $dataCarrito['texto'] = "En cola";
            $dataCarrito['claseMenu'] = 'back_vio';
            $dataCarrito['leyenda'] = 'Tu pedido está siendo preparado.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-utensils"></i>';
            break;
        case 2:
            $dataCarrito['clase'] ="badge-success";
            $dataCarrito['texto'] = "Entregado";
            $dataCarrito['claseMenu'] = 'back_ok';
            $dataCarrito['leyenda'] = 'Su pedido ya fue entregado.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-circle-check"></i>';
            break;
        case 3:
            $dataCarrito['clase'] ="badge-primary";
            $dataCarrito['texto'] = "Preparando";
            $dataCarrito['claseMenu'] = 'back_vio';
            $dataCarrito['leyenda'] = 'Tu pedido está siendo preparado.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-utensils"></i>';
            break;
        case 4:
            $dataCarrito['clase'] ="badge-especial";
            $dataCarrito['texto'] = "En camino";
            $dataCarrito['claseMenu'] = 'back_esp';
            $dataCarrito['leyenda'] = 'Su pedido ya está en camino.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-motorcycle"></i>';
            break;
        case 5:
            $dataCarrito['clase'] ="badge-especial";
            $dataCarrito['texto'] = "Para retirar";
            $dataCarrito['claseMenu'] = 'back_esp';
            $dataCarrito['leyenda'] = 'Su pedido ya está listo para retirar.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-bag-shopping"></i>';
            break;
        case 6:
            $dataCarrito['clase'] ="badge-danger";
            $dataCarrito['texto'] = "Cancelado";
            $dataCarrito['claseMenu'] = 'back_red';
            $dataCarrito['leyenda'] = 'Su pedido fue cancelado.';
            $dataCarrito['icono'] = '<i class="fa-solid fa-heart-crack"></i>';
        break;
        default:
            $dataCarrito['clase'] ="badge-danger";
            $dataCarrito['texto'] = "Default";
            $dataCarrito['claseMenu'] = 'back_vio';
            $dataCarrito['leyenda'] = '?';
            $dataCarrito['icono'] = '?';
            break;
    }

    return $dataCarrito;
}

// function obtenerEstadoPedido($status)
// {
//     $clase = '';
//     $leyenda = '';
//     $icono = '';

//     switch ($status) {
//         case 1:
//         case 3:
//             $clase = 'back_vio';
//             $leyenda = 'Tu pedido está siendo preparado.';
//             $icono = '<i class="fa-solid fa-utensils"></i>';
//             break;
//         case 2:
//             $clase = 'back_ok';
//             $leyenda = 'Su pedido ya fue entregado.';
//             $icono = '<i class="fa-solid fa-circle-check"></i>';
//             break;
//         case 4:
//             $clase = 'back_esp';
//             $leyenda = 'Su pedido ya está en camino.';
//             $icono = '<i class="fa-solid fa-motorcycle"></i>';
//             break;
//         case 5:
//             $clase = 'back_esp';
//             $leyenda = 'Su pedido ya está listo para retirar.';
//             $icono = '<i class="fa-solid fa-bag-shopping"></i>';
//             break;
//         case 6:
//             $clase = 'back_red';
//             $leyenda = 'Su pedido fue cancelado.';
//             $icono = '<i class="fa-solid fa-heart-crack"></i>';
//             break;
//     }

//     return array('clase' => $clase, 'leyenda' => $leyenda, 'icono' => $icono);
// }
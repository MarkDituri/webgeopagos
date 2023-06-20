<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'Libraries/phpmailer/Exception.php';
include 'Libraries/phpmailer/PHPMailer.php';
include 'Libraries/phpmailer/SMTP.php';

function host()
{
    return $_SERVER["HTTP_HOST"];
}

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

function media()
{
    return BASE_URL . "/Assets";
}

function headerView($data = "")
{
    $view_header = "Views/Template/header.php";
    require_once($view_header);
}

function menu($data = "")
{
    $view_header = "Views/Template/menu.php";
    require_once($view_header);
}

function scripts($data = "")
{
    $view_scripts = "Views/Template/scripts.php";
    require_once($view_scripts);
}

function footer($data = "")
{
    $view_footer = "Views/Template/footer.php";
    require_once($view_footer);
}

function loadingWeb()
{
    $view_loading = "Views/Template/Others/loading_web.php";
    require_once($view_loading);
}

function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

function getUsuario()
{
    require_once("Libraries/Core/Mysql.php");
    $idRest = $_SESSION['idRest'];
    $con = new Mysql();
    $sql = "SELECT * FROM restaurantes WHERE id_restaurante = $idRest AND status = 2;";
    $request = $con->select($sql);

    return $request;
}


function sessionUser(int $id_restaurante)
{
    require_once("Models/LoginModel.php");
    $objLogin = new LoginModel();
    $request = $objLogin->sessionLogin($id_restaurante);
    return $request;
}

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

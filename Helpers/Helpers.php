<?php

function host()
{
    return $_SERVER["HTTP_HOST"];
}

function base_url()
{
    return BASE_URL;
}

function base_api()
{
    return API_URL;
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

function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
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

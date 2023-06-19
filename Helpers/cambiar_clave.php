<?php
require ("../php/config.php");
include("../php/conexion.php");

if($_POST){
    if(empty($_POST['clave_1']) || empty($_POST['clave_2']))				
    {
        $request = array("status" => false, "msg" => 'Datos incorrectos.');
    } else {
        $clave = hash("SHA256",$_POST['clave_1']);        
        $token = $_POST["token"];

        // Guarda clave con MD5 y status 2 login
        $sql = "UPDATE restaurantes SET password = '$clave' WHERE email_user = '$email'";                      
                            
        if ($result = $connect->query($sql)){
            $row_cnt = $connect->affected_rows;                    
            if ($row_cnt === 1) {
                header("location:".$base_url."/usuarios/perfil");  
                $request = array('status' => true, 'value' => 'activa', 'msg' => '¡Su contraseña ah sido guardadad con exito.', 'p' => 'Sera redirijido al Login...');                    
            } else {
                $request = array('status' => false, 'value' => 'preactiva', 'msg' => '¡Su cuenta ya fue activada!.',  'p' => 'Al parecer su cuenta ya se activo previamente');                    
                return false;
            }                    
        }
    }      
} 

?>
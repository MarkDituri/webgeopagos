<?php
require_once("Libraries/Core/Mysql.php");

trait TLoginMenu
{
    private $con;
    private $strCategoria;
    private $intIdcategoria;
    private $intIdProducto;
    private $strProducto;
    private $cant;
    private $option;
    private $strRuta;
    private $strRutaCategoria;

    public function loginUserMenu(int $id_restaurante)
    {
        session_start();        

        if(!isset($_SESSION['restaurante']) && !isset($_SESSION['code_session'])) {
            $this->intId_restaurante = $id_restaurante;            
            $qr = isset($_GET['adm']) ? '' : 'si';
    
            //Buscar RESTAURANTE CON ID    
            $sql = "SELECT id_restaurante, identificacion, nombres, apellidos, nombre_rest, telefono, email_user, direccion, numero, localidad, url_logo, url, id_color, dark_mode, facebook, instagram, status, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha 
                        FROM restaurantes
                    WHERE id_restaurante = $this->intId_restaurante;";
                    
            $requestRest = $this->con->select($sql);
    
            if (!empty($requestRest)) {
    
                $n = 5;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $SESSION_code = '';
    
                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $SESSION_code .= $characters[$index];
                }
                //Creando sesion con dato random & id_local                       
                //Declarando datos para sesion                
                $_SESSION['restaurante'] = $requestRest;
                $_SESSION["code_session"] = "$SESSION_code";
    
                $datecreated = getDatacreatedDB();
                //Crear carrito para sesion actual       
                $sql = "INSERT INTO carrito_temp (id_carrito_temp, status, code_session, id_restaurante, qr, datecreated, activo)
                    VALUES (?,?,?,?,?,?,?);";
                $arrData = array(
                    NULL,
                    0,
                    $SESSION_code,
                    $this->intId_restaurante,
                    $qr,
                    $datecreated,
                    'si'
                );
                $request = $this->con->insert($sql, $arrData);

                // $arrResponse = array('code_session' => $SESSION_code, 'restaurante' => $requestRest);
                // return $arrResponse;
            }
        }
     
    }

    public function sesionMenu()
    {
        session_start();

        if(!isset($_SESSION['restaurante']) && empty($_SESSION['code_session'])){
            return false;
        } else {              
            $id_restaurante = $_SESSION['restaurante']['id_restaurante'];
            $this->con = new Mysql();
            $sql = "SELECT id_restaurante, identificacion, nombres, apellidos, nombre_rest, telefono, email_user, direccion, numero, localidad, id_color, dark_mode, url_logo, url, facebook, instagram, status, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha 
                        FROM restaurantes 
                    WHERE id_restaurante = $id_restaurante;";
            $request = $this->con->select($sql);                
            $_SESSION['restaurante'] = $request;
            return $_SESSION;
        }
    }

    public function sesionMenuReset()
    {
        session_start();
        unset($_SESSION['restaurante'], $_SESSION["code_session"]);
        return true;
        die();
    }

    public function sesionMenuCerrar()
    {                
        session_start();
        unset($_SESSION['restaurante'], $_SESSION["code_session"], $_SESSION["comensal"]);
        return true;
        die();    
    }
}

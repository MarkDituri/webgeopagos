<?php
require_once("Libraries/Core/Mysql.php");
trait TCarrito
{
    private $con;

    function getCarrito(int $id_restaurante, string $SESSION_code)
    {
        $this->con = new Mysql();
        $sql = "SELECT id_carrito_temp,
                        status,
                        code_session,
                        mesa,
                        modo,
                        total,
                        activo,
                        DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha,
                        DATE_FORMAT(datecreated, '%H:%i') as hora,
                        id_restaurante,
                        id_comensal
                FROM carrito_temp		
                WHERE id_restaurante = $id_restaurante AND code_session = '$SESSION_code' AND activo = 'si';";

        $request = $this->con->select($sql);
        return $request;
    }

    function getProductosCarrito(int $id_restaurante, string $SESSION_code)
    {
        $this->con = new Mysql();
        $sql = "SELECT p.id_producto, p.titulo, p.status, p.descripcion, p.url_img, p.precio,
            d.id_pedido, d.status, d.id_producto, d.id_restaurante, d.detalle, d.code_session, d.cantidad, d.precio
            FROM pedidos d 
            INNER JOIN productos p 
            ON d.id_producto = p.id_producto 
            WHERE d.code_session = '$SESSION_code' 
            AND d.id_restaurante = $id_restaurante;";

        $request = $this->con->select_all($sql);
        return $request;
    }

    function getDetalle($id_pedido, int $id_restaurante, string $SESSION_code)
    {
        $this->con = new Mysql();
        $sql = "SELECT id_pedido, detalle
            FROM pedidos
        WHERE id_pedido = $id_pedido AND id_restaurante = $id_restaurante AND code_session = '$SESSION_code';";
        $request = $this->con->select($sql);

        if (empty($request)) {
            $arrResponse = array('status' => false, 'msg' => $request);
        } else {
            $arrResponse = array('status' => true, 'detalle' => $request);
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    // function saveComensal($POST, string $modo, int $id_restaurante, string $SESSION_code)
    // {
    //     $this->con = new Mysql();

    //     $nombre = '';
    //     $telefono = '';
    //     $direccion = '';
    //     $numero = '';
    //     $localidad = '';
    //     $piso = '';
    //     $mesa = '';

    //     if ($modo == 'SITE') {
    //         $nombre = $POST['comensal_nombre'];
    //         $mesa = $POST['comensal_mesa'];

    //         if ($mesa != '') {                
    //             // Actualizar MESA en carrito_temp
    //             $query_update = "UPDATE carrito_temp SET mesa = ? 
    //                             WHERE id_restaurante = $id_restaurante 
    //                             AND code_session = '$SESSION_code';";
    //             $arrData = array($mesa);
    //             $request = $this->con->update($query_update, $arrData);
    //         }
    //         // insertar comensal     
    //         $query_insert  = "INSERT INTO comensales (id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante)
    //                             VALUES(?,?,?,?,?,?,?,?,?,?)";
    //         $arrData = array(NULL, 1, '', $nombre, '', '', '', '', '', $id_restaurante);            
    //     }

    //     if ($modo == 'DELI') {
    //         $nombre = $POST['comensal_nombre'];
    //         $telefono = $POST['comensal_telefono'];
    //         $direccion = $POST['comensal_direccion'];
    //         $numero = $POST['comensal_numero'];
    //         $localidad = $POST['comensal_localidad'];
    //         $piso = $POST['comensal_piso'];

    //         $query_insert  = "INSERT INTO comensales (id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante)
    //                          VALUES(?,?,?,?,?,?,?,?,?,?)";
    //         $arrData = array(NULL, 1, '', $nombre, $telefono, $direccion, $numero, $localidad, $piso, $id_restaurante);
    //     }

    //     if ($modo == 'TAKE') {
    //         $nombre = $POST['comensal_nombre'];
    //         $telefono = $POST['comensal_telefono'];        

    //         $query_insert  = "INSERT INTO comensales (id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante)
    //                          VALUES(?,?,?,?,?,?,?,?,?,?)";
    //         $arrData = array(NULL, 1, '', $nombre, $telefono, '', '', '', '', $id_restaurante);
    //     }

    //     $request_insert = $this->con->insert($query_insert, $arrData);

    //     if (empty($request_insert)) {
    //         $arrResponse = array('status' => false);
    //     } else {
    //         $arrResponse = array('status' => true, 'id_comensal' => $request_insert);
    //     }
    //     return $arrResponse;
    // }

    function saveComensal($POST, $sesionComensal, int $id_restaurante, string $SESSION_code)
    {
        $this->con = new Mysql();
        // Creacion de varaibles IA
        // Si la variable viene por POST la reemplaza, si no deja la de la $_SESSION y si no = ''
        $nombre =    isset($POST['comensal_nombre']) ? $POST['comensal_nombre'] : ($sesionComensal['nombre'] != '' ? $sesionComensal['nombre'] : '');
        $telefono =  isset($POST['comensal_telefono']) ? $POST['comensal_telefono'] : ($sesionComensal['telefono'] != '' ? $sesionComensal['telefono'] : '');
        $direccion = isset($POST['comensal_direccion']) ? $POST['comensal_direccion'] : ($sesionComensal['direccion'] != '' ? $sesionComensal['direccion'] : '');
        $numero =    isset($POST['comensal_numero']) ? $POST['comensal_numero'] : ($sesionComensal['numero'] != '' ? $sesionComensal['numero'] : '');
        $localidad = isset($POST['comensal_localidad']) ? $POST['comensal_localidad'] : ($sesionComensal['localidad'] != '' ? $sesionComensal['localidad'] : '');
        $piso =      isset($POST['comensal_piso']) ? $POST['comensal_piso'] : ($sesionComensal['piso'] != '' ? $sesionComensal['piso'] : '');
        $telefono =  isset($POST['comensal_telefono']) ? $POST['comensal_telefono'] : ($sesionComensal['telefono'] != '' ? $sesionComensal['telefono'] : '');
        $mesa =      isset($POST['comensal_mesa']) ? $POST['comensal_mesa'] : '';

        if ($mesa != '') {
            // Actualizar MESA en carrito_temp
            $query_update = "UPDATE carrito_temp SET mesa = ? 
                            WHERE id_restaurante = $id_restaurante AND code_session = '$SESSION_code';";
            $arrData = array($mesa);
            $this->con->update($query_update, $arrData);
        }
        if ($sesionComensal) { // Si la varaible no esta vacia, updatea con el valor
            // Actualizar comensal     
            $id_comensal = $sesionComensal['id_comensal'];
            $sql = "UPDATE comensales SET nombre = ?, telefono = ?, direccion = ?, numero = ?, localidad = ?, piso = ?
                    WHERE id_restaurante = $id_restaurante 
                    AND id_comensal = $id_comensal AND id_restaurante = $id_restaurante;";
            $arrData = array($nombre, $telefono, $direccion, $numero, $localidad, $piso);
            $request_insert = $this->con->update($sql, $arrData);

            $arrResponse = array('status' => true, 'id_comensal' => $id_comensal);
            
        } else {            
            // insertar comensal     
            $sql  = "INSERT INTO comensales (id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante)
                    VALUES(?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(NULL, 1, '', $nombre, $telefono, $direccion, $numero, $localidad, $piso, $id_restaurante);
            $request_insert = $this->con->insert($sql, $arrData);

            $arrResponse = array('status' => true, 'id_comensal' => $request_insert);
        }        
        
        return $arrResponse;
    }

    function getComensal(int $id_comensal, int $id_restaurante)
    {
        $this->con = new Mysql();
        $sql = "SELECT id_comensal, status, tipo, nombre, telefono, direccion, numero, localidad, piso, id_restaurante
                    FROM comensales
                WHERE id_comensal = $id_comensal AND id_restaurante = $id_restaurante;";
        $request = $this->con->select($sql);

        if (!empty($request)) {
            return $request;
        }
    }
}

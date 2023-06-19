<!DOCTYPE html>
<html>

<head>
    <style>
        @font-face {
            font-family: 'Ticketing';
            src: url('../../Views/Template/Others/fonts/Ticketing.otf'), url('../Others/fonts/Ticketing.ttf') format('ttf');
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0;
        }

        * {
            font-size: 12px;
            font-family: 'Ticketing' !important;
        }

        td,
        th,
        tr,
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .cont-img {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            width: 100px !important;
            max-width: 100px !important;
        }

        .borde-b {
            border-bottom: 1px solid black;
            padding-bottom: 2px;
        }

        .borde-t {
            border-top: 1px solid black;
            padding-top: 2px;
        }

        .txt-large {
            font-size: 19px;
            font-weight: bold;
        }

        td.producto,
        th.producto {
            text-align: left;
            width: 125px;
            max-width: 125px;
        }

        td.precio,
        th.precio {
            text-align: right;
            width: 38px;
            max-width: 38px;
            word-break: break-all;
        }

        .centrado {
            margin-top: 0;
            margin-bottom: 4px;
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 170px;
            max-width: 170px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .oculto-impresion,
            .oculto-impresion * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="cont-img centrado">
            <img class="centrado" src="<?= base_url(); ?>/Assets/images/logo-ticket.png" alt="Logotipo">
        </div>
        <p class="centrado bold txt-large">
            CODIGO: <?= $carrito_resp['code_session']; ?>
        </p>
        <p class="centrado" style="margin-bottom: 26px">Comercio:
            <span style="text-transform: capitalize;">
                <?= $_SESSION['userData']['nombre_rest']; ?></span><br>
            <span style="padding-bottom: 18px"><?= $carrito_resp['fecha']; ?> <?= $carrito_resp['hora']; ?>hs</span><br>
            <span style="padding-bottom: 18px">Modo:
                <?php
                $dataModo = getIconModo($carrito_resp['modo']);
                print $dataModo['texto'];
                if ($carrito_resp['mesa'] != '') {
                    print ' - Mesa:' . $carrito_resp['mesa'];
                }
                ?>
            </span><br>
        </p>
        <table>
            <thead>
                <tr class="borde-b">
                    <th class="producto"><b>DATOS DE CLIENTE</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="producto">- <?= $comensal_resp['nombre']; ?></td>
                </tr>
                <?php if ($comensal_resp['telefono'] != '') { ?>
                    <tr>
                        <td class="producto">- <?= $comensal_resp['telefono'] ?></td>
                    </tr>
                <?php }
                $piso = '';
                if ($comensal_resp['direccion'] != '') {
                    if ($comensal_resp['piso'] != '') {
                        $piso = ' - Piso/Dpto: ' . $comensal_resp['piso'];
                    }
                    $direccionCom = $comensal_resp['direccion'] . ' ' . $comensal_resp['numero'] . ', ' . $comensal_resp['localidad'] . $piso;
                ?>
                    <tr style="padding-bottom: 16px">
                        <td class="producto">- <?= $direccionCom; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="height: 7px"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr class="borde-b">
                    <th class="producto"><b>PRODUCTO</b></th>
                    <th class="precio"><b>PRECIO</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($pedidos_resp); $i++) {
                    $id_producto = $pedidos_resp[$i]['id_producto'];
                    $status_producto =    $pedidos_resp[$i]['status'];
                    $nombre_producto =    $pedidos_resp[$i]['titulo'];
                    $descDetalle =    $pedidos_resp[$i]['detalle'];
                    $precio_producto =    $pedidos_resp[$i]['precio'];
                    $cantidad_producto =    $pedidos_resp[$i]['cantidad'];
                    $descripcion_producto =    $pedidos_resp[$i]['descripcion'];
                    $img_producto =    $pedidos_resp[$i]['url_img'];

                    if (!!$descDetalle) {
                        $descDetalleView = $cantidad_producto . "x" . $nombre_producto . '<p style="margin: 0;font-style: italic;"> - ' . $descDetalle . ' - </p>';
                    } else {
                        $descDetalleView = $cantidad_producto . "x" . $nombre_producto . '';
                    }
                ?>
                    <tr>
                        <td class="producto"><?= $descDetalleView; ?></td>
                        <td class="precio">$<?= $precio_producto ?></td>
                    </tr>
                <?php }; ?>
                <tr class="borde-t">
                    <td class="producto" style="font-size: 14px; padding-top: 5px"><b>TOTAL</b></td>
                    <td class="precio" style="font-size: 14px;  padding-top: 5px">$<?= $carrito_resp['total']; ?></td>
                </tr>
            </tbody>
        </table>
        <p class="centrado" style="margin-bottom: 10px; color: white;"><br>
            espacioNull<br>
        </p>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
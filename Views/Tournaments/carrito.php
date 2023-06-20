<?php
headerMenu($data);
navbarMenu($data);
$dataCarrito =       $_SESSION['carrito'];
$classColor =        $_SESSION['restaurante']['class_color'];
$productosCarrito =  $data['productos_carrito'];
$count_productos =   count($productosCarrito);


//Comprobar si existe un comensal ya registradp
$nombre = '';
$telefono = '';
$direccion = '';
$numero = '';
$localidad = '';
$piso = '';
$mesa = '';

if (isset($_SESSION['comensal'])) {
    $nombre =    $_SESSION['comensal']['nombre'];
    $telefono =  $_SESSION['comensal']['telefono'];
    $direccion = $_SESSION['comensal']['direccion'];
    $numero =    $_SESSION['comensal']['numero'];
    $localidad = $_SESSION['comensal']['localidad'];
    $piso =      $_SESSION['comensal']['piso'];
}

?>
<!-- DATOS DE EDICION DE DETALLE-->
<section id="popEdit-detalle">
    <div class="cont-pop">
        <form action="<?= base_url(); ?>/menu/editardetalle" method="POST" class="row cont-edit-pop">
            <div class="cont-close">
                <h2 class="post-title my-0">Editando detalle</h2>
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="cont-detalle-bolas">
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
                <div class="bolas-nota"></div>
            </div>
            <input type="hidden" name="id_pedido" id="id_pedido" value="">
            <textarea maxlength="72" class="col-12" type="text" name="detalle" id="inpEditDetalle" value=""></textarea>
            <div class="spacer-prop "></div>
            <button class="btn-agregar-pedido <?= $classColor; ?>">Guardar</button>
        </form>
    </div>
</section>

<!-- DATOS PARA DELIVERY -->
<?php if ($_SESSION['carrito']['modo'] == 'DELI') { ?>
    <section id="pop-comensal">
        <div class="cont-pop">
            <form id="formComensal_deli" class="row cont-edit-pop">
                <div class="cont-close">
                    <h2 class="post-title my-0">Datos de envio</h2>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="cont-form-pop col-sm-12 col-md-12 col-lg-12" id="msg-gral"></div>

                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <!-- MODO DE PEDIDO PARA JS -->
                    <input type="hidden" name="modo" id="modo" value="<?= $_SESSION['carrito']['modo']; ?>">

                    <label for="comensal_nombre" class="form-label">Nombre*</label>
                    <input type="text" class="form-control" id="comensal_nombre" name="comensal_nombre" value="<?= $nombre; ?>">
                    <div class="Mensaje" id="msg-nombre"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <label for="comensal_telefono" class="form-label">Teléfono*</label>
                    <input type="number" class="form-control" id="comensal_telefono" name="comensal_telefono" value="<?= $telefono; ?>">
                    <div class="Mensaje" id="msg-telefono"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-8 col-8">
                    <label for="comensal_direccion" class="form-label">Dirección*</label>
                    <input type="text" class="form-control" id="comensal_direccion" name="comensal_direccion" value="<?= $direccion; ?>">
                    <div class="Mensaje" id="msg-direccion"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-4 col-4">
                    <label for="comensal_numero" class="form-label">Numero*</label>
                    <input type="text" class="form-control" id="comensal_numero" name="comensal_numero" value="<?= $numero; ?>">
                    <div class="Mensaje" id="msg-numero"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-8 col-12">
                    <label for="comensal_localidad" class="form-label">Localidad*</label>
                    <input type="text" class="form-control" id="comensal_localidad" name="comensal_localidad" value="<?= $localidad; ?>">
                    <div class="Mensaje" id="msg-localidad"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-4 col-12">
                    <label for="comensal_piso" class="form-label">Piso/Departamento</label>
                    <input type="text" class="form-control" id="comensal_piso" name="comensal_piso" value="<?= $piso; ?>">
                    <div class="Mensaje" id="msg-piso"></div>
                </div>
                <!-- <div class="cont-form-pop sinNada col-md-4">
                <label for="inputState" class="form-label">Barrio</label>
                <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div> -->

                <div class="spacer-prop"></div>
                <button type="submit" class="btn-agregar-pedido <?= $classColor; ?>">¡Listo!</button>
            </form>
        </div>
    </section>
<?php }; ?>

<!-- DATOS PARA SITE -->
<?php if ($_SESSION['carrito']['modo'] == 'SITE') { ?>
    <section id="pop-comensal">
        <div class="cont-pop">
            <form id="formComensal_site" class="row cont-edit-pop">
                <div class="cont-close">
                    <h2 class="post-title my-0">Datos de mesa</h2>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="cont-form-pop col-sm-12 col-md-12 col-lg-12" id="msg-gral"></div>

                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <!-- MODO DE PEDIDO PARA JS -->
                    <input type="hidden" name="modo" id="modo" value="<?= $_SESSION['carrito']['modo']; ?>">

                    <label for="comensal_nombre" class="form-label">Nombre*</label>
                    <input type="text" class="form-control" id="comensal_nombre" name="comensal_nombre" value="<?= $nombre; ?>">
                    <div class="Mensaje" id="msg-nombre"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <label for="comensal_mesa" class="form-label">Mesa</label>
                    <input type="text" class="form-control" id="comensal_mesa" name="comensal_mesa" value="<?= $mesa; ?>">
                    <div class="Mensaje" id="msg-mesa"></div>
                </div>

                <div class="spacer-prop"></div>
                <button type="submit" class="btn-agregar-pedido <?= $classColor; ?>">¡Listo!</button>
            </form>
        </div>
    </section>
<?php }; ?>

<!-- DATOS PARA TAKE AWAY -->
<?php if ($_SESSION['carrito']['modo'] == 'TAKE') { ?>
    <section id="pop-comensal">
        <div class="cont-pop">
            <form id="formComensal_take" class="row cont-edit-pop">
                <div class="cont-close">
                    <h2 class="post-title my-0">Datos de cliente</h2>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="cont-form-pop col-sm-12 col-md-12 col-lg-12" id="msg-gral"></div>

                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <!-- MODO DE PEDIDO PARA JS -->
                    <input type="hidden" name="modo" id="modo" value="<?= $_SESSION['carrito']['modo']; ?>">

                    <label for="comensal_nombre" class="form-label">Nombre*</label>
                    <input type="text" class="form-control" id="comensal_nombre" name="comensal_nombre" value="<?= $nombre; ?>">
                    <div class="Mensaje" id="msg-nombre"></div>
                </div>
                <div class="cont-form-pop sinNada col-md-6 col-12">
                    <label for="comensal_telefono" class="form-label">Telefono *</label>
                    <input type="number" class="form-control" id="comensal_telefono" name="comensal_telefono" value="<?= $telefono; ?>">
                    <div class="Mensaje" id="msg-telefono"></div>
                </div>

                <div class="spacer-prop"></div>
                <button type="submit" class="btn-agregar-pedido <?= $classColor; ?>">¡Listo!</button>
            </form>
        </div>
    </section>
<?php }; ?>

<section class="main-content mt-3">
    <div class="container-xl">

        <!-- <nav aria-label="breadcrumb">
            <div class="widget-header">
                <h3 class="widget-title">Estado de tu Pedido<span></h3>
            </div>
        </nav> -->

        <?php if($_SESSION['carrito']['status'] != 0) { ?>    
        <div class="row gy-4">

            <div class="col-lg-12">
                <!-- Estado de Orden -->
                <div class="comments padding-15 ul-cont-carrito">
                    <ul id="statusCarrito" class="comments">                                
                    <?php                    
                    $clase = ''; $leyenda = ''; $icono = '';                    
                    // Llamar a la función con el valor de status del pedido
                    $status = $_SESSION['carrito']['status'];
                    $hora = $_SESSION['carrito']['hora'];
                    $estadoPedido = getStatusCarrito($status);

                    $clase = $estadoPedido['claseMenu'];
                    $leyenda = $estadoPedido['leyenda'];
                    $icono = $estadoPedido['icono'];
                    ?>
                        <li class="StatusContent cont-li-prod rounded <?= $clase; ?>">
                            <div class="contStatusOrden">
                                <?= $icono; ?>
                                <h2><?= $leyenda; ?></h2>                             
                            </div>                      
                            <p class="hora"><span>
                                El pedido fue realizado a las: 
                                <i class="fa-regular fa-clock"></i> <?= $hora;?> hs</span>
                            </p>  
                        </li>
            
                    </ul>
                </div>
            </div>
        </div>
        <?php }; ?>

        <nav aria-label="breadcrumb">
            <div class="widget-header">
                <h3 class="widget-title">Tu Pedido<span style="font-weight: normal;">(<?= $count_productos; ?>)<span></h3>
            </div>
        </nav>

        <div class="row gy-4">

            <div class="col-lg-12">
                <!-- Producto -->
                <div class="comments padding-15 ul-cont-carrito">
                    <ul class="comments ">
                        <?php
                        //Enviando ID y trayendo array Productos del carrito    
                        if (count($data['productos_carrito']) == 0) { ?>
                            <div class="cont-txt-prod">
                                <p class="post-desc my-0 limitar-texto">No hay productos en tu orden</p><br>
                            </div>
                            <?php } else {
                            foreach ($data['productos_carrito'] as $productosCarrito) {
                                $id_producto =          $productosCarrito['id_producto'];
                                $status_producto =      $productosCarrito['status'];
                                $nombre_producto =      $productosCarrito['titulo'];
                                $descripcion_producto = $productosCarrito['descripcion'];
                                $precio_producto =      $productosCarrito['precio'];
                                $cantidad_producto =    $productosCarrito['cantidad'];
                                $img_producto =         $productosCarrito['url_img'];
                                $id_pedido =            $productosCarrito['id_pedido'];
                                $url_producto =         base_url() . '/producto?id_prod=' . $id_producto;
                                $detalle_pedido =       $productosCarrito['detalle'];

                                if ($cantidad_producto == 1) {
                                    $viewCantidad = null;
                                } else {
                                    $viewCantidad = "<span>(" . $cantidad_producto . ")x</span>";
                                }

                                if ($detalle_pedido != "") {
                                    $view_detalle = '<div class="cont-detalle-carr"><p>' . $detalle_pedido . '</p><a onClick="fntEditDetalle(' . $id_pedido . ')" class="cont-edit-detalle"><i class="fa-solid fa-pen"></i>&nbsp Editar</a></div>';
                                    $view_detalleOff = '<div class="cont-detalle-carr"><p>' . $detalle_pedido . '</p></div>';
                                } else {
                                    $view_detalle = "";
                                    $view_detalleOff = "";
                                }
                            ?>
                                <li class="cont-li-prod rounded">
                                    <div class='cont-productos'>
                                        <div class="cont-img-prod contImg-producto cont-img-prod" style="background: url(<?= media(); ?>/images/uploads/<?= $img_producto; ?>)no-repeat; background-size:cover; background-position: center">
                                            <a class="" href="#" id="url_img">
                                            </a>
                                        </div>
                                        <div class="cont-txt-prod">
                                            <h2 class="post-title my-0">
                                                <a href="#"><?= $viewCantidad . $nombre_producto; ?></a>
                                            </h2>
                                            <p class="post-desc my-0 limitar-texto"><?= $descripcion_producto; ?></p>
                                        </div>
                                        <div class="cont-precio-prod">
                                            <h5>$<?= $precio_producto; ?></h5>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['carrito']['status'] == 0) { ?>
                                        <div class="cont-btn-delete">
                                            <?= $view_detalle; ?>
                                            <a onclick="disableBtn()" href="<?= base_url(); ?>/menu/delproducto/<?= $id_pedido; ?>/<?= $precio_producto ?>/" class="btn-disabled btn-delete">
                                                <i class="fa-solid fa-trash-can"></i>&nbsp Eliminar producto
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="cont-btn-delete">
                                            <?= $view_detalleOff; ?>
                                        </div>
                                    <?php } ?>
                                </li>
                        <?php }
                        } ?>

                        <div class=' cont-total'>
                            <h5 style="text-align: left;">TOTAL</h5>
                            <h5>$<?= $_SESSION['carrito']['total'] ?></h5>
                        </div>
                        <?php
                        //Sugerir QR si ya ordeno
                        if ($_SESSION['carrito']['status'] != 0) { ?>
                            <div class="con-qr-detalle">
                                <div class="img-qr"></div>
                                <h2 class="">Si deseas seguir ordenando, puede hacer
                                    <a href="<?= base_url(); ?>/menu/resetmenu">Clic aquí</a>
                                    para crear un nuevo pedido
                                </h2>
                            </div>
                        <?php }

                        //Ordenar o volver texto
                        if ($_SESSION['carrito']['status'] == 0) {
                            $text_btn = "Seguir ordenando";
                        } else $text_btn = "Volver al inicio"; ?>
                        <div class="cont-producto" style="margin-top: 20px">
                            <a href="<?= base_url(); ?>/menu/id/<?= $_SESSION['restaurante']['url']; ?>/" class="btn-sin-pedido"><?= $text_btn; ?></a>
                        </div>

                    </ul>
                </div>
            </div>

        </div>

    </div>
</section>

<footer>
    <div class="container-xl">
        <div class="footer-inner">
            <div class="row d-flex align-items-center gy-4">
                <div style="height: 30px">

                </div>
            </div>
        </div>
    </div>
</footer>

<?php
CarritoMenu($data);
scriptsMenu($data);
?>
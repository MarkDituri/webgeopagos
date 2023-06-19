<?php
$dataCarrito =     $_SESSION['carrito'];
$classColor =      $_SESSION['restaurante']['class_color'];
$dataRestaurante = $_SESSION['restaurante'];
?>
<div class="container-footer">
    <!-- Mostrar solo si el IDENTIFICADOR es de cuenta DEMO -->
    <?php if ($data['page_name'] != 'modos' && $dataRestaurante['identificacion'] == ID_DEMO_MENU) { ?>
        <div class="cont-modalLogin">
            <div class="cont-showLogin" id="showLogin">
                <div class="content">
                    <h3 class="post-title my-0 limitar-texto">¿Te gustaría crear tu propio menú interactivo?</h3>
                    <i onclick="closeModalLogin();" class="fa-solid fa-chevron-down"></i>
                </div>
                <a href="https://bit.ly/3C8vwUX">Si, empezar ahora</a>
            </div>

            <div onclick="openModalLogin();" class="cont-hiddenLogin" id="hiddenLogin">
                <h3 class="post-title my-0 limitar-texto">Crear mi Menú</h3>
                <i class="fa-solid fa-chevron-up"></i>
            </div>
        </div>
    <?php } ?>

    <!-- Precio footer - botones -->
    <div class="cont-btn-sticky">
        <?php
        //Comprobar estado del carrito
        if ($dataCarrito['status'] != 0) { ?>
            <a href="<?= base_url(); ?>/menu/carrito" class="btn-sin-pedido">
                <i class="icon-check-carr fa-solid fa-circle-check"></i>
                &nbsp Pedido realizado
            </a>
        <?php
        } else { ?>
            <?php if ($data['page_name'] == 'menu') { ?>
                <?php if ($dataCarrito['total'] != 0) { ?>
                    <a href="<?= base_url(); ?>/menu/carrito" class="btn-agregar-pedido btn-info-ped <?= $classColor; ?> ">
                        <i class="fa-solid fa-bag-shopping">
                            <div><?= $count_productos; ?></div>
                        </i>
                        <span>Ver Pedido</span>
                        <span>$<?= $dataCarrito['total']; ?></span>
                    </a>
                <?php } else { ?>
                    <a href="#" class="btn-sin-pedido">
                        Sin pedidos
                    </a>
                <?php } ?>
            <?php } else if ($data['page_name'] == 'producto') { ?>
                <a href="<?= base_url(); ?>/menu/id/<?= $dataRestaurante['url'] ?>/" class="btn-sin-pedido">
                    Seguir ordenando
                </a>
            <?php } else if ($data['page_name'] == 'carrito' && $dataCarrito['total'] != 0) { ?>
                <div class=' cont-total'>
                    <h5 style="text-align: left;">TOTAL</h5>
                    <h5>$<?= $dataCarrito['total']; ?></h5>
                </div>
                <a onclick="openModalComensal();" class="btn-agregar-pedido btn-info-ped <?= $classColor; ?>">
                    <i class="fa-solid fa-bag-shopping">
                        <div><?= $count_productos; ?></div>
                    </i>
                    <span>Confirmar Pedido</span>
                    <span>$<?= $dataCarrito['total']; ?></span>
                </a>

            <?php } else if ($data['page_name'] == 'confirmado') { ?>
                <a href="<?= base_url(); ?>/menu/id/<?= $dataRestaurante['url'] ?>" class="btn-agregar-pedido">
                    Volver al Inicio
                </a>
        <?php }
        } ?>
    </div>
</div>
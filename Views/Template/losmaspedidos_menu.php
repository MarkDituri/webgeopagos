<?php
$dataBestProducto = $data['productoBest'];
?>
<!-- Listado de Productos Mas populares -->
<div class="col-lg-12" style="margin-top: 5px;">
    <!-- Los mas pedidos -->
    <div class="widget-header">
        <h3 class="widget-title">Los más pedidos</h3>
    </div>
    <div class="widget-content">
        <div class="post-carousel-destacados">
            <!-- Producto -->
            <?php
                if (count($data['productoBest']) > 0) {
                    foreach ($data['productoBest'] as $productoBest) { 
                        $url_producto = base_url() . '/menu/producto/' . $productoBest['id_producto'];
            ?>
                <div class="cont-destacados post post-carousel">
                    <div class="thumb rounded">
                        <a href="<?= $url_producto; ?>" class="precio-tag position-absolute"><?= $productoBest['precio']; ?></a>
                        <a href="<?= $url_producto; ?>">
                            <div class="inner" style="background: url(<?= media(); ?>/images/uploads/<?= $productoBest['url_img']; ?>);background-size:cover; background-position: center;">
                            </div>
                        </a>
                    </div>
                    <h5 class="txt-destacados limitar-texto post-title mb-0 mt-4">
                        <a href="<?= $url_producto; ?>"><?= $productoBest['titulo']; ?></a>
                    </h5>
                    <!-- <ul class="limitar-texto meta list-inline mt-2 mb-0">                                        
                        <li class="list-inline-item">29 March 2021</li>
                    </ul> -->
                </div>
            <?php } }; ?>
        </div>

    </div>
</div>

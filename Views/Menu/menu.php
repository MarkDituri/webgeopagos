<?php
headerMenu($data);
navbarMenu($data);
$classColor =     $_SESSION['restaurante']['class_color'];
$dataSliders =    $data['sliders'];
$dataCategorias = $data['categorias'];
?>
<section id="hero">
    <div class="container-xl">

        <div class="row gy-4">
            <!--Main Menu-->
            <div class="col-lg-12">
                <?php
                if (count($data['sliders']) > 0) { ?>
                    <div id="cont-sliders" class="row post-carousel-twoCol post-carousel">
                        <?php foreach ($data['sliders'] as $sliders) { ?>
                            <!--Slider-->
                            <div class="cont-slider post post-over-content col-md-6" style="background: url(<?= media(); ?>/images/uploads/<?= $sliders['img_slider']; ?>);background-size: cover; background-position: center">
                                <div class="details clearfix">
                                    <a href="#" class="categoria-badge <?= $classColor; ?>"><?= $sliders['tag']; ?></a>
                                    <h4 class="post-title">
                                        <a href="#"><?= $sliders['titulo']; ?></a>
                                    </h4>
                                </div>
                                <a href="#">
                                    <div class="thumb rounded">
                                        <div class="inner">
                                            <div style="height: 190px"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <!--Slider Categorias-->
            <div class="col-lg-12 sinNada">
                <div class="cont-categorias widget rounded">

                    <div class="widget-header">
                        <h3 class="widget-title">Categorias</h3>
                    </div>
                    <div class="widget-content">
                        <div class="post-carousel-categorias">

                            <div class="categ-div post post-carousel" id="cate-best">
                                <ul class="nav nav-tabs nav-pills nav-fill" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button onclick="abrirCategoria('best');" aria-controls="best" class="btn-categoria nav-link" id="best-tab" role="tab" type="button">
                                            Los mas pedidos
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            if (count($data['categorias']) > 0) {
                                foreach ($data['categorias'] as $categorias) { ?>
                                    <div class="categ-div post post-carousel">
                                        <ul class="nav nav-tabs nav-pills nav-fill" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button onclick="abrirCategoria(<?= $categorias['id_categoria']; ?>);" aria-controls="<?= $categorias['nombre']; ?>" class="btn-categoria nav-link" id="<?= "#" . $categorias['nombre'] . "-tab" ?>" role="tab" type="button">
                                                    <?php echo $categorias['nombre']; ?>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                            <?php }
                            } ?>
                            <!-- Fin categoria -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin categoria -->

            <!-- Listado de Productos -->
            <div class="col-lg-12">
                <!-- post tabs -->
                <div class="post-tabs">
                    <div class="tab-content cont-all-list-prod" id="postsTabContent">
                        <!-- loader -->
                        <div class="lds-dual-ring"></div>
                        <!-- Cont Productos -->
                        <div id="loader" style="display: none;">
                            <div class="loader loader_<?= $classColor; ?>"></div>
                        </div>

                        <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="cont-productos" role="tabpanel">
                            <!-- Carga el contenido desde JS -->
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($dataBestProducto = $data['productoBest']) {
                losMasPedidosMenu($data);
            }
            ?>
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
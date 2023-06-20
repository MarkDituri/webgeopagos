<?php
headerMenu($data);
navbarMenu($data);
?>
<!-- section main content -->
<section class="main-content" id="cont-all-confirm">
    <div class="container-xl">

        <div class="row">
            <div class="col-12 cont-exito">
                <h2>Tu pedido ha sido<br>confirmado con exito</h2>
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="col-lg-12">
                <?php
                if ($_SESSION['restaurante']['instagram'] != '') { ?>
                    <div id="cont-confirmacion" class="comments padding-15 rounded">
                        <h2>No olvides seguirnos en Instagram</h2>
                        <a class="btn-sin-pedido btn-ig" target="_blank" href="https://www.instagram.com/<?= $_SESSION['restaurante']['instagram'] ?>"><i class="fa-brands fa-instagram"></i>&nbsp Visitar cuenta</a>
                    </div>
                <?php } ?>
                <div class="con-qr-detalle">
                    <div class="img-qr"></div>
                    <h2 class="">Si deseas seguir ordenando, puede hacer
                        <a href="<?= base_url(); ?>/menu/resetmenu">Clic aquí</a>
                        para crear un nuevo pedido
                    </h2>
                </div>
                <div class="cont-ig-confirm">
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
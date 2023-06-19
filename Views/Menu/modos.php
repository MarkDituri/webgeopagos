<?php
headerMenu($data);
navbarMenu($data);
$classColor =     $_SESSION['restaurante']['class_color'];
?>
<!-- section Werlcome content -->
<section id="section-welcome" class="main-content mt-3">
    <div class="container-xl">
        <div class="row gy-4">
            <div class="col-lg-12 message">
                <div>                    
                    <h3>¡Bienvenido a <?= $_SESSION['restaurante']['nombre_rest'];?>!</h3>
                    <p>Elija una opción</p>
                </div>
            </div>
            <div class="col-lg-12 options_modos">
                <?php $dataModo = getIconModo('SITE');?>
                <a href="<?= base_url();?>/menu/setmodo?mod=SITE" class="opcModo comments bordered rounded">
                    <i class="fa-solid fa-utensils <?= $classColor . '_color'; ?>"></i>
                    <?= $dataModo['texto'];?>
                </a>
                <?php $dataModo = getIconModo('DELI');?>
                <a href="<?= base_url();?>/menu/setmodo?mod=DELI" class="opcModo comments bordered rounded">
                    <i class="fa-solid fa-motorcycle <?= $classColor . '_color'; ?>"></i>
                    <?= $dataModo['texto'];?>
                </a>
                <?php $dataModo = getIconModo('TAKE');?>
                <a href="<?= base_url();?>/menu/setmodo?mod=TAKE" class="opcModo comments bordered rounded">
                    <i class="fa-solid fa-bag-shopping <?= $classColor . '_color'; ?>"></i>
                    <?= $dataModo['texto'];?>
                </a>
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
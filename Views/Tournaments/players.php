<?php
headerView($data);
menu($data);

$players = $data['data'];
?>

<section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img" data-background="<?= base_url(); ?>/Assets/images/bg/bg-12.png">
    <div class="section-logo-text">
        <span class="title">GEOPAGOS</span>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-end mb-30-none">
            <div class="col-xl-12 col-lg-12 text-center mb-30">
                <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                    <h1 class="title">JUGADORES</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="breadcrumb-area">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jugadores</li>
        </ol>
    </nav>
</div>

<section class="trainer-section trainer-section--style trainer-section--style-two ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 text-center">
                <div class="section-header">
                    <h2 class="section-title"><span>JUGADORES</span> ENLISTADOS</h2>
                    <p>Lista de jugadores que participaran en los torneos de tenis en la simulación</p>
                </div>
            </div>
        </div>
        <div class="trainer-filter-wrapper">
            <div class="d-lg-flex justify-content-center button-group filter-btn-group">

                <button class="active" data-filter="*">Todos/as</button>
                <button data-filter=".male">Hombres</button>
                <button data-filter=".female">Mujeres</button>
            </div>
            <div class="grid">
                <?php
                foreach ($players as $player) {
                    $idPlayer = $player['id_player'];
                    $firstName = $player['first_name'];
                    $lastName = $player['last_name'];
                    $age = $player['age'];
                    $gender = $player['gender'];
                    $slug = $player['slug'];
                ?>
                    <div class="grid-item <?= $gender; ?> trainer">
                        <div class="trainer-item">
                            <div class="trainer-thumb">
                                <img src="<?= base_url(); ?>/Assets/images/trainer/player-<?= $gender; ?>.png" alt="trainer">
                                <div class="trainer-overlay">
                                    <div class="share-area">
                                        <div class="share-icon">
                                            <i class="fas fa-share-alt"></i>
                                        </div>
                                        <ul class="social-list">
                                            <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="trainer-content">
                                <h3 class="title"><a href="<?= base_url(); ?>/tournaments/player/<?= $slug; ?>/"><?= $firstName . ' ' . $lastName; ?></a></h3>
                                <span class="sub-title"><?= $age; ?> Años</span>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
        <div class="load-more-btn text-center mt-40">
            <a href="master.html"><img src="<?= base_url(); ?>/Assets/images/element/element-28.png" alt="element"></a>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Trainer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<?php
footer($data);
scripts($data);
?>
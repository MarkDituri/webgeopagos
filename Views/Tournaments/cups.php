<?php
headerView($data);
menu($data);

$cups = $data['data'];
?>

<section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img" data-background="<?= base_url(); ?>/Assets/images/bg/bg-12.png">
    <div class="section-logo-text">
        <span class="title">GEOPAGOS</span>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-end mb-30-none">
            <div class="col-xl-12 col-lg-12 text-center mb-30">
                <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                    <h1 class="title">TORNEOS</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="breadcrumb-area">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Torneos</li>
        </ol>
    </nav>
</div>



<section class="event-section event-section-two ptb-120">
    <div class="container">
        <div class="row justify-content-center mb-60-none">
            <?php
            foreach ($cups as $cup) {
                $id = $cup['id'];
                $name = $cup['name'];
                $description = $cup['description'];
                $type = $cup['type'];
                $direction = $cup['direction'];
                $year = $cup['year'];
                $gender = $cup['gender'];
                $slug = $cup['slug'];
                $created_at = $cup['created_at'];
        
                list($fecha, $hora) = explode(' ', $created_at);
                list($day, $month, $year) = explode('/', $fecha);
                $meses = Meses();
                $mes = $meses[(int)$month - 1];
                $mesAbreviado = substr($mes, 0, 3);
                list($hora, $minutos, $segundos) = explode(':', $hora);
            ?>
            <div class="col-xl-6 col-lg-6 mb-60">
                <div class="event-item">
                    <div class="event-thumb">
                        <img src="<?= base_url(); ?>/Assets/images/event/event-<?= $gender;?>.png" alt="event">
                    </div>
                    <div class="event-content">
                        <div class="event-meta-area">
                            <div class="event-post-meta">
                                <div class="event-location">
                                    <span><i class="fas fa-map-marker-alt"></i> <?= $direction; ?></span>
                                </div>
                                <div class="event-date">
                                    <span><i class="fas fa-clock"></i> <?= $hora.':'.$minutos; ?></span>
                                </div>
                            </div>
                            <div class="event-badge">
                                <h3 class="badge-title"><span><?= $day;?></span> <span class="month"><?= $mesAbreviado; ?></span></h3>
                            </div>
                        </div>
                        <h3 class="title"><a href="event-details.html"><?= $name; ?></a></h3>
                        <p><?= $description; ?></p>
                        <div class="btn btn--base mt-3">
                            <a href="<?= base_url();?>/tournaments/start/<?= $gender;?>">Simular torneo <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php
footer($data);
scripts($data);
?>
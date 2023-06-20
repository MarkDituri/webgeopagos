<?php
headerView($data);
menu($data);

$player = $data['data'];

?>

<section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img" data-background="<?= base_url(); ?>/Assets/images/bg/bg-12.png">
    <div class="section-logo-text">
        <span class="title">SWORD</span>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-end mb-30-none">
            <div class="col-xl-12 col-lg-12 text-center mb-30">
                <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                    <h1 class="title">MASTER <span>SINGLE</span></h1>
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

<?php
    $firstName = $player['first_name'];
    $lastName = $player['last_name'];
    $age = $player['age'];
    $gender = $player['gender'];
    $genderView = ($gender === 'male') ? 'Hombre' : 'Mujer';
    $country = $player['country'];
    $slug = $player['slug'];

    $force = $player['skill']['energy'];
    $speed = $player['skill']['speed'];
    $response = $player['skill']['aim'];
    $luck = $player['skill']['luck'];
?>
<section class="trainer-section trainer-details-section ptb-120">
    <div class="container">
        <div class="row justify-content-center align-items-center mb-30-none">
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="about-thumb">
                    <img src="<?= base_url(); ?>/Assets/images/trainer/player-<?= $gender; ?>.png" alt="about">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="trainer-about-content-area">
                    <div class="trainer-about-header">
                        <h2 class="title"><?= $firstName .' '. $lastName;?></h2>
                        <span class="sub-title"><?= $genderView; ?></span>
                        <div class="ratings">
                            <span><i class="fas fa-star"></i> 4.50 (09)</span>
                        </div>
                    </div>
                    <div class="trainer-about-body">
                        <p><b>Pais:</b> <?= $country;?></p>
                        <p><b>Edad:</b> <?= $age;?></p>
                    </div>                    
                    <ul class="trainer-about-social">
                        <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#0"><i class="fab fa-twitter"></i></a></li>                                
                        <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                    </ul>                        
                </div>
            </div>
        </div>

        <div class="skill-widget-area">
            <h3 class="widget-title">HABILIDADES</h3>
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="choose-item">
                        <div class="chart" data-percent="<?= $force; ?>"><span><?= $force; ?>%</span></div>
                        <h4 class="title">FUERZA</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="choose-item">
                        <div class="chart" data-percent="<?= $speed; ?>"><span><?= $speed; ?>%</span></div>
                        <h4 class="title">VELOCIDAD</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="choose-item">
                        <div class="chart" data-percent="<?= $response; ?>"><span><?= $response; ?>%</span></div>
                        <h4 class="title">RESPUESTA</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="choose-item">
                        <div class="chart" data-percent="<?= $luck; ?>"><span><?= $luck; ?>%</span></div>
                        <h4 class="title">SUERTE</h4>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</section>

<!-- <section class="trainer-section trainer-section--style trainer-section--style-two trainer-section--style-three ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 text-center">
                <div class="section-header">
                    <h2 class="section-title">More Training <span>Masters</span></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-10-none">
            <div class="col-xl-12">
                <div class="trainer-slider-two">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="trainer-item">
                                <div class="trainer-thumb">
                                    <img src="<?= base_url(); ?>/Assets/images/trainer/trainer-1.png" alt="trainer">
                                    <div class="trainer-overlay">
                                        <div class="share-area">
                                            <div class="share-icon">
                                                <i class="fas fa-share-alt"></i>
                                            </div>
                                            <ul class="social-list">
                                                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainer-content">
                                    <h3 class="title"><a href="master-details.html">Randall Schwartz</a></h3>
                                    <span class="sub-title">Women's Trainner</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="trainer-item">
                                <div class="trainer-thumb">
                                    <img src="<?= base_url(); ?>/Assets/images/trainer/trainer-2.png" alt="trainer">
                                    <div class="trainer-overlay">
                                        <div class="share-area">
                                            <div class="share-icon">
                                                <i class="fas fa-share-alt"></i>
                                            </div>
                                            <ul class="social-list">
                                                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainer-content">
                                    <h3 class="title"><a href="master-details.html">Randall Schwartz</a></h3>
                                    <span class="sub-title">Women's Trainner</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="trainer-item">
                                <div class="trainer-thumb">
                                    <img src="<?= base_url(); ?>/Assets/images/trainer/trainer-3.png" alt="trainer">
                                    <div class="trainer-overlay">
                                        <div class="share-area">
                                            <div class="share-icon">
                                                <i class="fas fa-share-alt"></i>
                                            </div>
                                            <ul class="social-list">
                                                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainer-content">
                                    <h3 class="title"><a href="master-details.html">Randall Schwartz</a></h3>
                                    <span class="sub-title">Women's Trainner</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="trainer-item">
                                <div class="trainer-thumb">
                                    <img src="<?= base_url(); ?>/Assets/images/trainer/trainer-4.png" alt="trainer">
                                    <div class="trainer-overlay">
                                        <div class="share-area">
                                            <div class="share-icon">
                                                <i class="fas fa-share-alt"></i>
                                            </div>
                                            <ul class="social-list">
                                                <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="#0"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainer-content">
                                    <h3 class="title"><a href="master-details.html">Randall Schwartz</a></h3>
                                    <span class="sub-title">Women's Trainner</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section> -->


<?php
footer($data);
scripts($data);
?>
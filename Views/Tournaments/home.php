<?php
headerView($data);
menu($data);
?>

<section class="banner">
    <div class="slider-prev">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="slider-next">
        <i class="fas fa-chevron-right"></i>
    </div>
    <div class="banner-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="banner-section banner-section-two">
                    <div class="banner-bg bg-overlay-black bg_img" data-background="<?= base_url(); ?>/Assets/images/bg/bg-10.png"></div>
                    <div class="container-fluid">
                        <div class="row justify-content-center align-items-end mb-30-none">
                            <div class="col-xl-12 col-lg-12 text-center mb-30">
                                <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                                    <span class="sub-title">DEVELOPMENT CHALLENGE FOR PREPAGOS</span>
                                    <h1 class="title">Te damos la bienvenida </h1>
                                    <h3 class="inner-title">al torneo geopagos cup</h3>
                                    <p>Por Marcos E. Dituri</p>
                                    <div class="banner-btn">
                                        <a href="apply.html" class="btn--base">Simular ahora <i class="fas fa-arrow-right ml-2"></i></a>
                                        <a href="training.html" class="btn--base active">Ver jugadores <i class="fas fa-arrow-right ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="#" class="scrollToTop">
    <img src="<?= base_url(); ?>/Assets/images/element/top.png" alt="element">
    <div class="scrollToTop-icon">
        <i class="fas fa-arrow-up"></i>
    </div>
</a>

<section class="service-section ptb-120">
    <div class="container">
        <div class="service-area">
            <div class="service-element">
                <img src="<?= base_url(); ?>/Assets/images/element/element-24.png" alt="element">
            </div>
            <div class="row justify-content-center mb-10-none">
                <div class="col-xl-12">
                    <div class="service-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="service-item">
                                    <div class="service-thumb">
                                        <img src="<?= base_url(); ?>/Assets/images/service/service-1.png" alt="service">
                                        <div class="service-overlay">
                                            <div class="service-overlay-content">
                                                <h3 class="title"><a href="training-details.html">VER JUGADORES MASCULINOS</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-item">
                                    <div class="service-thumb">
                                        <img src="<?= base_url(); ?>/Assets/images/service/service-2.png" alt="service">
                                        <div class="service-overlay">
                                            <div class="service-overlay-content">
                                                <h3 class="title"><a href="training-details.html">VER JUGADORAS FEMENINAS</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-item">
                                    <div class="service-thumb">
                                        <img src="<?= base_url(); ?>/Assets/images/service/service-3.png" alt="service">
                                        <div class="service-overlay">
                                            <div class="service-overlay-content">
                                                <h3 class="title"><a href="training-details.html">SIMULAR UN TORNEO</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
footer($data);
scripts($data);
?>
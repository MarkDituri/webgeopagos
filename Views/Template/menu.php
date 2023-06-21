<?php
// $dataRestaurante = $_SESSION['restaurante'];
// $classColor =      $_SESSION['restaurante']['class_color'];
?>
<!-- preloader -->

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="preloader">
    <div class="">
        <div class="loader-thumb">
            <svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a">
                        <stop stop-color="#8f2df5" stop-opacity="0" offset="0%" />
                        <stop stop-color="#8f2df5" stop-opacity=".631" offset="63.146%" />
                        <stop stop-color="#8f2df5" offset="100%" />
                    </linearGradient>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)">
                        <path d="M36 18c0-9.94-8.06-18-18-18" id="Oval-2" stroke="url(#a)" stroke-width="2">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s" repeatCount="indefinite" />
                        </path>
                        <circle fill="#8f2df5" cx="36" cy="18" r="1">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s" repeatCount="indefinite" />
                        </circle>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>

<header class="header-section header-section-two">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container-fluid">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-xl p-0">
                        <a class="site-logo site-title d-block d-xl-none" href="<?= base_url(); ?>/tournaments/"><img src="<?= base_url(); ?>/assets/images/logo-2.png" alt="site-logo"></a>
                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ml-auto mr-auto">
                                <li><a class="site-logo site-title d-none d-xl-block" href="<?= base_url(); ?>/tournaments/"><img src="<?= base_url(); ?>/assets/images/logo-2.png" alt="site-logo"></a>
                                </li>
                                <li class="menu_has_children">
                                    <a href="<?= base_url(); ?>/tournaments/">HOME</a>
                                </li>
                                <li><a href="<?= base_url(); ?>/tournaments/players">JUGADORES</a></li>
                                <li><a href="<?= base_url(); ?>/tournaments/cups">TORNEOS</a></li>
                                <li><a class="btnStart btn--base" href="<?= base_url(); ?>/tournaments/cups">SIMULAR</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
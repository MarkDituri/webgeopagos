<?php
headerView($data);
menu($data);

$playoffs = $data['playoff'];
$tournament = $data['tournament'];
$winnerCup = $data['winnerCup'];

getModal('modalWinner', $data);
?>

<section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img" data-background="<?= base_url(); ?>/Assets/images/event/event-bg-<?= $tournament[0]['gender'];?>.png">
    <div class="section-logo-text">
        <span class="title">GEOPAGOS</span>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-end mb-30-none">
            <div class="col-xl-12 col-lg-12 text-center mb-30">
                <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                    <h1 class="title">SIMULACIÓN DE <?= $tournament[0]['name'];?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="breadcrumb-area">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>/tournaments/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Torneos</li>
        </ol>
    </nav>
</div>

<section class="event-section event-section-two ptb-20">
    <div class="container">
        <div class="row justify-content-center mb-60-none">
            <div class="playoff-table">
                <div class="playoff-table-content">
                    <!-- OCTAVOS -->
                    <div class="playoff-table-tour">
                        <h4>Octavos</h4>
                        <div class="playoff-table-group">
                            <?php
                            foreach ($playoffs['8tavos'] as $octavos) {
                                $player1 = $octavos['player1'];
                                $player2 = $octavos['player2'];

                                $classPJ1 = ($player1['winner']) ? 'winner' : '';
                                $classPJ2 = ($player2['winner']) ? 'winner' : '';

                                $tagWinner1 = ($player1['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                                $tagWinner2 = ($player2['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                            ?>
                                <div class="playoff-table-pair playoff-table-pair-style">
                                    <div class="playoff-table-left-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ1; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player1['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player1['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner1; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player1['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player1['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="playoff-table-right-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ2; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player2['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player2['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner2; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player2['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player2['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- CUARTOS -->
                    <div class="playoff-table-tour">
                        <h4>Cuartos</h4>
                        <div class="playoff-table-group">
                            <?php
                            foreach ($playoffs['4tos'] as $cuartos) {
                                $player1 = $cuartos['player1'];
                                $player2 = $cuartos['player2'];

                                $classPJ1 = ($player1['winner']) ? 'winner' : '';
                                $classPJ2 = ($player2['winner']) ? 'winner' : '';

                                $tagWinner1 = ($player1['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                                $tagWinner2 = ($player2['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                            ?>
                                <div class="playoff-table-pair playoff-table-pair-style">
                                    <div class="playoff-table-left-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ1; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player1['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player1['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner1; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player1['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player1['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="playoff-table-right-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ2; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player2['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player2['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner2; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player2['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player2['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- SEMIFINAL -->
                    <div class="playoff-table-tour">
                        <h4>Semifinal</h4>
                        <div class="playoff-table-group">
                            <?php
                            foreach ($playoffs['Semifinals'] as $semifinals) {
                                $player1 = $semifinals['player1'];
                                $player2 = $semifinals['player2'];

                                $classPJ1 = ($player1['winner']) ? 'winner' : '';
                                $classPJ2 = ($player2['winner']) ? 'winner' : '';

                                $tagWinner1 = ($player1['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                                $tagWinner2 = ($player2['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                            ?>
                                <div class="playoff-table-pair playoff-table-pair-style">
                                    <div class="playoff-table-left-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ1; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player1['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player1['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner1; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player1['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player1['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="playoff-table-right-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ2; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player2['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player2['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner2; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player2['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player2['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- FINAL -->
                    <div class="playoff-table-tour">
                        <h4>Final</h4>
                        <div class="playoff-table-group">
                            <?php
                            foreach ($playoffs['Final'] as $final) {
                                $player1 = $final['player1'];
                                $player2 = $final['player2'];

                                $classPJ1 = ($player1['winner']) ? 'winner' : '';
                                $classPJ2 = ($player2['winner']) ? 'winner' : '';

                                $tagWinner1 = ($player1['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                                $tagWinner2 = ($player2['winner']) ? "<div class='playoff-player-win'>win</div>" : "";
                            ?>
                                <div class="playoff-table-pair playoff-table-pair-style">
                                    <div class="playoff-table-left-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ1; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player1['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player1['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner1; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player1['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player1['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="playoff-table-right-player faq-wrapper">
                                        <div class="faq-item <?= $classPJ2; ?>">
                                            <div class="faq-title">
                                                <div>
                                                    <h3 class="playoff-player-name"><?= $player2['data']['first_name']; ?></h3>
                                                    <h4 class="playoff-player-lastname"><?= $player2['data']['last_name']; ?></h3>
                                                </div>
                                                <?= $tagWinner2; ?>
                                            </div>
                                            <div class="faq-content">
                                                <div class="skills">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($player2['data']['skill'] as $skill) {
                                                        $arrayNames = array('Fuerza', 'Velocidad', 'Respuesta', 'Suerte');
                                                    ?>
                                                        <label for="force"><?= $arrayNames[$i]; ?></label>
                                                        <div class="progress-total">
                                                            <div class="progress-var" style="width:<?= $skill; ?>%"></div>
                                                        </div>
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                </div>
                                                <a class="btn" href="<?= base_url(); ?>/tournaments/player/<?= $player2['data']['slug']; ?>">Ver jugador</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- END FINAL -->
                </div>
            </div>

        </div>
    </div>
</section>

<?php
footer($data);
scripts($data);
?>
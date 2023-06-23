<div class="modal" id="modalWinner" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img src="<?= base_url();?>/Assets/images/event/winner.png" alt="">
        <h4>¡El ganador de esta simulacion es!</h4>
        <h3 class="title"><?= $data['winnerCup']['players']['first_name'].' '.$data['winnerCup']['players']['last_name']?></h3>        
      </div>
    </div>
  </div>
</div>
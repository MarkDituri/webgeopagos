<?php
headerAdmin($data);
getModal('modalSliders', $data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><?= $data['page_title'] ?>
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">     
            <div class="row">                
                
                <div class="col-lg-6 cont-qr">                    
                    <div id="print_150x150">
                      <?php 
                        $codeIndex = $_SESSION['userData']['identificacion'];
                        $url_menu = $_SESSION['userData']['url'];
                        ?>
                      <img style="border: 1px dotted gray;" class="qr-rec" src="<?= media(); ?>/images/uploads/qr/qr_<?=$url_menu;?>_150x150.jpg" >
                    </div>
                    <div class="cont-btns">
                        <div class="">
                            <h5><b>Medidas:</b> 4x4cm</h5>
                        </div>
                        <a class="btn btn-primary btn-print" onclick="print150x150()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                        <a class="btn btn-primary btn-print-2" onclick="print150x150_cut()"><i class="fa fa-scissors"></i> Para recorte</a>
                    </div>                    
                </div>        

                <div class="col-lg-6 cont-qr">                  
                    <div id="print_200x200">
                      <?php $codeIndex = $_SESSION['userData']['identificacion'];?>
                      <img style="border: 1px dotted gray;" class="qr-rec" src="<?= media(); ?>/images/uploads/qr/qr_<?=$url_menu;?>_200x200.jpg" >
                    </div>
                    <div class="cont-btns">
                        <div class="">
                            <h5><b>Medidas:</b> 5x5cm</h5>
                        </div>
                        <a class="btn btn-primary btn-print" onclick="print200x200()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                        <a class="btn btn-primary btn-print-2" onclick="print200x200_cut()"><i class="fa fa-scissors"></i> Para recorte</a>
                    </div>                    
                </div>  

              </div>       
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php footerAdmin($data); ?>
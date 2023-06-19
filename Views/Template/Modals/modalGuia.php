<!-- Modal -->
<div class="modal fade modalTypeOne" id="modalViewQR" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header-noty header-primary">
        <h5 class="modal-title" id="titleModalNoty"><i class="fa-solid fa-bell"></i>&nbsp&nbspVer mi Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 class="headline">Puedes escanear el codigo QR para ver tu Menú en tiempo real</h2>
        <div class="app-menu_qr">
          <img src="<?= base_url(); ?>/Assets/images/uploads/qr/qr_<?= $_SESSION['userData']['url']; ?>_200x200.jpg" alt="">
        </div>
        <div class="cont-link">
          <h3 class="txtLink">Link del Menú:</h3>
          <p>También puedes usar este Link para compartirlo por donde desees</p>
          <div class="form-control form-div" id="txtLink">
            <a class="inpUrlCopy" target="_blank" href='<?= linkMenu() ?>'><?= linkMenu(); ?></a>
            <button onclick="btnCopy()" id="urlCopy" class="divCopy"><i class="fa-regular fa-clone"></i> Copiar</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeModalQR" class="btn btn-modalTypeOne" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
      </div>
    </div>
  </div>
</div>
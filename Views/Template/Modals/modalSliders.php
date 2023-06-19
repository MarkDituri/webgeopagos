<!-- Crear y actualizar Modal -->
<div class="modal fade" id="modalFormSliders" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSliders" name="formSliders" class="form-horizontal">
          <input type="hidden" id="id_slider" name="id_slider" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="cont-switch">
                  <b>Estado *</b>
                  <label class="switch">
                    <input type="checkbox" id="listStatus" name="listStatus" checked>
                    <span class="slider round"></span>
                  </label>
                  <span id="txtSwitch" style="font-weight: normal;">Activado</span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Titulo <span class="required">*</span></label>
                <input class="form-control" id="txtTitulo" name="txtTitulo" type="text" placeholder="Titulo del slider" autocomplete="off" required="">
              </div>
              <div class="form-group">
                <label class="control-label">Tag <span class="required">*</span></label>
                <input class="form-control" id="txtTag" name="txtTag" type="text" placeholder="Promo, descuento, etc" autocomplete="off" required="">
              </div>
            </div>
            <div class="col-md-5">
              <div class="photo">
                <label for="foto">Portada:</label>
                <div class="prevPhoto">
                  <span class="delPhoto notBlock"><i class="fa fa-fw fa-lg fa-times-circle"></i></span>
                  <label for="foto"></label>
                  <div class="div-img-pop">
                    <img class="img-defect" id="img" src="<?= base_url(); ?>/Assets/images/uploads/portada_categoria.png">
                  </div>
                </div>
                <br>
                <div class="alert-info-cont">
                  <p class="text-primary">Tamaño recomendado 380 x 190px</p>
                </div>
                <div class="upimg">
                  <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
              </div>
            </div>
          </div>

          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ver Modal -->
<div class="modal fade" id="modalViewSlider" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal"><i class="far fa-eye"></i>&nbsp Datos de la Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="txtBold">Titulo:</td>
              <td id="celTitulo"></td>
            </tr>
            <tr>
              <td class="txtBold">Estado:</td>
              <td id="celStatus"></td>
            </tr>
            <tr>
              <td class="txtBold">Tag</td>
              <td id="celTag"></td>
            </tr>
            <tr>
              <td class="txtBold">Portada:</td>
              <td id="celFotos"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProductos" name="formProductos" class="form-horizontal">
          <input type="hidden" id="id_producto" name="id_producto" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">

          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-7">
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
                <label for="listCategoria">Categoría <span class="required">*</span></label>
                <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required=""></select>
              </div>
              <div class="form-group">
                <label class="control-label">Titulo <span class="required">*</span></label>
                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre Producto" required="" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Descripción <span class="required">*</span></label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción Producto" autocomplete="off"></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Precio <span class="required">*</span></label>
                <input class="form-control" id="txtPrecio" name="txtPrecio" type="number" placeholder="Precio" required="" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4">
              <div class="photo">
                <label for="foto">Foto:</label>
                <div class="prevPhoto">
                  <span class="delPhoto notBlock"><i class="fa fa-fw fa-lg fa-times-circle"></i></span>
                  <label for="foto"></label>
                  <div class="div-img-pop">
                    <img class="img-defect" id="img" src="<?= base_url(); ?>/Assets/images/uploads/portada_prod.png">
                  </div>
                </div>
                <br>
                <div class="alert-info-cont">
                  <p class="text-primary">Tamaño recomendado 200 x 200px</p>
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

<!-- Modal -->
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal"><i class="far fa-eye"></i>&nbsp Datos de la Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="txtBold">Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td class="txtBold">Estado:</td>
              <td id="celStatus"></td>
            </tr>
            <tr>
              <td class="txtBold">Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td class="txtBold">Categoria</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td class="txtBold">Precio</td>
              <td><div id="celPrecio"></div></td>
            </tr>

            <tr>
              <td class="txtBold">Foto:</td>
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
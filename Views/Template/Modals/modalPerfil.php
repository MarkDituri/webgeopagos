<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPerfil" name="formPerfil" class="form-horizontal">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <h5><i class="fa fa-user"></i>&nbsp Cuenta</h5>
          <br>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtEmail">Email</label>
              <input type="hidden" name="txtEmail" id="txtEmail" value="<?= $_SESSION['userData']['email_user']; ?>">
              <div class="form-control form-div" id="txtEmail"><?= $_SESSION['userData']['email_user']; ?></div>
            </div>
            <div class="form-group col-md-6">
              <label for="txtNombres">Nombres <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtNombres" name="txtNombres" value="<?= $_SESSION['userData']['nombres']; ?>" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtApellidos">Apellidos <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtApellidos" name="txtApellidos" value="<?= $_SESSION['userData']['apellidos']; ?>" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtTelefono">Teléfono <span class="required">*</span></label>
              <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" value="<?= $_SESSION['userData']['telefono']; ?>" required="" onkeypress="return controlTag(event);">
            </div>
          </div>
          <br>

          <h5><i class="fa fa-dumpster"></i>&nbsp Comercio</h5>
          <br>
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group col-md-12 sinPad">
                <label for="txtIdentificacion">Key</label>
                <input type="hidden" name="txtIdentificacion" id="txtIdentificacion" value="<?= $_SESSION['userData']['identificacion']; ?>">
                <div class="form-control form-div"><?= $_SESSION['userData']['identificacion']; ?></div>
              </div >
              <div class="form-group col-md-12 sinPad">
                <label for="txtNombreRest">Nombre de tu comercio <span class="required">*</span></label>
                <input type="text" class="form-control valid validText" id="txtNombreRest" name="txtNombreRest" value="<?= $_SESSION['userData']['nombre_rest']; ?>" required="" autocomplete="off" >
              </div>
            </div> 
            <div class="col-md-6">
              <div class="photo">
                <label for="foto">Logo de tu marca:</label>
                <div class="prevPhoto">
                  <span class="delPhoto notBlock"><i class="fa fa-fw fa-lg fa-times-circle"></i></span>
                  <label for="foto"></label>
                  <div class="div-img-pop">
                    <img class="img-defect" id="img" src="<?= base_url(); ?>/Assets/images/uploads/portada_logo.png">
                  </div>
                </div>      
                <br>  
                <div class="alert-info-cont">
                  <p class="text-primary">Tamaño recomendado 140 x 38px</p>
                </div>                    
                <br>
                <div class="upimg">  
                  <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
              </div>
            </div>

            <div class="col-md-12">
              <!--Direccion-->
              <div class="form-row">
                <div class="form-group col-md-4 sinPad">
                  <label for="txtDireccion">Dirección</label>
                  <input type="text" class="form-control valid" id="txtDireccion" name="txtDireccion" value="<?= $_SESSION['userData']['direccion']; ?>" autocomplete="off">
                </div>   
                <div class="form-group col-md-2 sinPad">
                  <label for="txtNumero">N°</label>
                  <input type="number" class="form-control valid validNumber" id="txtNumero" name="txtNumero" value="<?= $_SESSION['userData']['numero']; ?>" autocomplete="off">
                </div>   
                <div class="form-group col-md-6 sinPad">
                  <label for="txtLocalidad">Localidad</label>
                  <input type="text" class="form-control valid" id="txtLocalidad" name="txtLocalidad" value="<?= $_SESSION['userData']['localidad']; ?>" autocomplete="off">
                </div>   
                <!--REDES-->
                <div class="form-group col-md-6 sinPad">
                  <label for="txtFacebook"><i class="fa fa-facebook-f"></i> Facebook</label>
                  <input type="text" class="form-control valid" id="txtFacebook" name="txtFacebook" value="<?= $_SESSION['userData']['facebook']; ?>" autocomplete="off" >
                </div>   
                <div class="form-group col-md-6 sinPad">
                  <label for="txtInstagram"><i class="fa fa-instagram"></i> Instagram</label>
                  <input type="text" class="form-control valid" id="txtInstagram" name="txtInstagram" value="<?= $_SESSION['userData']['instagram']; ?>" autocomplete="off" >
                </div>   
              </div>

            </div> 
          </div>

          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-edit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalFormClave" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" >
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">
          <i style="color: #421875;" class="fa fa-key" aria-hidden="true"></i>&nbspCambiar clave
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCrear" name="formCrear" class="form-horizontal">       
          <div class="form-row">
            <div class="form-group col-sm-12 col-md-12 col-lg-12" id="msg-gral">						
            </div>    
            <div class="form-group col-md-12">
              <label for="txtNombres">Nueva contraseña <span class="required">*</span></label>
              <input type="password" class="form-control valid" id="txtPassword" name="txtPassword" value="">
              <div class="Mensaje" id="msg-txtPassword"></div>
            </div>
            <div class="form-group col-md-12">
              <label for="txtNombres">Confirmar contraseña <span class="required">*</span></label>
              <input type="password" class="form-control valid" id="txtPasswordConfirm" name="txtPasswordConfirm" value="">
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
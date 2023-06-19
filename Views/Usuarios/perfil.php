<?php
  headerAdmin($data);  
  getModal('modalPerfil',$data);

 ?>
<main class="app-content">    
    <div class="row">
      <div class="col-md-12 col-lg-7 col-xl-8">
        <div class="app-title">
          <div>
            <h1><?= $data['page_title'] ?>
            </h1>
          </div>      
        </div>
        <div class="tile">
          <div class="tile-body">
            <div class="table-responsive">
              <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                  <div class="timeline-post">
                    <div class="post-media">
                      <div class="content">
                        <h5>Datos de la cuenta&nbsp&nbsp
                          <?php
                            if($_SESSION['permisosMod']['u']){
                              $btnEdit = '<button class="btn-edit-sm" onClick="fntEditUsuario('.$_SESSION['userData']['id_restaurante'].')"  title="Editar Perfil"><i class="fas fa-pencil-alt"></i> &nbspEditar</button>';
                              echo $btnEdit;
                            }
                          ?>                        
                      </div>
                    </div>
                    <table class="table table-bordered" id="tablePerfil">
                      <thead>
                        <tr>
                          <th colspan="2"><i class="fa fa-user"></i>&nbsp Cuenta</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Email (Usuario):</td>
                          <td><?= $_SESSION['userData']['email_user']; ?></td>
                        </tr>
                        <tr>
                          <td>Contraseña:</td>
                          <td><button class="btn btn-primary-sm" onClick="fntEditClave('<?=$_SESSION['userData']['id_restaurante'];?>')"><i class="fa fa-key"></i> Cambiar clave</button></td>
                        </tr>
                        <tr>
                          <td>Nombres:</td>
                          <td><?= $_SESSION['userData']['nombres']; ?></td>
                        </tr>
                        <tr>
                          <td>Apellidos:</td>
                          <td><?= $_SESSION['userData']['apellidos']; ?></td>
                        </tr>
                        <tr>
                          <td>Teléfono:</td>
                          <td><?= $_SESSION['userData']['telefono']; ?></td>
                        </tr>
                    
                      </tbody>
                      <thead>
                        <tr>
                          <th colspan="2"><i class="fa fa-dumpster"></i>&nbsp Comercio</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Link del Menú:</td>      
                          <td>
                            <div class="form-control form-div" id="txtLink">
                              <a class="inpUrlCopy" target="_blank" href='<?= linkMenu() ?>'><?= linkMenu();?></a>                              
                              <button onclick="btnCopy()" id="urlCopy" class="divCopy"><i class="fa-regular fa-clone"></i> Copiar</button>
                            </div>                            
                          </td>
                        </tr>
                        <tr>
                          <td>Logo de tu marca:</td>      
                          <td><img class="img-logo" src="<?= base_url(); ?>/Assets/images/uploads/<?=$_SESSION['userData']['url_logo'];?>"></td>
                        </tr>
                        <tr>
                          <td>Nombre del comercio:</td>      
                          <td><?= $_SESSION['userData']['nombre_rest']; ?></td>
                        </tr>
                        <tr>
                          <td>Key:</td>
                          <td><?= $_SESSION['userData']['identificacion']; ?></td>
                        </tr>      
                        <tr>
                          <td>Dirección:</td>
                          <?php 
                            $direccion = $_SESSION['userData']['direccion'];
                            $direccion_view = $direccion == "" ? '' : $direccion.", ";
                            
                            $numero = $_SESSION['userData']['numero'];        
                            $numero_view = $numero == 0 ? '' : $numero;
                          ?>
                          <td><?= $direccion_view." ".$numero_view; ?></td>
                        </tr>     
                        <tr>
                          <td>Localidad:</td>
                          <td><?= $_SESSION['userData']['localidad']?></td>
                        </tr>  
                        <tr>
                          <td><i class="fa fa-facebook-f"></i>&nbsp&nbspFacebook:</td>
                          <td><?= $_SESSION['userData']['facebook']?>
                            <a target="_blank" href="https://www.facebook.com/<?= $_SESSION['userData']['facebook']?>">
                            <?php if($_SESSION['userData']['facebook'] != ''){
                              print("<i class='fa fa-paperclip'></i> Probar link");
                            }?>
                            </a>
                          </td>
                        </tr>   
                        <tr>
                          <td><i class="fa fa-instagram"></i>&nbsp&nbspInstagram:</td>
                          <td><?= $_SESSION['userData']['instagram']?>
                            <a target="_blank" href="https://www.instagram.com/<?= $_SESSION['userData']['instagram']?>">
                            <?php if($_SESSION['userData']['instagram'] != ''){
                            print("<i class='fa fa-paperclip'></i> Probar link");
                            }?>
                            </a>
                          </td>
                        </tr>           
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="user-settings">
                  <div class="tile user-settings">
                    <h4 class="line-head">Datos fiscales</h4>
                    <form id="formDataFiscal" name="formDataFiscal">
                      <div class="row mb-4">
                        <div class="col-md-6">
                          <label>Identificación Tributaria</label>
                          <input class="form-control" type="text" id="txtNit" name="txtNit" value="<?= $_SESSION['userData']['nit']; ?>">
                        </div>
                        <div class="col-md-6">
                          <label>Nombre fiscal</label>
                          <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" value="<?= $_SESSION['userData']['nombrefiscal']; ?>" >
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-4">
                          <label>Dirección fiscal</label>
                          <input class="form-control" type="text" id="txtDirFiscal" name="txtDirFiscal" value="<?= $_SESSION['userData']['direccionfiscal']; ?>">
                        </div>
                      </div>
                      <div class="row mb-10">
                        <div class="col-md-12">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-lg-5 col-xl-4">
        <div class="app-title">
          <div>
            <h1>Opciones
            </h1>
          </div>      
        </div>
        <div class="tile">
          <div class="tile-body">
            <div class="table-responsive">
              <div class="tab-content">
              <div class="tab-pane active" >
                  <div class="timeline-post">
                    <div class="post-media">
                      <div class="content">
                        <h5>Modo oscuro               
                      </div>
                    </div>
                    
                    <input type="hidden" id="dark_mode_SESSION" value="<?= $_SESSION['userData']['dark_mode']?>">
                    <?php 
                      if ($_SESSION['userData']['dark_mode'] == 1) {
                        $classActive = "active_dark";
                        $classDesactive = "";
                      } else {
                        $classActive = "";
                        $classDesactive = "active_dark";
                      }
                    ?>
                    <div class="btn-modeDark">
                        <button class="btn-darkMode <?=$classActive;?>" onclick="cambiarDarkMode(1)"><i class="fa fa-moon"></i> Activado</button>
                        <button class="btn-darkMode <?=$classDesactive;?>" onclick="cambiarDarkMode(0)">Desactivado</button>
                    </div>

                  </div>
                </div>

                <br>

                <div class="tab-pane active" id="user-timeline">
                  <div class="timeline-post">
                    <div class="post-media">
                      <div class="content">
                        <h5>Color de tu Menu                  
                      </div>
                    </div>
                    
                    <input type="hidden" id="id_color_SESSION" value='<?= $_SESSION['userData']['id_color']?>'>
                    <div class="cont-colores" id="cont-colores"></div>

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
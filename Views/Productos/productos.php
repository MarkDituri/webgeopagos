<?php
headerAdmin($data);
getModal('modalProductos', $data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><?= $data['page_title'] ?>
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <?php if ($_SESSION['permisosMod']['w']) { ?>
        <button class="btn btn-primary" type="button" onclick="openModal();"><i class='fa fa-plus'></i>&nbsp&nbspNuevo Producto</button>
      <?php } ?>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">                        
            <table class="table table-hover table-bordered" id="tableProductos">                          
              <thead>
                <tr>
                  <th>Portada</th>
                  <th>Estado</th>
                  <th>Categoria</th>                  
                  <th>Titulo</th>                                    
                  <th>Precio</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>
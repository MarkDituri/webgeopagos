<?php
headerAdmin($data);
getModal('modalPedido', $data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><?= $data['page_title'] ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tablePedidos">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Estado</th>
                  <th>Modo</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Acciones</th>
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
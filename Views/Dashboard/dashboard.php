<?php

use Spipu\Html2Pdf\Tag\Html\I;


headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa-solid fa-grid-horizontal"></i> <?= $data['page_title'] ?></h1>
    </div>
  </div>
  <div class="row">
    <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
      <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="<?= base_url(); ?>/" class="linkw">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-qrcode fa-3x"></i>
            <div class="info">
              <h4>QR Escaneado</h4>
              <p><b><?= $data['QR'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
      <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="<?= base_url(); ?>/categorias" class="linkw">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Categorias activas</h4>
              <p><b><?= $data['categorias'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
      <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="<?= base_url(); ?>/productos" class="linkw">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
            <div class="info">
              <h4>Productos activos</h4>
              <p><b><?= $data['productos'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
      <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="<?= base_url(); ?>/pedidos" class="linkw">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
            <div class="info">
              <h4>Pedidos entregados</h4>
              <p><b><?= $data['pedidos'] ?></b></p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
  <div class="row">
    <!-- <div class="col-md-4">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Novedades</h3> 
            </div>
            <div id="carrousel-nov">
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="<?= base_url(); ?>/images/novedad-1.png" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"></span>
                </button>
              </div>
            </div>
          </div>
        </div> -->

    <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
      <div class="col-md-12 col-lg-12 col-xl-8">
        <div class="tile">
          <h3 class="tile-title">Últimos Pedidos</h3>
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Estado</th>
                <th>Fecha y hora</th>
                <th class="text-right">Monto</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($data['lastOrders']) > 0) {
                foreach ($data['lastOrders'] as $pedido) {
              ?>
                  <tr>
                    <?php                            
                    $dataStatus = getStatusCarrito($pedido['status']);
                    ?>
                    <td><span><?= $pedido['code_session']; ?></span></td>
                    <td><span class='badge <?= $dataStatus['clase']; ?>'><?= $dataStatus['texto']; ?></span></td>
                    <td>
                      <span style="color: darkgrey;">
                        <i class="fa fa-calendar"></i> <?= $pedido['fecha']; ?>&nbsp&nbsp&nbsp                        
                        <i class="fa fa-clock"></i><?= $pedido['hora']; ?>                        
                      </span>
                    </td>
                    <td class="text-right"><?= SMONEY . " " . formatMoney($pedido['total']) ?></td>
                    <!-- <td><a href="<?= base_url(); ?>/pedidos/orden/<?= $pedido['id_pedido'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>  -->
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
      <div class="col-md-12 col-lg-12 col-xl-4">
        <div class="tile">
          <h3 class="tile-title">Los más Pedidos</h3>
          <table class="table table-striped table-sm">
            <?php
            if ($data['pedidosTop'] == false) { ?>
              <thead>
                <tr>
                  <td style="width: 100%;">
                    <span style="width: 100%;line-height: 25px;"><b>No hay datos suficientes</b></span><br>
                    <span>A medida de que tus clientes confirmen pedidos, el sistema mostrara los productos más pedidos en esta sección</span>
                  </td>
                </tr>
              </thead>
            <?php } else if (count($data['pedidosTop']['productos']) > 0) { ?>
              <thead>
                <tr>
                  <th>Foto</th>
                  <th>Titulo</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data['pedidosTop']['productos'] as $pedido) {
                  $titulo = $pedido['titulo'];
                  $precio = "$" . $pedido['precio'];
                  $urlImg = $pedido['url_img'];
                ?>
                  <tr>
                    <td><img style="width: 40px; max-width: 40px" src="<?= base_url(); ?>/Assets/images/uploads/<?= $urlImg ?>"></td>
                    <td><?= $titulo ?></td>
                    <td><?= $precio ?></td>
                  </tr>
              <?php }
              } ?>
              </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
      <!-- <div class="col-md-8">
          <div class="tile row">
            <div class="col-12 sinNada">
              <h3 class="tile-title">Pagos/Plan</h3>
            </div>
 
            <div class="col-6">
              <div class="cont-rowFechas row">
                <?php
                if (count($data['creacion']) > 0) {
                }

                ?>
                  <h4 class="col-12 label"><b>Fecha de creación</b></h4>
                  <?php
                  foreach ($data['creacion'] as $creacion) {
                    $dataCreated = $creacion['datecreated'];
                    $fechaEntera = strtotime($dataCreated);
                    $fechaBase = date("d-m-Y", $fechaEntera);
                    $mes = date("m", $fechaEntera);
                    $dia = date("d", $fechaEntera);
                    $mes = mesesEspa("$mes");

                    echo "<h5 class='col-12 fecha'>$dia de $mes</h5>";

                    //sumo 1 día
                    // echo date("d-m-Y",strtotime($fechaBase."+ 1 days")); 
                  }
                  ?>              
              </div>
              <div class="cont-rowFechas row">
                  <h4 class="col-12 label">Fecha de vencimiento</h4>
                  <h5 class="col-12 fecha">30 de Noviembre</h5>       
              </div>
            </div>

            <div class="col-6">
              <div class="cont-rowFechas row">
                  <h4 class="col-12 label"><b>Proximo pago</b></h4>
                  <h5 class="col-12 fecha">30 de Octubre</h5>       
              </div>
              <div class="cont-rowFechas row">
                  <h4 class="col-12 label">Ultimo pago</h4>
                  <h5 class="col-12 fecha">30 de Octubre</h5>       
              </div>
            </div>

          </div>
        </div> -->
    <?php } ?>
  </div>

  <!-- <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por mes</h3>
              <div class="dflex">
                <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaMes"></div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por año</h3>
              <div class="dflex">
                <input class="ventasAnio" name="ventasAnio" placeholder="Año" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaAnio"></div>
          </div>
        </div>
      </div> -->

</main>
<?php footerAdmin($data); ?>
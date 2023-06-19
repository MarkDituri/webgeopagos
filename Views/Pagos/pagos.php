<?php
headerAdmin($data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Ultimo pago
      </h1>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12 col-lg-7 col-xl-8">
        <div class="tile">
            <div class="row tile-body cont-PagoActual">    
     
                <div class="col-md-6">                
                    <h3>Total a Pagar</h3>
                    <input type="hidden" id="id_pago" value=""></input> 
                    <h5 id="celEstado" class="pago"></h5> 
                    <h5><i class="fa-solid fa-calendar-days"></i>&nbspVencimiento: <span id="celVencimiento">00/00/0000</span></h5>
                    <h2><span id="celMonto">$0</span></h2>
                </div>

                <div class="col-md-6">                            
                    <h5>Plan: <span id="celPlan"></span></h5>
                    <h5 style="font-weight: 500;">Numero de Pago: FQ<span id="celIdPago"></span></h5>    
                    <h5 style="font-weight: 500;">Fecha de Cierre: <span id="celCierre">00/00/0000</span></h5>               
                    <div id="btnPagar">
                      <div class="checkout-btn"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-5 col-xl-4">
        <div class="tile">
            <div class="row tile-body cont-PagoActual"> 
                <div class="col-md-12">                            
                    <h5>¿Necesitas ayuda? <span></span></h5><br>
                    <p>Podes contactarte con nosotros escribiendonos a: <a href="mailto:<?= EMAIL_SOPORTE;?>"><?= EMAIL_SOPORTE;?></a>
                      o llamando al <a href="tel:<?= TELEMPRESA;?>"><?= TELEMPRESA;?></a> 
                    </p>                    
                </div>
            </div>
        </div>
    </div>
  </div>


  <div class="app-title">
    <div>
      <h1>Pagos anteriores
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">            
            <table class="table table-hover table-bordered" id="tablePagos">                          
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Estado</th>
                  <!-- <th>Imagen</th> -->
                  <th>Vencimiento</th>
                  <th>Plan</th>         
                  <th>Monto</th>                             
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
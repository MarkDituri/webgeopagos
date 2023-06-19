<!-- Modal -->
<div class="modal fade" id="modalViewPedido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal"><i class="far fa-eye"></i>&nbspDatos del Pedido</h5>
        <div id="printBtn"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-bordered table-50">
          <tbody>
            <tr>  
              <td class="txtBold">Codigo:</td>
              <td id="celCode"></td>
            </tr>
            <tr>
              <td class="txtBold">Fecha y hora:</td>
              <td id="celFecha"></td>
            </tr> 
            <tr>
              <td class="txtBold">Estado:</td>
              <td id="celEstado"></td>
            </tr>       
            <tr>
              <td class="txtBold">Modo:</td>
              <td id="celModo"></td>
            </tr>      
            <tr id="celMesa">        
            </tr>           
          </tbody>
        </table>

        <div id="contComensal">      
        </div>
        
        <div id="txtDetalle">                                                        
        </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
      </div>
    </div>
  </div>
</div>
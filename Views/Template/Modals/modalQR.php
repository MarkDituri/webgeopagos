<!-- Modal -->
<div class="modal fade modalTypeOne" id="modalViewGuia" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header-noty header-primary">
        <h5 class="modal-title" id="titleModalNoty"><i class="fa-solid fa-bell"></i>&nbsp&nbspPrimeros Pasos en Qudimar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <h2 class="headline">Te gustaria saber por donde empezar?</h2>                  
        <h3 class="subheadline">Preparamos <b style="font-weight: bold;">esta guía</b> para que puedas seguirla y generar así una carta online profesional, lista para usar.</h3>                  
        <a target="_blank" href="<?= web_url().'/guia'?>" class="btn btn-primary btn-abrirGuia"><i class="fa-solid fa-circle-play"></i>&nbsp&nbspVer guía ahora</a>       
      </div>
      <div class="modal-footer">
        <button type="button" id="closeModalGuia" class="btn btn-modalTypeOne" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>No volver a mostrar</button>
      </div>
    </div>
  </div>
</div>
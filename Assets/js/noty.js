var tablet = 780;	

if ($(window).width() < tablet) {
    swal({
        allowOutsideClick: true,
        html: true,
        icon: 'alert',
        title: '<i class="fa-solid fa-circle-exclamation"></i> Atencion!',
        text: 'Se recomienda usar el sistema desde un ordenador de escritorio o <i class="fa-solid fa-laptop"></i> notebook.<br>',			
        showConfirmButton: true,
        confirmButtonText: "Entendido!",			
    })
}

setInterval(function() {
    notNuevosPedidos();
    //Mostrar modal Guia si no guardo "no mostrar mas"
    if (window.localStorage) {
        if (window.localStorage.getItem('modalGuia') !== undefined 
            && window.localStorage.getItem('modalGuia')
        ) {
            return false;
        } else {
            fntViewGuia();
        }
    }
 
}, 4000);

//Funciones
function notNuevosPedidos() {
    $.ajax({
        url: base_url+'/Pedidos/getNotificacion',
        type: 'POST',
        success:function(data) {	
            let objData = JSON.parse(data);								
            if (objData.data != 'vacio'){			
                // Sonido		
                const music = new Audio(base_url+'/Assets/audios/notificacion_1.wav');
                window.focus();
                music.muted = true;
                music.play();				
                music.muted = false;		
                music.play();			
                music.playbackRate = 2;

                let codigo = objData.data[0]['code_session'];	            

                swal({
                    allowOutsideClick: true,
                    html: true,
                    icon: 'success',
                    title: '<i class="fa-solid fa-bag-shopping"></i> Ingresó un pedido',
                    text: 'Han ordenado desde el menú<br>'+
                    '<b>Codigo:</b> '+codigo,
                    showConfirmButton: true,
                    confirmButtonText: "Entendido!",
                    timer: 2800
                })
                // Si estoy en pedidos, actualizar recibido el pedido
                if(page_name == 'pedidos'){
                    tablePedidos.api().ajax.reload(); 
                }                
            }			
        }
    })
}



function fntViewGuia() {   
    //Varriables Modal guia
    $('#modalViewGuia').modal('show');
    btnCloseModal = document.getElementById("closeModalGuia")

    btnCloseModal.onclick = function() {
        localStorage.setItem("modalGuia", 'false');	    
    };
}
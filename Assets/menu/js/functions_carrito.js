$('#popEdit-detalle').hide();

$(".cont-close").click(function () {
    $('#popEdit-detalle').hide()
})

function fntEditDetalle(id_pedido) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/menu/detalle/' + id_pedido;
    console.log(ajaxUrl);
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                Obj = objData.detalle;
                var json2 = JSON.stringify(Obj);

                detalle = JSON.parse(json2);
                textoDetalle = detalle.detalle;

                // btnAction = '<a class="btn btn-action" href=""><i class="fab fa-whatsapp"></i></a><a class="btn btn-action" href="tel:'+objData.data.telefono+'"><i class="fas fa-phone-alt"></i> '+objData.data.telefono+'</a>';                        
                document.querySelector("#id_pedido").value = id_pedido;
                document.querySelector("#inpEditDetalle").innerHTML = textoDetalle;
                // $("#popEdit-detalle").css("display","flex");
                $('#popEdit-detalle').show();

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


// Datos del comensal

$('#pop-comensal').hide();

$(".cont-close").click(function () {
    $('#pop-comensal').hide()
})

function openModalComensal() {
    $('#pop-comensal').show();
}

document.addEventListener('DOMContentLoaded', function () {
    //NUEVO COMENSAL    
    let divLoading = document.querySelector("#preloader");
    // VALIDACION DELIVERY
    if (document.querySelector("#formComensal_deli")) {
        let formComensal_deli = document.querySelector("#formComensal_deli");
        formComensal_deli.onsubmit = function (e) {
            e.preventDefault();
            let strNombre = document.querySelector('#comensal_nombre').value;
            let strTelefono = document.querySelector('#comensal_telefono').value;
            let strDireccion = document.querySelector('#comensal_direccion').value;
            let strNumero = document.querySelector('#comensal_numero').value;
            let strLocalidad = document.querySelector('#comensal_localidad').value;
            let strPiso = document.querySelector('#comensal_piso').value;

            if (strNombre == '' || strTelefono == '' || strDireccion == '' || strNumero == '' || strLocalidad == '') {
                document.querySelector("#msg-gral").focus();
                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Complete los campos obligatorios (*)</div>";
                return false;
            } else {
                document.querySelector("#msg-gral").innerHTML = "";
                if (validarNombre(strNombre) === false ||
                    validarTelefono(strTelefono) === false ||
                    validarDireccion(strDireccion) === false ||
                    validarNumero(strNumero) === false ||
                    validarLocalidad(strLocalidad) === false) {
                    return false;
                } else {
                    divLoading.style.display = "flex";
                    formComensal_deli.style.opacity = "0.5";
                    setTimeout(function () {
                        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        let ajaxUrl = base_url + '/menu/confirmarPedido';
                        let formData = new FormData(formComensal_deli);
                        request.open("POST", ajaxUrl, true);
                        request.send(formData);
                        request.onreadystatechange = function () {
                            if (request.readyState == 4 && request.status == 200) {
                                let objData = JSON.parse(request.responseText);
                                if (objData.status) {
                                    window.location.href = base_url + '/menu/confirmado/';
                                }
                            }
                            formComensal_deli.style.opacity = "100";
                            divLoading.style.display = "none";
                            return false;
                        }
                    }, 2000);

                }
            }
        }
    }

    // VALIDACION SITE
    if (document.querySelector("#formComensal_site")) {
        let formComensal_site = document.querySelector("#formComensal_site");
        formComensal_site.onsubmit = function (e) {
            e.preventDefault();
            let strNombre = document.querySelector('#comensal_nombre').value;
            let strMesa = document.querySelector('#comensal_mesa').value;

            if (strNombre == '') {
                document.querySelector("#msg-gral").focus();
                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Complete los campos obligatorios (*)</div>";
                return false;
            } else {
                document.querySelector("#msg-gral").innerHTML = "";
                if (validarNombre(strNombre) === false) {
                    return false;
                } else {
                    divLoading.style.display = "flex";
                    formComensal_site.style.opacity = "0.5";
                    setTimeout(function () {
                        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        let ajaxUrl = base_url + '/menu/confirmarPedido';
                        let formData = new FormData(formComensal_site);
                        request.open("POST", ajaxUrl, true);
                        request.send(formData);
                        request.onreadystatechange = function () {
                            if (request.readyState == 4 && request.status == 200) {
                                let objData = JSON.parse(request.responseText);
                                if (objData.status) {
                                    window.location.href = base_url + '/menu/confirmado/';
                                }
                            }
                            formComensal_site.style.opacity = "100";
                            divLoading.style.display = "none";
                            return false;
                        }
                    }, 2000);

                }
            }
        }
    }

    // VALIDACION TAKE
    if (document.querySelector("#formComensal_take")) {
        let formComensal_take = document.querySelector("#formComensal_take");
        formComensal_take.onsubmit = function (e) {
            e.preventDefault();
            let strNombre = document.querySelector('#comensal_nombre').value;
            let strTelefono = document.querySelector('#comensal_telefono').value;

            if (strNombre == '' || strTelefono == '') {
                document.querySelector("#msg-gral").focus();
                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Complete los campos obligatorios (*)</div>";
                return false;
            } else {
                document.querySelector("#msg-gral").innerHTML = "";
                if (validarNombre(strNombre) === false || validarTelefono(strTelefono) === false)  {
                    return false;
                } else {
                    divLoading.style.display = "flex";
                    formComensal_take.style.opacity = "0.5";
                    setTimeout(function () {
                        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        let ajaxUrl = base_url + '/menu/confirmarPedido';
                        let formData = new FormData(formComensal_take);
                        request.open("POST", ajaxUrl, true);
                        request.send(formData);
                        request.onreadystatechange = function () {
                            if (request.readyState == 4 && request.status == 200) {
                                let objData = JSON.parse(request.responseText);
                                if (objData.status) {
                                    window.location.href = base_url + '/menu/confirmado/';
                                }
                            }
                            formComensal_take.style.opacity = "100";
                            divLoading.style.display = "none";
                            return false;
                        }
                    }, 2000);

                }
            }
        }
    }

})


// Validacion Nombre
function validarNombre(strNombre) {
    if (strNombre.length > 3) {
        document.querySelector('#msg-nombre').innerHTML = "";
        document.querySelector('#comensal_nombre').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-nombre').innerHTML = "<span style='color: red'>Nombre demasiado corto</span>";
        document.querySelector('#comensal_nombre').classList.add("error-inp");
        return false;
    }
}

// Validacion Telefono
function validarTelefono(strTelefono) {
    if (strTelefono.length > 6) {
        document.querySelector('#msg-telefono').innerHTML = "";
        document.querySelector('#comensal_telefono').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-telefono').innerHTML = "<span style='color: red'>Ingrese un numero valido</span>";
        document.querySelector('#comensal_telefono').classList.add("error-inp");
        return false;
    }
}

// Validar Direccion
function validarDireccion(strDireccion) {
    if (strDireccion.length > 3) {
        document.querySelector('#msg-direccion').innerHTML = "";
        document.querySelector('#comensal_direccion').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-direccion').innerHTML = "<span style='color: red'>Dirección demasiada corta</span>";
        document.querySelector('#comensal_direccion').classList.add("error-inp");
        return false;
    }
}

// Validar Numero
function validarNumero(strNumero) {
    if (strNumero.length > 0) {
        document.querySelector('#msg-numero').innerHTML = "";
        document.querySelector('#comensal_numero').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-numero').innerHTML = "<span style='color: red'>Numero demasiado corto</span>";
        document.querySelector('#comensal_numero').classList.add("error-inp");
        return false;
    }
}

// Validar Localidad
function validarLocalidad(strLocalidad) {
    if (strLocalidad.length > 3) {
        document.querySelector('#msg-localidad').innerHTML = "";
        document.querySelector('#comensal_localidad').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-localidad').innerHTML = "<span style='color: red'>Localidad demasiada corta</span>";
        document.querySelector('#comensal_localidad').classList.add("error-inp");
        return false;
    }
}
// Validar Localidad
// function validarPiso(strPiso) {
//     if (strPiso.length > 3) {
//         document.querySelector('#msg-piso').innerHTML = "";
//         document.querySelector('#comensal_piso').classList.remove("error-inp");
//     } else {
//         document.querySelector('#msg-piso').innerHTML = "<span style='color: red'>Piso/Dpto demasiado corto</span>";
//         document.querySelector('#comensal_piso').classList.add("error-inp");
//         return false;
//     }
// }

if(statusCarrito != 0){
    setInterval(function() {
        refreshStatusPedido();
        //Mostrar modal Guia si no guardo "no mostrar mas"   
    }, 3000);
}

function refreshStatusPedido() {
    $.ajax({
        url: base_url+'/menu/getStatusPedido',
        type: 'POST',
        success:function(data) {	
            let objData = JSON.parse(data);								
            if (objData.data != 'vacio'){			
                // Sonido		
                let viewStatus = '';                
                let status = objData.data['status'];
                let hora = objData.data['hora'];


                const dataEstado = getStatusCarrito(status);                

                viewStatus += `<li class="StatusContent cont-li-prod rounded ${dataEstado.claseMenu}">
                <div class="contStatusOrden">
                    ${dataEstado.icono}
                    <h2> ${dataEstado.leyenda}</h2>
                    </div>       
                    <p class="hora"><span>
                        El pedido fue realizado a las: 
                        <i class="fa-regular fa-clock"></i> ${hora} hs</span>
                    </p>                               
                </li>`
      
                document.querySelector('#statusCarrito').innerHTML = viewStatus;
            }			
        }
    })
}



function getStatusCarrito(estado) {    
    const status = parseInt(estado);

    const dataStatus = {
        clase: '',
        texto: ''
    };
            
    switch (status) {
        case 1:
            dataStatus.clase = 'badge-primary';
            dataStatus.texto = 'En cola';
            dataStatus.claseMenu = 'back_vio';
            dataStatus.leyenda = 'Tu pedido está siendo preparado.';
            dataStatus.icono = '<i class="fa-solid fa-utensils"></i>';
            break;
        case 2:
            dataStatus.clase = 'badge-success';
            dataStatus.texto = 'Entregado';
            dataStatus.claseMenu = 'back_ok';
            dataStatus.leyenda = 'Su pedido ya fue entregado.';
            dataStatus.icono = '<i class="fa-solid fa-circle-check"></i>';
            break;
        case 3:
            dataStatus.clase = 'badge-primary';
            dataStatus.texto = 'Preparando';
            dataStatus.claseMenu = 'back_vio';
            dataStatus.leyenda = 'Tu pedido está siendo preparado.';
            dataStatus.icono = '<i class="fa-solid fa-utensils"></i>';
            break;
        case 4:
            dataStatus.clase = 'badge-especial';
            dataStatus.texto = 'En camino';
            dataStatus.claseMenu = 'back_esp';
            dataStatus.leyenda = 'Su pedido ya está en camino.';
            dataStatus.icono = '<i class="fa-solid fa-motorcycle"></i>';
            break;
        case 5:
            dataStatus.clase = 'badge-especial';
            dataStatus.texto = 'Para retirar';
            dataStatus.claseMenu = 'back_esp';
            dataStatus.leyenda = 'Su pedido ya está listo para retirar.';
            dataStatus.icono = '<i class="fa-solid fa-bag-shopping"></i>';
            break;
        case 6:
            dataStatus.clase = 'badge-danger';
            dataStatus.texto = 'Cancelado';
            dataStatus.claseMenu = 'back_red';
            dataStatus.leyenda = 'Su pedido fue cancelado.';
            dataStatus.icono = '<i class="fa-solid fa-heart-crack"></i>';
            break;
    }
    
    return dataStatus;
}
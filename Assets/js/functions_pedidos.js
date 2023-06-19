let tablePedidos;
let rowTable = "";

tablePedidos = $('#tablePedidos').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Ver _MENU_",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "",
        "searchPlaceholder": "Buscar",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ultimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
    },
    "ajax": {
        "url": " " + base_url + "/Pedidos/getPedidos",
        "dataSrc": ""
    },
    "columns": [
        { "data": "code_session" },
        { "data": "status" },
        { "data": "modo" },
        { "data": "total" },
        { "data": "fecha" },
        { "data": "hora" },
        { "data": "options" }
    ],
    "dom": '<"row"<"col-sm-12 col-md-2"l><"col-sm-12 col-md-6"f><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap b-arreglo"B>>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    'buttons': [{
        "extend": "excelHtml5",
        "text": "<i class='fas fa-file-excel'></i> Excel",
        "titleAttr": "Esportar a Excel",
        "className": "btn-excel"
    }, {
        "extend": "pdfHtml5",
        "text": "<i class='fas fa-file-pdf'></i> PDF",
        "titleAttr": "Esportar a PDF",
        "className": "btn-pdf"
    }, {
        "extend": "csvHtml5",
        "text": "<i class='fas fa-file-csv'></i> CSV",
        "titleAttr": "Esportar a CSV",
        "className": "btn-csv"
    }],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 25,
    "order": []
});

function fntViewInfo(id_carrito_temp) {
    $('#txtDetalle').children().remove();
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/getPedido/' + id_carrito_temp;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#printBtn").innerHTML = '<a onclick="printComanda(' + id_carrito_temp + ')" class="btn btn-primary btn-print"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>';
                let status = objData.data['carrito']['status'];                
                let fecha = objData.data['carrito']['fecha'];
                let hora = objData.data['carrito']['hora'];
                let total = objData.data['carrito']['total'];
                let modo = objData.data['carrito']['modo'];
                let mesa = objData.data['carrito']['mesa'];
                const dataModo = getIconModo(modo);
                const dataEstado = getStatusCarrito(status);                

                // let estado = `<span class="badge badge-especial">`+dataStatus.texto+`</span>`; 

                let estado = `<span class="badge ${dataEstado.clase}">${dataEstado.texto}</span>`;

                // Data del Comensal
                let nombre = objData.data['comensal']['nombre'];
                let telefono = objData.data['comensal']['telefono'];
                let direccion = objData.data['comensal']['direccion'];
                let numero = objData.data['comensal']['numero'];
                let localidad = objData.data['comensal']['localidad'];
                let piso = objData.data['comensal']['piso'];
                let direccionCom = direccion + ' ' + numero + ', ' + localidad;

                document.querySelector("#celCode").innerHTML = objData.data['carrito']['code_session'];
                document.querySelector("#celEstado").innerHTML = estado;
                document.querySelector("#celFecha").innerHTML = '<i class="fa fa-calendar"></i> ' + fecha + '&nbsp&nbsp&nbsp<span style="color: darkgrey;"><i class="fa fa-clock"></i> ' + hora + '</span>';
                document.querySelector("#celModo").innerHTML = "<div class='contModo'>" + dataModo.icono + dataModo.texto + "</div>";

                if (mesa && mesa !== '') {
                    document.querySelector("#celMesa").innerHTML = "<td class='txtBold'>Mesa:</td><td><div class='contModo' >" + mesa + "</div></td>";
                } else {
                    document.querySelector("#celMesa").innerHTML = "";
                }

                const divComensal = document.getElementById('contComensal');
                const viewTable = `
                    <table class="table table-bordered table-50">
                        <tbody>`;
                let nombreComensal = '';
                let telefonoComensal = '';
                let direccionComensal = '';
                let mesaCarrito = '';
                const urlDireccion = direccion + ' ' + numero + ', ' + localidad;
                const dataMap = urlDireccion.replace(/ /g, '+');
                const urlMap = `https://www.google.com.ar/maps/place/${dataMap}`;

                let comensalPiso = '';
                const tableFinalView = `
                        </tbody>
                    </table>
                `;

                if (nombre && nombre !== '') {
                    nombreComensal = `
                        <tr>
                            <td class="txtBold">Nombre:</td>
                            <td id="">${nombre}</td>
                        </tr>`;
                }

                if (telefono && telefono !== '') {
                    telefonoComensal = `
                        <tr>
                            <td class="txtBold">Teléfono:</td>
                            <td class="contAllDireccion">         
                                <div class="cont-direccion">                       
                                    <a class="btn-primary-sm icon-circle" href='tel:${telefono}'>
                                        <i class="fa-solid fa-phone"></i>                                               
                                    </a>
                                    <a class="btn-wapp btn-primary-sm icon-circle" target='_blank' href="https://api.whatsapp.com/send?phone=${telefono}&text=Hola%20${nombre}">
                                        <i class="fa-brands fa-whatsapp"></i>                                          
                                    </a>
                                    <span>${telefono}</span>                  
                                </div>                                   
                            </div>             
                            
                        </tr>`;
                }

                if (direccion && direccion !== '') {
                    direccionComensal = `
                        <tr>
                            <td class="txtBold">Dirección:</td>
                            <td class="contAllDireccion">         
                                <div class="cont-direccion">                       
                                    <a class="btn-primary-sm icon-circle" target='_blank' href='${urlMap}'>
                                        <i class="fa-solid fa-location-dot"></i>                                               
                                    </a>
                                    <span>${direccionCom}</span>                  
                                </div>                                   
                            </div>                  
                        </tr>`;
                }

                if (piso && piso !== '') {
                    comensalPiso = `
                        <tr>
                            <td class="txtBold">Piso/Dpto:</td>
                            <td id="">${piso}</td>
                        </tr>`;
                }

                const totalViewComensal = viewTable + nombreComensal + telefonoComensal + direccionComensal + comensalPiso + tableFinalView;
                divComensal.innerHTML = totalViewComensal;

                i = 0;
                jQuery.each(objData.data.detalle, function () {
                    idPedidoProd = objData.data['detalle'][i]['id_pedido'];
                    tituloProd = objData.data['detalle'][i]['titulo'];
                    descProd = objData.data['detalle'][i]['descripcion'];
                    descDetalle = objData.data['detalle'][i]['detalle'];
                    cantidadProd = objData.data['detalle'][i]['cantidad'];
                    precio = objData.data['detalle'][i]['precio'];
                    fotoProd = objData.data['detalle'][i]['url_img'];
                    url_img = base_url + "/Assets/images/uploads/" + fotoProd;

                    if (!!descDetalle) {
                        descDetalleView = `<div class="detalle-user">
                            <p>` + descDetalle + `</p>
                        </div>`;
                    } else {
                        descDetalleView = ``;
                    }

                    var targetDiv = document.getElementById('txtDetalle');
                    block = `
                        <div class="row cont-card-prod">
                            <div class="col-1 sinNada">
                                <img class="cont-img" style="background: url(`+ url_img + `); background-size:cover; background-position: center">
                            </div>
                            <div class="col-9 sinNada cont-text">
                                <h3>`+ cantidadProd + `x` + tituloProd + `</h3>`
                        + descDetalleView + `
                            </div>
                            <h3 class="col-2 cont-precio">$`+ precio + `</h3>
                        </div>
                    `;
                    targetDiv.innerHTML += block;

                    i = i + 1;
                });

                blockTotal = `
                <div class="row cont-card-prod total">                 
                    <h4 class="col-8 sinNada">Total</h4>
                    <h4 class="col-4 sinNada" style="text-align: right; padding-right: 8px">$`+ total + `</h4>
                </div>
                `;
                document.getElementById('txtDetalle').innerHTML += blockTotal;


                $('#modalViewPedido').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntUpdateInfo() {
    let formUpdatePedido = document.querySelector("#formUpdatePedido");
    formUpdatePedido.onsubmit = function (e) {
        e.preventDefault();
        let transaccion;
        if (document.querySelector("#txtTransaccion")) {
            transaccion = document.querySelector("#txtTransaccion").value;
            if (transaccion == "") {
                swal("", "Complete los datos para continuar.", "error");
                return false;
            }
        }

        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Pedidos/setPedido/';
        divLoading.style.display = "flex";
        let formData = new FormData(formUpdatePedido);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    swal("", objData.msg, "success");
                    $('#modalFormPedido').modal('hide');
                    if (document.querySelector("#txtTransaccion")) {
                        rowTable.cells[1].textContent = document.querySelector("#txtTransaccion").value;
                        rowTable.cells[4].textContent = document.querySelector("#listTipopago").selectedOptions[0].innerText;
                        rowTable.cells[5].textContent = document.querySelector("#listEstado").value;
                    } else {
                        rowTable.cells[5].textContent = document.querySelector("#listEstado").value;
                    }
                } else {
                    swal("Error", objData.msg, "error");
                }

                divLoading.style.display = "none";
                return false;
            }
        }

    }
}

function fntDelInfo(id_carrito_temp) {
    swal({
        title: "¿Realmente quiere eliminar esta pedido?",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Pedidos/delPedido';
            let strData = "id_carrito_temp=" + id_carrito_temp;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal({
                            title: "Pedidos",
                            text: "Dato eliminado correctamente.",
                            type: "success",
                            confirmButtonText: "Entendido!",
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        })
                        tablePedidos.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

function fntStatusPedido(id_carrito_temp, modo, status, thisElement) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/changeStatus';
    let strData = "id_carrito_temp=" + id_carrito_temp + "&status=" + status;
    request.open("POST", ajaxUrl, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(strData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let x = thisElement.parentNode;
                let thisDropdown = x.parentNode;
                let options = '';
                let viewDropdown = '';
                const dataStatus = getStatusCarrito(status);

                options = createDropdownMenu(id_carrito_temp, modo);

                viewDropdown = `<button class="badge ` + dataStatus.clase + ` dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span> `+ dataStatus.texto + `</span>
                </button> `+ options;

                $(thisDropdown).html(viewDropdown);

            } else {
                swal("Atención!", objData.msg, "error");
            }
        }
    }
}

function printComanda(id_carrito_temp) {
    var a = window.open(base_url + '/Pedidos/getComanda/' + id_carrito_temp, ' ', 'height=720px, width=900px');
    a.document.close();
}

function getIconModo(modo) {
    const dataModo = {
        icono: '',
        texto: ''
    };

    switch (modo) {
        case 'SITE':
            dataModo.icono = '<i class="fa-solid fa-utensils"></i>';
            dataModo.texto = "En salón";
            break;
        case 'DELI':
            dataModo.icono = '<i class="fa-solid fa-motorcycle"></i>';
            dataModo.texto = "Delivery";
            break;
        case 'TAKE':
            dataModo.icono = '<i class="fa-solid fa-bag-shopping"></i>';
            dataModo.texto = "Takeaway";
            break;
        default:
            dataModo.icono = '<i class="fas fa-question"></i>';
            break;
    }

    return dataModo;
}


function createDropdownMenu(id_carrito_temp, modo) {
    let options;
    const option1 = createOption(id_carrito_temp, modo, 2, "Entregado", "badge-success");
    const option2 = createOption(id_carrito_temp, modo, 1, "En cola", "badge-primary");
    const option3 = createOption(id_carrito_temp, modo, 3, "Preparando", "badge-primary");
    const option4 = createOption(id_carrito_temp, modo, 4, "En camino", "badge-especial");
    const option5 = createOption(id_carrito_temp, modo, 5, "Para retirar", "badge-especial");
    const option6 = createOption(id_carrito_temp, modo, 6, "Cancelado", "badge-danger");

    switch (modo) {
        case 'SITE':
            options = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      ${option1}
                      ${option2}
                      ${option3}                                                        
                      ${option6}
                    </div>`;
            break;
        case 'DELI':
            options = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      ${option1}
                      ${option2}
                      ${option3}
                      ${option4}
                      ${option6}
                    </div>`;
            break;
        case 'TAKE':
            options = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      ${option1}
                      ${option2}
                      ${option3}         
                      ${option5}             
                      ${option6}
                    </div>`;
            break;
        default:
            options = '';
            break;
    }

    return options;
}

function createOption(id, modo, status, text, clase) {
    return `<a onClick="fntStatusPedido(` + id + `, '` + modo + `', ` + status + `, this)" class="dropdown-item badge ` + clase + `" href="#">
              <span>`+ text + `</span>
            </a>`;
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
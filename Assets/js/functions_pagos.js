var selector = $(".btn.dropdown-toggle.btn-light");

let tablePagos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    tablePagos = $('#tablePagos').dataTable({
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
            "url": " " + base_url + "/Pagos/getPagos",
            "dataSrc": ""
        },   
        "columns": [         
            { "data": "id_pago" },
            { "data": "status" },            
            { "data": "fechaVen" },        
            { "data": "plan" },
            { "data": "precio" },      
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
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pagos/getUltimoPago/'
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);   
            if (objData.status) {
                let objPago = objData.data;
                let btnPago = document.querySelector(".checkout-btn");
                let estadoPago = objData['btnPagar'];                                
                console.log(objPago);
                if (objPago.plan == 'Demo'){                                        
                    btnPago = '<button class="checkout-btn-disable" disabled></button>';                       
                    document.querySelector("#btnPagar").innerHTML = btnPago;
                    montoPago = 'Gratis';
                } else {                    
                    if(objPago.status == 'pagar' || objPago.status == 'vencido'){                              
                        btnPago.style.visibility = "visible";
                    }
                    else if(objPago.status == 'pagado'){                        
                        btnPago = '<button class="checkout-btn-disable" disabled>Pago ya efectuado</button>';   
                        document.querySelector("#btnPagar").innerHTML = btnPago;                     
                    }
                    montoPago = '$'+objPago.precio;
                }
                document.querySelector("#id_pago").innerHTML = objPago.id_pago;
                document.querySelector("#id_pago").value = objPago.id_pago;
                document.querySelector("#celEstado").innerHTML = estadoPago;
                document.querySelector("#celVencimiento").innerHTML =  objPago.fechaVen;
                document.querySelector("#celCierre").innerHTML =  objPago.fechaFin;
                document.querySelector("#celMonto").innerHTML = montoPago;
                document.querySelector("#celPlan").innerHTML = objPago.plan;
                document.querySelector("#celIdPago").innerHTML = objPago.id_pago;                
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }

}, false);

function fntViewInfo(id_pago) {
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pagos/getPago/' + id_pago;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objPago = objData.data;
                let estadoPago = objPago.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celTitulo").innerHTML = objPago.titulo;                                                
                document.querySelector("#celTag").innerHTML = objPago.tag;
                document.querySelector("#celStatus").innerHTML = estadoPago;        
                document.querySelector("#celFotos").innerHTML = '<div style="background: url(' + objData.data.url_portada + ');background-position: center; background-size: cover;"></div>';
                $('#modalViewPago').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


function fntEditInfo(element, id_pago) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "<i class='fas fa-pencil-alt'></i> Actualizar Pago";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-edit");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pagos/getPago/' + id_pago;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#id_pago").value = objData.data.id_pago;
                document.querySelector("#txtTitulo").value = objData.data.titulo;
                document.querySelector("#txtTag").value = objData.data.tag;
                document.querySelector('#foto_actual').value = objData.data.img_pago;
                document.querySelector("#foto_remove").value = 0;
                var intStatus = document.getElementById("listStatus");
                var txtStatus = document.getElementById("txtSwitch");

                if (objData.data.status == 1) {
                    intStatus.checked = true;     
                    txtStatus.innerHTML = "Activado";
                } else {                    
                    intStatus.checked = false;       
                    txtStatus.innerHTML = "Desactivado";
                }  

                $('#listCategoria').selectpicker('render');

                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objData.data.url_portada + ">";
                }

                if (objData.data.portada == 'portada_pago.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormPagos').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(id_pago) {
    swal({
        title: "¿Realmente quiere eliminar este pago?",                  
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Pagos/delPago';
            let strData = "id_pago=" + id_pago;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tablePagos.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}

function fntCategorias() {
    if (document.querySelector('#listCategoria')) {
        let ajaxUrl = base_url + '/Categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria').selectpicker('render');
            }
        }
    }
}

function toggle(checked) {
    var y = document.getElementById('listStatus');    
    y.addEventListener('change', function(){
        if(y.checked == true){
            document.getElementById('txtSwitch').innerHTML = "Activado";
        } else {
            document.getElementById('txtSwitch').innerHTML = "Desactivado";
        }        
    });
}

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function openModal() {
    rowTable = "";
    document.querySelector('#id_pago').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-edit", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "<i class='fa fa-plus'></i> Nuevo pago";
    document.querySelector("#formPagos").reset();
    $('#modalFormPagos').modal('show');
    removePhoto();
}


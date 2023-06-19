let tableCategorias;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {
    console.log(base_url);
    tableCategorias = $('#tableCategorias').dataTable({
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
            "url": " " + base_url + "/Categorias/getCategorias",
            "dataSrc": ""
        },
        "columns": [            
            { "data": "status" },
            { "data": "nombre" },
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

    if (document.querySelector("#foto")) {
        let foto = document.querySelector("#foto");
        foto.onchange = function(e) {
            let uploadFoto = document.querySelector("#foto").value;
            let fileimg = document.querySelector("#foto").files;
            let nav = window.URL || window.webkitURL;
            let contactAlert = document.querySelector('#form_alert');
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value = "";
                    return false;
                } else {
                    contactAlert.innerHTML = '';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
                }
            } else {
                alert("No selecciono foto");
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
            }
        }
    }

    //NUEVA CATEGORIA
    let formCategoria = document.querySelector("#formCategoria");
    formCategoria.onsubmit = function(e) {
        e.preventDefault();
        let strNombre = document.querySelector('#txtNombre').value;
        var intStatus = document.getElementById("listStatus");
        var checkStatus = intStatus.checked == true ? 1 : 2;
        
        if (strNombre == '' || intStatus == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Categorias/setCategoria';
        let formData = new FormData(formCategoria);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {

                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    if (rowTable == "") {
                        tableCategorias.api().ajax.reload();
                    } else {
                        htmlStatus = checkStatus == 1 ?
                            '<span class="badge badge-success">Activado</span>' :
                            '<span class="badge badge-danger">Desactivado</span>';
                        rowTable.cells[0].innerHTML = htmlStatus;
                        rowTable.cells[1].textContent = strNombre;
                        rowTable = "";
                    }

                    $('#modalFormCategorias').modal("hide");
                    formCategoria.reset();                 
                    swal({
                        title: "Categoria",
                        text: "Datos Actualizados correctamente.",
                        type: "success",                        
                        confirmButtonText: "Entendido!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }    
    toggle();
}, false);

function fntViewInfo(idcategoria) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + idcategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estado = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activado</span>' :
                    '<span class="badge badge-danger">Desactivado</span>';                
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celEstado").innerHTML = estado;
                $('#modalViewCategoria').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


function fntEditInfo(element, id_categoria) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "<i class='fas fa-pencil-alt'></i> Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-edit");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + id_categoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#id_categoria").value = objData.data.id_categoria;
                document.querySelector("#txtNombre").value = objData.data.nombre;                
                var intStatus = document.getElementById("listStatus");
                var txtStatus = document.getElementById("txtSwitch");                

                if (objData.data.status == 1) {
                    intStatus.checked = true;     
                    txtStatus.innerHTML = "Activado";
                } else {                    
                    intStatus.checked = false;       
                    txtStatus.innerHTML = "Desactivado";
                }  

                $('#listStatus').selectpicker('render');
                $('#modalFormCategorias').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(id_categoria) {
    swal({
        title: "¿Realmente quiere eliminar esta categoría?",        
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Categorias/delCategoria';
            let strData = "id_categoria=" + id_categoria;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal({
                            title: "Categoria",
                            text: "Datos Actualizados correctamente.",
                            type: "success",                        
                            confirmButtonText: "Entendido!",
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        })
                        tableCategorias.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

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

function openModal() {
    rowTable = "";
    document.querySelector('#txtSwitch').innerHTML = "Activado";
    document.querySelector('#id_categoria').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-edit", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "<i class='fa fa-plus'></i> Nueva Categorías";
    document.querySelector("#formCategoria").reset();
    $('#modalFormCategorias').modal('show');    
}
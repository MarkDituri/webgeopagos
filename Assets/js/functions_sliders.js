
var selector = $(".btn.dropdown-toggle.btn-light");


let tableSliders;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    tableSliders = $('#tableSliders').dataTable({
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
            "url": " " + base_url + "/Sliders/getSliders",
            "dataSrc": ""
        },   
        "columns": [
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<div class="imgDataTable-slider" style="background: url('+base_url+'/Assets/images/uploads/'+JsonResultRow.img_slider+'); background-position: center; background-size:cover;"></div>';
                }
            },
            { "data": "status" },
            { "data": "titulo" },
            { "data": "tag" },            
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

    if (document.querySelector(".delPhoto")) {
        let delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }

    //NUEVO SLIDER
    let formSliders = document.querySelector("#formSliders");
    formSliders.onsubmit = function(e) {
        e.preventDefault();
        let strTitulo = document.querySelector('#txtTitulo').value;        
        let strTag = document.querySelector('#txtTag').value;        
        var intStatus = document.getElementById("listStatus");
        var checkStatus = intStatus.checked == true ? 1 : 2;

        if (strTitulo == '' || strTag == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Sliders/setSlider';
        let formData = new FormData(formSliders);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    if (rowTable == "") {                               
                        tableSliders.api().ajax.reload();
                    } else {                                               
                        var elemento = $(".div-img-pop #img");                                                              
                        urlBlob = elemento[0].src;
                                                
                        Image = '<div class="imgDataTable-slider" style="background: url('+urlBlob+'); background-position: center; background-size:cover;"></div>';
                        htmlStatus = checkStatus == 1 ?
                            '<span class="badge badge-success">Activado</span>' :
                            '<span class="badge badge-danger">Desactivado</span>';
                        
                        rowTable.cells[0].innerHTML = Image;
                        rowTable.cells[1].innerHTML = htmlStatus;
                        rowTable.cells[2].textContent = strTitulo;                        
                        rowTable.cells[3].textContent = strTag;
                        rowTable = "";
                    }

                    $('#modalformSliders').modal("hide");
                    formSliders.reset();
                    swal({
                        title: "Slider",
                        text: objData.msg,
                        type: "success",
                        confirmButtonText: "Entendido!",
                        closeOnConfirm: false,
                    });
                    removePhoto();
                    $('#modalFormSliders').modal('hide');
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
    fntCategorias();
    toggle();
}, false);

function fntViewInfo(id_slider) {
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Sliders/getSlider/' + id_slider;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objSlider = objData.data;
                let estadoSlider = objSlider.status == 1 ?
                    '<span class="badge badge-success">Activado</span>' :
                    '<span class="badge badge-danger">Desactivado</span>';

                document.querySelector("#celTitulo").innerHTML = objSlider.titulo;                                                
                document.querySelector("#celTag").innerHTML = objSlider.tag;
                document.querySelector("#celStatus").innerHTML = estadoSlider;        
                document.querySelector("#celFotos").innerHTML = '<div style="background: url(' + objData.data.url_portada + ');background-position: center; background-size: cover;"></div>';
                $('#modalViewSlider').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, id_slider) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "<i class='fas fa-pencil-alt'></i> Actualizar Slider";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-edit");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Sliders/getSlider/' + id_slider;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#id_slider").value = objData.data.id_slider;
                document.querySelector("#txtTitulo").value = objData.data.titulo;
                document.querySelector("#txtTag").value = objData.data.tag;
                document.querySelector('#foto_actual').value = objData.data.img_slider;
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

                if (objData.data.portada == 'portada_slider.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormSliders').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(id_slider) {
    swal({
        title: "¿Realmente quiere eliminar este slider?",                  
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Sliders/delSlider';
            let strData = "id_slider=" + id_slider;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableSliders.api().ajax.reload();
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
    document.querySelector('#txtSwitch').innerHTML = "Activado";
    document.querySelector('#id_slider').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-edit", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "<i class='fa fa-plus'></i> Nuevo slider";
    document.querySelector("#formSliders").reset();
    $('#modalFormSliders').modal('show');
    removePhoto();
}


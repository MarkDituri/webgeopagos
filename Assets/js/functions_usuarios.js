
let txtPassword = document.querySelector('#txtPassword').value;    
let txtPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;   

formCrear.onsubmit = function(e) {
    e.preventDefault();        
    if(txtPassword == '' || txtPasswordConfirm == ''){
        document.querySelector("#msg-gral").focus();
        document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Por favor ingrese una contraseña</div>";            
        return false;
    }
}

$('#txtPassword').keyup(function(e) {    
    //Validar clave segura        
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{6,}).*", "g");
    var respClave;

    if (false == enoughRegex.test($(this).val())) {
        $('#msg-txtPassword').html('Al menos 6 caracteres.');
        respClave = false;
    } else if (mediumRegex.test($(this).val())) {                
        $('#msg-txtPassword').html('<span class="ok">Contraseña válida.</span>');
        respClave = true;
    } else {
        $('#msg-txtPassword').html('<span class="error">Contraseña débil.</span>');
        respClave = false;
    }


    // Crear clave
    let divLoading = document.querySelector("#divLoading");
    let formCrear = document.querySelector("#formCrear");
    formCrear.onsubmit = function(e) {
        e.preventDefault(); 
        if(respClave === true){                  
            // e.preventDefault();        
            let txtPassword = document.querySelector('#txtPassword').value;
            let txtPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;                      

            if (txtPassword == '' || txtPasswordConfirm == '' ) {                    
                document.querySelector("#msg-gral").focus();
                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Todos los campos son obligatorios</div>";            
                return false;           
            } else {
                if(txtPassword === txtPasswordConfirm){                    
                    //Aca envia evento
                    divLoading.style.display = "flex";
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Usuarios/cambiarClave';
                    let formData = new FormData(formCrear);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                $('#modalFormClave').modal("hide");
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false,
                                }, function(isConfirm) {
                                    if (isConfirm) {
                                        location.reload();
                                    }
                                });
                            } else {
                                swal("Error", objData.msg, "error");
                            }
                        }
                        divLoading.style.display = "none";
                        return false;
                    }

                } else {
                    document.querySelector("#msg-gral").focus();
                    document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Tus contraseñas no coinciden</div>";            
                    return false;
                }                  
            }
        } else {
            document.querySelector("#msg-gral").focus();
            document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Contraseña muy debil</div>";            
            return false;
        }                                     
    }                   
    return false;  
});


let id_color_SESSION = document.querySelector("#id_color_SESSION").value;
let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
let ajaxUrl = base_url + '/Usuarios/getColores/'
request.open("GET", ajaxUrl, true);
request.send();
request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);
        if (objData.status) {         

            let viewColores = '';

            for (var i = 0; i < objData.data.length; i++) {
                let id_color = (objData.data[i].id_color);
                let nombre = (objData.data[i].nombre);
                let class_name = (objData.data[i].class_name);

                if (id_color == 7){
                    nombre = nombre+' <span style="color: grey;font-weight: lighter;">(default)</span>';
                }

                if (id_color_SESSION == id_color){
                    class_select = 'selected_color';
                } else { class_select = '' };

                viewColores += `<div onclick="cambiarColor(`+id_color+`)" class="cont-color `+class_select+`">
                    <div id="`+id_color+`" class="circle-color `+class_name+`"></div>
                    <h5>`+nombre+`</h5>
                </div>`;                
            }

            document.querySelector('#cont-colores').innerHTML = viewColores;            

        } else {
            swal("Error", objData.msg, "error");
        }
    }
}

function cambiarColor (id_color){ 
    var element = id_color;
    var elementHtml = element.outerHTML;
    console.log(elementHtml);        
    divLoading.style.display = "flex";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/changeColor?id_color='+id_color;
    let formData = new FormData(elementHtml);
    console.log(formData);
    request.open("GET", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#modalFormClave').modal("hide");
                swal({
                    title: "",
                    text: objData.msg,
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                }, function(isConfirm) {
                    if (isConfirm) {
                        location.reload();
                    }
                });
            } else {
                swal("Error", objData.msg, "error");
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

function cambiarDarkMode (boolDark){     
    var element = boolDark;
    var elementHtml = element.outerHTML;
    console.log(elementHtml);        
    divLoading.style.display = "flex";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/swichDarkMode?boolDark='+boolDark;
    let formData = new FormData(elementHtml);
    console.log(formData);
    request.open("GET", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {    
                swal({
                    title: "",
                    text: objData.msg,
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                }, function(isConfirm) {
                    if (isConfirm) {
                        location.reload();
                    }
                });
            } else {
                swal("Error", objData.msg, "error");
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_restaurante" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "nombrerol" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [{
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary"
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Esportar a Excel",
            "className": "btn btn-success"
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Esportar a PDF",
            "className": "btn btn-danger"
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Esportar a CSV",
            "className": "btn btn-info"
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

    //ACTUALIZAR USER
    let formPerfil = document.querySelector("#formPerfil");
    formPerfil.onsubmit = function(e) {
        e.preventDefault();    
        let strNombre = document.querySelector('#txtNombres').value;
        let strApellido = document.querySelector('#txtApellidos').value;
        let intTelefono = document.querySelector('#txtTelefono').value;
        let strNombreRest = document.querySelector('#txtNombreRest').value;       
        if (strApellido == '' || strNombre == '' || intTelefono == '' || strNombreRest == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Usuarios/putPerfil';
        let formData = new FormData(formPerfil);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if(request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    formPerfil.reset();
                    swal({
                        title: "",
                        text: objData.msg,
                        type: "success",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                    }, function(isConfirm) {
                        location.reload();
                    });
                }else{
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
                
            // if (strPassword != "" || strPasswordConfirm != "") {
            //     if (strPassword != strPasswordConfirm) {
            //         swal("Atención", "Las contraseñas no son iguales.", "info");
            //         return false;
            //     }
            //     if (strPassword.length < 5) {
            //         swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
            //         return false;
            //     }
            // }

     
    //Actualizar Datos Fiscales
    if (document.querySelector("#formDataFiscal")) {
        let formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function(e) {
            e.preventDefault();
            let strNit = document.querySelector('#txtNit').value;
            let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            let strDirFiscal = document.querySelector('#txtDirFiscal').value;

            if (strNit == '' || strNombreFiscal == '' || strDirFiscal == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/putDFical';
            let formData = new FormData(formDataFiscal);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);


function fntRolesUsuario() {
    if (document.querySelector('#listRolid')) {
        let ajaxUrl = base_url + '/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid').selectpicker('render');
            }
        }
    }
}

function fntViewUsuario(id_restaurante) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_restaurante;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                let estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUsuario(id_restaurante) {    
    document.querySelector('#titleModal').innerHTML = "<i class='fas fa-pencil-alt'></i> Actualizar Perfil";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-edit");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_restaurante;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {                
                document.querySelector("#txtNombres").value = objData.data.nombres;
                document.querySelector("#txtApellidos").value = objData.data.apellidos;
                document.querySelector('#foto_actual').value = objData.data.url_logo;
                document.querySelector("#foto_remove").value = 0;                             

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objData.data.url_portada + ">";
                }

                if (objData.data.portada == 'portada_logo.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormPerfil').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditClave(id_restaurante) {    
    document.querySelector('#titleModal').innerHTML = "<i class='fas fa-pencil-alt'></i> Actualizar Perfil";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-edit");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_restaurante;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {                
                document.querySelector("#txtNombres").value = objData.data.nombres;
                document.querySelector("#txtApellidos").value = objData.data.apellidos;
                document.querySelector('#foto_actual').value = objData.data.url_logo;
                document.querySelector("#foto_remove").value = 0;                             

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objData.data.url_portada + ">";
                }

                if (objData.data.portada == 'portada_logo.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormClave').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

// let txtPassword = document.querySelector('#txtPassword').value;    

// formCrear.onsubmit = function(e) {
//     e.preventDefault();        
//     if(txtPassword == '' ){
//         document.querySelector("#msg-gral").focus();
//         document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Por favor ingrese una contraseña</div>";            
//         return false;
//     }
// }






function fntDelUsuario(id_restaurante) {
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/delUsuario';
            let strData = "idUsuario=" + id_restaurante;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableUsuarios.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
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
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}

function openModalPerfil() {
    $('#modalFormPerfil').modal('show');
}
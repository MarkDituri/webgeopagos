document.addEventListener('DOMContentLoaded', function () {
    //NUEVO USUARIO
    document.querySelector("#section-msg").style.display = "none";
    let divLoading = document.querySelector("#divLoading");
    let formCrear = document.querySelector("#formCrear");
    formCrear.onsubmit = function (e) {
        e.preventDefault();

        let strNombre = document.querySelector('#nombre').value;
        let strApellido = document.querySelector('#apellido').value;
        let strEmail = document.querySelector('#email').value;
        let strTelefono = document.querySelector('#telefono').value;
        let strNegocios = document.querySelector('#negocio').value;
        let strURL = document.querySelector('#url_menu').value;
        let checkTerminos = document.querySelector('#terminos');

        if (strNombre == '' || strApellido == '' || strEmail == '' || strTelefono == '' || strNegocios == '' || strURL == '') {
            document.querySelector("#msg-gral").focus();
            document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Todos los campos son obligatorios</div>";
            return false;
        } else {
            document.querySelector("#msg-gral").innerHTML = "";
            if (validarNombre(strNombre) === false || validarApellido(strApellido) === false || validarEmail(strEmail) === false || validarTelefono(strTelefono) === false || validarNegocio(strNegocios) === false || validarUrlNegocio(strURL) === false)
            // || validarTerminos(checkTerminos) === false)
            {
                return false;
            } else {
                divLoading.style.display = "flex";
                formCrear.style.opacity = "0.5";
                setTimeout(function () {
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = 'empezar/crear_cuenta';
                    let formData = new FormData(formCrear);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            let objData = JSON.parse(request.responseText);

                            if (objData.status) {
                                document.querySelector("#section-action").style.display = "none";
                                document.querySelector("#section-msg").style.display = "flex";
                            }
                            else {
                                // if(objData.input === 'email'){
                                //     document.querySelector("#url_negocio").classList.remove("error-inp");
                                // } else if (objData.input === 'url_negocio'){
                                //     document.querySelector("#email").classList.remove("error-inp");
                                // }
                                document.querySelector("#" + objData.input).classList.add("error-inp");
                                document.querySelector("#" + objData.input).focus();
                                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>" + objData.msg + "</div>";
                            }
                        }
                        formCrear.style.opacity = "100";
                        divLoading.style.display = "none";
                        return false;
                    }
                }, 2000);

            }
        }
    }
})


// Funciones
// Validacion Nombre
function validarNombre(strNombre) {
    if (strNombre.length > 3) {
        document.querySelector('#msg-nombre').innerHTML = "";
        document.querySelector('#nombre').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-nombre').innerHTML = "<span style='color: red'>Nombre demasiado corto</span>";
        document.querySelector('#nombre').classList.add("error-inp");
        return false;
    }
}
// Validar Apellido
function validarApellido(strApellido) {
    if (strApellido.length > 3) {
        document.querySelector('#msg-apellido').innerHTML = "";
        document.querySelector('#apellido').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-apellido').innerHTML = "<span style='color: red'>Apellido demasiado corto</span>";
        document.querySelector('#apellido').classList.add("error-inp");
        return false;
    }
}
// Validacion Email
function validarEmail(strEmail) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var request = emailPattern.test(strEmail);
    if (request == true) {
        document.querySelector('#msg-email').innerHTML = "";
        document.querySelector('#email').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-email').innerHTML = "<span style='color: red'>Escriba un email correcto</span>";
        document.querySelector('#email').classList.add("error-inp");
        return false;
    }
}
// Validacion Telefono
function validarTelefono(strTelefono) {
    if (strTelefono.length > 6) {
        document.querySelector('#msg-telefono').innerHTML = "";
        document.querySelector('#telefono').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-telefono').innerHTML = "<span style='color: red'>Ingrese un numero valido</span>";
        document.querySelector('#telefono').classList.add("error-inp");
        return false;
    }
}
// Validacion nombre Negocio
function validarNegocio(strNegocios) {
    if (strNegocios.length >= 2) {
        document.querySelector('#msg-negocio').innerHTML = "";
        document.querySelector('#negocio').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-negocio').innerHTML = "<span style='color: red'>Nombre demasiado corto</span>";
        document.querySelector('#negocio').classList.add("error-inp");
        return false;
    }
}


// Validacion URL negocio
var strUrlNegocio = document.getElementById("url_menu")
strUrlNegocio.addEventListener("input", function (event) {    
    validarCarNegocio(this, "[0-9a-z]")
})

function validarCarNegocio(strUrlNegocio, patron) {
    var texto = strUrlNegocio.value
    var letras = texto.split("")
    for (var x in letras) {
        var letra = letras[x]
        if (!(new RegExp(patron, "i")).test(letra)) {
            letras[x] = ""
        }
    }
    strUrlNegocio.value = letras.join("")
}


function validarUrlNegocio(strUrlNegocio){    
    if (strUrlNegocio.length >= 4){
        document.querySelector('#msg-url_menu').innerHTML = "";
        document.querySelector('#url_menu').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-url_menu').innerHTML = "<span style='color: red'>La URL es demasiado corta</span>";
        document.querySelector('#url_menu').classList.add("error-inp");
        return false;
    }
    if (strUrlNegocio.length >= 20){
        document.querySelector('#msg-url_menu').innerHTML = "<span style='color: red'>La URL es demasiado larga</span>";
        document.querySelector('#url_menu').classList.add("error-inp");
        return false;
    }
}

// Validacion Terminos
function validarTerminos(checkTerminos) {
    if (checkTerminos.checked) {
        document.querySelector('#msg-terminos').innerHTML = "";
        document.querySelector('#terminos').classList.remove("error-inp");
    } else {
        document.querySelector('#msg-terminos').innerHTML = "<span style='color: red'>Por favor, debe aceptar los términos para continuar</span>";
        document.querySelector('#terminos').classList.add("error-inp");
        return false;
    }
}

// Mostrar URL en tiempo real de ejemplo
var strUrlNegocio = document.getElementById("url_menu")

strUrlNegocio.addEventListener("input", function (event) {    
    var valueURL = document.getElementById("url_menu").value;
    if( event.data == ''){
        document.querySelector('#url_dinamic').innerHTML = valueURL;        
    } else {        
        document.querySelector('#url_dinamic').innerHTML = '';
        document.querySelector('#url_dinamic').innerHTML = valueURL;        
    }
})







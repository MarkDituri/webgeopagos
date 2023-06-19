
document.addEventListener('DOMContentLoaded', function () {
    let clave_1 = document.querySelector('#clave_1').value;
    let clave_2 = document.querySelector('#clave_2').value;

    formCrear.onsubmit = function (e) {
        e.preventDefault();
        if (clave_1 == '' || clave_2 == '') {
            document.querySelector("#msg-gral").focus();
            document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Por favor ingrese una contraseña</div>";
            return false;
        }
    }

    $('#clave_1').keyup(function (e) {
        //Validar clave segura        
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        var respClave;

        if (false == enoughRegex.test($(this).val())) {
            $('#msg-clave_1').html('Al menos 6 caracteres.');
            respClave = false;
        } else if (mediumRegex.test($(this).val())) {
            $('#msg-clave_1').html('<span class="ok">Contraseña válida.</span>');
            respClave = true;
        } else {
            $('#msg-clave_1').html('<span class="error">Contraseña débil.</span>');
            respClave = false;
        }

        // Crear clave
        let divLoading = document.querySelector("#divLoading");
        let formCrear = document.querySelector("#formCrear");
        formCrear.onsubmit = function (e) {
            if (respClave === true) {
                // e.preventDefault();        
                let clave_1 = document.querySelector('#clave_1').value;
                let clave_2 = document.querySelector('#clave_2').value;
                let email = document.querySelector('#email').value;

                if (clave_1 == '' || clave_2 == '' || email == '') {
                    document.querySelector("#msg-gral").focus();
                    document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Todos los campos son obligatorios</div>";
                    return false;
                } else {
                    if (clave_1 === clave_2) {
                        //Aca envia evento
                        return true;
                    } else {
                        document.querySelector("#msg-gral").focus();
                        document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Tus contraseñas no coinciden</div>";
                        return false;
                    }
                }
            } else {
                document.querySelector("#msg-gral").focus();
                document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Contraseña muy débil</div>";
                return false;
            }
        }
        return false;
    });
})
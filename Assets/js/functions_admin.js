
function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if (tecla == 0 || tecla == 9) return true;
    patron = /[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function testText(txtString) {
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if (stringText.test(txtString)) {
        return true;
    } else {
        return false;
    }
}

function testEntero(intCant) {
    var intCantidad = new RegExp(/^([0-9])*$/);
    if (intCantidad.test(intCant)) {
        return true;
    } else {
        return false;
    }
}

function fntEmailValidate(email) {
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/);
    if (stringEmail.test(email) == false) {
        return false;
    } else {
        return true;
    }
}

function fntValidText() {
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function (validText) {
        validText.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!testText(inputValue)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
}

function fntValidNumber() {
    let validNumber = document.querySelectorAll(".validNumber");
    validNumber.forEach(function (validNumber) {
        validNumber.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!testEntero(inputValue)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
}

function fntValidEmail() {
    let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function (validEmail) {
        validEmail.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!fntEmailValidate(inputValue)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
}

function abrirModalQR() {
    //Varriables Modal guia
    $('#modalViewQR').modal('show');
    btnCloseModal = document.getElementById("closeModalQR")

    btnCloseModal.onclick = function () {
        localStorage.setItem("modalQR", 'false');
    };
}

function btnCopy() {
    const linkText = document.querySelector('.inpUrlCopy'); // Obtener el elemento del enlace
    const textToCopy = linkText.innerText; // Obtener el texto a copiar
    navigator.clipboard.writeText(textToCopy).then(() => {
        // El texto se ha copiado correctamente
        console.log('Texto copiado al portapapeles: ' + textToCopy);
        const icon = document.querySelector('#urlCopy i'); // Obtener el elemento del icono
        icon.classList.remove('fa-regular', 'fa-clone'); // Eliminar las clases actuales
        icon.classList.add('fa-solid', 'fa-check'); // Agregar las clases nuevas
        icon.style.color = 'green'; // Establecer el color verde
    }).catch((error) => {
        // No se pudo copiar el texto
        console.error('Error al copiar texto: ' + error);
    });
}

window.addEventListener('load', function () {
    fntValidText();
    fntValidEmail();
    fntValidNumber();
}, false);



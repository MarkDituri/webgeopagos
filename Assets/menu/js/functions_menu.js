$(document).ready(function () {
    $('.btn-categoria').click(function () {
        $('.btn-categoria').removeClass("active_" + class_color);
        $(this).addClass("active_" + class_color);
    });

    printProductos();
});

var id_restaurante = document.querySelector("#id_restaurante").value;
var divLoading = document.querySelector("#loader");

function printProductos() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/menu/getProductoBestJSON/' + id_restaurante;

    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            // Si existe top TRUE
            if (objData.status) {
                abrirCategoria('best');
                var element = document.getElementById("best-tab");
                element.classList.add("active_" + class_color);

                // Si no mostrar primer producto de la primer categoria disponible
            } else {
                document.querySelector("#cate-best").innerHTML = '';
                abrirCategoria(0); // 0 Para inidcar que buscque la primer categoria                
                let text = document.querySelector(".nav-item").firstElementChild;
                document.querySelector(".btn-categoria").classList.add("active_" + class_color);
            }
        }
    }
}


function abrirCategoria(id_categoria) {
    divLoading.style.display = "flex";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    if (id_categoria == 'best') {
        var ajaxUrl = base_url + '/menu/getProductoBestJSON/' + id_restaurante;
    } else {
        var ajaxUrl = base_url + '/menu/getProductoCatJSON/' + id_categoria + '-' + id_restaurante;
    }

    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                Obj = objData.productos;
                var json2 = JSON.stringify(Obj);
                productos = JSON.parse(json2);
                let viewProduct = '';

                for (var i = 0; i < productos.length; i++) {
                    var id_producto = productos[i].id_producto;
                    var nombre = productos[i].titulo;
                    var descripcion = productos[i].descripcion;
                    var url_img = productos[i].url_img;
                    var precio = productos[i].precio;
                    var url_producto = base_url + `/menu/producto/` + id_producto;

                    viewProduct += `<a href='` + url_producto + `' class='cont-all-productos'>
                        <div class='cont-productos rounded widget'>
                            <div class='cont-img-prod' style='background: url(` + base_url + `/Assets/images/uploads/` + url_img + `); background-size:cover; background-position: center'>                                
                                <div class=''>                                 
                                </div>                                
                            </div>
                            <div class='cont-txt-prod'>
                                <h2 class='post-title my-0 limitar-texto '>
                                    ${nombre}
                                </h2>
                                <p class='post-desc my-0 limitar-texto'>
                                    ${descripcion}
                                </p>               
                            </div>
                            <div class='cont-precio-prod'>
                                <h5>$` + precio + `</h5>
                            </div>                            
                        </div>
                    </a>`
                }

                document.querySelector('#cont-productos').innerHTML = viewProduct;

            } else {
                let viewProduct = '';

                viewProduct += `
                        <div class='cont-productos'>
                            <ul class='meta list-inline mt-1 mb-0'>
                                <li class='list-inline-item'>No hay productos</li>
                            </ul>
                        </div>`


                document.querySelector('#cont-productos').innerHTML = viewProduct;

            }
        }
        divLoading.style.display = "none";
    }
}
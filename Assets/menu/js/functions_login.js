
var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
	if(document.querySelector("#formLogin")){
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) {
			e.preventDefault();

			let strIdRest = document.querySelector('#id_restaurante').value;

			if(strIdRest == "")
			{
				swal("Por favor", "Escribe usuario y contraseñaa.", "error");
				return false;
			}else{
				divLoading.style.display = "flex";
				let ajaxUrl = base_url + '/models/path/login';
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{						
							window.location = base_url+'/Home';
							//window.location = base_url+'/dashboard';
							// window.location.reload(false);
						}else{
							swal("Atención", objData.msg, "error");
							document.querySelector('#id_restaurante').value = "";
						}
					}else{
						swal("Atención","Error en el proceso", "error");
					}
					divLoading.style.display = "none";
					return false;
				}
			}
		}
	}

	if(document.querySelector("#formRecetPass")){		
		let formRecetPass = document.querySelector("#formRecetPass");
		formRecetPass.onsubmit = function(e) {
			e.preventDefault();

			let strIdRest = document.querySelector('#id_restauranteReset').value;
			if(strIdRest == "")
			{
				swal("Por favor", "Escribe tu correo electrónico.", "error");
				return false;
			}else{
				divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? 
								new XMLHttpRequest() : 
								new ActiveXObject('Microsoft.XMLHTTP');
								
				var ajaxUrl = base_url+'/Login/resetPass'; 
				var formData = new FormData(formRecetPass);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;

					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							swal({
								title: "",
								text: objData.msg,
								type: "success",
								confirmButtonText: "Aceptar",
								closeOnConfirm: false,
							}, function(isConfirm) {
								if (isConfirm) {
									window.location = base_url;
								}
							});
						}else{
							swal("Atención", objData.msg, "error");
						}
					}else{
						swal("Atención","Error en el proceso", "error");
					}
					divLoading.style.display = "none";
					return false;
				}	
			}
		}
	}

	if(document.querySelector("#formCambiarPass")){
		let formCambiarPass = document.querySelector("#formCambiarPass");
		formCambiarPass.onsubmit = function(e) {
			e.preventDefault();

			let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
			let idUsuario = document.querySelector('#idUsuario').value;

			if(strPassword == "" || strPasswordConfirm == ""){
				swal("Por favor", "Escribí la nueva contraseña." , "error");
				return false;
			}else{
				if(strPassword.length < 5 ){
					swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres." , "info");
					return false;
				}
				if(strPassword != strPasswordConfirm){
					swal("Atención", "Las contraseñas no son iguales." , "error");
					return false;
				}
				divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? 
							new XMLHttpRequest() : 
							new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/setPassword'; 
				var formData = new FormData(formCambiarPass);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							swal({
								title: "",
								text: objData.msg,
								type: "success",
								confirmButtonText: "Iniciar sesión",
								closeOnConfirm: false,
							}, function(isConfirm) {
								if (isConfirm) {
									window.location = base_url+'/login';
								}
							});
						}else{
							swal("Atención",objData.msg, "error");
						}
					}else{
						swal("Atención","Error en el proceso", "error");
					}
					divLoading.style.display = "none";
				}
			}
		}
	}

}, false);
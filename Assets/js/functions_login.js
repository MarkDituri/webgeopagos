$('.login-content [data-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
});

var divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){		
	//Vlidar ambs campos para cambiar Pass
	if(document.querySelector("#formCambiarPass")){
		let formCambiarPass = document.querySelector("#formCambiarPass");
		let txtPassword = document.querySelector('#txtPassword').value;    
		let txtPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;   

		formCambiarPass.onsubmit = function(e) {		
			e.preventDefault();        
			if(txtPassword == '' || txtPasswordConfirm == ''){
							
				document.querySelector("#msg-gral").focus();
				document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Por favor ingrese una contraseña</div>";            
				return false;
			}
		}		
	}

	//Validar clave segura        
	$('#txtPassword').keyup(function(e) {  	
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
		if(document.querySelector("#formCambiarPass")){
			let divLoading = document.querySelector("#divLoading");
			let formCambiarPass = document.querySelector("#formCambiarPass");
			formCambiarPass.onsubmit = function(e) {			
				e.preventDefault();
				if(respClave === true){
					let strPassword = document.querySelector('#txtPassword').value;
					let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
					let idUsuario = document.querySelector('#idUsuario').value;
		
					if(strPassword == "" || strPasswordConfirm == ""){
						document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Escribe la nueva contraseña</div>";				
						return false;
					}else{
						if(strPassword.length < 7 ){
							document.querySelector("#msg-gral").innerHTML = "<div class='msg-adv'>La contraseña debe tener un mínimo de 5 caracteres.</div>";					
							return false;
						}
						if(strPassword != strPasswordConfirm){
							document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Las contraseñas no son iguales.</div>";					
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
									document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>"+objData.msg+"</div>";							
								}
							}else{
								document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Error en el proceso</div>";						
							}
							divLoading.style.display = "none";
						}
					}
				} else {
					document.querySelector("#msg-gral").focus();
					document.querySelector("#msg-gral").innerHTML = "<div class='msg-gral'>Contraseña muy débil</div>";            
					return false;
				}
			}
		}         
		return false;  
	});

	if(document.querySelector("#formLogin")){
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) {
			e.preventDefault();

			let strEmail = document.querySelector('#txtEmail').value;
			let strPassword = document.querySelector('#txtPassword').value;
			let msgAlert = document.querySelector('#msgAlert');

			if(strEmail == "" || strPassword == "")
			{
				msgAlert.style.visibility = "visible";
				msgAlert.innerHTML = "Por favor, Escriba usuario y contraseña.";				
				return false;
			}else{
				divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/loginUser'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							msgAlert.style.visibility = "hidden";							
							window.location.reload(false);
						}else{
							msgAlert.style.visibility = "visible";
							msgAlert.innerHTML = objData.msg;
							// swal("Atención", objData.msg, "error");
							document.querySelector('#txtPassword').value = "";
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
		let msgAlert2 = document.querySelector('#msgAlert2');

		formRecetPass.onsubmit = function(e) {
			e.preventDefault();

			let strEmail = document.querySelector('#txtEmailReset').value;
			if(strEmail == "")
			{
				msgAlert2.style.visibility = "visible";
				msgAlert2.innerHTML = "Escribe tu correo electrónico.";				
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
									window.location = base_url+'/';
								}
							});
						}else{
							msgAlert2.style.visibility = "visible";
							msgAlert2.innerHTML = objData.msg;										
						}
					}else{
						msgAlert2.style.visibility = "visible";
						msgAlert2.innerHTML = objData.msg;
					}
					divLoading.style.display = "none";
					return false;
				}	
			}
		}
	}

}, false);
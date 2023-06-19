<?php 
	//LOCAL	
	const BASE_URL = "http://localhost/Qudimar-Fusion-Features-mirage";
	const WEB_URL = "http://localhost/Qudimar-Fusion-Features-mirage";

	const DB_HOST = "localhost";
	const DB_NAME = "db_qudimar_local";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";	

	const MP_PUBLIC_KEY = 'TEST-c9a928cd-a8a2-4736-a28b-a612a3aaf140';
	const MP_ACCESS_TOKEN = 'TEST-3381582219099709-111517-6a20ca5318040b043ecf141be502b710-269870262';

	// TEST	
	// const BASE_URL = "https://dev.qudimar.com";
	// const WEB_URL = "https://dev.qudimar.com/";
	
	// const DB_HOST = "localhost";
	// const DB_NAME = "u352148083_qudimar_dev";
	// const DB_USER = "u352148083_dev";
	// const DB_PASSWORD = "SapoPepe1122";
	// const DB_CHARSET = "utf8";
	// const MP_PUBLIC_KEY = 'APP_USR-d320b51e-901c-4943-bc20-544763d7ef5d';
	// const MP_ACCESS_TOKEN = 'APP_USR-3381582219099709-111517-7c6fd8299474fae45f698040173737d4-269870262';
	
	// PROD	
	// const BASE_URL = "https://qudimar.com";
	// const WEB_URL = "https://qudimar.com";
	
	// const DB_HOST = "localhost";
	// const DB_NAME = "u352148083_qudimar_prod";
	// const DB_USER = "u352148083_prod";
	// const DB_PASSWORD = "Markqudimar2022!!";
	// const DB_CHARSET = "utf8";
	// const MP_PUBLIC_KEY = 'APP_USR-d320b51e-901c-4943-bc20-544763d7ef5d';
	// const MP_ACCESS_TOKEN = 'APP_USR-3381582219099709-111517-7c6fd8299474fae45f698040173737d4-269870262';
	
	
	//Zona horaria
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	//Para envío de correo
	const ENVIRONMENT = 0; // Local: 0, Produccón: 1;

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";
	const CURRENCY = "USD";

	//Api PayPal
	//SANDBOX PAYPAL
	const URLPAYPAL = "https://api-m.sandbox.paypal.com";
	const IDCLIENTE = "";
	const SECRET = "";
	//LIVE PAYPAL
	//const URLPAYPAL = "https://api-m.paypal.com";
	//const IDCLIENTE = "";
	//const SECRET = "";

	//Datos Config y Marketing
	const ID_DEMO_MENU = '1tloe4158';

	//Datos envio de correo
	const NOMBRE_REMITENTE = "Qudimar";
	const EMAIL_REMITENTE = "no-reply@qudimar.com";
	const NOMBRE_EMPESA = "Qudimar";
	const WEB_EMPRESA = "www.qudimar.com";

	const DESCRIPCION = "Tu carta online lista para escanear";
	const SHAREDHASH = "Qudimar";

	//Datos Empresa
	const DIRECCION = "Buenos Aires";
	const TELEMPRESA = "+(54)1133048081";
	const WHATSAPP = "+1133048081";
	const EMAIL_EMPRESA = "info@qudimar.com";
	const EMAIL_PEDIDOS = "pedidos@qudimar.com"; 
	const EMAIL_SUSCRIPCION = "newsletter@qudimar.com";
	const EMAIL_CONTACTO = "contacto@qudimar.com";
	const EMAIL_SOPORTE = "soporte@qudimar.com";

	//Envío
	const COSTOENVIO = 5;

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MSUSCRIPTORES = 7;
	const MDCONTACTOS = 8;
	const MDPAGINAS = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RSUPERVISOR = 2;
	const RCLIENTES = 3;

	const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');

	//Productos por página
	const CANTPORDHOME = 8;
	const PROPORPAGINA = 4;
	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;

	//REDES SOCIALES
	const FACEBOOK = "https://www.facebook.com/qudimar";
	const INSTAGRAM = "https://www.instagram.com/qudimar/";	

	// CONEXION A BASE DE DATOS SIMPLES
	function conexion(){
		$host = $_SERVER["HTTP_HOST"];
		//lOCAL
		if ($host == "localhost") {
			$DBhost = DB_HOST;
			$DBuser = DB_USER;
			$DBpass = DB_PASSWORD;
			$DBname = DB_NAME;
		}
		// TEST
		if ($host == "dev.qudimar.com") {
			$DBhost = DB_HOST;
			$DBuser = DB_USER;
			$DBpass = DB_PASSWORD;
			$DBname = DB_NAME;
		}
		// PROD
		if ($host == "qudimar.com") {
			$DBhost = DB_HOST;
			$DBuser = DB_USER;
			$DBpass = DB_PASSWORD;
			$DBname = DB_NAME;
		}
	
		try {
			$conexion = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		} catch(PDOException $ex){    
			die($ex->getMessage());
		}

		return $conexion;
	}

	function devuelveAlgo(){
		echo "devuelv esto";

		return "Hola";
	}

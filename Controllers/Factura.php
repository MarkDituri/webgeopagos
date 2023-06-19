<?php 
	require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

	class Factura extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MPEDIDOS);
		}

		public function generarFactura($id_pago)
		{
			if($_SESSION['permisosMod']['r']){
				if(is_numeric($id_pago)){					
					$id_restaurante = $_SESSION['userData']['id_restaurante'];		
					$data = $this->model->selectPedido($id_pago,$id_restaurante);		
					if(empty($data)){
						echo "Datos no encontrados";
					}else{					
						$id_pago = $data['pago']['id_pago'];
						ob_end_clean();
						$html = getFile("Template/Modals/comprobantePDF",$data);
						$html2pdf = new Html2Pdf('p','A4','es','true','UTF-8');
						$html2pdf->writeHTML($html);
						$html2pdf->output('factura-'.$id_pago.'-'.$id_restaurante.'.pdf');
					}
				}else{
					echo "Dato no válido";
				}
			}else{
				header('Location: '.base_url().'/login');
				die();
			}
		}

	}

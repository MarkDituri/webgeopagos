<?php 
class Home extends Controllers
{			
	public function __construct()
	{
		parent::__construct();			
	}

	public function home(){				
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "home";			
		$data['page_canonical'] = "";		
		$data['page_js'] = "";			
		$this->views->getView($this,"home",$data); 			
	}
	
	public function menu(){				
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "menu";			
		$data['page_canonical'] = "";		
		$data['page_js'] = "";			
		$this->views->getView($this,"home",$data); 			
	}

}

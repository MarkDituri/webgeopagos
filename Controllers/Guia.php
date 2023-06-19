<?php 
class Guia extends Controllers
{			
	public function __construct()
	{
		parent::__construct();			
	}

	public function guia(){				
		$data['page_name'] = "guia";			
		$data['page_js'] = "";			
		$data['page_canonical'] = "guia";		
		$this->views->getView($this,"guia",$data); 			
	}
}

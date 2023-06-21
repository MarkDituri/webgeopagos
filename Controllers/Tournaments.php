<?php
require_once("Models/ApiModel.php");

class Tournaments extends Controllers
{
	use ApiModel;

	public function __construct()
	{
		parent::__construct();
	}

	public function Tournaments()
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Torneos";
		$this->views->getView($this, "home", $data);
	}

	public function players()
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Jugadores";
		$data = $this->getPlayers();  // Consulta a la API

		$this->views->getView($this, "players", $data);
	}

	public function player($slug)
	{
		if (empty($slug)) {
			header("Location:" . base_url() . '/tournaments/players');
		} else {
			$data['page_tag'] = NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "Jugador";
			$data = $this->getPlayer($slug);  // Consulta a la API

			$this->views->getView($this, "player", $data);
		}
	}

	public function cups()
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Copas";
		$data = $this->getCupss();  // Consulta a la API

		$this->views->getView($this, "cups", $data);
	}

	public function start($gender)
	{
		$data['page_tag'] = NOMBRE_EMPESA;
		$data['page_title'] = NOMBRE_EMPESA;
		$data['page_name'] = "Start ";
		$data = $this->getStart($gender);  // Consulta a la API

		$this->views->getView($this, "start", $data);
	}
}

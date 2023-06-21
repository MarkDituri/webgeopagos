<?php

trait ApiModel
{
	public function getPlayer($slug)
	{
		// Consulta a la Api
		$url =  base_api() . '/api/v2/players/' . $slug;
		$json = file_get_contents($url);
		$request = json_decode($json, true);

		return $request;
	}

	public function getPlayers()
	{
		// Consulta a la API
		$url =  base_api() . '/api/v2/players/';
		$json = file_get_contents($url);
		$request = json_decode($json, true);

		return $request;
	}

	public function getCupss()
	{
		// Consulta a la Api		
		$url =  $url =  base_api() . '/api/v2/tournaments/';
		$json = file_get_contents($url);
		$request = json_decode($json, true);

		return $request;
	}

	public function getStart($gender)
	{
		// Consulta a la Api				
		$url =  $url =  base_api() . '/api/v2/start/' . $gender;
		$json = file_get_contents($url);
		$request = json_decode($json, true);

		return $request;
	}
}

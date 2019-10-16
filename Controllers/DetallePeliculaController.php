<?php namespace Controllers;


use Models\Cuenta as Cuenta;
use Models\Cliente as Cliente;



class DetallePeliculaController
{
	
	public function __construct()

	{	
		
			
	}


	public function searchMovie ($movie_id)
	{
		
		include "Config/API_tmdb.php";
		include "Api/api_now.php";// incluyo la API de peliculas actuales en cartelera

	if ($nowplaying!=null){
		foreach ($nowplaying->results as $mov) {
			if ($mov->id == $movie_id){

				//traer las pelis de la BD y reemplazar el llamado a la API
				require(ROOT . '/Views/User/detallePelicula.php');
				break;

			}//if
			
		}//foreach

	}//if general
		

	}//fin buscar peli






}//fin clase---
?>
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
		
		//traer las pelis de la BD y reemplazar el llamado a la API
		$peliculasController = new Adm_PeliculasController();//creo instancia de peliculas controller
		$mov=$peliculasController->buscarXiD_api($movie_id);//busco la pelicula x ID de api y devuelve obj pelicula

		$generos=array();
		$generos=$mov->getCategoria();

		//var_dump($generos);

		$functController = new FuncionController();
		$lista_funciones=$functController->devolverFuncionesXidPelicula($movie_id);

		//var_dump($lista_funciones);
		require(ROOT . '/Views/User/detallePelicula.php');
		
	}//fin buscar peli






}//fin clase---
?>
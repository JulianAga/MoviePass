<?php namespace Controllers;


use Models\Cuenta as Cuenta;
use Models\Cliente as Cliente;



class DetallePeliculaController
{
	private $DAOFunciones;
	
	public function __construct()

	{	
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
			
	}


	public function searchMovie ($movie_id)
	{
		try
		{
			//traer las pelis de la BD y reemplazar el llamado a la API
			$peliculasController = new Adm_PeliculasController();//creo instancia de peliculas controller
			$mov=$peliculasController->buscarXiD_api($movie_id);//busco la pelicula x ID de api y devuelve obj pelicula

			$generos=array();
			$generos=$mov->getCategoria();
			
			$lista_funciones=$this->DAOFunciones->devolverFuncionesXidPelicula($movie_id);
		}
		catch(PDOException $ex)
		{
			$_SESSION['Error']="Error al devolver peliculas por id";
		}
		
		require(ROOT . '/Views/User/detallePelicula2.php');
		
	}//fin buscar peli






}//fin clase---
?>
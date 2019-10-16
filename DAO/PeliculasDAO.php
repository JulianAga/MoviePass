<?php namespace DAO;

use \Exception as Exception;
use \PDOException as PDOException;
use models\Pelicula as Pelicula;

/**
 * 
 */
class PeliculasDAO extends SingletonAbstractDAO implements IDAO
{
	//----------ATRIBUTOS------------------
	private $table = 'Peliculas';
	
	//----------METODOS--------------------
	public function insertar($dato){

	}//FIN INSERTAR
	//
	//
	//
	public function insertarDevolverID($dato){

	}//fin insertar devolver ID
	//
	//
	//
	public function buscarPorID($dato){

	}//fin buscar por ID
	//
	//
	//
	public function borrar($dato){

	}//fin borrar
	//
	//
	//
	public function actualizar($dato){

	}// fin actualizar
	//
	//
	//
	
}
?>
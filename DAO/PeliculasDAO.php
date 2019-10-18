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
		try 
    	{
    		

			$query = 'INSERT INTO '.$this->table.' 
			( duracion, imagen , lenguaje , titulo, descripcion, id_api) 
			VALUES 
			(:duracion, :imagen, :lenguaje, :titulo, :descripcion, :id_api)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$duracion = $dato->getDuracion();
			$imagen = $dato->getImagen();
			$lenguaje = $dato->getLenguaje();
			$titulo = $dato->getNombre();
			$descripcion = $dato->getDescripcion();
			$id_api = $dato->getId_api();

			$command->bindParam(':duracion', $duracion);
			$command->bindParam(':imagen', $imagen);
			$command->bindParam(':lenguaje', $lenguaje);
			$command->bindParam(':titulo', $titulo);
			$command->bindParam(':descripcion', $descripcion);
			$command->bindParam(':id_api', $id_api);


			$command->execute();

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

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
	public function traerTodos(){

	}//fin traer todos
}
?>
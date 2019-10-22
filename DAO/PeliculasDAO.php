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

			//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error==null)
			echo '<script language="javascript">alert("Peliculas Actualizadas..");</script>';
		else{

			echo '<script language="javascript">alert("Error al actualizar peliculas de BD!");</script>';
			echo '<script language="javascript">alert("Error Nº '.$num_error.'");</script>';
			echo '<script language="javascript">alert("Descripcion: '.$descripcion_error.'");</script>';
		}
		//----------------------------------------------------------------------------------

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
	public function buscarPorID($dato){//buscar una pelicula por el ID de la API
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_api = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			

			while ($row = $command->fetch())
			{
				$duracion = ($row['duracion']);
				$imagen = ($row['imagen']);
				$lenguaje = ($row['lenguaje']);
				$titulo = ($row['titulo']);
				$descripcion = ($row['descripcion']);
				$id_api = ($row['id_api']);
				$habilitada = ($row['habilitada']);

				$object = new \Models\Pelicula($id_api, $descripcion, $titulo, $duracion,null, $imagen, $lenguaje) ;
				

				$object->setId($row['id_pelicula']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}

	}//fin buscar por ID
	//
	//
	//
	public function buscarPorID_BD($dato){//buscar una pelicula por el ID de la BD
		try 
    	{
    		
			$object = null;
			

			$query = 'SELECT * FROM '.$this->table.' WHERE id_pelicula = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();



			

			while ($row = $command->fetch())
			{
				$duracion = ($row['duracion']);
				$imagen = ($row['imagen']);
				$lenguaje = ($row['lenguaje']);
				$titulo = ($row['titulo']);
				$descripcion = ($row['descripcion']);
				$id_api = ($row['id_api']);
				$habilitada = ($row['habilitada']);

				$object = new \Models\Pelicula($id_api, $descripcion, $titulo, $duracion,null, $imagen, $lenguaje) ;
				

				$object->setId($row['id_pelicula']);	
			}

			
			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}

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
<?php namespace DAO;

use \Exception as Exception;
use \PDOException as PDOException;
use models\Pelicula as Pelicula;
use DAO\GenerosDAO as GenerosDAO;

/**
 * 
 */
class PeliculasDAO extends SingletonAbstractDAO implements IDAO
{
	//----------ATRIBUTOS------------------
	private $table = 'Peliculas';
	private $table2 = 'PeliculasXgenero';
	private $generosDAO;
	
	public function __construct()
	{			

		//--------------------BD-----------------------------
		$this->generosDAO= new GenerosDAO();
		
		
	}	
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

			$query = 'INSERT INTO '.$this->table2.' 
			(id_pelicula, id_genero) 
			VALUES 
			(:id_pelicula, :id_genero)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

            $array= array();
            $array= $dato->getCategoria();
            foreach($array as $genero)
            {
                $id_pelicula = $dato->getId_api();
                $id_genero = $genero;
                $command->bindParam(':id_pelicula', $id_pelicula);
                $command->bindParam(':id_genero', $id_genero);


                $command->execute();
          
            }//fin foreach

				

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
				
            	$generos = $this->buscarGenerosXidPelicula($dato);
				
			
				$object = new \Models\Pelicula($id_api, $descripcion, $titulo, $duracion,$generos, $imagen, $lenguaje) ;
				
			}//while 


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}

	}//fin buscar por ID
	public function buscarGenerosXidPelicula($dato){

		$array=array();
		$query = 'SELECT * FROM '.$this->table2.' WHERE id_pelicula = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		
		$command->bindParam(':id', $dato);
		$command->execute();
	
		while ($row = $command->fetch())
		{
			$id_genero = ($row['id_genero']);
			
			$object = $this->generosDAO->buscarPorID($id_genero);
			
			array_push($array, $object);
		}
		$generos= $array;
		return $generos;

	}//fin buscar genero x id pelicula
	//
	//
	//
	public function buscarPorID_BD($dato){//buscar una pelicula por el ID de la BD
		try 
    	{
    		
			$object = null;
			

			$query = 'SELECT * FROM '.$this->table.' WHERE id_api = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato->getId_api());
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
		try 
    	{
			$objects = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

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

				$object = new \Models\Pelicula($id_api, $descripcion, $titulo, $duracion,null, $imagen, $lenguaje);

				array_push($objects, $object);

			}
			
			return $objects; //retorno lista de Peliculas

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}



	}//fin traer todos
}
?>
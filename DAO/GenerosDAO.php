<?php namespace DAO;



use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class GenerosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'Generos';
	
	

	public function insertar($dato){
		try 
    	{
    		

			$query = 'INSERT INTO '.$this->table.' 
			(id_genero,nombre_genero) 
			VALUES 
			(:id_genero,:nombre_genero)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id_genero = $dato->getId();
			$nombre_genero = $dato->getName();
			

			$command->bindParam(':nombre_genero', $nombre_genero);
			$command->bindParam(':id_genero', $id_genero);
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

	public function traerTodos()
	{
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
				$nombre= ($row['nombre_genero']);
				$idApi = ($row['id_genero']);
				

				$object = new \Models\Genre($nombre,$idApi);

				array_push($objects, $object);

			}

			return $objects; //retorno lista de Generos

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function guardarGeneros(){


	}
	//
	//
	//
	public function insertarDevolverID($dato){

	}
	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo retorna en forma de objeto.
	public function buscarPorID($dato){
		try 
    	{
    		//var_dump($dato);
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_genero = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$id_genre=$dato;
			$command->bindParam(':id', $id_genre);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre_genero = ($row['nombre_genero']);
				$idGenero=($row['id_genero']);
				$object = new \Models\Genre($idGenero,$nombre_genero) ;

				
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}

	}


	/*public function devolverArrayGeneros($arrayIdGeneros)
    {
        $arrayGeneros=array();
        foreach($arrayIdGeneros as $idGenero)
        {
            $genero = $this->buscarPorID($idGenero);
            array_push($arrayGeneros,$genero);
        }

        return $arrayGeneros;
    }*/


	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo borra. No retorna nada.
	public function borrar($dato){

	}
	// Recibe un objeto (ya modificado) por parametros y lo reemplaza en la tabla y lo actualiza.
	public function actualizar($dato){

	}
	// Retorna todas las filas de la tabla en forma de objetos en un array.
	
}
?>
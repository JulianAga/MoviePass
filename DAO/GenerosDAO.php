<?php namespace DAO;


use models\Genre as Genre;
use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class GenerosDAO extends SingletonAbstractDAO implements IDAO
{

	//-------------ATRIBUTOS--------------
	private $table = 'Generos';
	//-------------METODOS--------------------
	public function insertar($dato){
		try 
    	{
    		

			$query = 'INSERT INTO '.$this->table.' 
			(nombre_genero, id_api) 
			VALUES 
			(:nombre_genero, :id_api)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$nombre_genero = $dato->getName();
			$id_api = $dato->getId();
			

			$command->bindParam(':nombre_genero', $nombre_genero);
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
		try 
    	{
			$query = 'INSERT INTO '.$this->table.' 
			(nombre_genero, id_api) 
			VALUES 
			(:nombre_genero, :id_api)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$nombre_genero = $dato->getName();
			$id_api = $dato->getIdApi();
			

			$command->bindParam(':nombre_genero', $nombre_genero);
			$command->bindParam(':id_api', $id_api);
			


			$command->execute();

			
			$dato->setId($connection->lastInsertId());

			return $dato;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}//fin insertar devolver ID
	//
	//
	//
	public function buscarPorID($dato){
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table.'WHERE id_genero = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre_genero = ($row['nombre_genero']);
				$id_api = ($row['id_api']);

				$object = new \Models\Genre($id, $nombre_genero, $id_api);

				$object->setId($row['id_genero']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}//fin buscar genero por id


	

    	}
    	catch (PDOException $ex) {
    		echo '<script language="javascript">alert("Buscar por genero: PDO EXCEPTION");</script>';
			throw $ex;
    	}
    	catch (Exception $e) {
    		echo '<script language="javascript">alert("Buscar por genero: EXCEPTION");</script>';
			throw $e;
    	}

	}//fin borrar
	//
	//
	//
	public function actualizar($dato){
		try 
    	{
    		//table=clientes
    		

			$query= 'UPDATE '.$this->table.'
					SET nombre_genero = :nombre_genero, 
						id_api = :id_api,
        }
						
					WHERE id_genero = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getID();
			$nombre = $dato->getName();
			$idApi = $dato->getidApi();
			

			$command->bindParam(':id', $id);
			$command->bindParam(':nombre_genero', $nombre);
			$command->bindParam(':id_api', $idApi);
			
			

			$command->execute();

    	}
    	catch (PDOException $ex) {
    		echo '<script language="javascript">alert("Error al modificar Genero en BD");</script>'; //este tipo de mensaje no rompe el codigo
			throw $ex;
    	}
    	catch (Exception $e) {
    		echo '<script language="javascript">alert("Error al modificar Genero en BD");</script>'; //este tipo de mensaje no rompe el codigo
			throw $e;
    	}

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
				$nombre= ($row['nombre_genero']);
				$idApi = ($row['id_api']);
				

				$object = new \Models\Genre($nombre,$idApi);

				$object->setId($row['id_genero']);	

				array_push($objects, $object);

			}

			return $objects; //retorno lista de Cines

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}//fin traer todos
//
//	

	
}//fin class----------------

?>
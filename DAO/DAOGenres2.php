<?php namespace DAO;



use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class DAOGenres extends SingletonAbstractDAO 
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

	public function GetAll()
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
				

				$object = new \Models\Genre($idApi,$nombre);

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
	public function GetById($dato){
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
	public function delete($dato)
	{
		
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_genero= :id';
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);



		$command->bindParam(':id', $dato);
		$command->execute();
		//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($num_error==null){
			$flag=true;//si se pudo borrar y no dio error de BD, asigno true para retornar

		}
		else{
			$flag=false;//si dio error al borrar de BD retorno false 
			$msj="Error en BD. Nº: ".$num_error." .".$descripcion_error.".";
			$_SESSION['BD']=$msj;
		}
		
		//----------------------------------------------------------------------------------

    	}
    	catch (PDOException $ex) {
    		$_SESSION['BD']="Error al eliminar Cine: PDO EXCEPTION";
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    		$_SESSION['BD']="Error al eliminar Cine: EXCEPTION";
    		
			throw $e;
    	}

		return $flag;
	}
	}
	
?>
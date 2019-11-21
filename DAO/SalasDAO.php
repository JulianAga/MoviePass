<?php namespace DAO;

use models\Cine as Cine;
use DAO\CinesDAO as CinesDAO;
use DAO\PeliculasDAO as PeliculasDAO;
//use DAO\SalasDAO as SalasDAO;
use \Exception as Exception;
use \PDOException as PDOException;

class SalasDAO extends SingletonAbstractDAO implements IDAO{

	//-------------ATRIBUTOS--------------
	private $table = 'Salas';
	//-------------METODOS--------------------


	public function insertar($dato){
		try 

    	{
			$query = 'INSERT INTO '.$this->table.' 
			(nombre, capacidad ,  valor_entrada , id_cine) 
			VALUES 
			(:nombre, :capacidad,  :valor_entrada , :id_cine)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$capacidad = $dato->getCapacidad();
			$nombre = $dato->getNombre();
			$valor_entrada = $dato->getValor_Entrada();
			$id_cine = $dato->getCine()->getID();

			
			$command->bindParam(':capacidad', $capacidad);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':valor_entrada', $valor_entrada);
			$command->bindParam(':id_cine', $id_cine);


			$command->execute();

			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
			
			if ($num_error==null){
			$flag=true;//si se pudo insertar y no dio error de BD, asigno true para retornar

			}
			else{
				
				$flag=false;//si dio error al insertar de BD retorno false
			}

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
    	return $flag;

	}//fin insertar
	
	public function insertarDevolverID($dato){

	}//fin insertarDevolverID
	
	public function buscarPorID($dato){
		try 
    	{
    		
    		$cineDAO= new CinesDAO();
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_sala = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$nombre = ($row['nombre']);
				$capacidad = ($row['capacidad']);
				$valor_entrada = ($row['valor_entrada']);
				$id_cine = ($row['id_cine']);
	

				$object = new \Models\Sala($capacidad,$valor_entrada,$nombre,$cineDAO->buscarPorID($id_cine) );

				$object->setId($row['id_sala']);	
			}

			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}
	}// fin buscar por id

		public function buscarPorNombre($dato, $id_cine){
			try 
			{
				
				$object = null;
				$cineDAO= new CinesDAO();
	
				$query = 'SELECT * FROM '.$this->table.' WHERE nombre = :nombre and id_cine = :id_cine';
	
				$pdo = new Connection();
				$connection = $pdo->Connect();
				$command = $connection->prepare($query);			
	
				$command->bindParam(':nombre', $dato);
				$command->bindParam(':id_cine', $id_cine);

				$command->execute();
				
				while ($row = $command->fetch())
				{
					
					$nombre = ($row['nombre']);
					$capacidad = ($row['capacidad']);
					$valor_entrada = ($row['valor_entrada']);
					$id_cine = ($row['id_cine']);
		
					$object = new \Models\Sala($capacidad,$valor_entrada,$nombre,$cineDAO->buscarPorID($id_cine)) ;
	
					$object->setId($row['id_sala']);	
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
	public function borrar($dato){  // SIN TESTEAR
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_sala = :id_sala';
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);



		$command->bindParam(':id_sala', $dato);
		$command->execute();
		//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($num_error==null){
			$flag=true;//si se pudo borrar y no dio error de BD, asigno true para retornar

		}
		else
			$flag=false;//si dio error al borrar de BD retorno false 
		
		//----------------------------------------------------------------------------------

    	}
    	catch (PDOException $ex) {
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    		
			throw $e;
    	}

    	return $flag;
	}//fin borrar
	
	public function actualizar($dato){

	}//fin actualizar
	
	public function traerTodos(){
		try 
    	{
    		
			$salasDAO= new SalasDAO();
			$cineDAO= new CinesDAO();
			
			$array = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			while ($row = $command->fetch())
			{
				$id_sala = ($row['id_sala']);
				$nombre = ($row['nombre']);
				$capacidad = ($row['capacidad']);
				$valor_entrada = ($row['valor_entrada']);
				$id_cine = ($row['id_cine']);
				
				$object = new \Models\Sala($capacidad,$valor_entrada,$nombre,$cineDAO->buscarPorID($id_cine) );
				$object->setId($id_sala);
				array_push($array, $object);

			}

			return $array; //retorno lista de funciones

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}//fin traerTodos




}//fin class

?>
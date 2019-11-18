<?php namespace DAO;


use models\Cine as Cine;
use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class CinesDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'Cines';
	//-------------METODOS--------------------
	public function insertar($dato){
		try 

    	{	
			$query = 'INSERT INTO '.$this->table.' 
			(direccion, nombre ,  habilitado) 
			VALUES 
			(:direccion, :nombre,  :habilitado)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$habilitado = $dato->getHabilitado();

			
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':habilitado', $habilitado);


			$command->execute();

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

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
    	return $flag;

	}//FIN INSERTAR
	//
	//
	//
	public function insertarDevolverID($dato){
		try 
    	{
			$query = 'INSERT INTO '.$this->table.' 
			(  direccion,nombre,habilitado) 
			VALUES 
			( :direccion,:nombre ,:habilitado)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			

			
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$habilitado = $dato->getHabilitado();

			
			
			
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':habilitado', $habilitado);
			
			

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

			$query = 'SELECT * FROM '.$this->table.' WHERE id_cine = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$direccion = ($row['direccion']);
				$nombre = ($row['nombre']);
				$habilitado = ($row['habilitado']);

				$object = new \Models\cine($nombre, $direccion, $habilitado) ;

				$object->setId($row['id_cine']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}//fin buscar cuenta por id de cliente

	
	//
	public function buscarPorNombre($dato){
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE nombre = :nombre_cine';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':nombre_cine', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$direccion = ($row['direccion']);
				$nombre = ($row['nombre']);
				$habilitado = ($row['habilitado']);

				$object = new \Models\cine($nombre, $direccion, $habilitado) ;

				$object->setId($row['id_cine']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}//fin buscar cine por nombre


	public function deshabilitar($dato){
			$flag;
			$cine = buscarPorID($dato);
			$cine->setHabilitado(false);

			$flag=actualizar($cine);
	}

	//
	//
	public function borrar($dato){
		
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_cine = :id';
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
	}//fin borrar
	//
	//
	//
	public function actualizar($dato){
		try 
    	{
    		//table=clientes
    		
    		$flag;
			$query= 'UPDATE '.$this->table.'
					SET  
						direccion = :direccion,
						nombre = :nombre,
						habilitado = :habilitado
						
					WHERE id_cine = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getID();
			
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$habilitado = $dato->getHabilitado();
					
					


			$command->bindParam(':id', $id);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':habilitado', $habilitado);
			

			$command->execute();

			//-------------------CAPTURO ERRORES DE BD---------------------------------------
			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		
			if ($num_error==null){
				$flag=true;//si se pudo borrar y no dio error de BD, asigno true para retornar

			}
			else{
				$msj="Error en BD. Nº: ".$num_error." .".$descripcion_error.".";
				$_SESSION['BD']=$msj;
				$flag=false;//si dio error al borrar de BD retorno false 
			}
		
		//----------------------------------------------------------------------------------

    	}
    	catch (PDOException $ex) {

			$_SESSION['BD']="Error al modificar Cine en BD.PDOException";
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    		$_SESSION['BD']="Error al modificar Cine en BD.EXCEPTION";
			throw $e;
    	}
    	return $flag;

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
				
				$direccion = ($row['direccion']);
				$nombre = ($row['nombre']);
				$habilitado = ($row['habilitado']);

				$object = new \Models\cine($nombre,$direccion,$habilitado);

				$object->setId($row['id_cine']);	

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
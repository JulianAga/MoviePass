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
			(capacidad, direccion, nombre , valor_entrada , habilitado) 
			VALUES 
			(:capacidad, :direccion, :nombre, :valor_entrada, :habilitado)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$capacidad = $dato->getCapacidad();
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$valor_entrada = $dato->getValor_entrada();
			$habilitado = $dato->getHabilitado();

			$command->bindParam(':capacidad', $capacidad);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':valor_entrada', $valor_entrada);
			$command->bindParam(':habilitado', $habilitado);


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
			( capacidad, direccion,nombre,valor_entrada ,habilitado) 
			VALUES 
			( :capacidad, :direccion,:nombre,:valor_entrada ,:habilitado)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			

			$capacidad = $dato->getCapacidad();
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$valor_entrada = $dato->getValor_entrada();
			$habilitado = $dato->getHabilitado();

			
			
			$command->bindParam(':capacidad', $capacidad);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':valor_entrada', $valor_entrada);
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
				$capacidad = ($row['capacidad']);
				$direccion = ($row['direccion']);
				$nombre = ($row['nombre']);
				$valor_entrada = ($row['valor_entrada']);
				$habilitado = ($row['habilitado']);

				$object = new \Models\cine($nombre, $direccion, $capacidad, $valor_entrada, $habilitado) ;

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


	public function deshabilitar($dato)
	{
			$cine = buscarPorID($dato);
			$cine->setHabilitado(false);
			actualizar($cine);
			echo '<script language="javascript">alert("Cine deshabilitado");</script>';
	}

	//
	//
	public function borrar($dato){
		
		try 
    	{
		$query = 'DELETE FROM '.$this->table.' WHERE id_cine = :id';


		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);



		$command->bindParam(':id', $dato);
		$command->execute();
		//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error==null)
			echo '<script language="javascript">alert("Cine Eliminado");</script>';
		else{

			echo '<script language="javascript">alert("Error al eliminar Cine de BD");</script>';
			echo '<script language="javascript">alert("Error Nº '.$num_error.'");</script>';
			echo '<script language="javascript">alert("Descripcion: '.$descripcion_error.'");</script>';
		}
		//----------------------------------------------------------------------------------

    	}
    	catch (PDOException $ex) {
    		echo '<script language="javascript">alert("Error al eliminar Cine: PDO EXCEPTION");</script>';
			throw $ex;
    	}
    	catch (Exception $e) {
    		echo '<script language="javascript">alert("Error al eliminar Cine: EXCEPTION");</script>';
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
					SET capacidad = :capacidad, 
						direccion = :direccion,
						nombre = :nombre,
						valor_entrada = :valor_entrada,
						habilitado = :habilitado
						
					WHERE id_cine = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getID();
			$capacidad = $dato->getCapacidad();
			$direccion = $dato->getDireccion();
			$nombre = $dato->getNombre();
			$valor_entrada = $dato->getValor_entrada();
			$habilitado = $dato->getHabilitado();
					
					


			$command->bindParam(':id', $id);
			$command->bindParam(':capacidad', $capacidad);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':valor_entrada', $valor_entrada);
			$command->bindParam(':habilitado', $habilitado);
			

			$command->execute();

    	}
    	catch (PDOException $ex) {
    		echo '<script language="javascript">alert("Error al modificar Cine en BD");</script>'; //este tipo de mensaje no rompe el codigo
			throw $ex;
    	}
    	catch (Exception $e) {
    		echo '<script language="javascript">alert("Error al modificar Cine en BD");</script>'; //este tipo de mensaje no rompe el codigo
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
				$capacidad = ($row['capacidad']);
				$direccion = ($row['direccion']);
				$nombre = ($row['nombre']);
				$valor_entrada = ($row['valor_entrada']);
				$habilitado = ($row['habilitado']);

				$object = new \Models\cine($nombre,$direccion,$capacidad,$valor_entrada,$habilitado);

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
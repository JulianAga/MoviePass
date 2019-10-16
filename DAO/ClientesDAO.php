<?php 

namespace DAOS;

use \Exception as Exception;
use \PDOException as PDOException;

class ClientesDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------------------
	private $table = 'Clientes';



	//-------------------METODOS-----------------------

	public function insertar($dato){
		
		$query = 'INSERT INTO '.$this->table.' 
		( nombre , apellido , dni, telefono , direccion , ciudad , numero_tarjeta) 
		VALUES 
		( :nombre , :apellido ,:dni, :telefono , :direccion , :ciudad , :numero_tarjeta )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$nombre = $dato->getNombre();
		$apellido = $dato->getApellido();
		$dni = $dato->getDni();
		$telefono = $dato->getTelefono();
		$direccion = $dato->getDireccion();
		$ciudad = $dato->getCiudad();
		$num_tarjeta = $dato->getNumeroTarjeta();

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':dni', $dni);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':direccion', $direccion);
		$command->bindParam(':ciudad', $ciudad);
		$command->bindParam(':numero_tarjeta', $numTarjeta);

		$command->execute();
		
	}
	public function insertarDevolverID($dato){
		
		$query = 'INSERT INTO '.$this->table.' 
		( nombre , apellido ,dni, telefono , direccion , ciudad , numero_tarjeta ) 
		VALUES 
		( :nombre , :apellido ,:dni, :telefono , :direccion , :ciudad , :numero_tarjeta )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$nombre = $dato->getNombre();
		$apellido = $dato->getApellido();
		$dni = $dato->getDni();
		$telefono = $dato->getTelefono();
		$direccion = $dato->getDireccion();
		$ciudad = $dato->getCiudad();
		$num_tarjeta = $dato->getNumeroTarjeta();

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':dni', $dni);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':direccion', $direccion);
		$command->bindParam(':ciudad', $ciudad);
		$command->bindParam(':numero_tarjeta', $numTarjeta);

		$command->execute();

		$dato->setId($connection->lastInsertId());
			
		return $dato;
		
	}
	public function buscarPorID($dato)
	{
		try 
    	{
			
			$object = null;
			
			$query = 'SELECT * FROM '.$this->table.' WHERE id_cliente = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre = ($row['nombre']);
				$apellido = ($row['apellido']);
				$dni = ($row['dni']);
				$telefono = ($row['telefono']);
				$direccion = ($row['direccion']);
				$ciudad = ($row['ciudad']);
				$numTarjeta = ($row['numero_tarjeta']);

				$object = new \Models\Cliente( $nombre , $apellido ,$dni,$telefono, $direccion ,$ciudad,$numTarjeta  ) ;

				$object->setId($row['id_cliente']);	
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
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
}
?>
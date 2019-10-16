<?php 

namespace DAOS;
/*
CREATE TABLE clientes(
 *	id_cliente int auto_increment not null,
 *	nombre varchar(30),
 *	apellido varchar(30),
 *	telefono varchar(30),
 *	direccion varchar(30),
 *	ciudad varchar(30),
 *	num_tarjeta varchar(30),
 *	
 *	
 *	primary key(id_cliente)
 *	);
*/
use \Exception as Exception;
use \PDOException as PDOException;

class ClientesDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------------------
	private $table = 'clientes';



	//-------------------METODOS-----------------------

	public function insertar($dato){
		
		$query = 'INSERT INTO '.$this->table.' 
		( nombre , apellido , telefono , direccion , ciudad , num_tarjeta) 
		VALUES 
		( :nombre , :apellido , :telefono , :direccion , :ciudad , :num_tarjeta )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$nombre = $dato->getNombre();
		$apellido = $dato->getApellido();
		$telefono = $dato->getTelefono();
		$direccion = $dato->getDireccion();
		$ciudad = $dato->getCiudad();
		$num_tarjeta = $dato->getNumeroTarjeta();

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':direccion', $direccion);
		$command->bindParam(':ciudad', $ciudad);
		$command->bindParam(':num_tarjeta', $numTarjeta);

		$command->execute();
		
	}
	public function insertarDevolverID($dato){
		
		$query = 'INSERT INTO '.$this->table.' 
		( nombre , apellido , telefono , direccion , ciudad , num_tarjeta ) 
		VALUES 
		( :nombre , :apellido , :telefono , :direccion , :ciudad , :num_tarjeta )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$nombre = $dato->getNombre();
		$apellido = $dato->getApellido();
		$telefono = $dato->getTelefono();
		$direccion = $dato->getDireccion();
		$ciudad = $dato->getCiudad();
		$num_tarjeta = $dato->getNumeroTarjeta();

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':direccion', $direccion);
		$command->bindParam(':ciudad', $ciudad);
		$command->bindParam(':num_tarjeta', $numTarjeta);

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
				$telefono = ($row['telefono']);
				$direccion = ($row['direccion']);
				$ciudad = ($row['ciudad']);
				$numTarjeta = ($row['num_tarjeta']);

				$object = new \Models\Cliente( $nombre , $apellido ,$telefono, $direccion ,$ciudad,$numTarjeta  ) ;

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
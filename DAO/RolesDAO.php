<?php namespace DAOS;

use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class RolesDAO extends SingletonAbstractDAO implements IDAO
{

	private $table = 'Roles';
//----------------------------------METODOS-----------
	public function insertarRol($dato){//inserta un nuevo rol en bd
		
		$query = 'INSERT INTO '.$this->table.' 
		( nombre , descripcion ) 
		VALUES 
		( :nombre , :descripcion )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$nombre = $dato->getNombre();
		$descripcion = $dato->getDescripcion();
		

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':descripcion', $descripcion);
		

		$command->execute();
		
	}//FIN NUEVO
	





}//FIN CLASS

?>
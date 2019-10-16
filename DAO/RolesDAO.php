<?php namespace DAO;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Rol as Rol;

/**
 * 
 */
class RolesDAO extends SingletonAbstractDAO implements IDAO
{

	private $table = 'Roles';
//----------------------------------METODOS-----------
	public function insertar($dato){//inserta un nuevo rol en bd
		
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
	//
	//
	public function buscarRol($dato){//busca un rol por nombre ,tiene que recibir ADM para administrador y User para user

		try 
    	{
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE nombre = :nombre';//busco en table2 qe corresponde a Roles

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':nombre', $dato);

			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre=($row['nombre']);
				$descripcion=($row['descripcion']);
				

				$object = new Rol($nombre,$descripcion);//tomo los datos de la cuenta buscada y creo un objeto
				$object->setId($row['id_rol']);	//le asigno el id al objeto rol	
			}

			return $object;//retorno el objeto o null si no lo encontro

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}//fin buscar--------
	public function insertarDevolverID($dato){

	}
	public function buscarPorID($dato){

	}
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
	





}//FIN CLASS

?>
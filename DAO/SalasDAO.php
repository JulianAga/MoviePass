<?php namespace DAO;

use models\Cine as Cine;
use \Exception as Exception;
use \PDOException as PDOException;

class SalasDAO extends SingletonAbstractDAO implements IDAO{

	//-------------ATRIBUTOS--------------
	private $table = 'Salas';
	//-------------METODOS--------------------


	public function insertar($dato){
		try 

    	{
    		
    		
			
    		$flag;
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
			else
				$flag=false;//si dio error al insertar de BD retorno false

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

	}//fin buscarPorID
	
	public function borrar($dato){

	}//fin borrar
	
	public function actualizar($dato){

	}//fin actualizar
	
	public function traerTodos(){

	}//fin traerTodos

}//fin class

?>
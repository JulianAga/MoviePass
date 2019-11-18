<?php namespace DAO;


use \Exception as Exception;
use \PDOException as PDOException;
use DAO\CinesDAO as CinesDAO;
use DAO\PeliculasDAO as PeliculasDAO;
use DAO\SalasDAO as SalasDAO;
/**
 * 
 */
class FuncionesDAO extends SingletonAbstractDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'Funciones';
	//-------------METODOS--------------------
	public function insertar($dato){
		try 
    	{
    		
			$query = 'INSERT INTO '.$this->table.' 
			(id_sala, id_pelicula, dia, horario) 
			VALUES 
			(:id_sala, :id_pelicula, :dia, :horario)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id_sala = $dato->getSala()->getId();
			$id_pelicula = $dato->getIdPelicula();
            $dia = $dato->getDia();
			$horario = $dato->getHorario();
            

			$command->bindParam(':id_sala', $id_sala);
			$command->bindParam(':id_pelicula', $id_pelicula);
            $command->bindParam(':dia', $dia);
			$command->bindParam(':horario', $horario);

			$command->execute();

			$dato->setId($connection->lastInsertId());

			return $dato;

		//capturar errores de BD----------------------------
			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error!=null){
			$msj="Error al guardar Funcion en  BD. Error Nº ".$num_error." Descripcion: ".$descripcion_error ;
			$_SESSION['Error']=$msj;
		}
		//-----------------------------------------------------

    	

    	}//fin if 
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

    }
    //FIN INSERTAR
	//
	//
    //
    public function traerTodos(){
		try 
    	{
			$salasDAO= new SalasDAO();
			$peliDAO= new PeliculasDAO();
			
			$arrayFunciones = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			while ($row = $command->fetch())
			{
				$id_sala = ($row['id_sala']);
				$id_pelicula = ($row['id_pelicula']);
				$dia = ($row['dia']);
				$horario = ($row['horario']);
				

				$object = new \Models\Funcion($salasDAO->buscarPorID($id_sala),$peliDAO->buscarPorID($id_pelicula),$horario,$dia);
				
				//$object->setId($row['id_funcion']);
				array_push($arrayFunciones, $object);

			}

			return $arrayFunciones; //retorno lista de funciones

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
public function devolverFuncionesXidPelicula($dato){


	
	$salaDAO= new SalasDAO();
	$peliDAO= new PeliculasDAO();
	$arrayFunciones = array();
	$query = 'SELECT * FROM ' .$this->table.' inner join Peliculas ON ' .$this->table.'.id_pelicula=Peliculas.id_api WHERE '.$this->table. '.id_pelicula=:id'; //devuelve todas las funciones asociadas a una pelicula

	$pdo = new Connection();
	$connection = $pdo->Connect();
	$command = $connection->prepare($query);
	$command->bindParam(':id', $dato);

	$command->execute();

	//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error!=null){
			$msj="Error al eliminar Cine de BD. Error Nº ".$num_error." Descripcion: ".$descripcion_error ;
			$_SESSION['Error']=$msj;
		}
		//----------------------------------------------------------------------------------

	while ($row = $command->fetch())
	{
		$id_sala = ($row['id_sala']);
		$id_pelicula = ($row['id_pelicula']);
		$dia = ($row['dia']);
		$horario = ($row['horario']);
		

		$object = new \Models\Funcion($salaDAO->buscarPorID($id_sala),$peliDAO->buscarPorID($id_pelicula),$horario,$dia);
		//$object->setId($row['id_funcion']);
		array_push($arrayFunciones, $object);

	}

	return $arrayFunciones; //retorno lista de funciones

}//fin devolver funciones x id pelicula
//
//
//
public function devolverFuncionesXsala($dato){
	$salaDAO= new SalasDAO();
	$peliDAO= new PeliculasDAO();

	$arrayFunciones = array();

	$query= 'SELECT * FROM ' .$this->table. ' where id_sala=:id';

	$pdo = new Connection();
	$connection = $pdo->Connect();
	$command = $connection->prepare($query);
	$command->bindParam(':id', $dato);

	$command->execute();

	//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error!=null){
			$msj="Error al devolver funciones X Cine de BD. Error Nº ".$num_error." Descripcion: ".$descripcion_error ;
			$_SESSION['Error']=$msj;
		}
		//----------------------------------------------------------------------------------

	while ($row = $command->fetch())
	{
		$id_sala = ($row['id_sala']);
		$id_pelicula = ($row['id_pelicula']);
		$dia = ($row['dia']);
		$horario = ($row['horario']);
		

		$object = new \Models\Funcion($salaDAO->buscarPorID($id_sala),$peliDAO->buscarPorID($id_pelicula),$horario,$dia);
		$object->setId($row['id_funcion']);
		array_push($arrayFunciones, $object);

	}

	return $arrayFunciones; //retorno lista de funciones


}//fin devolver funciones x cine
//
//
//
public function verificarPeliculaEnCartelera($id_cine,$id_pelicula,$fecha){
	
	
	$arrayFunciones = array();

	$query='SELECT * FROM '.$this->table. ' WHERE '.$this->table. '.dia="'.$fecha.  '" AND '.$this->table.'.id_pelicula='.$id_pelicula;
	//echo $query;
	$pdo = new Connection();
	$connection = $pdo->Connect();
	$command = $connection->prepare($query);

	$command->execute();

	//-------------------CAPTURO ERRORES DE BD---------------------------------------
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($row = $command->fetch()){
			
			return true;//retorno true si encontro esa pelicula en cartelera
			
		}
		else
			return false;
	//----------------------------------------------------------------------------------

	


}//fin verificar pelicula en cartelera
//
//
//
public function borrar($idSala,$idPelicula){
	
	try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_sala = :id AND id_pelicula = :idPelicula';
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);



		$command->bindParam(':id', $idSala);
		$command->bindParam(':idPelicula', $idPelicula);
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

			$_SESSION['Error']="Error al eliminar Cine: PDO EXCEPTION";
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    		$_SESSION['Error']="Error al eliminar Cine:EXCEPTION";

			throw $e;
    	}

    	return $flag;
}//fin borrar

}// fin class-----
    ?>
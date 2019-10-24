<?php namespace DAO;


use \Exception as Exception;
use \PDOException as PDOException;
use DAO\CinesDAO as CinesDAO;
use DAO\PeliculasDAO as PeliculasDAO;
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
			(id_cine, id_pelicula, dia, horario) 
			VALUES 
			(:id_cine, :id_pelicula, :dia, :horario)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id_cine = $dato->getIdCine();
			$id_pelicula = $dato->getIdPelicula();
            $dia = $dato->getDia();
			$horario = $dato->getHorario();
            

			$command->bindParam(':id_cine', $id_cine);
			$command->bindParam(':id_pelicula', $id_pelicula);
            $command->bindParam(':dia', $dia);
			$command->bindParam(':horario', $horario);

			$command->execute();

		//capturar errores de BD----------------------------
			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		if ($descripcion_error==null)
			echo '<script language="javascript">alert("Funcion Agregada!");</script>';
		else{

			echo '<script language="javascript">alert("Error al guardar Funcion en  BD. Error Nº '.$num_error.' Descripcion: '.$descripcion_error.' ");</script>';
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
			$objects = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			while ($row = $command->fetch())
			{
				$id_cine = ($row['id_cine']);
				$id_pelicula = ($row['id_pelicula']);
				$dia = ($row['dia']);
				$horario = ($row['horario']);
				
				$CinesDAO = new CinesDAO();
				$PeliculasDAO = new PeliculasDAO();
				$cine= $CinesDAO->buscarPorID($id_cine);         //con el dao de cines busco el cine en la base de datos con el id y creo el objeto
				$pelicula = $PeliculasDAO->buscarPorID($id_pelicula); // lo mismo con la pelicula
				var_dump($pelicula);
				$object = new \Models\Funcion($cine,$pelicula,$horario,$dia);
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
    
    
}
    ?>
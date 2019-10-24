<?php namespace DAO;


use Models\Pelicula as Pelicula;
use Models\Genre as Genero;
use \Exception as Exception;
use \PDOException as PDOException;

use DAO\PeliculasDAO as PeliculasDAO;
use DAO\GenerosDAO as GenerosDAO;
/**
 * 
 */
class PeliculasXgeneroDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'PeliculasXgenero';
	//-------------METODOS--------------------
	public function insertar($dato){
		try 
    	{
    		
            
			$query = 'INSERT INTO '.$this->table.' 
			(id_pelicula, id_genero) 
			VALUES 
			(:id_pelicula, :id_genero)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

            $array= array();
            $array= $dato->getCategoria();
            var_dump($array);
            foreach($array as $genero)
            {
                    $id_pelicula = $dato->getId_api();
                    $id_genero = $genero;
                    $command->bindParam(':id_pelicula', $id_pelicula);
                    $command->bindParam(':id_genero', $id_genero);
    
    
                    $command->execute();
    
               
            }
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
	
	
	//
	public function buscarGeneroPorIdPelicula($dato){
		try 
    	{
            $generosDAO= new GenerosDAO();
            
            $array=array();
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_pelicula = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$id_genero = ($row['id_genero']);
                $object = $generosDAO->buscarPorID($id_genero);
                
                array_push($array, $object);
			}


			return $array;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}//fin buscar genero por id de pelicula

	//
	public function buscarPeliculaPorIdGenero($dato){
		try 
    	{
            $peliculasDAO=new PeliculasDAO();

            $array=array();
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_genero = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$id_pelicula = ($row['id_pelicula']);
                $object =  $peliculasDAO->buscarPorID($id_pelicula);
                
                array_push($array, $object);
			}


			return $array;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}//fin buscar genero por id de pelicula
	
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

    public function insertarDevolverID($dato){}
	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo retorna en forma de objeto.
	public function buscarPorID($dato){}
	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo borra. No retorna nada.
	
	
}//fin class----------------


    
	

?>
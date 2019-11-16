<?php namespace DAO;


use Models\CuentaCredito as CuentaCredito;
use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class CuentaCreditoDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'CuentasCredito';
	//-------------METODOS--------------------
	public function insertar($dato){
		try 

    	{
    		
    		
    		$flag;
			$query = 'INSERT INTO '.$this->table.' 
			(empresa, numero_tarjeta) 
			VALUES 
			(:empresa, :numero_tarjeta)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$empresa = $dato->getEmpresa();
			$numero_tarjeta = $dato->getNumeroTarjeta();
			

			
			$command->bindParam(':empresa', $empresa);
			$command->bindParam(':numero_tarjeta', $numero_tarjeta);
			


			$command->execute();

			$dato->setId($connection->lastInsertId());
            
            return $dato;

			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
			
			if ($num_error==null){
			$flag=true;//si se pudo borrar y no dio error de BD, asigno true para retornar

			}
			else
				$flag=false;//si dio error al borrar de BD retorno false

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
	
	//
	//
	//
	public function buscarPorID($dato){ // id
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_cuenta_credito = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$empresa = ($row['empresa']);
				$numero_tarjeta = ($row['numero_tarjeta']);
				

				$object = new CuentaCredito($empresa, $numero_tarjeta);

				$object->setId($row['id_cuenta_credito']);	
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
	//
	public function borrar($dato){
		
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_cuenta_credito = :id';
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
		else
			$flag=false;//si dio error al borrar de BD retorno false 
		
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
                    empresa = :empresa,
                    numero_tarjeta = :numero_tarjeta,
						
					WHERE id_cuenta_credito = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			
			
			$empresa = $dato->getEmpresa();
			$numero_tarjeta = $dato->getNumeroTarjeta();
			

			$command->bindParam(':id', $id);
			$command->bindParam(':empresa', $empresa);
			$command->bindParam(':numero_tarjeta', $numero_tarjeta);

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
    		echo '<script language="javascript">alert("Error al modificar Cine en BD");</script>'; //este tipo de mensaje no rompe el codigo
			throw $ex;
    	}
    	catch (Exception $e) {
    		echo '<script language="javascript">alert("Error al modificar Cine en BD");</script>'; //este tipo de mensaje no rompe el codigo
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
				
				$empresa = ($row['empresa']);
				$numero_tarjeta = ($row['numero_tarjeta']);
				

				$object = new CuentaCredito($empresa, $numero_tarjeta);

				$object->setId($row['id_cuenta_credito']);	
				array_push($objects, $object);
			}

			
			return $objects; //retorno lista de CuentasCredito

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
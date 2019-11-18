<?php namespace DAO;


use Models\Compra as Compra;
use \Exception as Exception;
use \PDOException as PDOException;
use DAO\CuentasDAO as CuentasDAO;
use DAO\EntradasDAO as EntradasDAO;
/**
 * 
 */
class ComprasDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'Compras';
	//-------------METODOS--------------------

	public function insertarDevolverID($dato){}
	public function actualizar($dato){}
	
	
	public function insertar($dato){
		try 
    	{
    		$entradasdao = EntradasDAO::getInstance();
    		
    		$flag;
			$query = 'INSERT INTO '.$this->table.' 
			(id_cuenta, fecha, descuento , subtotal, total) 
			VALUES 
			(:id_cuenta, :fecha, :descuento,  :subtotal, :total)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id_cuenta= $dato->getCuenta()->getId();
			$fecha = $dato->getFecha();
			$descuento = $dato->getDescuento();
            $subtotal = $dato->getSubtotal();
            $total = $dato->getTotal();

			$command->bindParam(':id_cuenta', $id_cuenta);
			$command->bindParam(':fecha', $fecha);
			$command->bindParam(':descuento', $descuento);
            $command->bindParam(':subtotal', $subtotal);
            $command->bindParam(':total', $total);


            $command->execute();
            
			$dato->setId($connection->lastInsertId());
			
			/*$entradas=$dato->getEntradas();
			foreach($entradas as $e)
			{
				$entradasdao->insertar($e,$dato->getId());
			}*/
            
            


			$num_error=$command->errorInfo()[1];//tomo el error que produce la query
			$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
			
			if ($num_error==null){
			$flag=true;//si se pudo borrar y no dio error de BD, asigno true para retornar
				
			}
			else
				echo $descripcion_error;//si dio error al borrar de BD retorno false

			return $dato;
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
	public function buscarPorID($dato){
		try 
    	{
    		$cuentasdao= CuentasDAO::getInstance();
			$entradasdao = EntradasDAO::getInstance();
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_compra = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$cuenta=$cuentasdao->buscarPorID($row['id_cuenta']);
				$entradas=$entradasdao->buscarPorIDCompra($row['id_compra']);
                $fecha = ($row['fecha']);
				$descuento = ($row['descuento']);
                $subtotal = ($row['subtotal']);
                $total = ($row['total']);

				$object = new Compra($cuenta,$entradas,$fecha, $descuento, $subtotal,$total);

				$object->setId($row['id_compra']);	
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
	public function borrar($dato){
		
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_compra = :id';
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
	/*public function actualizar($dato){
		try 
    	{
    		//table=clientes
    		
    		$flag;
			$query= 'UPDATE '.$this->table.'
					SET  
					id_cuenta=:id_cuenta,
					fecha = :fecha,
                    descuento = :descuento,
                    subtotal = :subtotal,
                    total = :total
						
					WHERE id_compra = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			
            
            $fecha = $dato->getFecha();
			$descuento = $dato->getDescuento();
            $subtotal = $dato->getSubtotal();
            $total = $dato->getTotal();

			$command->bindParam(':id', $id);
			$command->bindParam(':fecha', $fecha);
			$command->bindParam(':descuento', $descuento);
            $command->bindParam(':subtotal', $subtotal);
            $command->bindParam(':total', $total);
			

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

	}// fin actualizar*/
	//
	//
	//
	public function traerTodos(){
		try 
    	{
			$cuentasdao= CuentasDAO::getInstance();
			$entradasdao = EntradasDAO::getInstance();
			
			$objects = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			

			while ($row = $command->fetch())
			{
				
				$cuenta=$cuentasdao->buscarPorID($row['id_cuenta']);
				$entradas=$entradasdao->buscarPorIDCompra($row['id_compra']);
                $fecha = ($row['fecha']);
				$descuento = ($row['descuento']);
                $subtotal = ($row['subtotal']);
                $total = ($row['total']);

				$object = new Compra($cuenta,$entradas,$fecha, $descuento, $subtotal,$total);

				$object->setId($row['id_compra']);		

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
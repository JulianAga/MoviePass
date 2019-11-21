<?php namespace DAO;


use Models\PagoTC as PagoTC;
use \Exception as Exception;
use \PDOException as PDOException;
use \ComprasDAO as ComprasDAO;
use \CuentaCreditoDAO as CuentaCreditoDAO;
/**
 * 
 */
class PagoTCDAO extends SingletonAbstractDAO implements IDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'PagoTC';
	//-------------METODOS--------------------
	public function insertar(PagoTC $dato){
		try 

    	{
    		
    		
    		$flag;
			$query = 'INSERT INTO '.$this->table.' 
			(id_compra, id_cuenta_credito, cod_aut, fecha,total) 
			VALUES 
			(:id_compra, :id_cuenta_credito, :cod_aut, :fecha, :total)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$id_compra = $dato->getCompra()->getId();
            $id_cuenta_credito = $dato->getCuentaCredito()->getId();
            $cod_aut = $dato->getCodigoAutenticacion();
			$fecha = $dato->getFecha();
            $total = $dato->getTotal();
			
			$command->bindParam(':id_compra', $id_compra);
            $command->bindParam(':id_cuenta_credito', $id_cuenta_credito);
            $command->bindParam(':cod_aut', $cod_aut);
            $command->bindParam(':fecha', $fecha);
            $command->bindParam(':total', $total);
			


			$command->execute();

            $dato->setId($connection->lastInsertId());
            
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
	//
	
	//
	//
	//
	public function buscarPorID($dato){ // id
		try 
    	{
            $comprasdao= ComprasDAO::getInstance();
            $cuentaCreditodao= CuentaCreditoDAO::getInstance();
            $object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_pagoTC = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$compra = $comprasdao->buscarPorID($row['id_compra']);
                $cuenta_credito = $compraCreditodao->buscarPorID($row['id_cuenta_credito']);
                $cod_aut = ($row['cod_aut']);
				$fecha = ($row['fecha']);
				$total = ($row['total']);

				$object = new PagoTC($cod_aut, $fecha,$total,$compra,$cuenta_credito);

				$object->setId($row['id_pagoTC']);	
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
		$query = 'DELETE FROM '.$this->table.' WHERE id_pagoTC = :id';
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
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    		
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
    		$comprasdao= ComprasDAO::getInstance();
            $cuentaCreditodao= CuentaCreditoDAO::getInstance();
            
            $flag;
			$query= 'UPDATE '.$this->table.'
					SET  
                    id_compra = :id_compra,
                    id_cuenta_credito = :id_cuenta_credito,
                    cod_aut = :cod_aut,
                    fecha = :fecha,
                    total = :total,
						
					WHERE id_pagoTC = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			
			
			$id_compra = $dato->getCompra()->getId();
            $id_cuenta_credito = $dato->getCuentaCredito()->getId();
            $cod_aut = $dato->getCodigoAutenticacion();
			$fecha = $dato->getFecha();
            $total = $dato->getTotal();
			
			$command->bindParam(':id_compra', $id_compra);
            $command->bindParam(':id_cuenta_credito', $id_cuenta_credito);
            $command->bindParam(':cod_aut', $cod_aut);
            $command->bindParam(':fecha', $fecha);
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
    		
			throw $ex;
    	}
    	catch (Exception $e) {
    	
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
            $comprasdao= ComprasDAO::getInstance();
            $cuentaCreditodao= CuentaCreditoDAO::getInstance();
            
            $objects = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			while ($row = $command->fetch())
			{
				
				$compra = $comprasdao->buscarPorID($row['id_compra']);
                $cuenta_credito = $compraCreditodao->buscarPorID($row['id_cuenta_credito']);
                $cod_aut = ($row['cod_aut']);
				$fecha = ($row['fecha']);
				$total = ($row['total']);

				$object = new PagoTC($cod_aut, $fecha,$total,$compra,$cuenta_credito);

				$object->setId($row['id_pagoTC']);
                
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
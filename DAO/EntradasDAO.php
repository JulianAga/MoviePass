<?php namespace DAO;


use Models\Entrada as Compra;
use \Exception as Exception;
use \PDOException as PDOException;
use DAO\ComprasDAO as ComprasDAO;
use DAO\FuncionesDAO as FuncionesDAO;
use DAO\QRDAO AS QRDAO;
/**
 * 
 */
class EntradasDAO extends SingletonAbstractDAO
{
	//-------------ATRIBUTOS--------------
	private $table = 'Entradas';
	
	
	//-------------METODOS--------------------
	public function insertar($dato,$id_compra){
		try 
    	{
    	
			$query = 'INSERT INTO '.$this->table.' 
			(numero_entrada, id_funcion, id_compra) 
			VALUES 
			(:numero_entrada, :id_funcion, :id_compra)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$numero_entrada = $dato->getNumeroEntrada();
            $id_funcion=$dato->getFuncion()->getID();
            
            
            $command->bindParam(':id_compra', $id_compra);
            $command->bindParam(':id_funcion', $id_funcion);
			$command->bindParam(':numero_entrada', $numero_entrada);
            
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
	}//FIN INSERTAR
	//
	
	//
	public function buscarPorID($dato){
		try 
    	{
            $funcionesdao= FuncionesDAO::getInstance();
            $object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_entrada = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				
				$numero_entrada = ($row['numero_entrada']);
				$qr = ($row['qr']);
                $funcion = $funcionesdao->buscarPorID($row['id_funcion']);

				$object = new Entrada($numero_entrada, $qr, $funcion) ;

				$object->setId($row['id_entrada']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			
			throw $ex;
    	}
    	catch (Exception $e) {
			
			throw $e;
		}		
    }//fin 
    
    public function buscarPorIDCompra($dato){
		try 
    	{
    		$array=array();
			$object = null;
            $funcionesdao= FuncionesDAO::getInstance();
            
            $query = 'SELECT * FROM '.$this->table.' WHERE id_compra = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$numero_entrada = ($row['numero_entrada']);
                $funcion = $funcionesdao->buscarPorID($row['id_funcion']);

				$object = new Entrada($numero_entrada, $funcion) ;

				$object->setId($row['id_entrada']);

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
	}//fin 

	
	
	//
	public function borrar($dato){
		
		try 
    	{
    	$flag;
		$query = 'DELETE FROM '.$this->table.' WHERE id_entrada = :id';
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
	/*public function actualizar($dato){
		try 
    	{
    		//table=clientes
    		
    		$flag;
			$query= 'UPDATE '.$this->table.'
					SET  
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
            $funcionesdao= FuncionesDAO::getInstance();
            $array = array();

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$command->execute();

			while ($row = $command->fetch())
			{
				$numero_entrada = ($row['numero_entrada']);
                $funcion = $funcionesdao->buscarPorID($row['id_funcion']);

				$object = new Entrada($numero_entrada, $funcion) ;

				$object->setId($row['id_entrada']);

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

	}//fin traer todos

	public function ultimaEntrada($id_funcion)
{
	try 
    {
	
		$numero_entrada=null;
		$query = 'call '.'sp_retornarUltimaEntrada(:id_funcionE)';
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);


		$command->bindParam(':id_funcionE', $id_funcion);


		$command->execute();

		while ($row = $command->fetch())
		{
				$numero_entrada=$row['numero_entrada'];
		}
		
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		
		return $numero_entrada;
	}
	catch (PDOException $ex) {
		
		throw $ex;
	}
	catch (Exception $e) {
		
		throw $e;
	}
}

/*
public function getUltimaEntrada()
{
	$query = "SELECT max(id_entrada) as id_entrada FROM ". $this->tableName ;
	$this->connection = Connection::GetInstance();
	$resultSet = $connection->Execute($query);

	try {
		if(!empty($resultSet)){
			return $resultSet[0]['id_entrada'];
		}
	} catch (\Throwable $th) {
		throw $th;
	}
   
}*/


public function getUltimaEntrada()
{
	try 
    {
	
		$numero_entrada=null;
		$query = "SELECT max(id_entrada) as id_entrada FROM ". $this->table ;
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);


		$command->execute();

		while ($row = $command->fetch())
		{
				$numero_entrada=$row['numero_entrada'];
		}
		
		$num_error=$command->errorInfo()[1];//tomo el error que produce la query
		$descripcion_error=$command->errorInfo()[2];//tomo la descripcion del error que produce la query
		
		
		return $numero_entrada;
	}
	catch (PDOException $ex) {
		
		throw $ex;
	}
	catch (Exception $e) {
		
		throw $e;
	}
}

}

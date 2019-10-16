<?php 

namespace DAO;



use \Exception as Exception;
use \PDOException as PDOException;

class CuentasDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'Clientes';
	private $table2 = 'Cuentas';

	public function insertar($dato)//le llega un objeto cliente y lo guarda en la base de datos
	{
		try 
    	{
			$query = 'INSERT INTO '.$this->table.' 
			(email, pass, rol,fk_cliente) 
			VALUES 
			(:email, :pass, :rol,fk_cliente)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$email = $dato->getEmail();
			$pass = $dato->getPassword();
			$rol = $dato->getRol();
			$fk_cliente = $dato->getImagen();

			$command->bindParam(':email', $email);
			$command->bindParam(':pass', $pass);
			$command->bindParam(':rol', $rol);
			$command->bindParam(':fk_cliente', $fk_cliente);


			$command->execute();

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}

	public function insertarCuenta($dato)//le llega un objeto cuenta y lo guarda en BD
	{
		try 
    	{
    		//table2 es cuentas
			$query = 'INSERT INTO '.$this->table2.' 
			(email, pass, rol,fk_cliente) 
			VALUES 
			(:email, :pass, :rol,:fk_cliente)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$email = $dato->getEmail();
			$pass = $dato->getPassword();
			$rol = $dato->getRol();
			$fk_cliente = $dato->getCliente();

			$command->bindParam(':email', $email);
			$command->bindParam(':pass', $pass);
			$command->bindParam(':rol', $rol);
			$command->bindParam(':fk_cliente', $fk_cliente);

			$command->execute();

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}

	public function insertarDevolverID($dato)//le llega un cliente sin ID
	{
		try 
    	{
			$query = 'INSERT INTO '.$this->table.' 
			( nombre, apellido,dni,telefono direccion,ciudad,numero_tarjeta) 
			VALUES 
			( :nombre, :apellido,:dni,:telefono :direccion,:ciudad,:numero_tarjeta)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			

			$nombre = $dato->getNombre();
			$apellido = $dato->getApellido();
			$dni = $dato->getDni();
			$telefono = $dato->getTelefono();
			$direccion = $dato->getDireccion();
			$ciudad = $dato->getCiudad();
			$numTarjeta = $dato->getNumeroTarjeta();

			
			
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':apellido', $apellido);
			$command->bindParam(':dni', $dni);
			$command->bindParam(':telefono', $telefono);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':ciudad', $ciudad);
			$command->bindParam(':numero_tarjeta', $numTarjeta);
			
			

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
    	

	}

	public function buscarPorEmail($dato)
	{
		try 
    	{
			$object = null;

			$query = 'SELECT * FROM '.$this->table2.' WHERE email = :email';//busco en table2 qe corresponde a CUENTAS

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':email', $dato);

			$command->execute();

			while ($row = $command->fetch())
			{
				$email=($row['email']);
				$pass=($row['pass']);
				$rol=($row['rol']);
				$id_cliente=($row['fk_cliente']);

				$object = new \Models\Cuenta($email, $pass, $rol,$id_cliente);//tomo los datos de la cuenta buscada y creo un objeto
				$object->setId($row['id_cuenta']);		
			}

			return $object;//retorno el objeto o null si no lo encontro

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}

	public function buscarClientePorID($dato)
	{
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_cliente = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				

				$nombre = ($row['nombre']);
				$apellido = ($row['apellido']);
				$dni = ($row['dni']);
				$telefono = ($row['telefono']);
				$direccion = ($row['direccion']);
				$ciudad = ($row['ciudad']);
				$numTarjeta = ($row['numero_tarjeta']);
				
				

				$object = new \Models\Cliente( $nombre , $apellido ,$dni,$telefono, $direccion ,$ciudad,$numTarjeta  ) ;

				$object->setId($row['id_cliente']);	
			}

			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}
	
	public function borrar($dato)
	{

	}
	public function actualizar($dato)
	{
		try 
    	{
			$query= 'UPDATE '.$this->table.'
					SET 
						pass = :pass
						
					WHERE id_cuenta = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			$pass = $dato->getPassword();
			
			$command->bindParam(':id', $id);
			$command->bindParam(':pass', $pass);
			
			$command->execute();

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}
	public function traerTodos()
	{
		
	}
	public function buscarPorID($dato)
	{

	}

	public function actualizarDatos($dato)
	{
		try 
    	{
    		//table=clientes

			$query= 'UPDATE '.$this->table.'
					SET nombre = :nombre, 
						apellido = :apellido,
						dni = :dni,
						telefono = :telefono,
						direccion = :direccion,
						ciudad = :ciudad,
						numero_tarjeta = :numero_tarjeta
						
					WHERE id_cliente = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			$nombre = $dato->getNombre();
			$apellido = $dato->getApellido();
			$dni = $dato->getDni();
			$telefono = $dato->getTelefono();
			$direccion = $dato->getDireccion();
			$ciudad = $dato->getCiudad();
			$num_tarjeta = $dato->getNumeroTarjeta();		
					


			$command->bindParam(':id', $id);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':apellido', $apellido);
			$command->bindParam(':dni', $dni);
			$command->bindParam(':telefono', $telefono);
			$command->bindParam(':direccion', $direccion);
			$command->bindParam(':ciudad', $ciudad);
			$command->bindParam(':numero_tarjeta', $numTarjeta);
			

			$command->execute();

    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}

	}
	public function buscarCuentaPorIDCliente($dato)
	{
		try 
    	{
    		
			$object = null;

			$query = 'SELECT * FROM '.$this->table2.' WHERE fk_cliente = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			
			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$email = ($row['email']);
				$pass = ($row['pass']);
				$rol = ($row['rol']);
				$fk_cliente = ($row['fk_cliente']);

				$object = new \Models\Cuenta($email, $pass, $rol, $fk_cliente) ;

				$object->setId($row['id_cuenta']);	
			}


			return $object;
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
		}		
	}
}
?>
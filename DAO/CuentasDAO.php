<?php 

namespace DAOS;

/*
 *CREATE TABLE cuentas(
 *id_cuenta int auto_increment not null,
 *email varchar(100),
 *pass varchar(100),
 *rol varchar(10),
 *fk_cliente int,
 *constraint pk_cuenta primary key(id_cuenta),
 *constraint fk_cuenta_cliente foreign key(fk_cliente) references clientes(id_cliente),
 *constraint unq_cuenta_email unique (email)
 *);
 */

use \Exception as Exception;
use \PDOException as PDOException;

class CuentasDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'clientes';
	private $table2 = 'cuentas';

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
			$fk_cliente = $dato->getMCliente();

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
			( apellido, domicilio,nombre,telefono) 
			VALUES 
			( :apellido, :domicilio,:nombre,:telefono)';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			
			$apellido = $dato->getApellido();
			$domicilio = $dato->getDomicilio();
			$nombre = $dato->getNombre();
			$telefono = $dato->getTelefono();

			$command->bindParam(':apellido', $apellido);
			$command->bindParam(':domicilio', $domicilio);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':telefono', $telefono);

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

	public function buscarPorNombre($dato)
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

				$object = new \Modelos\Cuenta($email, $pass, $rol,$id_cliente);//tomo los datos de la cuenta buscada y creo un objeto
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
				$apellido = ($row['apellido']);
				$domicilio = ($row['domicilio']);
				$nombre = ($row['nombre']);
				$telefono = ($row['telefono']);

				$object = new \Modelos\Cliente( $nombre , $apellido , $domicilio , $telefono ) ;

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
			$query= 'UPDATE '.$this->table.'
					SET apellido = :apellido, 
						domicilio = :domicilio,
						nombre = :nombre,
						telefono = :telefono
						
					WHERE id_cliente = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			$apellido = $dato->getApellido();
			$domicilio = $dato->getDomicilio();
			$nombre = $dato->getNombre();
			$telefono = $dato->getTelefono();		


			$command->bindParam(':id', $id);
			$command->bindParam(':apellido', $apellido);
			$command->bindParam(':domicilio', $domicilio);
			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':telefono', $telefono);
			

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

				$object = new \Modelos\Cuenta($email, $pass, $rol, $fk_cliente) ;

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
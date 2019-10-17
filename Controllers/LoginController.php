<?php namespace Controllers;

	use Models\Cuenta as Cuenta;
	use Models\Cliente as Cliente;
	use Repository\ClientRepository as ClientRepository;
	use Repository\AccountRepository as AccountRepository;
	use DAO\SingletonAbstractDAO as SingletonAbstractDAO;

	class LoginController 
	{
		
		private $RepositoryCuentas;
		private $RepositoryClientes;

		private $DAOClientes;
		private $DAOCuentas;
		private $DAORoles;
		private $DAOCines;
		

		public function __construct()
		{			
			//REPOSITORIOS DE JSON
			//$this->RepositoryCuentas= new AccountRepository();
			//$this->RepositoryClientes= new ClientRepository();
			//BD
			$this->DAOCuentas=\DAO\CuentasDAO::getInstance();
			$this->DAORoles=\DAO\RolesDAO::getInstance();
			$this->DAOClientes=\DAO\ClientesDAO::getInstance();
			$this->DAOCines=\DAO\CinesDAO::getInstance();
			
		}	



		public function index()
		{
			
			if(isset($_SESSION['Login']))//Si hay session:
			{
				

				if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				{
					//lo lleva al home ADM
					//pasar por la controladora de ADM para levantar los datos de la bd
					$arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista
					
					require(ROOT . '/Views/Adm/home_adm.php');//
					
				}
				if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
				{
					
					//lo lleva al home CLIENTE
					//paso por la controladora de Home y desde ahi lo redirijo a la vista
					
					require(ROOT . '/Views/home.php');
					
				}
			}

			else
			{
				
				require(ROOT . '/Views/home.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
			}
		}//fin index-------



		public function verificarSesion($emailBuscado, $passLogin) //recibo el mail y la contraseña del login
		{
			//session_start();
			
			
			if(	!isset($_SESSION['Login']) )//entra si la sesion Login NO existe			
			{	
				try 
				{
					//$buscado=$this->RepositoryCuentas->GetByEmail($emailBuscado);//busco si existe el email en BD ,devuelve null o el objeto CUENTA
					$buscado=$this->DAOCuentas->buscarPorEmail($emailBuscado);
			    }
			    catch (Exception $e) 
			    {
			    	echo "<script>alert('Error al buscar datos del Login en JSON'));</script>";
			    }

				if ( $buscado !=null)//entra si encontro el mail
				{
					if ($passLogin==$buscado->getPassword())//verifica que el pass de la BD sea igual que el ingresado
					{	
						$this->crearSesion($buscado);//llamo a crear session(para modularizar) y le paso la CUENTA encontrada en BD
					}

					else
					{
						echo "<script> if(alert('E-Mail y/o Contraseña icorrectos!'));</script>";
						$this->index();
					}					
				}
				
				else
				{					
						echo "<script> if(alert('El E-Mail ingresado no se encuentra Registrado'));</script>";
						$this->index();										
									
				}
				
			}//fin if general session

			else//entra si la session LOGIN EXISTE... 
			{				
				echo "<script> if(alert('ERROR! Usuario actualmente logueado'));</script>";
				$this->index();				
			}//fin else general
			
		}//fin verificar session**********


		public function crearSesion($cuenta)
		{	
			//session_start();		
			$_SESSION['Login']=$cuenta;//guardo el objeto CUENTA logueada en la session
			$cliente=$this->DAOClientes->buscarPorID($cuenta->getCliente() );
			$_SESSION['Cliente_Logueado']=$cliente;


			echo '<script language="javascript">alert("Bienvenido '.$cuenta->getEmail(). '!");</script>';
			$this->index();

		}//fin crear session**********


		public function cerrarSesion()
		{	
			//session_start();
			
			if (isset($_SESSION['Login']) )//entra si existe la session
			{	
    			unset($_SESSION["Login"]); 
    			unset($_SESSION["Cliente_Logueado"]);    			
    			$this->index();
			}

			else
			{
				echo '<script language="javascript">alert("Ningun usuario logueado!");</script>';
				$this->index();

			}			

		}//fin crear session**********

		public function nuevo_usuario($nombre, $apellido,$dni, $telefono,$direccion,$ciudad, $email, $pass1, $pass2) 
		{	
			//traigo roles de la bd
			
			$objectRol = $this->DAORoles->buscarRol("User");//busco en bd el rol User y creo un objeto ROl

			try 
			{
				//$buscado=$this->RepositoryCuentas->GetByEmail($email);//busco si existe el email en JSON
				$buscado=$this->DAOCuentas->buscarPorEmail($email);//busco si existe el email en BD
		    } 
		    catch (Exception $e) 
		    {
		    	echo "<script>alert('Error al buscar datos del Login en BBDD'));</script>";
		    }

			if ($buscado == null)
			{//entra si el email buscado en BD no existe

				$cliente = new Cliente ($nombre, $apellido,$dni,$telefono, $direccion,$ciudad );//creo el cliente

				try 
				{
					//$clientID = $this->RepositoryClientes->saveClienteReturnID($cliente);// le paso un cliente sin id, lo guarda en json y me devuelve el cliente con ID
					$clienteConId = $this->DAOClientes->insertarDevolverID($cliente);//le paso cliente , lo guarda en bd y me devuelve el cliente con ID
			    }
			    catch (Exception $e) 
			    {
			    	echo "<script>alert('Error al insertar nuevo Usuario  en BBDD'));</script>";
			    }				
				
				if ($pass1 == $pass2)//verifico que coincidan las pass
				{
					$nuevaCuenta = new Cuenta($email,$pass1,$objectRol->getId(),$clienteConId->getId());//creo la cuenta con el FK_ID del cliente y con el FK_ID de rol
					try 
					{
						//$this->RepositoryCuentas->Add($nuevaCuenta);//agrego la cuenta completa a Json
						$this->DAOCuentas->insertarCuenta($nuevaCuenta);//agrego la cuenta completa a la BD
						echo "<script> if(alert('Usuario Registrado !'));</script>";
				    } 
				    catch (Exception $e) 
				    {
				    	echo "<script>alert('Error al insertar Cuenta en BBDD'));</script>";
				    }
				}
				else
				{
					echo "<script> if(alert('Las contaseñas no coinciden'));</script>";
				}
				
			}
			
			else
			{
					echo "<script> if(alert('El Email ya se encuentra Registrado..'));</script>";
			}

			$this->index();//llamo a la vista
		}//fin nuevo*****


		

		


		

	}//fin clase control 
?>
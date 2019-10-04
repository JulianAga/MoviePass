<?php namespace Controllers;

	use Models\Cuenta as Cuenta;
	use Models\Cliente as Cliente;
	use Repository\ClientRepository as ClientRepository;
	use Repository\AccountRepository as AccountRepository;
	use DAOS\SingletonAbstractDAO as SingletonAbstractDAO;

	class LoginController 
	{
		
		private $RepositoryCuentas;
		private $RepositoryClientes;
		

		public function __construct()
		{			
			
			$this->RepositoryCuentas= new AccountRepository();
			$this->RepositoryClientes= new ClientRepository();
			
		}	



		public function index()
		{
			if(isset($_SESSION['Login']))//Si hay session:
			{
				if($_SESSION['Login']->getRol()=="adm")//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				{
					//lo lleva al home ADM
				}
				if($_SESSION['Login']->getRol()=="cliente")// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
				{
					
					//lo lleva al home CLIENTE
				}
			}

			else
			{
				require_once(ROOT . '/Views/home.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
			}
		}//fin index-------

		public function verificarSesion($emailBuscado, $passLogin) //recibo el mail y la contraseña del login
		{
			//session_start();
			
			if(	!isset($_SESSION['Login']) )//entra si la sesion Login NO existe			
			{	
				try 
				{
					$buscado=$this->RepositoryCuentas->GetByEmail($emailBuscado);//busco si existe el email en BD ,devuelve null o el objeto CUENTA
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
										
			$_SESSION['Login']=$cuenta;//guardo el objeto CUENTA logueada en la session			
			echo '<script language="javascript">alert("Bienvenido '.$cuenta->getEmail(). '!");</script>';
			$this->index();

		}//fin crear session**********


		public function cerrarSesion()
		{	
			session_start();
			
			if (isset($_SESSION['Login']) )//entra si existe la session
			{	
    			unset($_SESSION["Login"]);     			
    			$this->index();
			}

			else
			{
				echo '<script language="javascript">alert("Ningun usuario logueado!");</script>';
				$this->index();
			}			

		}//fin crear session**********

		public function nuevo($nombre, $apellido, $telefono,$direccion,$ciudad, $email, $pass1, $pass2) 
		{	

			try 
			{
				$buscado=$this->RepositoryCuentas->GetByEmail($email);//busco si existe el email en BD
		    } 
		    catch (Exception $e) 
		    {
		    	echo "<script>alert('Error al buscar datos del Login en BBDD'));</script>";
		    }

			if ($buscado == null)
			{//entra si el email buscado en BD no existe

				$cliente = new Cliente ($nombre, $apellido,$telefono, $direccion,$ciudad );//creo el cliente

				try 
				{
					$clientID = $this->RepositoryClientes->saveClienteReturnID($cliente);// le paso un cliente sin id, lo guarda en json y me devuelve el cliente con ID
			    }
			    catch (Exception $e) 
			    {
			    	echo "<script>alert('Error al insertar datos de Login en BBDD'));</script>";
			    }				
				
				if ($pass1 == $pass2)//verifico que coincidan las pass
				{
					$nuevaCuenta= new Cuenta($email,$pass1,User,$clientID);//creo la cuenta con el ID del cliente
					try 
					{
						$this->RepositoryCuentas->Add($nuevaCuenta);//agrego la cuenta completa a la BD
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
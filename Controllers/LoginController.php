<?php namespace Controllers;

	use Models\Cuenta as Cuenta;
	use Models\Cliente as Cliente;
	use Controllers\CineController as CineController;
	use Repository\ClientRepository as ClientRepository;
	use Repository\AccountRepository as AccountRepository;
	use DAO\SingletonAbstractDAO as SingletonAbstractDAO;

	use Repository\DAOGenres as DAOGenres;

	?>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->
<?php
	


	class LoginController 
	{
		
		private $RepositoryCuentas;
		private $RepositoryClientes;

		private $DAOClientes;
		private $DAOCuentas;
		private $DAORoles;
		private $DAOCines;
		private $DAOFunciones;
		private $DAOSalas;
		

		public function __construct()
		{			
			//---------REPOSITORIOS DE JSON---------------------
			//$this->RepositoryCuentas= new AccountRepository();
			//$this->RepositoryClientes= new ClientRepository();

			//--------------------BD-----------------------------
			$this->DAOCuentas=\DAO\CuentasDAO::getInstance();
			$this->DAORoles=\DAO\RolesDAO::getInstance();
			$this->DAOClientes=\DAO\ClientesDAO::getInstance();
			$this->DAOCines=\DAO\CinesDAO::getInstance();
			$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
			$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
			$this->DAOSalas=\DAO\SalasDAO::getInstance();
			
		}	



		public function index($genre = '', $date='')
		{
			try
			{
				if(isset($_SESSION['Login']))//Si hay session:
				{
						
		
					if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
					{
						
						//lo lleva al home ADM
						//pasar por la controladora de ADM para levantar los datos de la bd
						
						
						$movieList=$this->DAOPeliculas->traerTodos();
						
						$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
						
						$salaList=$this->DAOSalas->traerTodos();
						$arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD
						
						require(ROOT . '/Views/Adm/home_adm.php');//
						
					}
					if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
					{
						
						//lo lleva al home CLIENTE
						//paso por la controladora de Home y desde ahi lo redirijo a la vista
						$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
						$functionController=new FuncionController();//intancia de controladora de funciones
						$generoYfecha=$functionController->filtroGenero_Fecha($genre,$date,$functionList);//llamo a los filtros genero y fecha
						$salaList=$this->DAOSalas->traerTodos();
						$movieList=array_shift($generoYfecha);
						$genresArray=array_shift($generoYfecha);
	
						
						require(ROOT . '/Views/home2.php');
					}
				}
		
				else
				{
					$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
					$functionController=new FuncionController();//intancia de controladora de funciones
					$generoYfecha=$functionController->filtroGenero_Fecha($genre,$date,$functionList);//llamo a los filtros genero y fecha
					
					$movieList=array_shift($generoYfecha);
					$genresArray=array_shift($generoYfecha);
					

					require(ROOT . '/Views/home2.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
				}//fin else
			}
			catch(PDOException $ex)
			{
				$_SESSION['Error']="Error index login controller";
			}
			
		}//fin index-------



		public function verificarSesion($emailBuscado, $passLogin) //recibo el mail y la contraseña del login
		{
			try
			{
				if(	!isset($_SESSION['Login']) )//entra si la sesion Login NO existe			
				{	
					try 
					{
						//$buscado=$this->RepositoryCuentas->GetByEmail($emailBuscado);//busco si existe el email en BD ,devuelve null o el objeto CUENTA
						$buscado=$this->DAOCuentas->buscarPorEmail($emailBuscado);
					}
					catch (Exception $e) 
					{
						
						$_SESSION['Error']="Error al buscar datos del Login en BD";
					}

					if ( $buscado !=null)//entra si encontro el mail
					{
						if ($passLogin==$buscado->getPassword())//verifica que el pass de la BD sea igual que el ingresado
						{	
							$this->crearSesion($buscado);//llamo a crear session(para modularizar) y le paso la CUENTA encontrada en BD

						}

						else
						{
							$_SESSION['Error']="Email o contraseña incorrectos!";
							$this->index();
							
							
						}					
					}
					
					else
					{					
							$_SESSION['Error']="El email ingresado no se encuentra registrado";				
							$this->index();	
							
															
										
					}
					
				}//fin if general session

				else//entra si la session LOGIN EXISTE... 
				{				
					
					$_SESSION['Error']="Usuario actualmente logueado!";
					$this->index();
									
				}//fin else general
			}
			catch(PDOException $ex)
			{
				$_SESSION['Error']="Error al verificar sesion";
			}
	
		}//fin verificar session**********


		public function crearSesion($cuenta)
		{	
			try
			{
				$_SESSION['Login']=$cuenta;//guardo el objeto CUENTA logueada en la session
				$_SESSION['id_cuenta']=$cuenta->getId(); //guardo el id de la cuenta
				$cliente=$this->DAOClientes->buscarPorID($cuenta->getCliente() );
				$_SESSION['Cliente_Logueado']=$cliente;


				//echo '<script language="javascript">alert("Bienvenido '.$cuenta->getEmail(). '!");</script>';
				//header("Location:".ROOT_VIEW);
				//header("Location:".ROOT_VIEW);
				$msj="Bienvenido ". $cliente->getNombre() . " " . $cliente->getApellido()."!";
				$_SESSION['Success']=$msj;
				$this->index();
			}
			catch(PDOException $ex)
			{
				$_SESSION['Error']="Error al crear sesion";
			}		
			
			
			

		}//fin crear session**********


		public function cerrarSesion()
		{	
			//session_start();
			
			if (isset($_SESSION['Login']) )//entra si existe la session
			{	
    			unset($_SESSION["Login"]); 
    			unset($_SESSION["Cliente_Logueado"]); 
    			header("Location:".ROOT_VIEW); 
    			//$this->index();
			}

			else
			{
				$_SESSION['Error']="Ningún usuario logueado";
				$this->index();
				

			}			

		}//fin crear session**********

		public function nuevo_usuario($nombre, $apellido,$dni, $telefono,$direccion,$ciudad, $email, $pass1, $pass2) 
		{	
			try
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
					$_SESSION['BD']="Error al buscar datos del login en la base de datos.Exception";
					
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
						$_SESSION['Error']="Error al insertar un nuevo usuario en la base de datos.Exception";
					}				
					
					if ($pass1 == $pass2)//verifico que coincidan las pass
					{
						
						$nuevaCuenta = new Cuenta($email,$pass1,$objectRol->getId(),$clienteConId->getId());//creo la cuenta con el FK_ID del cliente y con el FK_ID de rol
						try 
						{
							

							//$this->RepositoryCuentas->Add($nuevaCuenta);//agrego la cuenta completa a Json
							$this->DAOCuentas->insertarCuenta($nuevaCuenta);//agrego la cuenta completa a la BD
							$_SESSION['Success']="Usuario correctamente registrado";
							$this->crearSesion($nuevaCuenta);//creo la sesion y lo redirijo al index
						} 
						catch (Exception $e) 
						{
							$_SESSION['Error']="Error al insertar la cuenta en la base de datos.Exception";
							
						}
					}
					else
					{
						$_SESSION['Error']="Las contraseñas no coinciden";
						$this->index();
					}
					
				}
				
				else
				{
					$_SESSION['Error']="El email ya se encuentra registrado"; 
					$this->index();
					
				}
			}
			catch(PDOException $ex)
			{
				$_SESSION['Error']="Error al crear nuevo usuario";
			}
			

		
		}//fin nuevo*****

	}//fin clase control 
?>
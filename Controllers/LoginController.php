<?php namespace Controllers;

	use Models\Cuenta as Cuenta;
	use Models\Cliente as Cliente;
	use Controllers\CineController as CineController;
	use Repository\ClientRepository as ClientRepository;
	use Repository\AccountRepository as AccountRepository;
	use DAO\SingletonAbstractDAO as SingletonAbstractDAO;

	use Repository\DAOGenres as DAOGenres;
	


	class LoginController 
	{
		
		private $RepositoryCuentas;
		private $RepositoryClientes;

		private $DAOClientes;
		private $DAOCuentas;
		private $DAORoles;
		private $DAOCines;
		private $DAOFunciones;
		

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
			
		}	



		public function index($genre = '')
		{
			
			if(isset($_SESSION['Login']))//Si hay session:
			{
				

				if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				{
					//lo lleva al home ADM
					//pasar por la controladora de ADM para levantar los datos de la bd
					
					//$cineController = new CineController();//creo objeto de otra controladora para usar sus metodos desde esta
					//$arrayCines=$cineController->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista

					$cineController= new CineController();//creo objeto de otra controladora para usar sus metodos desde esta
					$arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD
					
					require(ROOT . '/Views/Adm/home_adm.php');//
					
				}
				if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
				{
					
					//lo lleva al home CLIENTE
					//paso por la controladora de Home y desde ahi lo redirijo a la vista
					$movieList = $this->DAOFunciones->traerTodos();
					require(ROOT . '/Views/home.php');
					
				}
			}

			else
			{
				

				$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
				$arrayPeliculas=array();
				foreach ($functionList as $key) {//recorro la lista de funciones y creo objetos pelicula con esos datos

					array_push($arrayPeliculas, $this->DAOPeliculas->buscarPorID_BD($key->getIdPelicula() ) ); //busco las peliculas que estan en la lista de funciones por su ID y las guardo en una lista para poder mostrarlas
					
				}//fin foreach
				
				$daoGenres=new DAOGenres();           //crea un objeto de dao genres
				$genresArray=$daoGenres->GetAll();    //carga en la variable la lista con los generos 
				
				$movieList=array();
				if ($functionList !=null)//si no esta null la cartelera que llega desde movie DB, la recorro
				{
					
					if(!empty($genre))
					{
						foreach ($functionList as $p) 
						{ 
							if(in_array($genre,$p->genre_ids) ) //verifica que la pelicula sea de el genero elegido ** CORREJIR **
							{
								array_push($movieList,$p);
							}
						}
					}
					else
					{
						foreach ($functionList as $p) 
						{ 
							array_push($movieList,$p);
						}
					}
				}
				//var_dump($movieList);
			
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
						$this->crearSesion($nuevaCuenta);//creo la sesion y lo redirijo al index
				    } 
				    catch (Exception $e) 
				    {
				    	echo "<script>alert('Error al insertar Cuenta en BBDD'));</script>";
				    }
				}
				else
				{
					echo "<script> if(alert('Las contraseñas no coinciden'));</script>";
				}
				
			}
			
			else
			{
					echo "<script> if(alert('El Email ya se encuentra Registrado..'));</script>";
			}

			$this->index();//llamo a la vista
		}//fin nuevo*****


		
	private function genreFilter($genre)
	{
		

		$movieList=array();
		if ($nowplaying !=null)//si no esta null la cartelera que llega desde movie DB, la recorro
        {
			
			if(!empty($genre))
			{
				foreach ($nowplaying->results as $p) 
				{ 
					if(in_array($genre,$p->genre_ids)) //verifica que la pelicula sea de el genero elegido
					{
						array_push($movieList,$p);
					}
				}
			}
			else
			{
				foreach ($nowplaying->results as $p) 
				{ 
					array_push($movieList,$p);
				}
			}
		}

		return $movieList;
	}
		


		

	}//fin clase control 
?>
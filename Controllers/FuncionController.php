<?php namespace Controllers;

use models\cine as Cine;
use models\Funcion as Funcion;
use DAO\GenerosDAO as GenerosDAO;
//use Repository\CinesRepository as CinesRepository;

/**
 * 
 */
class FuncionController 
{

//----------------ATRIBUTOS-----------------------
	 private $DAOFunciones;
	 private $DAOPeliculas;
	 private $DAOSalas;
//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
		$this->DAOSalas=\DAO\SalasDAO::getInstance();
	}

	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG
                {
                    //lo lleva al home ADM
                    $movieController = new Adm_PeliculasController();
					$movieList=$this->DAOPeliculas->traerTodos();//le paso la lista de peliculas de la BD propia
	                $functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD  
	                $cineController = new CineController();//creo objeto de otra controladora para usar sus metodos desde esta
	                $salaList=$this->DAOSalas->traerTodos();
					$arrayCines=$cineController->traerTodos();//levanto todos los cines de la BD
				   require(ROOT . '/Views/Adm/home_adm.php');//no esta hecho aun
                    
                }
                if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
                {
                    
                    //lo lleva al home CLIENTE
                    require(ROOT . '/Views/User/home2.php');
                    
                }
            }

            else
            {
                require(ROOT . '/Views/home2.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
            }
		}
		
		public function addFuncion($id_pelicula, $id_sala, $fecha, $hora)
		{
			//verificar que la pelicula no este ya en cartelera en ese cine
			/*echo '<pre>';
			var_dump($hora+15);
			echo "</pre>";*/
			$sala=$this->DAOSalas->buscarPorID($id_sala);//busco la sala por id y me devuelv el obj sala
			
			$flag=$this->DAOFunciones->verificarPeliculaEnCartelera($sala->getCine()->getID(),$id_pelicula,$fecha);//verifica si la pelicula se proyecta ese dia en ese cine. DEVUELVE TRUE SI YA HAY FUNCION ESE DIA Y FALSE SI NO LO HAY
			/*echo $flag;*/
			
			$flag2= $this->validarHorario($sala->getCine()->getID(),$fecha,$hora,$id_pelicula);

			
			
			if($flag==false && $flag2== true){//si ese dia no hay ninguna funcion, creo la funcion
				
				//verificar los 15 minutos MINIMO entre pelicula y pelicula
				$peli_buscada=$this->DAOPeliculas->buscarPorID($id_pelicula);//le paso el ID de la pelicula de la API y me devuelve el objeto de esa pelicula en BD
				$funcion = new Funcion($sala, $peli_buscada->getId_api(), $hora, $fecha);
				$this->DAOFunciones->insertar($funcion);
				//header("Location:".ROOT_VIEW);
				$_SESSION['Success']="Función agregada!";
				$this->index();

			}//if
			else if ($flag2==false){
				$_SESSION['Error']="Horario no disponible";
				$this->index();

			}
			else{//si ese dia hay funcion de esa pelicula en ese cine, error
				$_SESSION['Error']="Pelicula en cartelera";
				
				$this->index();

			}//else



			
		}//fin add funcion
	public function deleteFunction($id_cine,$id_pelicula){
		
		if ( ($id_cine!=null)&&($id_pelicula!=null) ){
			$flag=$this->DAOFunciones->borrar($id_cine,$id_pelicula);
			if($flag==true){
				$_SESSION['Success']="Funcion eliminada exitosamente!";
            	$this->index();
			}
			else{
				$_SESSION['Error']="Error al borrar la funcion";
            	$this->index();
			}

		}//fin if
			



	}//fin modify function

	//
	//
	public function devolverFuncionesXidPelicula($id_pelicula){
		
		
		$arrayFunciones=$this->DAOFunciones->devolverFuncionesXidPelicula($id_pelicula);
		return $arrayFunciones;

	}
	//
	//
	//
	public function filtroGenero_Fecha($genre, $date,$functionList){
		//FILTRO GENEROS
				date_default_timezone_set ( "America/Argentina/Buenos_Aires" );
				foreach($functionList as $f)
				{
					if($f->getDia()<date("Y-m-d "))
					{
						unset($functionList[array_search($f,$functionList)]);
					}
				}
				$arrayPeliculas=array();
				$arrayToReturn=array();
				foreach ($functionList as $key) {//recorro la lista de funciones 

					array_push($arrayPeliculas,$key->getIdPelicula()); // las guardo en una lista para poder mostrarlas
					
				}//fin foreach
				
				$daoGenres=new GenerosDAO();           //crea un objeto de dao genres
				$genresArray=$daoGenres->traerTodos();    //carga en la variable la lista con los generos 
				
				
				$movieList=array();
				$toShow=array();
				
				if ($functionList !=null)//si no esta null la cartelera que llega desde movie DB, la recorro
				{
					
					if(!empty($genre) && !empty($date))
					{
						foreach ($functionList as $f) 
						{ 
						
							if( $date==$f->getDia() ) //verifica que la pelicula sea de el genero elegido 
							{
								if(!in_array($f,$movieList))
								{
									array_push($movieList,$f->getIdPelicula());
								}
							}
							
							
						}
						
						foreach ($movieList as $p) 
						{ 
							foreach($p->getCategoria() as $categoria)
							{
								if( $genre==$categoria->getId() ) //verifica que la pelicula sea de el genero elegido 
								{
									if(!in_array($p,$toShow))
									{
										array_push($toShow,$p);
									}
									
								}
							}
							
						}
					}
					else if (!empty($date) && empty($genre) )
					{
						
						
						foreach ($functionList as $f) 
						{ 
						
							if( $date==$f->getDia() ) //verifica que la pelicula sea de el genero elegido 
							{
								if(!in_array($f->getIdPelicula(),$toShow))
								{
									array_push($toShow,$f->getIdPelicula());
								
								}
							}
							
							
						}
						
					}
					else if (!empty($genre) && empty($date))
					{
						foreach ($functionList as $f) 
						{ 
							
							$p =$f->getIdPelicula();
							
							foreach($p->getCategoria() as $categoria)
							{
								if( $genre==$categoria->getId() ) //verifica que la pelicula sea de el genero elegido 
								{
									if(!in_array($p,$toShow))
									{
										array_push($toShow,$p);
									}
									
								}
							}
							
							
							
						}
					}
					else
					{
						foreach ($functionList as $f) 
						{ 
							$p =$f->getIdPelicula();
							if(!in_array($p,$toShow))
							{
								array_push($toShow,$p);
							}
						
						}
					}

					//FILTRO FECHA
					
					$movieList=$toShow;

				}
				//var_dump($movieList);
				array_push($arrayToReturn,$movieList);
				array_push($arrayToReturn,$genresArray);
				return $arrayToReturn;
	}


	public function validarHorario($cine,$date,$time,$id_pelicula)
	{
		$functionList= $this->DAOFunciones->traerTodos();
		$peli_buscada=$this->DAOPeliculas->buscarPorID($id_pelicula);
		
		$datetime=date_create($time); //crea un time con la hora que quiere agregar
		
		$duracionInsertada=$peli_buscada->getDuracion(); //busca la duracion de la pelicula q quiere asignar
		$finishInsertada=date_create($time); //crea un  time para agregarle la duracion
		date_add($finishInsertada,date_interval_create_from_date_string($duracionInsertada." minutes")); //le agrega a la hora asignada la duracino para tener a que hora terminaria la pelicula
		if($functionList==null)
		{
			return true;				//si no hay funciones la agrega de una
		}
		else
		{
			
			
			foreach($functionList as $function) // recorre las funciones
			{
				
				
				if($function->getSala()->getCine()->getID()== $cine && $date == $function->getDia()) //si la funcion es en el cine y en el dia que se quiere agregar la nueva pelicula entra
				{
					
					
					$horario=date_create($function->getHorario());	//crea un time con el horario
					$film= $function->getIdPelicula();	//asigna la pelicula de la funcion
					
					$finishTime=date_create($function->getHorario()); // crea un time con el horario en donde empieza la pelicula de la funcion
					$duracion= $film->getDuracion(); // busca la duracion de la pelicula de la funcion
					$duracion=$duracion+15; //le agrega los 15 min pedidos entre funciones
					date_add($finishTime,date_interval_create_from_date_string($duracion." minutes")); //suma al horario de inico de la pelicula para tener a q hora termina la pelicula de la funcion
					date_format($finishTime,"G:i");
					/*echo 'intentado: '.date_format($datetime,"G:i");
					echo 'horario: '.date_format($horario,"G:i");						
					echo 'finish time es: '.date_format($finishTime,"G:i");
					echo 'finishInsertada time es: '.date_format($finishInsertada,"G:i");*/
					if(($datetime > $horario && $datetime <$finishTime) | ($finishInsertada > $horario && $finishInsertada < $finishTime))  //verifica q le pelicula no se pise con otras funciones
					{
						
						return false;
					}
				}
			}
			
			return true;
		}
		
	}

	public function contarEntradas($id_funcion)
	{
		$num = $this->DAOFunciones->contarEntradas($id_funcion);
	//var_dump($num);
	
		return $num;

	}

}
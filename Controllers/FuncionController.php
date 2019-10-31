<?php namespace Controllers;

use models\cine as Cine;
use models\Funcion as Funcion;
use Repository\DAOGenres as DAOGenres;
//use Repository\CinesRepository as CinesRepository;

/**
 * 
 */
class FuncionController 
{

//----------------ATRIBUTOS-----------------------
	 private $DAOFunciones;
	 private $DAOPeliculas;
//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
	}

	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
                   
                $cineController = new CineController();//creo objeto de otra controladora para usar sus metodos desde esta
				$arrayCines=$cineController->traerTodos();//levanto todos los cines de la BD
				   require(ROOT . '/Views/Adm/home_adm.php');//no esta hecho aun
                    
                }
                if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
                {
                    
                    //lo lleva al home CLIENTE
                    require(ROOT . '/Views/User/home_usuario.php');
                    
                }
            }

            else
            {
                require(ROOT . '/Views/home.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
            }
		}
		
		public function addFuncion($id_pelicula, $id_cine, $fecha, $hora)
		{
			//verificar que la pelicula no este ya en cartelera en ese cine
			echo '<pre>';
			var_dump($hora+15);
			echo "</pre>";
			$flag=$this->DAOFunciones->verificarPeliculaEnCartelera($id_cine,$id_pelicula,$fecha);//verifica si la pelicula se proyecta ese dia en ese cine. DEVUELVE TRUE SI YA HAY FUNCION ESE DIA Y FALSE SI NO LO HAY
			echo $flag;

			
			if($flag==false){//si ese dia no hay ninguna funcion, creo la funcion
				
				//$funcionesXcine=$this->DAOFunciones->devolverFuncionesXCine($id_cine);
				//verificar los 15 minutos MINIMO entre pelicula y pelicula
				$peli_buscada=$this->DAOPeliculas->buscarPorID($id_pelicula);//le paso el ID de la pelicula de la API y me devuelve el objeto de esa pelicula en BD
				$funcion = new Funcion($id_cine,$peli_buscada->getId_api(),$hora,$fecha);
				$this->DAOFunciones->insertar($funcion);
				//header("Location:".ROOT_VIEW);
				$this->index();

			}//if

			else{//si ese dia hay funcion de esa pelicula en ese cine, error
				$this->index();

			}//else



			
		}//fin add funcion

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
				
				$arrayPeliculas=array();
				$arrayToReturn=array();
				foreach ($functionList as $key) {//recorro la lista de funciones 

					array_push($arrayPeliculas,$key->getIdPelicula()); // las guardo en una lista para poder mostrarlas
					
				}//fin foreach
				
				$daoGenres=new DAOGenres();           //crea un objeto de dao genres
				$genresArray=$daoGenres->GetAll();    //carga en la variable la lista con los generos 
				//var_dump($genresArray);
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

}
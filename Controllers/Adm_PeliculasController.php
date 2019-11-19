<?php namespace Controllers;


use models\Pelicula as Pelicula;
use Controllers\CineController as CineController;
use Repository\MovieRepository as MovieRepository;
/**
 * 
 */
class Adm_PeliculasController
{
	//------------------------ATRIBUTOS-------------------
	private $repositoryMovies;

	private $cineDAO;
	private $peliculaDAO;
	private $DAOFunciones;
	private $DAOSalas;
	private $DAOCines;
	private $DAOCompras;

	//------------------------CONSTRUCTOR-----------------
	
	function __construct()
	{
		//$this->repositoryMovies= new MovieRepository();
		$this->peliculaDAO = \DAO\PeliculasDAO::getInstance();
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOSalas=\DAO\SalasDAO::getInstance();
		$this->DAOCines=\DAO\CinesDAO::getInstance();
		$this->DAOCompras=\DAO\ComprasDAO::getInstance();
		
	}

	//------------------------METODOS---------------------


public function index (){

		if(isset($_SESSION['Login']))//Si hay session:
			{
				

				if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				{
					//lo lleva al home ADM
					$cineController = new CineController();//creo objeto de otra controladora para usar sus metodos desde esta
					$movieList=$this->peliculaDAO->traerTodos();
					 $salaList=$this->DAOSalas->traerTodos();
					$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
					$arrayCines=$cineController->traerTodos();//levanto todos los cines de la BD

					require(ROOT . '/Views/Adm/home_adm.php');//llamo a la vista
					
				}
				if($_SESSION['Login']->getRol()==2)// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
				{
					
					//lo lleva al home CLIENTE
					
					require(ROOT . '/Views/home.php');
					
				}
			}

			else
			{
				
				require(ROOT . '/Views/home.php');//SI NO HAY SESSION LO LLEVA A HOME (como no hay ninguna session lo lleva al home.php como anonimo)
			}

}//fin index
//
//
//
public function adm_peliculas(){

	if($_SESSION['Login']->getRol()=="ADM"){  //SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				
					//lo lleva al home ADM
		require(ROOT . '/Views/Adm/ADM-Peliculas.php');//no esta hecho aun
	}

}//fin adm peliculas
//
//
//
public function adm_cines(){

	if($_SESSION['Login']->getRol()=="ADM"){   //SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
					//lo lleva al home ADM
		require(ROOT . '/Views/Adm/home_adm.php');//no esta hecho aun
					
	}

}//fin adm cines
//
//
//
public function recibirPeliculas(){

	include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
	include "Api/api_now.php";// incluyo la API de peliculas actuales en cartelera

	$generoController = new GeneroController();//creo instancia controladora de generos
	$arrayGeneros=$generoController->recibirGeneros();//recibo todos los generos de la API
	
	$generoController->guardar_Generos($arrayGeneros);

	foreach ($nowplaying->results as $m) {


		$codigo=$m->id;
		$duracion =null;
		$imagen=$m->poster_path;
		$lenguaje=$m->original_language;
		$titulo = $m->title;
		$descripcion = $m->overview;
		$genero = $m->genre_ids;

	
		$newMovie = new Pelicula ($codigo,$descripcion,$titulo,$duracion,$genero,$imagen,$lenguaje);//creo objeto con los datos de la API
		
		$buscado=$this->peliculaDAO->buscarPorID($newMovie->getId_api() );//Busco en la BD si existe esa pelicula
		if($buscado==null){
		//guarda solo las peliculas que NO estan en la BD
			
			$this->peliculaDAO->insertar($newMovie);//guardo la pelicula en BD
		}
		
		

	}//fin foreach
	$this->index();
}//fin recibir peliculas
//
//
//
public function traerTodos(){

	$arrayPeliculas= array();
    $arrayPeliculas=$this->peliculaDAO->traerTodos();

        if($arrayPeliculas!=null){

            return $arrayPeliculas;
        }
        else{
            
            
            $_SESSION['Error']="No hay Peliculas cargados en la base de datos!";
            return null;
        }

}//fin addmovie
//
//
public function buscarXiD_api($id_api){

	
	$objPelicula=$this->peliculaDAO->buscarPorID($id_api);
	return $objPelicula;

}

public function testCines($idCinesI,$fechaIN,$fechaOUT)
{
	$arrayPeliculas=$this->peliculaDAO->traerTodos();
	$arrayCines=$this->DAOCines->traerTodos();
	$valor=$this->DAOCompras->valoresPorCine($idCinesI,$fechaIN,$fechaOUT);

	require(ROOT . '/Views/Adm/Consultas.php');
	
	
}

public function testPeliculas($idPeliculaI,$fechaIN,$fechaOUT)
{
	$arrayCines=$this->DAOCines->traerTodos();
	$arrayPeliculas=$this->peliculaDAO->traerTodos();
	$valor=$this->DAOCompras->valoresPorPelicula($idPeliculaI,$fechaIN,$fechaOUT);

	require(ROOT . '/Views/Adm/Consultas.php');
	
	
}



public function test()
{
	$arrayCines=$this->DAOCines->traerTodos();
	$arrayPeliculas=$this->peliculaDAO->traerTodos();
	require(ROOT . '/Views/Adm/Consultas.php');
}


//fin buscar por id api
//
//
//









}//fin class------------




?>
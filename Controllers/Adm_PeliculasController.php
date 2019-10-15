<?php namespace Controllers;


use models\Pelicula as Pelicula;
use Repository\MovieRepository as MovieRepository;
/**
 * 
 */
class Adm_PeliculasController
{
	//------------------------ATRIBUTOS-------------------
	private $repositoryMovies;

	//------------------------CONSTRUCTOR-----------------
	
	function __construct()
	{
		$this->repositoryMovies= new MovieRepository();
		
	}

	//------------------------METODOS---------------------


public function index (){

		if(isset($_SESSION['Login']))//Si hay session:
			{
				

				if($_SESSION['Login']->getRol()=="ADM")//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
				{
					//lo lleva al home ADM
					
					require(ROOT . '/Views/Adm/home_adm.php');//no esta hecho aun
					
				}
				if($_SESSION['Login']->getRol()=="User")// SI ES CLIENTE AL HOME DE CLIENTE (falta configurar esto)
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

	echo "entro a recibir peliculas";
	
	foreach ($nowplaying->results as $m) {

		$descripcion = $m->overview;
		$titulo = $m->title;
		$restriccion = null;
		$duracion =null;
		$codigo=$m->id;
		$categoria= $m->genre_ids;
		$tipo=null;



		$newMovie = new Pelicula ($descripcion,$titulo,$restriccion,$duracion,$codigo,$categoria,$tipo);

		$this->repositoryMovies->add($newMovie);

		//var_dump($this->repositoryMovies->getAll() );
	}


}//fin recibir peliculas








}//fin class------------




?>
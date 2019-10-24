<?php namespace Controllers;

use models\cine as Cine;
use models\Funcion as Funcion;
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
			
			$peli_buscada=$this->DAOPeliculas->buscarPorID($id_pelicula);//le paso el ID de la pelicula de la API y me devuelve el objeto de esa pelicula en BD
			$funcion = new Funcion($id_cine,$peli_buscada->getId(),$hora,$fecha);
			
			 
			$this->DAOFunciones->insertar($funcion);
			$this->index();
		}

}
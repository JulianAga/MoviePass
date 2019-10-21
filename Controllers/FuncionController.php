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
//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
	}

	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
                   // $arrayFunciones=$this->DAOFunciones->traerTodos();//levanto todas las funciones de la BD antes de el llamado a la vista
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
			$funcion = new Funcion();
			$funcion->setIdPelicula($id_pelicula);
			$funcion->setIdCine($id_cine);
			$funcion->setDia($fecha);
			$funcion->setHorario($hora);
			
			echo $funcion->getHorario();
			
		$this->DAOFunciones->insertar($funcion);
        
        echo '<script language="javascript">alert("Funcion agregada satisfactoriamente!");</script>'; //este tipo de mensaje no rompe el codigo
		$this->index();
		}

}
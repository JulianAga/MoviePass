<?php namespace Controllers;



use models\Sala as Sala;
use models\Funcion as Funcion;
?>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->
<?php

class SalaController{

	//----------------ATRIBUTOS-----------------------
	 private $DAOFunciones;
	 private $DAOPeliculas;
	 private $DAOSalas;
	 private $DAOCines;
	//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
		$this->DAOSalas=\DAO\SalasDAO::getInstance();
		$this->DAOCines=\DAO\CinesDAO::getInstance();
	}
	//-----------------METODOS------------------------

	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
                    $movieList=$this->DAOPeliculas->traerTodos();
                    $salaList=$this->DAOSalas->traerTodos();
                    
                    $functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
                    $arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista
                    require(ROOT . '/Views/Adm/home_adm.php');//
                    
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
        }//fin index-------
	public function addSala($nombre,$capacidad,$valor_entrada,$id_cine){
		//echo "entro a add sala ";

		if($this->DAOSalas->buscarPorNombre($nombre,$id_cine)!= null)//busca que no haya otro nombre de sala igual en el mismo cine
		{
			$this->index();
			?><script> sweetAlert("Error", "El Nombre de sala ya existe en el cine!", "error")</script>
            <?php
		}
		else if($nombre!=null && $capacidad!=null && $valor_entrada!=null && $id_cine!=null){
			$cine=$this->DAOCines->buscarPorID($id_cine);

			$newSala = new Sala ($capacidad,$valor_entrada,$nombre,$cine);
			
			$flag=$this->DAOSalas->insertar($newSala);
			if($flag==true){

			$this->index();
			?><script> sweetAlert("Exito", "Sala agregada!", "success")</script>
            <?php
			}
		
		}	


	}//fin add sala

	public function borrarSala($id_sala)
	{
		$this->DAOSalas->borrarSala($id_sala);

		$this->index();
	}//fin borrar sala
	



	
		}//fin class
	
?>
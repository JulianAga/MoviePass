<?php namespace Controllers;

use models\cine as Cine;
use Controllers\AlertasController as AlertasController;
//use Controllers\CineController as CineController;
use Repository\CinesRepository as CinesRepository;

?>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->
<?php
/**
 * 
 */
class CineController 
{

//----------------ATRIBUTOS-----------------------
	 private $DAOCines;
     private $DAOFunciones;
     private $DAOPeliculas;
     private $DAOSalas;

//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOCines=\DAO\CinesDAO::getInstance();
        $this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
        $this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
        $this->DAOSalas=\DAO\SalasDAO::getInstance();
       
	}

//----------------METODOS--------------------------
	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
                    $movieList=$this->DAOPeliculas->traerTodos();
                    
                    $functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
                    $arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista
                    $salaList=$this->DAOSalas->traerTodos();
                    $arrayAlertExito=$arrayAlertExito;
                    $arrayAlertError=$arrayAlertError;
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
	//
	//
	public function newCine($cine,$direccion){
        
        $newCine = new cine ($cine,$direccion,true);//creo el nuevo cine

        if ($newCine->getNombre() == null || $newCine->getDireccion() == null)
        {
            $_SESSION['Error']="Los campos deben estar completos!";
            $this->index();

        }
        else if($this->DAOCines->buscarPorID($newCine->getID() )!=null ) // Verifica que no exista otro Cine con el mismo id en BD
        {
            $_SESSION['Error']="El ID del cine ya se encuentra registrado!";
            $this->index();
            
        }
        else if(strlen($cine)>30 ) // Verifica que el nombre del cine no supere los 30 caracteres maximos usados en BD
        {
            $_SESSION['Error']="El nombre del cine excede los 30 caracteres!";
            $this->index();
        }
        else if(strlen($direccion)>30 ) // Verifica que la direccion del cine  no supere los 30 caracteres maximos usados en BD
        {
            $_SESSION['Error']="La dirección del cine excede los 30 caracteres!";
            $this->index();
        }
        else if($this->DAOCines->buscarPorNombre($newCine->getNombre() )!=null ) // Verifica que no exista otro Cine con el mismo nombre en BD
        { 
            
            $_SESSION['Error']="El cine ingresado ya existe";
            $this->index();
            
        
        }
        
        else{
            $flag=$this->DAOCines->insertar($newCine);
              //este tipo de mensaje no rompe el codigo
            
            if ($flag==true){
                
                $_SESSION['Success']="Cine añadido correctamente!";  
            }
            else{
                $_SESSION['Error']="No se pudo agregar el Cine!";
                
            }
            $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
        }
    }//fin newcine
    //
    //
	public function deleteCine($id_cine){
     
     
        $flag=$this->DAOCines->borrar($id_cine);         
         $this->index();
         if ($flag==true){
            $_SESSION['Success']="Cine eliminado correctamente!";
         }
         else{
            $_SESSION['Error']="El Cine contiene funciones activas!";
         }
        
	}//fin delete cine
	//
	//
	public function modifyCine($id,$cine,$habilitado,$direccion,$capacidad,$valor){
        


        if (strlen($cine)>30){//verifico tamaño del nombre
            $_SESSION['Error']="El nombre del cine excede los 30 caracteres!";
            $this->index();

        }
        else if(strlen($direccion)>30 ) // Verifica que la direccion del cine  no supere los 30 caracteres maximos usados en BD
        {
            $_SESSION['Error']="La dirección del cine excede los 30 caracteres!";
            $this->index();
        }
        else if(($this->DAOCines->buscarPorNombre($cine)!=null) && ($this->DAOCines->buscarPorNombre($cine)->getID()!=$id)) // Verifica que no exista otro Cine con el mismo nombre en BD
        { 
            $_SESSION['Error']="El cine ingresado ya existe";
            $this->index();
        }
        else{//si esta todo bien , modifico el cine

            if ($habilitado==1)
            $cineMod = new cine ($cine,$direccion,$capacidad,$valor,1);
            else if($habilitado==0)
                $cineMod = new cine ($cine,$direccion,$capacidad,$valor,0);

            $flag;
            $cineMod->setID($id);
            $flag=$this->DAOCines->actualizar($cineMod);
            if($flag==true){
                $_SESSION['Success']="Cine modificado satisfactoriamente!";
            }
            else{
                $_SESSION['Error']="Error al modificar Cine!";
            }
            $this->index();
         

        }//fin else
        


    }//fin modify cine
    //
    //
    public function habilitado(){

    }//fin habilitar
    //
    //
    public function traerTodos(){
        
        $arrayCines= array();
        $arrayCines=$this->DAOCines->traerTodos();

        if($arrayCines!=null){

            return $arrayCines;
        }
        else{
            $_SESSION['Error']="No hay cines cargados en la base de datos!";
            return null;
        }
    }//traer todos
    //
    //
    //

}//fin class

?>
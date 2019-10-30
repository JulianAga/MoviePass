<?php namespace Controllers;

use models\cine as Cine;
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
//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOCines=\DAO\CinesDAO::getInstance();
       
	}

//----------------METODOS--------------------------
	public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
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
	//
	//
	public function newCine($cine,$direccion,$valor,$capacidad){
        

        
        $newCine = new cine ($cine,$direccion,$capacidad,$valor,true);//creo el nuevo cine

        if ($newCine->getValor_entrada() == null || $newCine->getCapacidad() == null)
        {
            $this->index();
            ?><script> sweetAlert("Error", "El campo debe tener valores positivos", "error")</script>
            <?php
            //header("Location:".ROOT_VIEW);
        }
        else if($this->DAOCines->buscarPorID($newCine->getID() )!=null ) // Verifica que no exista otro Cine con el mismo id en BD
        {
            $this->index();
            ?><script> sweetAlert("Error", "El ID del cine ya se encuentra registrado!", "error")</script>
            <?php
           // header("Location:".ROOT_VIEW);
        }
        else if(strlen($cine)>30 ) // Verifica que el nombre del cine no supere los 30 caracteres maximos usados en BD
        {
            $this->index();
            ?><script> sweetAlert("Error", "El nombre del cine excede los 30 caracteres!", "error")</script>
            <?php
            
           // header("Location:".ROOT_VIEW);
        }
        else if(strlen($direccion)>30 ) // Verifica que la direccion del cine  no supere los 30 caracteres maximos usados en BD
        {
            $this->index();
            ?><script> sweetAlert("Error", "La dirección del cine excede los 30 caracteres!", "error")</script>
            <?php

            //header("Location:".ROOT_VIEW);
        }
        else if($this->DAOCines->buscarPorNombre($newCine->getNombre() )!=null ) // Verifica que no exista otro Cine con el mismo nombre en BD
        { 
            $this->index();
            ?><script> sweetAlert("Error", "El cine ingresado ya existe", "error")</script>
            <?php
        
            //header("Location:".ROOT_VIEW);
           
         
        }
        else
        {
        $this->DAOCines->insertar($newCine);
          //este tipo de mensaje no rompe el codigo
        $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
        ?><script> sweetAlert("Exito!", "Cine añadido correctamente!", "success")</script>
            <?php
        }
    }//fin newcine
    //
    //
	public function deleteCine($id_cine){
     
     
        $this->DAOCines->borrar($id_cine);         
         $this->index();
        ?><script> sweetAlert("Exito!", "Cine eliminado correctamente!", "success")</script>
        <?php
	}//fin delete cine
	//
	//
	public function modifyCine($id,$cine,$habilitado,$direccion,$capacidad,$valor){
        


        if (strlen($cine)>30){//verifico tamaño del nombre
            $this->index();
            ?><script> sweetAlert("Error", "El nombre del cine excede los 30 caracteres!", "error")</script>
            <?php
        
          // header("Location:".ROOT_VIEW);
        }
        else if(strlen($direccion)>30 ) // Verifica que la direccion del cine  no supere los 30 caracteres maximos usados en BD
        {
            $this->index();
            ?><script> sweetAlert("Error", "La dirección del cine excede los 30 caracteres!", "error")</script>
            <?php
            
            //header("Location:".ROOT_VIEW);
        }
        else if(($this->DAOCines->buscarPorNombre($cine)!=null) && ($this->DAOCines->buscarPorNombre($cine)->getID()!=$id)) // Verifica que no exista otro Cine con el mismo nombre en BD
        { 
            $this->index();
            ?><script> sweetAlert("Error", "El cine ingresado ya existe", "error")</script>
            <?php
        }
        else{//si esta todo bien , modifico el cine

            if ($habilitado==1)
            $cineMod = new cine ($cine,$direccion,$capacidad,$valor,1);
        else if($habilitado==0)
            $cineMod = new cine ($cine,$direccion,$capacidad,$valor,0);

        $cineMod->setID($id);
        $this->DAOCines->actualizar($cineMod);
        $this->index();
        ?><script> sweetAlert("Modificar", "Cine modificado satisfactoriamente!", "success")</script>
            <?php //este tipo de mensaje no rompe el codigo
       // $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
        //header("Location:".ROOT_VIEW);

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
            
            ?><script> sweetAlert("BD", "No hay cines cargados en la base de datos!", "error")</script>
            <?php
            return null;
        }
    }//traer todos
    //
    //
    //

}//fin class

?>
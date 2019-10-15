<?php namespace Controllers;

use models\Cine as Cine;
use Repository\CinesRepository as CinesRepository;

/**
 * 
 */
class PublishController 
{
    private $newProd;
    private $repository;
    
    public function __construct()
    {
        $this->newProd = new Cine();
        $this->repository = new CinesRepository();
    }



    public function index()
        {
            
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
    public function newCine(){
        $this->newProd->setDireccion($_POST['direccion']);
        $this->newProd->setNombre($_POST['cine']);
        $this->newProd->setID($_POST['ID']);
        $this->newProd->setValor_entrada($_POST['valor']); 
        $this->newProd->setCapacidad($_POST['capacidad']);
        $this->newProd->setHabilitado(true);

        if($this->repository->existByID($this->newProd->getID())) // Verifica que no exista otro Cine con el mismo id en el repositorio
        {
            echo '<script language="javascript">alert("El ID del cine ya se encuentra registrado!");</script>';
            $this->index();
        }
        else
        {
        $this->repository->add($this->newProd);
        
        echo '<script language="javascript">alert("Cine agregado satisfactoriamente!");</script>'; //este tipo de mensaje no rompe el codigo
        $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
        }
    }

/*
if($_POST){
    //$newProd = new Cine();
    $this->newProd->setDireccion($_POST['direccion']);
    $this->newProd->setNombre($_POST['cine']);
    $this->newProd->setID($_POST['ID']);
   $this->newProd->setValor_entrada($_POST['valor']);
    //$newProd->setDate($_POST['date']);
    $this->newProd->setCapacidad($_POST['capacidad']);
    $this->newProd->setHabilitado(true);

   
    //$this->repository = new CinesRepository();
    $this->repository->add($newProd);
    echo "<script> alert('Cine agregado satisfactoriamente!');";
    //echo "window.location = 'Views/Adm/home_adm.php'; </script>";
    $successMje =  "Cine agregado satisfactoriamente!";
    $this->index(); //llamo al index de esta clase para redirigirlo a donde sea correspondiente
}
*/



}//-----fin clase----------------------




 ?>
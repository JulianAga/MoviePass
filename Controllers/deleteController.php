<?php
namespace Controllers;

use models\Cine as Cine;
use Repository\CinesRepository as CinesRepository;

class DeleteController 
{
//    private $newProd;
    private $repository;
    
    public function __construct()
    {
        
        //$this->newProd = new Cine();
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



    public function deleteCine()
    {
        //echo $_POST['eliminar'];
    
        $this->repository->disable($_POST['eliminar']);

        //$repository->saveData();

        echo '<script language="javascript">alert("Cine eliminado satisfactoriamente!");</script>'; //este tipo de mensaje no rompe el codigo
        $this->index();
}
}

 ?>
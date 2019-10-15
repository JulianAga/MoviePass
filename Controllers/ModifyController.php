<?php
namespace Controllers;

use Repository\CinesRepository as CinesRepository;
use Models\Cine as Cine;

class ModifyController
{

    private $cinema;
    private $repository;
    
    public function __construct()
    {
        $this->cinema = new Cine();
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

    public function modifyCine()
    {
        $this->repository->modify($_POST['ID'],$_POST['direccion'],$_POST['cine'],$_POST['valor'],$_POST['capacidad']);
        
        echo '<script language="javascript">alert("Cine modificado satisfactoriamente!");</script>'; //este tipo de mensaje no rompe el codigo
        $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
    }

}

?>
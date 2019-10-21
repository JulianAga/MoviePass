<?/*php namespace Controllers;

use models\cine as Cine;
use Repository\CinesRepository as CinesRepository;

/**
 * 
 */
/*class CinesController 
{
    private $newProd;
    private $repository;

    private $DAOCines;
    
    public function __construct()
    {
        //$this->newProd = new Cine();
        //$this->repository = new CinesRepository();

        $this->DAOCines=\DAO\CinesDAO::getInstance();
        
    }



    public function index()
        {
            
            if(isset($_SESSION['Login']))//Si hay session:
            {
                

                if($_SESSION['Login']->getRol()==1)//SI ES ADMIN LO LLEVA A SU PAG (falta configurar esto)
                {
                    //lo lleva al home ADM
                    $arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista
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
        }//fin index-------
//
//


    public function newCine($direccion,$cine,$valor,$capacidad){

        $newCine = new cine ($cine,$direccion,$capacidad,$valor,true);//creo el nuevo cine

        if ($newCine->getValor_entrada() == null || $newCine->getCapacidad() == null) // Verifica que el cine no tenga valores negativos
        {
            echo '<script language="javascript">alert("El campo debe tener valores positivos!");</script>';
            $this->index();
        }
        else if($this->DAOCines->buscarPorID($newCine->getID() )!=null ) // Verifica que no exista otro Cine con el mismo id en BD
        {
            
            echo '<script language="javascript">alert("El ID del cine ya se encuentra registrado!");</script>';
            $this->index();
        }
        else
        {
        $this->DAOCines->insertar($newCine);
        
        echo '<script language="javascript">alert("Cine agregado satisfactoriamente!");</script>'; //este tipo de mensaje no rompe el codigo
        $this->index(); //llamo al index de esta clase para redirigirlo a la vista que  sea correspondiente
        }
    }


}//-----fin clase----------------------




*/ ?>
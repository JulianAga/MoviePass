<?php namespace Controllers;

	use Models\Cuenta as Cuenta;
	use Models\Cliente as Cliente;
	use Controllers\CineController as CineController;
	use Repository\ClientRepository as ClientRepository;
	use Repository\AccountRepository as AccountRepository;
	use DAO\SingletonAbstractDAO as SingletonAbstractDAO;

	use Repository\DAOGenres as DAOGenres;

	?>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SWEET ALERT -->
<?php
	


	class NavController 
	{
		
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

        public function adm_cine()
        {
			$movieList=$this->DAOPeliculas->traerTodos();
			$salaList=$this->DAOSalas->traerTodos();
			
			$functionList = $this->DAOFunciones->traerTodos(); //traigo todas las funciones de la BD
			$arrayCines=$this->DAOCines->traerTodos();//levanto todos los cines de la BD antes de el llamado a la vista
            require(ROOT . '/Views/Adm/cines_adm.php');
		}
		
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

	}
}
<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {


        	if( isset($_SESSION['Login'])){
			  	$cuenta_logueada=$_SESSION['Login'];
			  	$cuenta_logueada->getEmail();
			}
			if( isset($_SESSION['Cliente_Logueado'])){
  				$cliente=$_SESSION['Cliente_Logueado'];
  
			}
            require_once(VIEWS_PATH."home.php");
        }//fin index



               
    }//fin class
?>
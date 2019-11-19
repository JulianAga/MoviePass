<?php namespace Controllers;





/**
 * 
 */
class CompraController 
{
	//----------------ATRIBUTOS--------------------
	private $DAOClientes;
	private $DAOCuentas;
	private $DAOCines;
	private $DAOFunciones;
	private $DAOSalas;
	private $DAOCompras;
	private $DAOEntradas;
	//----------------CONSTRUCTOR--------------------
	function __construct()
	{
		$this->DAOCuentas=\DAO\CuentasDAO::getInstance();
		$this->DAOClientes=\DAO\ClientesDAO::getInstance();
		$this->DAOCines=\DAO\CinesDAO::getInstance();
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
		$this->DAOSalas=\DAO\SalasDAO::getInstance();
		$this->DAOCompras=\DAO\ComprasDAO::getInstance();
		$this->DAOEntradas=\DAO\EntradasDAO::getInstance();
	}
	//----------------METODOS--------------------

public function index(){

}//index
//
//
//
public function preCompra(){
	$function=$_SESSION['Funcion'];
	require(ROOT . '/Views/User/detalleCompra.php');

}//end precompra
//
//
//
public function newCompra($cantidad_entradas){
	if(isset($_SESSION['Login']))
	{
		//tomo el obj funcion de la sesion !PROVISORIO!
		
		$user=$_SESSION['Login'];
		$function=$_SESSION['Funcion'];

		//compra
		
		$subtotal=$function->getSala()->getValor_Entrada()*$cantidad_entradas;
		$fechaActual = date('Y-m-d');
		$descuento = 0;
		$total=$subtotal;
		
		
		$compra= new \Models\Compra($user,null,$fechaActual,$descuento,$subtotal,$total);
		$compra =$this->DAOCompras->insertar($compra);

		//entrada
		$ultima_entrada=$this->DAOEntradas->ultimaEntrada($function->getID()); // valor de la ultima entrada en bd
		

		//echo ($ultima_entrada+$cantidad_entradas);

		

		if(($ultima_entrada+$cantidad_entradas) > $function->getSala()->getCapacidad())//entra si no hay mas capacidad
		{
			//aca tira error
			echo "error entradas no disponibles";
		}
		else//entra si hay capacidad disponible
		{
			
			for ($i = 0; $i < $cantidad_entradas; $i++) //genero la cantidad de entradas pasadas por parametro
			{ 
				
				$ultima_entrada=$this->DAOEntradas->ultimaEntrada($function->getID()); // valor de la ultima entrada en bd
				$qr="qr";
					
				if($ultima_entrada== null) //busco la ultima entrada vendida y retorno, si es null(todavia no hay entradas para esa funcion) es 0
				{
					$ultima_entrada=0;
				}
				
				$numero_entrada=$ultima_entrada+1; //agrego +1 al la ultima entrada guardada
				$entrada= new \Models\Entrada($numero_entrada,$function,$qr);
				$entrada =$this->DAOEntradas->insertar($entrada,$compra->getId());
				
				
				
			}//end for

			//si no hay session lo llevo a home
			require(ROOT . '/Views/User/pagoCompra.php');


		}//end else
		
	}//end if
	else
	{
		
		//si no hay session le pido iniciar session FALTA HACER
		header("Location:".ROOT_VIEW);
		
	}

	
	
	
	

}//new compra
//
//
//











}//CLASS

?>
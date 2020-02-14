<?php namespace Controllers;


use Models\Compra as Compra;
use Models\QR as QR;
use Models\Entrada as Entrada;
use DAO\FuncionesDAO as FuncionesDAO;
use DAO\CuentasDAO as CuentasDAO;
use DAO\EntradasDAO as EntradasDAO;
use DAO\CuentaCreditoDAO AS CuentaCreditoDAO;
use DAO\ComprasDAO as ComprasDAO;
use DAO\QRDAO as QRDAO;
use Controllers\FuncionController as FuncionController;
use Controllers\MailsController as MailsController;



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
	private $DAOQR;
	private $mailsController;
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
		$this->DAOQR=\DAO\QRDAO::getInstance();
		$this->mailsController=new MailsController();
	}
	//----------------METODOS--------------------

public function index(){

}//index
//
//
//
public function preCompra($id)
{
	try
	{
		$function=$this->DAOFunciones->buscarPorID($id);
		$_SESSION['Funcion']=$function;
	}
	catch(PDOException $ex)
	{
		$_SESSION['Error']="Error al buscar por id funciones)";
	}

	
	require(ROOT . '/Views/User/detalleCompra.php');

}//end precompra
public function pagoCreditCard($cant_entradas){
	
	$cantidad_entradas=$cant_entradas;
	$function=$_SESSION['Funcion'];
	require(ROOT . '/Views/User/pagoCompra.php');

}
//
//
//
public function newCompra($cantidad_entradas){
	try
	{
		if(isset($_SESSION['Login']))
		{
			//tomo el obj funcion de la sesion !PROVISORIO!
			
			$user=$_SESSION['Login'];
			$function=$_SESSION['Funcion'];

			//compra
			
			$subtotal=$function->getSala()->getValor_Entrada()*$cantidad_entradas;
			$fechaActual = date('Y-m-d');
			if($cantidad_entradas>=2 && ((date("l")=="Tuesday" || date("l")=="Wednesday")))
			{
					$total=$subtotal*0.75;
					$descuento=$subtotal-$total;
			}
			else
			{
				$descuento = 0;
				$total=$subtotal;
			}
			
			$qrsToSend=array();
			
			$compra= new \Models\Compra($user,null,$fechaActual,$descuento,$subtotal,$total);
			$compra =$this->DAOCompras->insertar($compra);

			//entrada
			$ultima_entrada=$this->DAOEntradas->ultimaEntrada($function->getID()); // valor de la ultima entrada en bd
			

			//echo ($ultima_entrada+$cantidad_entradas);
			
			

			if(($ultima_entrada+$cantidad_entradas) > $function->getSala()->getCapacidad())//entra si no hay mas capacidad
			{
				$_SESSION['Error']="Error entradas no disponibles!";
				header("Location:".ROOT_VIEW);
			}
			else//entra si hay capacidad disponible
			{
				
				for ($i = 0; $i < $cantidad_entradas; $i++) //genero la cantidad de entradas pasadas por parametro
				{ 
					
					$ultima_entrada=$this->DAOEntradas->ultimaEntrada($function->getID()); // valor de la ultima entrada en bd

						
					if($ultima_entrada== null) //busco la ultima entrada vendida y retorno, si es null(todavia no hay entradas para esa funcion) es 0
					{
						$ultima_entrada=0;
					}
					
					$numero_entrada=$ultima_entrada+1; //agrego +1 al la ultima entrada guardada

					$entrada= new \Models\Entrada($numero_entrada,$function); 
					$entrada =$this->DAOEntradas->insertar($entrada,$compra->getId());
					$qr=new QR();
					$qr->setEntrada($entrada);
					
					$id_qr=$this->DAOQR->add($qr);
					
					array_push($qrsToSend,$id_qr);
					
					
				}//end for

				

                $this->mailsController->enviarMailCompra($compra,$qrsToSend);
				//si no hay session lo llevo a home
				$_SESSION['Success']="Compra Exitosa!";
				header("Location:".ROOT_VIEW);

			}//end else
		
		}//end if
		else
		{
			
			//si no hay session le pido iniciar session FALTA HACER
			$_SESSION['Error']="Ningun usuario Logueado!";
			header("Location:".ROOT_VIEW);
			
		}
	}
	catch(PDOException $ex)
	{
		$_SESSION['Error']="Error al crear una nueva compra)";
	}
	

	
	
	
	

}//new compra
//
//
//











}//CLASS

?>
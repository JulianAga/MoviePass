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
	//----------------CONSTRUCTOR--------------------
	function __construct()
	{
		$this->DAOCuentas=\DAO\CuentasDAO::getInstance();
		$this->DAOClientes=\DAO\ClientesDAO::getInstance();
		$this->DAOCines=\DAO\CinesDAO::getInstance();
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
		$this->DAOSalas=\DAO\SalasDAO::getInstance();
	}
	//----------------METODOS--------------------

public function index(){

}//index
//
//
//
public function newCompra(){

	$function=$_SESSION['Funcion'];//tomo el obj funcion de la sesion !PROVISORIO!
	
	require(ROOT . '/Views/User/detalleCompra.php');
	

}//new compra
//
//
//











}//CLASS

?>
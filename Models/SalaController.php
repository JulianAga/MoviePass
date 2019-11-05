<?php namespace Controllers;


use models\cine as Cine;
use models\Funcion as Funcion;


class SalaController{

	//----------------ATRIBUTOS-----------------------
	 private $DAOFunciones;
	 private $DAOPeliculas;
	//----------------CONSTRUCTOR---------------------
	function __construct()
	{
		$this->DAOFunciones=\DAO\FuncionesDAO::getInstance();
		$this->DAOPeliculas=\DAO\PeliculasDAO::getInstance();
	}
	//-----------------METODOS------------------------


	
}//fin class

?>
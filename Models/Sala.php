<?php namespace Models;

class Sala{
	//----------------ATRIBUTOS---------------------
	private $capacidad;
	private $funciones=array();
	private $nombre;
	private $valor_entrada;
	private $cine;
	//----------------CONTRUCTOR--------------------
	 function __construct($capacidad,$valor_entrada,$nombre,$cine){

	 	

		$this->setCapacidad($capacidad);
		$this->setValor_Entrada($valor_entrada);
		$this->setNombre($nombre);
		$this->cine=$cine;
		$this->setFunciones(null);
		

	}
	//-----------------GETERS AND SETERS-------------

	public function getCapacidad(){
		return $this->capacidad;
	}
	public function setCapacidad($capacidad){
		$this->capacidad=$capacidad;
	}

	public function getFunciones(){
		return $this->funciones;
	}
	public function setFunciones($funciones){
		$this->funciones=$funciones;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nombre){
		$this->nombre=$nombre;
	}
	public function getValor_Entrada(){
		return $this->valor_entrada;
	}
	public function setValor_Entrada($valor_entrada){
		$this->valor_entrada=$valor_entrada;
	}
	public function getCine(){
		return $this->cine;
	}
	public function setCine($cine){
		$this->cine=$cine;
	}
	//--------------------------------------------------





}//class




?>
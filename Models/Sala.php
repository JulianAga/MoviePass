<?php namespace Models;

class Sala{
	//----------------ATRIBUTOS---------------------
	private $capacidad;
	private $funciones=array();
	private $nombre;
	//----------------CONTRUCTOR--------------------
	function__construct ($capacidad,$funciones,$nombre){

		$this->setCapacidad($capacidad);
		$this->setFunciones($funciones);
		$this->setNombre($nombre);

	}
	//-----------------GETERS AND SETERS-------------

	public function getCapacidad(){
		return $this->capacidad;
	}
	public function setCapacidad($capacidad){
		$this->$capacidad=$capacidad;
	}

	public function getFunciones(){
		return $this->funciones;
	}
	public function setFunciones($funciones){
		$this->$funciones=$funciones;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nombre){
		$this->$nombre=$nombre;
	}
	//--------------------------------------------------





}//class




?>
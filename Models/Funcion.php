<?php namespace Models;

use models\Pelicula as Pelicula;

class Funcion
{
	//---------------ATRIBUTOS--------------
	private $id_funcion;

	private $id_cine;
	private $id_pelicula;
	private $horario;
	private $dia;
	
	//--------------CONSTRUCTOR--------------
	public function __construct($id_cine,$id_pelicula,$horario,$dia){
		$this->setIdCine($id_cine);
		$this->setIdPelicula($id_pelicula);
		$this->setHorario($horario);
		$this->setDia($dia);

	}

	//---------------GETERS SETERS------------

	function validar_fecha_espanol($fecha){
		$valores = explode('/', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			return true;
		}
		return false;
	}

	
	public function getID()
	{
		return $this->id_funcion;
	}

	public function getIdPelicula ()
	{
		return $this->id_pelicula;
	}
	
	public function getIdCine ()
	{
		return $this->id_cine;
	}
	
	public function getDia()
	{
		return $this->dia;
	}

	public function getHorario()
	{
		return $this->horario;
	}

	public function setIdCine ($id_cine)
	{
		$this->id_cine = $id_cine;
	}

	public function setIdPelicula($id_pelicula)
	{
		$this->id_pelicula = $id_pelicula;
	}

	public function setHorario($horario)
	{
		$this->horario = $horario;
	}

	public function setDia($dia)
	{
		//if (validar_fecha_espanol($dia))
		$this->dia = $dia;
	}

	public function setID($id)
	{
		$this->id_funcion=$id;
	}




}//fin clase funcion
?>
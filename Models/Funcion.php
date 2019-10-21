<?php namespace Models;

class Funcion
{

	private $id_funcion;
	private $id_cine;
	private $id_pelicula;
	private $horario;
	private $dia;
	

	public function __construct()
	{
	}
	public function getID()
	{
		return $this->id_funcion;
	}

	public function getPelicula ()
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
		$this->dia = $dia;
	}
	
	public function setID($id)
	{
		$this->id_funcion=$id;
	}




}//fin clase funcion
?>
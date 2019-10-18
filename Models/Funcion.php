<?php namespace Models;

class Funcion
{

	private $id_funcion;
	private $id_pelicula;
	private $horario;
	private $dia;
	

	public function __construct($pelicula, $horario, $dia)
	{
		$this->setIdPelicula($pelicula);
		$this->setHorario($horario);
		$this->setDia($dia);
		
		
	}
	public function getID()
	{
		return $this->id_funcion;
	}

	public function getPelicula ()
	{
		return $this->id_pelicula;
	}
	public function setIdPelicula($id_pelicula)
	{
		$this->id_pelicula = $id_pelicula;
	}
	public function getHorario()
	{
		return $this->horario;
	}
	public function setHorario($horario)
	{
		$this->horario = $horario;
	}
	public function getDia()
	{
		return $this->dia;
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
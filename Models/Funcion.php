<?php namespace Models;

class Funcion
{

	private $pelicula;
	private $horario;
	private $dia;


	public function __construct($pelicula, $horario, $dia)
	{
		$this->setPelicula($pelicula);
		$this->setHorario($horario);
		$this->setDia($dia);
		
		
	}

	public function getPelicula ()
	{
		return $this->pelicula;
	}
	public function setPelicula($pelicula)
	{
		$this->pelicula = $pelicula;
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





}//fin clase funcion
?>
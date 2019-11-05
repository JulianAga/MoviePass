<?php namespace Models;

class Cliente
{
	private $id;
	private $nombre;
	private $apellido;
	private $dni;
	private $telefono;
	private $direccion;
	private $ciudad;
	private $numeroTarjeta;


	public function __construct($nombre, $apellido,$dni, $telefono, $direccion,$ciudad)
	{
		$this->setId(null);
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setDni($dni);
		$this->setTelefono($telefono);
		$this->setDireccion($direccion);
		$this->setCiudad($ciudad);
		$this->setNumeroTarjeta(null);
		
	}



	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getNombre ()
	{
		return $this->nombre;
	}
	public function setNombre($nombre)
	{
		if(strlen($nombre)<25 && strlen($nombre)>2)
		$this->nombre = $nombre;
	}

	public function getApellido ()
	{
		return $this->apellido;
	}
	public function setApellido($apellido)
	{
		if(strlen($apellido)<25 && strlen($apellido)>2)
		$this->apellido = $apellido;
	}
	public function getDni()
	{
		return $this->dni;
	}
	public function setDni($dni)
	{
		if(strlen($dni)<10 && strlen($dni)>6)
		$this->dni = $dni;
	}
	public function getTelefono ()
	{
		return $this->telefono;
	}
	public function setTelefono($telefono)
	{
		if(strlen($telefono)<15 && strlen($telefono)>2)
		$this->telefono = $telefono;
	}
	public function getDireccion ()
	{
		return $this->direccion;
	}
	public function setDireccion($direccion)
	{
		if(strlen($direccion)<30 && strlen($direccion)>2)
		$this->direccion = $direccion;
	}
	public function getCiudad()
	{
		return $this->ciudad;
	}
	public function setCiudad($ciudad)
	{
		if(strlen($ciudad)<30 && strlen($ciudad)>2)
		$this->ciudad = $ciudad;
	}
	public function getNumeroTarjeta()
	{
		return $this->numeroTarjeta;
	}
	public function setNumeroTarjeta ($numeroTarjeta)
	{
		$this->numeroTarjeta = $numeroTarjeta;
	}



}//fin clase Cliente


?>
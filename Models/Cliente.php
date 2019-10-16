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


	public function __construct($nombre, $apellido,$dni, $telefono, $direccion,$ciudad,$numeroTarjeta)
	{
		$this->setId(null);
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setDni($dni);
		$this->setTelefono($telefono);
		$this->setDireccion($direccion);
		$this->setCiudad($ciudad);
		$this->setNumeroTarjeta($numeroTarjeta);
		
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
		$this->nombre = $nombre;
	}

	public function getApellido ()
	{
		return $this->apellido;
	}
	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}
	public function getDni()
	{
		return $this->dni;
	}
	public function setDni($dni)
	{
		$this->dni = $dni;
	}
	public function getTelefono ()
	{
		return $this->telefono;
	}
	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}
	public function getDireccion ()
	{
		return $this->direccion;
	}
	public function setDireccion($direccion)
	{
		$this->direccion = $direccion;
	}
	public function getCiudad()
	{
		return $this->ciudad;
	}
	public function setCiudad($ciudad)
	{
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
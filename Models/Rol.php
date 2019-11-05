<?php namespace Models;

/**
 * 
 */
class Rol 
{
	private $id;
	private $nombre;
	private $descripcion;

	function __construct($nombre,$descripcion)

	{
		$this->setNombre($nombre);
		$this->setDescripcion($descripcion);
		
	}


	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
}

?>
<?php namespace Models;

/**
 * 
 */
class ClassName 
{
	$id;
	$nombre;
	$descripcion;

	function __construct($nombre,$descripcion)

	{
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		
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
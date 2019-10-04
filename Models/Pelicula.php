<?php namespace Models;


class Pelicula
{
    private $id;
    private $descripcion;
    private $nombre;
    private $restriccion;
    private $duracion; //en minutos
    private $codigo;
    private $categoria;
    private $tipo;//2d 3d



    public function __construct($descripcion,  $nombre, $restriccion, $duracion, $codigo, $categoria,$tipo)
    {
        $this->setDescripcion($descripcion);
        $this->setNombre($nombre);
        $this->setRestriccion($restriccion);
        $this->setDuracion($duracion);
        $this->setCodigo($codigo);
        $this->setCategoria($categoria);
        $this->setTipo($tipo);
    }

    
	
     public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescripcion ()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getNombre ()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getRestriccion ()
    {
        return $this->restriccion;
    }
    public function setRestriccion($restriccion)
    {
        $this->restriccion = $restriccion;
    }
    public function getDuracion ()
    {
        return $this->duracion;
    }
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
     public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
     public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

}

?>
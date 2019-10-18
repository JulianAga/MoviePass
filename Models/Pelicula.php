<?php namespace Models;


class Pelicula
{
    private $id;
    private $id_api;
    private $descripcion;
    private $nombre;
    private $imagen;
    private $duracion; //en minutos
    private $categoria;
    private $lenguaje;
   



    public function __construct($id_api,$descripcion,  $nombre, $duracion,  $categoria, $imagen,$lenguaje)
    {
        $this->setId_api($id_api);
        $this->setDescripcion($descripcion);
        $this->setNombre($nombre);
        $this->setDuracion($duracion);
        $this->setImagen($imagen);
        $this->setCategoria($categoria);
        $this->setLenguaje($lenguaje);
        
    }
     public function getLenguaje()
    {
        return $this->lenguaje;
    }
    public function setLenguaje($lenguaje)
    {
        $this->lenguaje = $lenguaje;
    }
     public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
	 public function getId_api()
    {
        return $this->id_api;
    }
    public function setId_api($id_api)
    {
        $this->id_api = $id_api;
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
   
    public function getDuracion ()
    {
        return $this->duracion;
    }
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    
     public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    

}

?>
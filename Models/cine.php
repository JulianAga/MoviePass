<?php namespace Models;

$caracteresMax = 30;
class Cine {

    private $ID;
    private $nombre;
    private $direccion;
    private $capacidad;
    private $valor_entrada;
    private $habilitado;

    function __construct ($nombre,$direccion,$habilitado){

        $this->ID = null;
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
        $this->setHabilitado($habilitado);
    }



    public function getID (){
        return $this->ID;
    }

    public function setID ($ID){
        $this->ID = $ID;
    }

    public function getNombre (){
        return $this->nombre;
    }

    public function setNombre ($nombre){
        if(strlen($nombre)<30)
        {
        $this->nombre = $nombre;
        }
    }

    public function getDireccion (){
        return $this->direccion;
    }

    public function setDireccion ($direccion){
        if(strlen($direccion)<30)
        {
        $this->direccion = $direccion;
        }
    }

    
    
    public function getHabilitado()
    {
        return $this->habilitado;
    }
    
    public function setHabilitado($habilitado)
    {
        if($habilitado == true || $habilitado == false)
        {
        $this->habilitado = $habilitado;
        }
    }
}
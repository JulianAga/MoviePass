<?php namespace Models;

class Cine {

    private $ID;
    private $nombre;
    private $direccion;
    private $capacidad;
    private $valor_entrada;
    private $habilitado;

    function __construct ($nombre,$direccion,$capacidad,$valor_entrada,$habilitado){

        $this->ID = null;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->capacidad = $capacidad;
        $this->valor_entrada = $valor_entrada;
        $this->habilitado = $habilitado;
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
        if($nombre != null)
        {
            $this->nombre = $nombre;
        }
        else
        {
            $this->nombre ='unnamed';
        }
    }
    public function getDireccion (){
        return $this->direccion;
    }

    public function setDireccion ($direccion){
        $this->direccion = $direccion;
    }

    public function getCapacidad(){
        return $this->capacidad;
    }

    public function setCapacidad($capacidad){
        if($capacidad > 0)
        {
        $this->capacidad = $capacidad;
        }
    }

    public function getValor_entrada(){
        return $this->valor_entrada;
    }

    public function setValor_entrada($valor_entrada){
        if($valor_entrada > 0)
        {
        $this->valor_entrada = $valor_entrada;
        }
    }
    
    public function getHabilitado()
    {
        return $this->habilitado;
    }
    
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;
    }
}
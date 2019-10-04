<?php namespace Models;

class Cine {

    private $ID;
    private $nombre;
    private $direccion;
    private $capacidad;
    private $valor_entrada;

    function __construct (/*$ID ,$nombre, $direccion, $capacidad, $valor_entrada*/){
        /*$this->ID = $ID;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->capacidad = $capacidad;
        $this->valor_entrada = $valor_entrada;*/
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
        $this->nombre = $nombre;
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
        $this->capacidad = $capacidad;
    }

    public function getValor_entrada(){
        return $this->valor_entrada;
    }

    public function setValor_entrada($valor_entrada){
        $this->valor_entrada = $valor_entrada;
    }
}
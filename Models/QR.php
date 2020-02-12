<?php 
namespace Models;

class QR 
{
    
  
    private $tamaño;
    private $nivel;
    private $tamañoFrame;
    private $fileName;
    private $entrada;

    public function __construct() {
        $this->tamaño=10;
        $this->nivel='M';
        $this->tamañoFrame=3;
    }
    
    public function getTamaño()
    {
        return $this->tamaño;
    }
    public function getNivel()
    {
        return $this->nivel;
    }
    public function getTamañoFrame()
    {
        return $this->tamañoFrame;
    }

    public function getEntrada()
    {
    return $this->entrada;
    }
 
    public function getFileName()
    {
        return $this->fileName;
    }
  
    public function setFileName($fileName)
    {
        $this->fileName=$fileName;
    }

   
    public function setEntrada($entrada)
    {
        $this->entrada=$entrada;
    }
    
    

}
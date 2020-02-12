<?php namespace Models;

class Entrada
{
    private $id;
    private $numero_entrada;
    private $funcion;


	public function __construct($numero_entrada, $funcion)
	{
		$this->setNumeroEntrada($numero_entrada);
        $this->setFuncion($funcion);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNumeroEntrada()
    {
        return $this->numero_entrada;
    }

 
    public function setNumeroEntrada($numero_entrada)
    {
        $this->numero_entrada = $numero_entrada;
    }

    public function getFuncion()
    {
        return $this->funcion;
    }

 
    public function setFuncion($funcion)
    {
        $this->funcion = $funcion;
    }

   
    
}
?>
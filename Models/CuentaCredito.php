<?php namespace Models;

class CuentaCredito
{
    private $id;
    private $empresa;
    private $numero_tarjeta;


	public function __construct($empresa,$numero_tarjeta)
	{
        $this->setEmpresa($empresa);
        $this->setNumeroTarjeta($numero_tarjeta);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

 
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    public function getNumeroTarjeta()
    {
        return $this->numero_tarjeta;
    }

 
    public function setNumeroTarjeta($numero_tarjeta)
    {
        $this->numero_tarjeta = $numero_tarjeta;
    }
   
    
}
?>
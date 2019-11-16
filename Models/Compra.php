<?php namespace Models;

class Compra
{
    private $id;
    private $entradas=array();
    private $fecha;
    private $descuento;
    private $subtotal;
    private $total;


	public function __construct($entradas, $fecha,$descuento,$subtotal,$total)
	{
		$this->setCantidadEntradas($entradas);
        $this->setFecha($fecha);
        $this->setDescuento($descuento);
        $this->setSubtotal($subtotal);
        $this->setTotal($total);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEntradas()
    {
        return $this->entradas;
    }

 
    public function setEntradas($entradas)
    {
        $this->entradas = $entradas;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

 
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function getTotal()
    {
        return $this->total;
    }

 
    public function setTotal($total)
    {
        $this->total = $total;
    }

   
    
}
?>
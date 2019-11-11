<?php namespace Models;

class Compra
{
    private $id;
    private $cant_entradas;
    private $fecha;
    private $descuento;
    private $subtotal;
    private $total;


	public function __construct($cant_entradas, $fecha,$descuento,$subtotal,$total)
	{
		$this->setCantidadEntradas($cant_entradas);
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

    public function getCantidadEntradas()
    {
        return $this->cant_entradas;
    }

 
    public function setCantidadEntradas($cant_entradas)
    {
        $this->cant_entradas = $cant_entradas;
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
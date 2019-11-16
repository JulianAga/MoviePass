<?php namespace Models;

class PagoTC
{
    private $id;
    private $cod_aut;
    private $fecha;
    private $total;
    private $compra;
    private $cuenta_credito;


	public function __construct($cod_aut,$fecha,$total,$compra,$cuenta_credito)
	{
		$this->setCodigoAutenticacion($cod_aut);
        $this->setFecha($fecha);
        $this->setTotal($total);
        $this->setTotal($compra);
        $this->setCuentaCredito($cuenta_credito);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCodigoAutenticacion()
    {
        return $this->cod_aut;
    }

 
    public function setCodigoAutenticacion($cod_aut)
    {
        $this->cod_aut = $cod_aut;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getTotal()
    {
        return $this->total;
    }

 
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getCompra()
    {
        return $this->compra;
    }

 
    public function setCompra($compra)
    {
        $this->compra = $compra;
    }

    public function getCuentaCredito()
    {
        return $this->cuenta_credito;
    }

 
    public function setCuentaCredito($cuenta_credito)
    {
        $this->cuenta_credito = $cuenta_credito;
    }
    
}
?>
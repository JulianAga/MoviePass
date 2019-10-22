<?php namespace Models;

class Genre
{
    private $id;
	private $name;
    private $id_api;

	public function __construct($id, $name,$idApi)
	{
		$this->setId($id);
        $this->setName($name);
        $this->setIdApi($idApi);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdApi()
    {
        return $this->idApi;
    }

 
    public function setId($idApi)
    {
        $this->idApi = $idApi;
    }

    public function getName()
    {
        return $this->name;
    }

 
    public function setName($name)
    {
        $this->name = $name;
    }

   
    
}
?>
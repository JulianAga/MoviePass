<?php namespace Repository;

use Repository\IClientRepository as IClientRepository;
use Models\Cliente as Cliente;

use Repository\IAccountRepository as IAccountRepository;
use Models\Cuenta as Cuenta;

class ClientRepository implements IClientRepository{

    private $clientList = array();





//***********METODOS*************
    public function GetAll()
    {
        $this->RetrieveData();

        return $this->clientList;
    }
    //
    //
    public function GetById($id)
    {
        $this->RetrieveData();
        $clientFounded = null;
        
        if(!empty($this->clientList)){
            foreach($this->clientList as $client){
                if($client->getId() == $id)
                {
                    $clientFounded = $client;
                }
            }
        }
        else{
            echo 'esta vacio';
        }

        return $clientFounded;
    }
    //
    //
    //
    //
    public function Add(Cliente $newClient)
    {
        
        $this->RetrieveData();
        
        array_push($this->clientList, $newClient);

        $this->SaveData();
    }
    //
    //Json Persistence
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->clientList as $client)
        {
            $valuesArray["id"] = $client->getId();
            $valuesArray["nombre"] = $client->getNombre();
            $valuesArray["apellido"] = $client->getApellido();
            $valuesArray["telefono"] = $client->getTelefono();
            $valuesArray["direccion"] = $client->getDireccion();
            $valuesArray["ciudad"] = $client->getCiudad();
            $valuesArray["numeroTarjeta"] = $client->getNumeroTarjeta();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/clientes.json', $jsonContent);
    }
    //
    //
    private function RetrieveData()
    {
        $this->clientList = array();

        if(file_exists('Data/clientes.json'))
        {
            $jsonContent = file_get_contents('Data/clientes.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $client = new Cliente($valuesArray["nombre"],$valuesArray["apellido"],$valuesArray["telefono"],$valuesArray["direccion"],$valuesArray["ciudad"],$valuesArray["numeroTarjeta"],$valuesArray["id"]);
            

                array_push($this->clientList, $client);
            }
        }
        else
        {
            echo 'no encuentra json';
        }
    }
    //
    //
    public function returnArray($id)
    {
        $client=$this->GetById($id);
        
        $clientArray["id"] = $client->getId();
        $clientArray["nombre"] = $client->getNombre();
        $clientArray["apellido"] = $client->getApellido();
        $clientArray["telefono"] = $client->getTelefono();
        $clientArray["direccion"] = $client->getDireccion();
        $clientArray["ciudad"] = $client->getCiudad();
        $clientArray["numeroTarjeta"] = $client->getNumeroTarjeta();
        
        return $clientArray;
    }
    //
    //
    public function saveClienteReturnID($client)
    {
        var_dump("cliente"); 
        var_dump($client->GetNombre() ); 
        $arrayClient=$this->GetAll();//obtengo lista de todos los clientes
             
        $idClient=array_key_last($arrayClient);//busco la ultima posicion del array  para el ID del cliente
        $idClient++;//sumo 1 para qe el id no pise el ultimo cliente guardado
        

        $client->setId($idClient);//asigno el ID al cliente.ACA ESTA EL PROBLEMA Q NO GUARDA EL ID

        
        $this->Add($client);//guardo el Cliente con su ID
        
        return $idClient;
    
    }//fin saveClienteReturnID

    /*public function arrayConvertido($client)
    {
        $clientArray["id"] = $client->getId();
        $clientArray["nombre"] = $client->getNombre();
        $clientArray["apellido"] = $client->getApellido();
        $clientArray["telefono"] = $client->getTelefono();
        $clientArray["direccion"] = $client->getDireccion();
        $clientArray["ciudad"] = $client->getCiudad();
        $clientArray["numeroTarjeta"] = $client->getNumeroTarjeta();
        
        return $clientArray;

    }*/
}

?>


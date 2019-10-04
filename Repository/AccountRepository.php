<?php namespace Repository;

use Repository\IAccountRepository as IAccountRepository;
use Models\Cuenta as Cuenta;

use Repository\ClientRepository as ClientRepository;
use Models\Cliente as Cliente;

class AccountRepository implements IAccountRepository
{

    private $accountList = array();

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->accountList;
    }

    public function GetByEmail($email)
    {
        $this->RetrieveData();
        $accountFounded = null;
        
        if(!empty($this->accountList)) //entra si no esta vacio
        {
            foreach($this->accountList as $account)//recorro la lista de cuentas
            {
                if($account->getEmail() == $email)//si coinciden los email, creo objeto
                {
                    $accountFounded = $account;
                }
            }
        }
        else
        {
            echo 'esta vacio';
        }

        return $accountFounded;//devuelvo la cuenta encontrada
    }

    public function Add(Cuenta $newAccount)//agregar cuenta nueva
    {
        
        $this->RetrieveData();
        
        array_push($this->accountList, $newAccount);

        $this->SaveData();
    }

    //Json Persistence
    private function SaveData()
    {
        $arrayToEncode = array();
        foreach($this->accountList as $account) //recorro la lista con cuentas
        {
            $valuesArray["id"] = $account->getId();                 //guardo todos los valores en un array
            $valuesArray["email"] = $account->getEmail();
            $valuesArray["password"] = $account->getPassword();
            $valuesArray["rol"] = $account->getRol();
            
            $clientRepository= new ClientRepository();      
            
            $client= $account->getCliente();        

            $clientRepository->Add($client);       //se guarda el cliente EN UN JSON SEPARADO DE CLIENTES
            
            $valuesArray["cliente"] = $client->getId();    //se guarda el id del cliente en este atributo de la CUENTA

            array_push($arrayToEncode, $valuesArray);   
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);      //se guarda LA CUENTA EN EL JSON
        
        file_put_contents('Data/cuentas.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->accountList = array();

        if(file_exists('Data/cuentas.json'))
        {
            $jsonContent = file_get_contents('Data/cuentas.json');  //trae los datos del json

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array(); //se decodifica el json

            foreach($arrayToDecode as $valuesArray)    //se recorre el  array
            {
                
                $clientRepository= new ClientRepository();  
                $client=$clientRepository->GetById($valuesArray["cliente"]); //se busca en el json de clientes por el id guardado en el atributo cliente del json de CUENTAS
                
                $account = new Cuenta($valuesArray["email"],$valuesArray["password"],$valuesArray["rol"],$client); //se van creando las cuentas


                array_push($this->accountList, $account);
            }
        }

        else{
            echo 'no existe json';
        }
    }
}

?>


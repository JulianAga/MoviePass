<?php
namespace DAO;

use Models\Compra AS Compra;
use Models\QR AS QR;
use DAO\EntradasDAO AS EntradasDAO;

require_once(QR_ROUTE.'/phpqrcode/qrlib.php');
use QRcode AS QRcode;

class QRDAO extends SingletonAbstractDAO
{
    private $EntradasDAO;
    private $tableName="QRs";
    public function __construct() {
        $this->EntradasDAO = new EntradasDAO();
    }

    public function add(QR $newQr)
    {
        $query = "INSERT INTO ". $this->tableName . "(id_entrada,qr_image) VALUES(:id_entrada,:qr_image) ";
        $parameters["id_entrada"] = $this->EntradasDAO->getUltimaEntrada();
        $lastId=($this->getUltimoIDqr()+1);
        $fileName=QR_IMG."qr-".$lastId.".png";
        $file="qr-".$lastId.".png";
        $parameters["qr_image"]=$file;
        
        QRcode::png($lastId, $fileName);
   
        try {
           // $this->connection = Connection::GetInstance();
            //$this->connection->ExecuteNonQuery($query, $parameters);
            $pdo = new Connection();
            $connection = $pdo->Connect();
            $command = $connection->prepare($query, $parameters);
   
   
            $ResultSet= $command->execute($query, $parameters);
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
    
    public function getPorCompra(Compra $compra)
    {
        $QRList=array();
       $query = "SELECT * FROM ". $this->tableName . " inner join Entradas on Entradas.id_entrada=QRs.id_entrada inner join Compras on Compras.id_compra=Entradas.id_compra WHERE Compras.id_compra=:id_compra group by(QRs.id)";
       $parameters['id_compra']=$compra->getId();
       try {
       // $this->connection = Connection::GetInstance();
        //$ResultSet=$this->connection->Execute($query, $parameters);
        $pdo = new Connection();
        $connection = $pdo->Connect();
        $command = $connection->prepare($query, $parameters);
        $ResultSet= $command->execute($query, $parameters);
        foreach ($ResultSet as $item) {
            $qr=new QR();
            $entrada=$this->EntradasDAO->buscarPorID($item['id_entrada']);
            $qr->setEntrada($entrada);
            $qr->setFileName($item['qr_image']);
          array_push($QRList,$qr);
        }
        return $QRList;
    } catch (\Throwable $ex) {
        throw $ex;
    }
    }

    public function getUltimoIDqr()
    {
        $query = "SELECT max(id) as id FROM " .  $this->tableName;
        try {
           // $this->connection = Connection::GetInstance();
           $pdo = new Connection();
           $connection = $pdo->Connect();
           $command = $connection->prepare($query);
   
   
           $ResultSet= $command->execute();
            //$ResultSet=$this->connection->Execute($query);
            return $ResultSet[0]['id'];
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}

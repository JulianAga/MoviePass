<?php
namespace DAO;

use Models\Compra AS Compra;
use Models\QR AS QR;
use DAO\EntradasDAO AS EntradasDAO;
use DAO\ComprasDAO as ComprasDAO;
require_once(QR_ROUTE.'/phpqrcode/qrlib.php');
use QRcode AS QRcode;

class QRDAO extends SingletonAbstractDAO
{
    private $EntradasDAO;
  
    private $table="QRs";
    public function __construct() {
        $this->EntradasDAO = new EntradasDAO();
        
    }

    public function add(QR $newQr)
    {
      
        try {
            $query = 'INSERT INTO '.$this->table.' 
                (id_entrada, qr_image) 
                VALUES 
                (:id_entrada, :qr_image)';
            
            $pdo = new Connection();
            $connection = $pdo->Connect();
            $command = $connection->prepare($query);
            
            $id_entrada= $newQr->getEntrada()->getId();
            
            $lastId=($this->getUltimoIDqr()+1);
            $fileName=QR_IMG."qr-".$lastId.".png";
            $file="qr-".$lastId.".png";
            $qr_image=$file;
            
            $command->bindParam(':id_entrada', $id_entrada);
            $command->bindParam(':qr_image', $qr_image);
            
            $command->execute();
            $qrMsj="Entrada abonada, id entrada='$lastId'";
            
            QRcode::png($qrMsj, $fileName);
   
            return $connection->lastInsertId();
           // $this->connection = Connection::GetInstance();
            //$this->connection->ExecuteNonQuery($query, $parameters);
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
    
    public function getPorCompra(Compra $compra)
    {
        $QRList=array();
       $query = "SELECT * FROM ". $this->table . " inner join Entradas on Entradas.id_entrada=QRs.id_entrada inner join Compras on Compras.id_compra=Entradas.id_compra WHERE Compras.id_compra=:id_compra group by(QRs.id)";
       $id_compra=$compra->getId();
       try {
       
            $pdo = new Connection();
            $connection = $pdo->Connect();
            $command = $connection->prepare($query);
            $command->bindParam(':id_compra', $id_compra);
            $command->execute();
            
            while ($row = $command->fetch())
			{
				
				$id_entrada = ($row['id_entrada']);
				
            	
				
			}//while 


			return $object;
            
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
        $query = "SELECT max(id) as id FROM " .  $this->table;
        try {
           // $this->connection = Connection::GetInstance();
           $pdo = new Connection();
           $connection = $pdo->Connect();
           $command = $connection->prepare($query);
           $command->execute();
           while ($row = $command->fetch())
           { 
                $ResultSet= $row['id'];
           }
           
            //$ResultSet=$this->connection->Execute($query);
            return $ResultSet;
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}

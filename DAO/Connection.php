<?php namespace DAOS;

use \Exception as Exception;

    class Connection {
        
        public function Connect() 
        {
            return new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
        }
    }
?>
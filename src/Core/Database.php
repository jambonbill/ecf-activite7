<?php

namespace Core;

use PDO;
use PDOException;
use Exception;

class Database extends PDO
{
    
    static private $instance=null;

    /**
     * Private method, because we want a singleton
     */
    private function __construct()
    {
        
        // Todo:: read config file
        
        $dsn='mysql:host=' . DBHOST . ';dbname=;' . DBNAME;        
        //echo "dsn=$dsn\n";
        
        try{
            parent::__construct($dsn,DBUSER,DBPASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            var_dump($e);
            exit("Va te faire cuire le cul");
        }
    }

    private function __clone()
    {
        //because singleton -> no cloning
    }

    
    static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

}

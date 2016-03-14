<?php

class Database {
    
    protected static $instance = null;
    protected $dbh;
    
    public static function getInstance() {
        $username = 'wbsd12';
        $password = 'php54';
        $host = '213.229.84.20';
        $dbname = 'wbsd12';
        
        if (self::$instance === null) {
            self::$instance = new self($username, $password, $host, $dbname);
        }
        return self::$instance;       
    }
    
    private function __construct($username, $password, $host, $database) {
        $this->dbh = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    }
    
    public function getDbh() {
        return $this->dbh;
    }
    
    public function __destruct() {
        $this->dbh = null;
    }
    
    
}


    
    

//class Database {
//    
//    protected static $instance = null;
//    protected $dbh;
//    
//    public static function getInstance() {
//        $username = 'root';
//        $password = '';
//        $host = 'localhost';
//        $dbname = 'salford_assignment';
//        
//        if (self::$instance === null) {
//            self::$instance = new self($username, $password, $host, $dbname);
//        }
//        return self::$instance;       
//    }
//    
//    private function __construct($username, $password, $host, $database) {
//        $this->dbh = new PDO("mysql:host=$host;dbname=$database", $username, $password);
//    }
//    
//    public function getDbh() {
//        return $this->dbh;
//    }
//    
//    public function __destruct() {
//        $this->dbh = null;
//    }
//    
//    
//}
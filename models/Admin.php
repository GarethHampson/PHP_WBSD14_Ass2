<?php

class Admin {
    protected $username, $password, $forename;
    
    public function __construct($dbrow) {

        $this->password = $dbrow['password'];
      }
    

    
    public function getAdminPassword() {
        return $this->password;
    }
    
     public function getAdminForename() {
        return $this->forename;
    }
}
<?php

require_once __DIR__ . '/Admin.php';
require_once __DIR__ . '/TableAbstract.php';

class AdminTable extends TableAbstract {

    protected $name = 'hampson_wbsd14_ass2_admin';

    public function addAdmin($data) {


        $sql = "INSERT INTO $this->name (username, password, forename, surname) 
                VALUES (:username, :password, :forename, :surname)";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':username' => $data['username'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':forename' => $data['forename'],
            ':surname' => $data['surname']
        ));

        return $this->dbh->lastInsertID();
    }

    public function checkAdmin($data) {
        
     $sql = "SELECT password, forename
               FROM $this->name
               WHERE  username = :username";  
      
      $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                    ':username' => $data['username']
                ));
          
        $adminArray = array();
        while ($row = $results->fetch()) {
            $adminArray[] = new Admin($row);
        }
        return $adminArray;
         
        
    }

}

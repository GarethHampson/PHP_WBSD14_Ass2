<?php

require_once __DIR__ . '/Customers.php';
require_once __DIR__ . '/TableAbstract.php';

class CustomersTable extends TableAbstract {

    public function addCustomer($data) {


        $sql = "INSERT INTO hampson_wbsd14_ass2_customer_details (registration_id, forename, surname, address_1, address_2, address_3, 
                            address_4, address_5, postcode, email, phone) 
                VALUES (:registration_id, :forename, :surname, :address_1, :address_2, :address_3, :address_4, :address_5, :postcode, :email, :phone)";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':registration_id' => $data['registration_id'],
            ':forename' => $data['forename'],
            ':surname' => $data['surname'],
            ':address_1' => $data['address_1'],
            ':address_2' => $data['address_2'],
            ':address_3' => $data['address_3'],
            ':address_4' => $data['address_4'],
            ':address_5' => $data['address_5'],
            ':postcode' => $data['postcode'],
            ':email' => $data['email'],
            ':phone' => $data['phone']
        ));

        return $this->dbh->lastInsertID();
    }
    
    public function getCustomer($data) {
        
        $sql = "SELECT forename, surname, address_1, address_2, address_3, address_4, address_5, postcode, email, phone
                FROM hampson_wbsd14_ass2_customer_details 
                WHERE customer_id = :customer_id";
          
        $results = $this->dbh->prepare($sql);  
        
        $results->execute(array(
            ':customer_id' => $data['customer_id'],
            
        ));
        
        $customerArray = array();
        while ($row = $results->fetch()) {
            $customerArray[] = new Customers($row);
        }
        return $customerArray;
        
        
    }

}

<?php

class Customers {
    
            
    protected $customer_id, $registration_id, $forename, $surname, $address_1, $address_2, $address_3, $address_4, $address_5, $postcode, $email, $phone;
    
    public function __construct($dbrow) {
        $this->customer_id = $dbrow['customer_id'];
        $this->registration_id = $dbrow['registration_id'];
        $this->forename = $dbrow['forename'];
        $this->surname = $dbrow['surname'];
        $this->address_1 = $dbrow['address_1'];
        $this->address_2 = $dbrow['address_2'];
        $this->address_3 = $dbrow['address_3'];
        $this->address_4 = $dbrow['address_4'];
        $this->address_5 = $dbrow['address_5'];
        $this->postcode = $dbrow['postcode'];
        $this->email = $dbrow['email'];
        $this->phone = $dbrow['phone'];
      
    }
    
    public function getCustomerID() {
        return $this->customer_id;
    }
    
    public function getRegistrationID() {
        return $this->registration_id;
    }
    
    public function getForename() {
        return $this->forename;
    }
    
    public function getSurname() {
        return $this->surname;
    }
    
    public function getAddress1() {
        return $this->address_1;
    }
    
    public function getAddress2() {
        return $this->address_2;
    }
    
    public function getAddress3() {
        return $this->address_3;
    }
    
    public function getAddress4() {
        return $this->address_4;
    }
    
    public function getAddress5() {
        return $this->address_5;
    }
    
    public function getPostcode() {
        return $this->postcode;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
}
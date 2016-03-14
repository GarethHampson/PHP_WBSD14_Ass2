<?php


class CartCheck {
    protected $id;
    
    public function __construct($dbrow) {
        $this->id = $dbrow['id'];
               
    }
    
    public function getCartID() {
        return $this->id;
    }
    
      
}



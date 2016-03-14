<?php


class Product_Colour {
    protected $colour_id, $colour_name;
    
    public function __construct($dbrow) {
        $this->colour_id = $dbrow['colour_id'];
        $this->colour_name = $dbrow['colour_name'];
    }
    
    public function getColourName() {
        return $this->colour_name;
    }
    public function getColourID() {
        return $this->colour_id;
  }
}
<?php


class Product_Size {
    protected $size_id, $size_name;
    
    public function __construct($dbrow) {
        $this->size_id = $dbrow['size_id'];
        $this->size_name = $dbrow['size_name'];
    }
    
    public function getSizeName() {
        return $this->size_name;
    }
    public function getSizeID() {
        return $this->size_id;
  }
}
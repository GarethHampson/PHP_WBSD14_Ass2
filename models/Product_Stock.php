<?php


class Product_Stock {
    protected $stock_id;
    
    public function __construct($dbrow) {
       
        $this->stock_id = $dbrow['id'];
        
    }
    
    public function getStockID() {
        return $this->stock_id;
    }
    
       

}
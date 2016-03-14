<?php


class Product_Inventory {
    protected $stock_id, $product_id, $colour_name, $size_name, $stock_level;
    
    public function __construct($dbrow) {
        $this->product_id = $dbrow['product_id'];
        $this->stock_id = $dbrow['id'];
        $this->stock_colour = $dbrow['colour_name'];
        $this->stock_size = $dbrow['size_name'];
        $this->stock_level = $dbrow['stock_level'];

    }
    
    public function getStockID() {
        return $this->stock_id;
    }
    
    public function getProductID() {
        return $this->product_id;
    }
    
    public function getStockColour() {
        return $this->stock_colour;
    }
    
    public function getStockSize() {
        return $this->stock_size;
    }
    
    public function getStockLevel() {
        return $this->stock_level;
    }
    
    

}
<?php


class Cart {
    protected $cart_stock_id, $cart_quantity, $product_details, $price, $stock_level;
    
    public function __construct($dbrow) {
        $this->id = $dbrow['id'];
        $this->cart_stock_id = $dbrow['cart_stock_id'];
        $this->cart_quantity = $dbrow['cart_quantity'];
        $this->product_details = $dbrow['product_details'];
        $this->price = $dbrow['price'];
        $this->stock_level = $dbrow['stock_level'];
        
    }
    
    public function getCartID() {
        return $this->id;
    }
    
    public function getCartStockID() {
        return $this->cart_stock_id;
    }
    
    public function getCartQuantity() {
        return $this->cart_quantity;
    }
    
    public function getProductDetails() {
        return $this->product_details;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getStockLevel() {
        return $this->stock_level;
    }
    
}



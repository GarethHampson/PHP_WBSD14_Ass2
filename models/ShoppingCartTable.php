<?php

require_once __DIR__ . '/Cart.php';
require_once __DIR__ . '/TableAbstract.php';

class ShoppingCartTable extends TableAbstract {
protected $name = 'hampson_wbsd14_ass2_shopping_cart';
    
    public function getTheStockID($data) {
    
        $sql = "SELECT id 
                FROM hampson_wbsd14_ass2_product_stock
                WHERE product_id = :product_id AND colour_id = :colour_id AND size_id = :size_id";
                
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                    ':product_id' => $data['product_id'],
                    ':colour_id' => $data['colour_id'],
                    ':size_id' => $data['size_id']
                ));
          
            
        $stockArray = array();
        
        while ($row = $results->fetch()) {
            $stockArray[] = new Product_Stock($row);
        }
        return $stockArray;
        
        
    }
        
    public function getCartContents($data) {
    
        $sql = "SELECT sc.id, sc.cart_stock_id, sc.cart_quantity, CONCAT(p.name, ' - ', c.colour_name, ' - ',  siz.size_name) AS product_details, p.price, s.stock_level
                FROM hampson_wbsd14_ass2_shopping_cart as sc
                INNER JOIN hampson_wbsd14_ass2_product_stock AS s ON sc.cart_stock_id = s.id
                INNER JOIN hampson_wbsd14_ass2_products as p ON p.id = s.product_id
                INNER JOIN hampson_wbsd14_ass2_product_colour AS c ON c.id = s.colour_id
                INNER JOIN hampson_wbsd14_ass2_product_sizes AS siz ON siz.size_id = s.size_id
                WHERE sc.user_session_id = :user_session_id";
        
                
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                ':user_session_id' =>$data['user_session_id']
        ));
        
        //var_dump($results->errorInfo());
                     
        $cartArray = array();
        while ($row = $results->fetch()) {
            $cartArray[] = new Cart($row);
        }
        return $cartArray;
        
    }  
    
    public function checkProductExists($data) {
    
        $sql = "SELECT sc.id
                FROM hampson_wbsd14_ass2_shopping_cart as sc
                WHERE sc.user_session_id = :user_session_id AND sc.cart_stock_id = :cart_stock_id;";
        
                
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                ':user_session_id' =>$data['user_session_id'],
                ':cart_stock_id' =>$data['cart_stock_id']
        ));
        
                        
        $cartArray = array();
        while ($row = $results->fetch()) {
            $cartArray[] = new CartCheck($row);
        }
        return $cartArray;
        
    }  
    
    public function insertIntoCart($data) {
        
        $sql = "INSERT INTO $this->name (user_session_id, cart_stock_id, cart_quantity) 
                VALUES (:user_session_id,:cart_stock_id, :cart_quantity) ";
        
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
            ':user_session_id' => $data['user_session_id'],
            ':cart_stock_id' => $data['cart_stock_id'],
            ':cart_quantity' => $data['cart_quantity']
          
        ));
        
        return $this->dbh->lastInsertID();
        
    }
    
  public function editCart($data) {
        
        $sql = "UPDATE $this->name SET cart_quantity = cart_quantity + :cart_quantity 
                WHERE id = :cart_id";
        
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
            ':cart_id' => $data['cart_id'],
            ':cart_quantity' => $data['cart_quantity']
          
        ));
        
        
    }  
    
    public function deleteFromCart($data) {
        
        $sql = "DELETE from $this->name WHERE id = :cart_id" ;
        
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
            ':cart_id' => $data['cart_id'],
         
        ));
    }
    
    public function clearTheCart($data) {
        
        $sql = "DELETE FROM $this->name WHERE user_session_id = :user_session_id";
        
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
            ':user_session_id' => $data['user_session_id'],
         
        ));
        
    }
    
    
}


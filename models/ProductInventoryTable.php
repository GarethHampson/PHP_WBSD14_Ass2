<?php

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/TableAbstract.php';

class ProductInventoryTable extends TableAbstract {

    protected $name = 'hampson_wbsd14_ass2_product_stock';
    protected $primaryKey = 'id';
    
    public function fetchAllInventory() {
        $results = $this->fetchAll();
        $inventoryArray = array();
        while ($row = $results->fetch()) {
            $inventoryArray[] = new Product($row);
        }
        return $inventoryArray;
    }

    
   
    
    public function fetchInventoryById($data) {
              
       $sql = "SELECT s.id, s.product_id, c.colour_name, siz.size_name, s.stock_level
               FROM hampson_wbsd14_ass2_product_stock AS s 
               INNER JOIN hampson_wbsd14_ass2_product_colour AS c ON c.id = s.colour_id 
                INNER JOIN hampson_wbsd14_ass2_product_sizes AS siz ON siz.size_id = s.size_id 
                WHERE s.product_id = :id";  
      
      $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                    ':id' => $data['id']
                ));
          
        $inventoryArray = array();
        while ($row = $results->fetch()) {
            $inventoryArray[] = new Product_Inventory($row);
        }
        return $inventoryArray;
         
     }

}
<?php

//require_once __DIR__ . '/Orders.php';
require_once __DIR__ . '/TableAbstract.php';

class OrdersTable extends TableAbstract {

    public function addOrder($data) {


        $sql = "INSERT INTO hampson_wbsd14_ass2_orders (customer_id, total_cost) 
                VALUES (:customer_id, :total_cost)";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':customer_id' => $data['customer_id'],
            ':total_cost' => $data['total_cost']
          ));

        return $this->dbh->lastInsertID();
    }

     public function addOrderDetails($data) {


        $sql = "INSERT INTO hampson_wbsd14_ass2_order_details (order_id, stock_id, price, quantity) 
                VALUES (:order_id, :stock_id, :price, :quantity)";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':order_id' => $data['order_id'],
            ':stock_id' => $data['stock_id'],
            ':price' => $data['price'],
            ':quantity' => $data['quantity'],
          ));

        return $this->dbh->lastInsertID();
    }
    
}

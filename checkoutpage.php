<?php

$view = new stdClass();

$view->pageTitle = 'Checkout Shopping Cart';
require_once('autoload.php');

session_start();
$custID = session_id();



if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
    if (!isset($_SESSION['custID'])) {
        header("Location: checkoutaddress.php");
    }
        if (isset($_COOKIE['SHOPPER'])) 
            {
            $shopper_id = $_COOKIE['SHOPPER'];
            //$shopper_id = 2356; //Just a temporary number
            session_id($shopper_id);
             }
            else
            {
                //need to redirect back to cart;
                
            }
    }
    else  // if POST
    {
        //session_start();
        $shopper_id = session_id();
    }
    

    //Displaying the order
    
    $data = array(
        'user_session_id' => $shopper_id,
    );

    $cart = new ShoppingCartTable();
    $view->cartList = $cart->getCartContents($data);
    
    //var_dump ($view->cartList);
    
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
//Inserting the Order
     //var_dump($_POST);
    $data['customer_id'] = $_SESSION['custID'];
    $data['total_cost'] = $_POST['total'];
    
    //var_dump($data);
    
    $order = new OrdersTable();
    $view->custRef = $order->addOrder($data);
    
    foreach ($view->cartList as $cartlist) :
        
        $cartconts = array (
            'order_id' => $view->custRef,
            'stock_id' => $cartlist->getCartStockID(),
            'price' => $cartlist->getPrice(),
            'quantity' => $cartlist->getCartQuantity()
       );
    
     $view->custOrder = $order->addOrderDetails($cartconts);
    
    endforeach;
    
    $data_id['customer_id'] = $_SESSION['custID'];
    
    $customer = new CustomersTable();
    $view->custDetails = $customer->getCustomer($data_id);
    
        
    $cartClear = new ShoppingCartTable();
    
    $shopper_clear['user_session_id'] = $_COOKIE['SHOPPER']; 
    
    
    $cartClear->clearTheCart($shopper_clear);
     
    header("Location: payment.php");
 }
    

    //var_dump($_POST);


    require_once 'Views/checkoutpage.phtml';
     
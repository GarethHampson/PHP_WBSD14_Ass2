<?php

$view = new stdClass();

$view->pageTitle = 'Checkout Shopping Cart';
require_once('autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if (isset($_COOKIE['SHOPPER'])) 
            {
            $shopper_id = $_COOKIE['SHOPPER'];
            //$shopper_id = 2356; //Just a temporary number
            session_id($shopper_id);
            session_start();
            }
            else
            {
                //need to redirect back to cart;
                
            }
    }
    else  // if POST
    {
        session_start();
        $shopper_id = session_id();
    }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $data = array(
            'registration_id' => NULL,
            'forename' => $_POST['forename'],
            'surname' => $_POST['surname'],
            'address_1' => $_POST['address1'],
            'address_2' => $_POST['address2'],
            'address_3' => $_POST['address3'],
            'address_4' => $_POST['address4'],
            'address_5' => $_POST['address5'],
            'postcode' => $_POST['postcode'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
    );
    
    if (isset($data)){
  
    $customer = new CustomersTable();
    $view->custID = $customer->addCustomer($data);
    
    if (Count($view->custID) > 0) {
                   session_start();
       $_SESSION['custID'] = $view->custID;
    }
    echo $_SESSION['custID'];
    
    //Assuming no errors hapened here
    header("Location: checkoutpage.php");
    exit();
}
else {
    echo "Please enter the required fields";
}

}
    
    
//    $data = array(
//        'user_session_id' => $shopper_id,
//    );
//
//    $cart = new ShoppingCartTable();
//    $view->cartList = $cart->getCartContents($data);
//
//    //var_dump($_POST);


    require_once 'Views/checkoutaddress.phtml';

    
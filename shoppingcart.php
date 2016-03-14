<?php

$view = new stdClass();

$view->pageTitle = 'Shopping Cart';
require_once('autoload.php');
$database = new ShoppingCartTable();

 if (isset($_POST['submit'])){
                                
                  
                            }  

if (isset($_COOKIE['SHOPPER'])) {
    $shopper_id = $_COOKIE['SHOPPER'];
} else {
    $length = 12;
    $shopper_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

setcookie('SHOPPER', $shopper_id, time() + (60 * 60 * 34 * 30));

//Adding something to the cart
if (isset($_GET['prodID'], $_GET['prodCol'], $_GET['prodSize'], $_GET['task']) && ($_GET['task'] === 'add')) {



    $dataStockID = array(
        'product_id' => $_GET['prodID'],
        'colour_id' => $_GET['prodCol'],
        'size_id' => $_GET['prodSize']
    );

    $cartDB = new ShoppingCartTable();
    $view->stockList = $cartDB->getTheStockID($dataStockID);

    //var_dump($view->stockList);

    foreach ($view->stockList AS $stockID) : {
            ($stockID->getStockID());
        }
    endforeach;



    $dataCheck = array(
        'user_session_id' => $shopper_id,
        'cart_stock_id' => htmlentities($stockID->getStockID()),
    );

    $view->cartCheck = $cartDB->checkProductExists($dataCheck);
    
    

    if (count($view->cartCheck) > 0) {
        //var_dump($view->cartCheck);
        
        foreach ($view->cartCheck AS $cartID) : {
            ($cartID->getCartID());
        }
        endforeach;
        
        echo htmlentities($cartID->getCartID());
        
        $data = array(
            'cart_id' => htmlentities($cartID->getCartID()),
            'cart_quantity' => 1
        );
        
        $cartDB->editCart($data);
          
    } 
    
    else {
        
        $data = array(
            'user_session_id' => $shopper_id,
            'cart_stock_id' => htmlentities($stockID->getStockID()),
            'cart_quantity' => 1
        );
        $view->cartList = $cartDB->insertIntoCart($data);
    }

}

//Deleting something from the cart
elseif (isset($_GET['cart_id'], $_GET['task']) && ($_GET['task'] === 'delete')) {
    
    $cartDB = new ShoppingCartTable();
    echo "Delete me";
    
    $data = array(
        'cart_id' => $_GET['cart_id']
    );
    
    $cartDB->deleteFromCart($data);
    
    
}

//Updating any quantity changes
elseif (isset($_POST['quantity'])) {
    //If quantity changed, update the cart
    echo "Update the quantity";
}

$data = array(
    'user_session_id' => $shopper_id,
);

$cart = new ShoppingCartTable();
$view->cartList = $cart->getCartContents($data);





require_once 'Views/shoppingcart.phtml';

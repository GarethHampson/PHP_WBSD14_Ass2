<?php

$view = new stdClass();

$view->pageTitle = 'Admin SuperUser';
require_once('autoload.php');

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //var_dump($_POST);
    $data['username'] = $_POST['adminUsername'];
    $enteredpassword =  $_POST['adminPassword'];
    
    echo "Entered Password = " . $enteredpassword;
    
    
    $database = new AdminTable();
    $view->admin = $database->checkAdmin($data); 
    
    //var_dump($view->admin);
    
    foreach ($view->admin AS $adminPwd) : {
            ($adminPwd->getAdminPassword());
        }
    endforeach;
    
    $hash = ($adminPwd->getAdminPassword());
      
    if (password_verify($enteredpassword, $hash)){
    
        $_SESSION['admin_id'] = $_POST['adminUsername'];
        
        header("Location: admin_productlist.php");
        exit();
    }
    else {
        echo "The Username and Password are not recognised";
    }
    
    
    
    
    
}

require_once 'Views/admin_login.phtml';
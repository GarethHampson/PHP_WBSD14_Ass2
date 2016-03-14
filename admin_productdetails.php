<?php

session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$view = new stdClass();

$view->pageTitle = 'Admin - Product Details';
require_once('autoload.php');


if (isset($_GET['prodID'])) {
    
    $product_id = $_GET['prodID'];
    $database = new ProductsTable();
    $inventory = new ProductInventoryTable();
    
    $data['id'] = $product_id;
    $view->productsList = $database->fetchProductById($data);
    $view->inventoryList = $inventory->fetchInventoryById($data);

    }
    else {
        header("Location: admin_productlist.php");
    }
    
  if ($_SERVER['REQUEST_METHOD'] ==='POST') {
       if (isset($_POST['submit'])) {
         //var_dump ($_POST);
         
         $data = ['prod_id' => $_GET['prodID'],
            'cat_id' => $_POST['catID'],
            'name' => $_POST['prodName'],
            'price' => $_POST['prodPrice'],
            'introduction' => $_POST['prodIntro'],
            'description' => $_POST['prodDesc']
          
            ];
         $database->editProduct($data);
       } 
       
      if (isset($_POST['delete'])) {
         
          $data['id'] = $product_id;
         //var_dump ($data['id']);
         $database->deleteProduct($data);
         header ("Location: admin_productlist.php");
       }  
       
   }
    
$categories = new CategoryTable();
$view->categoryList = $categories->fetchAllCategories();

require_once 'Views/admin_productdetails.phtml';

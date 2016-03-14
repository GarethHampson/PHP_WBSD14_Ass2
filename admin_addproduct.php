<?php

session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$view = new stdClass();

$view->pageTitle = 'Admin - Add New Product';
require_once('autoload.php');

$categories = new CategoryTable();
$view->categoryList = $categories->fetchAllCategories();

$database = new ProductsTable();
 
     //var_dump ($_POST);  
  

       
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if (isset($_POST['submit'])) {
         var_dump ($_POST);
         
         $data = ['cat_id' => $_POST['catID'],
            'name' => $_POST['prodName'],
            'price' => $_POST['prodPrice'],
             'brand_id' => $_POST['brandID'],
            'introduction' => $_POST['prodIntro'],
            'description' => $_POST['prodDesc']
          
            ];
         
         $view->newProductID = $database->addProduct($data);
         
         //Add a temp image
         
         var_dump($view->newProductID);
         
         $dataimage = ['product_id' => $view->newProductID,
            'image_url' => "images/products/generic.jpeg",
            'image_order' => "1",
    
            ];
         
         $database->insertProductImages($dataimage);
         
         
          header("Location: admin_productdetails.php?prodID=" . $view->newProductID);
         //then redirection to admin_productdetails.php?prodID=$view->newProductID to add photos etc. 
       }     
  }
    


require_once 'Views/admin_addproduct.phtml';

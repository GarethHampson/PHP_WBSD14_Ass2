<?php

$view = new stdClass();

$view->pageTitle = 'Product Category';
require_once('autoload.php');

if (isset($_GET['cat_id']))
{
    $data['cat_id'] = $_GET['cat_id'];
    
    $database_cat = new CategoryTable();
    $view->categoryDesc = $database_cat->fetchCategorybyId($data); 
    
    $database = new ProductsTable();
    $view->productsList = $database->fetchProductByCategory($data);
    
    
}


 require_once 'Views/category.phtml'; 

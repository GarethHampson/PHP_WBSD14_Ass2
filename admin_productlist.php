<?php

$view = new stdClass();

$view->pageTitle = 'Admin - Product List';
require_once('autoload.php');

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['admin_logout'])) {
        unset($_SESSION['admin_id']);
        header("Location: admin_login.php");
  }

$categories = new CategoryTable();
$view->categoryList = $categories->fetchAllCategories();


$database = new ProductsTable();
$view->productsList = $database->fetchBasicProductData();

$numberrows = Count($view->productsList);
//echo $numberrows;


if (isset($_GET['catID'])) {

    $data = array(
        'cat_id' => $_GET['catID']
    );

    $view->productsList = $database->fetchProductByCategory($data);
}

//var_dump($_POST);







require_once 'Views/admin_productlist.phtml';

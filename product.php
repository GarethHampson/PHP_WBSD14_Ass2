<?php
$view = new stdClass();

$view->pageTitle = 'Product Description';
require_once('autoload.php');

if (isset($_GET['id'])) {
    $data['id'] = $_GET['id'];
    $database = new ProductsTable();
    $view->productsList = $database->fetchProductById($data);
    $view->productImages = $database->fetchProductImages($data);
    $view->productColour = $database->fetchProductColours($data);
    $view->productSize = $database->fetchProductSizes($data);



}




require_once 'Views/product.phtml'; 

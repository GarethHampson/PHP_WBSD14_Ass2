<?php

$view = new stdClass();

$view->pageTitle = 'Browse Product List';
require_once('autoload.php');


$database = new ProductsTable();
$view->productsList = $database->fetchBasicProductData();

$numberrows = Count($view->productsList);
//echo $numberrows;

$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numberrows / $rowsperpage);

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

$data = array(
    'offset' => $offset,
    'limit' => $rowsperpage
);



//$database = new ProductsTable();
//$view->productsList = $database->fetchBasicProductData();







require_once 'Views/browse.phtml';

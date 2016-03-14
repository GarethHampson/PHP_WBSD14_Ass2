<?php

$view = new stdClass();

$view->pageTitle = 'Home Page';
require_once('autoload.php');


//require ('common_for_all_controllers.php');

$database_cat = new CategoryTable();
$view->categoryDesc = $database_cat->fetchAllCategories();

 require_once 'Views/index.phtml'; 

 
 /*
  * common_for_all_controllers.php
  * read all categories
  * store them in $view->categories
  * 
  * 
  */
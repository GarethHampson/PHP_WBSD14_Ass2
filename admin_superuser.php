<?php

$view = new stdClass();

$view->pageTitle = 'Admin SuperUser';
require_once('autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
  
    $data['username'] = $_POST['newUsername'];
    $data['password'] =  $_POST['newAdminPassword'];
    $data['forename'] =  $_POST['newAdminForename'];
    $data['surname'] =  $_POST['newAdminSurname'];
    
    $database = new AdminTable();
    $view->admin = $database->addAdmin($data); 
    
}


require_once 'Views/admin_superuser.phtml';


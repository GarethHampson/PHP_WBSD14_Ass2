<?php

session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$view = new stdClass();

$view->pageTitle = 'Admin - Product Images';
require_once('autoload.php');

if (isset($_GET['prodID'])) {


    $product_id = $_GET['prodID'];
    $database = new ProductsTable();

    $data['id'] = $product_id;
    $view->productsList = $database->fetchProductById($data);
    $view->productImages = $database->fetchProductImages($data);

    if (isset($_POST['submit'])) {

        $numberimages = Count($view->productImages) + 1;
        $imagepath = "images/products/";
        echo $imagepath;

        $fileupload = new FileUpload($_FILES['photo']);
        if ($fileupload->upload()) {
            $data = array(
                'product_id' => $product_id,
                'image_url' => $imagepath . $fileupload->getFileName(),
                'image_order' => $numberimages
            );
            $database->insertProductImages($data);
            header('Refresh: 0; url=admin_productimages.php?prodID=' . $product_id);
            
        } else {
            echo "File upload failed";
        }
    }
    if (isset($_POST['delete'])) {
        $data = array(
                'image_id' => $_POST['image_id']
            );
            $database->deleteProductImages($data);
        header('Refresh: 0; url=admin_productimages.php?prodID=' . $product_id);
    }
    
}
else {
        header("Location: admin_productlist.php");
    }

require_once 'Views/admin_productimages.phtml';

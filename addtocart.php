<?php

session_start();

//Get the product information
$stock_id = isset($_GET['stock_id'])? $_GET['stock_id']: "";
$quantity = isset($_GET['quantity'])? $_GET['quantity']: "";



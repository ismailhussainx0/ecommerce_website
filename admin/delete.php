<?php
// SECURITY CHECK 
include "auth_check.php";

include "../config.php";

// product id
$deleteId = $_GET["deleteId"];

// select deleted data
$sql = "SELECT * FROM products WHERE product_id = ?";
$statment = mysqli_prepare($connect, $sql);
$statment->bind_param("i", $deleteId);
$statment->execute();
$result = $statment->get_result();

$row = mysqli_fetch_assoc($result);


// delete deleted row image file from uploads folder
if(!empty($row["product_image"]) && file_exists("../uploads/" . $row["product_image"])){
    unlink("../uploads/" . $row["product_image"]);
}

// row delete code 
$deleteSql = "DELETE FROM products WHERE product_id = ?";
$deleteStatment = mysqli_prepare($connect, $deleteSql);
$deleteStatment->bind_param("i", $deleteId);
$deleteResult = $deleteStatment->execute();

if($deleteResult){
    header("Location: products.php");
    exit;
}










?>
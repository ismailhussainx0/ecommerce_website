<?php

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


// delete deleted row file
if(!empty($row["product_image"]) && file_exists("../uploads/" . $row["product_image"])){
    unlink("../uploads/" . $row["product_image"]);
}










?>
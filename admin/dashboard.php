<?php

include "auth_check.php";
include "../config.php";

// ROW COUNT
$countQuery = "SELECT COUNT(*) AS total_users FROM users"; 
$countResult = mysqli_query($connect, $countQuery); 
$countRow = mysqli_fetch_assoc($countResult);

echo "Hello " . $_SESSION["userName"];
echo "<br><br>";
echo "Total Users: " . $countRow["total_users"];

// PRDOUCT COUNT
$productCount = "SELECT COUNT(*) AS total_products FROM products";
$productResult = mysqli_query($connect, $productCount);
$productRow = mysqli_fetch_assoc($productResult);

echo "<br><br>";
echo "Total Products: " . $productRow["total_products"];
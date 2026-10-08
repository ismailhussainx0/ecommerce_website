<?php
include "../config.php";

if(isset($_GET["product_id"])){
   $productId = $_GET["product_id"];

   $sql = "SELECT * FROM products WHERE product_id = ?";
   $statement = mysqli_prepare($connect, $sql);
   $statement->bind_param("i", $productId);
   $statement->execute();
   
   $result = $statement->get_result();

   $row = mysqli_fetch_assoc($result);
}

?>









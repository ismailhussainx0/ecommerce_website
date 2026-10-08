<?php
session_start();
include "auth_check.php";  


if(isset($_SESSION["userId"]) && $_SESSION["role"] === "user"){
    
    echo "Hello " . $_SESSION["userName"];
}else{
    header("Location: login.php");
    exit;
}

?>
<br>
<a href="logout.php">logout</a>
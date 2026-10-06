<?php

if(!(isset($_SESSION["userId"]) && $_SESSION["role"] === "admin")){
    header("Location: ../user/login.php");
    exit;
}








?>
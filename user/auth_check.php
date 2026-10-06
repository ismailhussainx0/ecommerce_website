<?php
session_start();

if(!(isset($_SESSION["userId"]) && $_SESSION["role"] === "user")){
    header("Location: login.php");
    exit;
}




?>
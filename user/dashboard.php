<?php

session_start();

if(isset($_SESSION["userId"])){
    
    echo "Hello " . $_SESSION["userName"];
}else{
    header("Location: login.php");
    exit;
}

?>
<br>
<a href="logout.php">logout</a>
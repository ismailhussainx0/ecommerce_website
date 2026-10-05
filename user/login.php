<form action="" method="post">

    <input type="email" name="email" placeholder="Enter your email">

    <input type="password" name="password" placeholder="Enter your password">

    <button type="submit">Login</button>

</form>



<?php
session_start();
include "../config.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["email"], $_POST["password"])){
        $loginEmail = $_POST["email"];
        $loginPassword = $_POST["password"];

        $selectRowQuery = "SELECT * FROM users WHERE email = ?"; 
        $selectStatement = mysqli_prepare($connect, $selectRowQuery);
        $selectStatement->bind_param("s", $loginEmail);
        $selectStatement->execute();

        $result = $selectStatement->get_result();
        
        if($result->num_rows > 0){
            
            $row = mysqli_fetch_assoc($result);
            $storedHash = $row["password"];

            if(password_verify($loginPassword, $storedHash)){

                $_SESSION["userId"] = $row["user_id"];
                $_SESSION["userName"] = $row["name"];
                $_SESSION["role"] = $row["role"];


                if($row["role"] === "admin"){
                    header("Location: ../admin/dashboard.php");
                    exit;
                }else{
                    header("Location: dashboard.php");
                }

            }else{
                echo "Wrong Password!";
            }


        }else{
            echo "Enter Correct Email";
        }





    }






}
    









?>
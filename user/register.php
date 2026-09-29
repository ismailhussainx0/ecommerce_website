<form action="" method="post">

    <input type="text" name="name" placeholder="Enter your name">

    <input type="email" name="email" placeholder="Enter your email">

    <input type="password" name="password" placeholder="Enter your password">

    <button type="submit">Register</button>

</form>


<?php
include "../config.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["name"], $_POST["email"], $_POST["password"])){

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        // Variables check empty or not 
        if(!empty($name) && !empty($email) && !empty($password)){

            // email validate 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                // password hashing 
                $hash_password = password_hash($password, PASSWORD_DEFAULT);

                $insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                $insertStatment = mysqli_prepare($connect, $insertQuery);
                $insertStatment->bind_param("sss", $name, $email, $hash_password);
                $insertResult = $insertStatment->execute();

                if($insertResult){
                    header("Location: register.php");
                    exit;
                }else{
                    echo "data not added";
                }
                


            }else{
                echo "Enter Valid Email";
            }





        }else{
            echo "Enter all the fields";
        }



    }





}






?>
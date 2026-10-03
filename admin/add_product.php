<form action="" method="post" enctype="multipart/form-data">

    <input type="text" name="product_name" placeholder="Product Name">

    <input type="number" name="product_price" placeholder="Product Price">

    <textarea name="product_description" placeholder="Product Description"></textarea>

    <input type="file" name="product_image">

    <button type="submit" name="add_product">Add Product</button>

</form>


<?php
include "../config.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

if(isset($_POST["add_product"])){

    if(isset($_POST["product_name"], $_POST["product_price"], $_POST["product_description"]) 
    && isset($_FILES["product_image"])){
        
        $productName = $_POST["product_name"];
        $productPrice = $_POST["product_price"];
        $productDescription = $_POST["product_description"];

        // file name
        $productFileName = $_FILES["product_image"]["name"];

        // file move into upload folder
        move_uploaded_file($_FILES["product_image"]["tmp_name"], "../uploads/" . $productFileName);

        $sql = "INSERT INTO products (product_name, product_price, product_description, product_image) VALUES (?, ? , ? ,?)";
        $statement = mysqli_prepare($connect, $sql);
        $statement->bind_param("siss", $productName, $productPrice, $productDescription, $productFileName);
        $result = $statement->execute();

        if($result){
            echo "data added successfully";
        }else{
            echo "data not added ";
        }

    }else{
        echo "Incorrect key name";
    }

    
    
    }
}    


?>
<?php
include "../config.php";

$productId = $_GET["id"];

$selectProduct = "SELECT * FROM products WHERE product_id = ?";
$Statement = mysqli_prepare($connect, $selectProduct);
$Statement->bind_param("i", $productId);
$Statement->execute();

$result = $Statement->get_result();
$row = mysqli_fetch_assoc($result);



// MOVE UPDATE INFORMATION IN DATABASE
if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["update_product"])){
        $productName = $_POST["product_name"];
        $productPrice = $_POST["product_price"];
        $productDesc = $_POST["product_description"];

        // IMAGE FILE
        $imgName = $_FILES["product_image"]["name"];
        $imgTmplocation = $_FILES["product_image"]["tmp_name"];

        move_uploaded_file($imgTmplocation, "../uploads/" . $imgName);

        $updateQuery = "UPDATE products SET product_name = ?, product_price = ?, product_description  = ?, product_image = ? 
        WHERE product_id = ?";

        $update_Statement = mysqli_prepare($connect, $updateQuery);
        $update_Statement->bind_param("sissi", $productName, $productPrice, $productDesc, $imgName, $productId);
        $result = $update_Statement->execute();

        if($result){
            header("Location: edit_product.php?id=" . $productId);
            exit;
        }


    }




}



?>

<form action="" method="post" enctype="multipart/form-data">

    <input type="text" name="product_name" value="<?php echo $row["product_name"] ?>" placeholder="Product Name">

    <input type="number" name="product_price" value="<?php echo $row["product_price"] ?>" placeholder="Product Price">

    <textarea name="product_description" placeholder="Product Description"><?php echo $row["product_description"] ?></textarea>
    
    <input type="file" name="product_image">
    
    <img src="../uploads/<?php echo $row["product_image"]; ?>" alt="<?php echo $row["product_name"];  ?>" height="100">

    <button type="submit" name="update_product">Update Product</button>

</form>
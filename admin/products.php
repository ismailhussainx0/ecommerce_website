<?php
// SECURITY CHECK 
include "auth_check.php";

// DATABASE CONNECTION
include "../config.php";

$selectQuery = "SELECT * FROM products";
$result = mysqli_query($connect, $selectQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="../uploads/<?php echo $row["product_image"] ?>" alt="<?php echo $row["product_name"] ?>">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["product_name"] ?></h5>
    <p class="card-text"><?php echo $row["product_description"] ?></p>
    <p class="card-text"><?php echo "Rs " . $row["product_price"] ?></p>
    <a href="edit_product.php?id=<?php echo $row["product_id"] ?>" class="btn btn-primary">Edit</a>
    <a href="delete.php?deleteId=<?php echo $row["product_id"] ?>" class="btn btn-primary" >Delete</a>
  </div>
</div>



<?php
}
?>





</body>
</html>





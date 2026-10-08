<?php
include "../config.php";

// PRODUCTS SHOW ON PAGE
$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);


// SEARCH FUNCTIONALITY
if(isset($_GET["search"])){
  $search = $_GET["search"];
  
  $searchQuery = "SELECT * FROM products WHERE product_name LIKE ?";
  $statment = mysqli_prepare($connect, $searchQuery);
  $searchTerm = "%" . $search . "%";
  $statment->bind_param("s", $searchTerm);
  $statment->execute();

  $result = $statment->get_result();

  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- my css -->
     <link rel="stylesheet" href="../CSS/style.css">

</head>
<body>
  
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a href="#" class="navbar-brand">My Store</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">

    <ul class="navbar-nav ms-auto">

      <li class="nav-item">
        <a href="" class="nav-link">Home</a>
      </li>

      <li class="nav-item">
        <a href="product.php" class="nav-link">Products</a>
      </li>

      <li class="nav-item">
        <a href="login.php" class="nav-link">Login</a>
      </li>
      
      <li class="nav-item">
        <a href="register.php" class="nav-link">Register</a>
      </li>

    </ul>


    </div>


  </div>

</nav>



<!-- product container -->
  <div class="container">

    <div class="text-center products-heading">
    <h1>Our Products</h1>
    <p>Explore our latest products</p>
    </div>


    <!-- SEARCH BAR -->

    <form action="" method="GET">

      <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-8 col-lg-6">

          <input
          type="text"
          name="search"
          class="form-control"
          placeholder="Search products...">

          <button type="submit" class="btn btn-primary mt-2">
            Search
          </button>

        </div>
      </div>
    </form>


    <div class="row">

<?php
while($row = mysqli_fetch_assoc($result)){
?>


<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card product-card h-100">

        <img
            class="card-img-top product-image"
            src="../uploads/<?php echo $row["product_image"]; ?>"
            alt="<?php echo $row["product_name"]; ?>"
        >

        <div class="card-body">

            <h5 class="card-title">
                <?php echo $row["product_name"]; ?>
            </h5>

            <p class="card-text">
                <?php echo $row["product_description"]; ?>
            </p>

            <p class="fw-bold fs-5">
                Rs <?php echo $row["product_price"]; ?>
            </p>

            <a href="product_details.php?product_id=<?php echo $row["product_id"]; ?>" class="btn btn-primary mt-auto">
                View Product
            </a>

        </div>
    </div>
</div>  
  
  <?php
}
?>

</div>

</div>

<!-- bootstrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




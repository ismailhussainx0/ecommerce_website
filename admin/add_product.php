<?php
// SECURITY CHECK 
include "auth_check.php";

include "../config.php";

$message = "";
$messageType = "";

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
            $message = "data added successfully";
            $messageType = "ok";
        }else{
            $message = "data not added ";
            $messageType = "err";
        }

    }else{
        $message = "Incorrect key name";
        $messageType = "err";
    }

    }
}    

$pageTitle = "Add product";
$adminActive = "add";
include "../partials/admin_header.php";
?>

<div class="page-head row align-items-center g-3 mb-4">
  <div class="col">
    <h1 class="mb-1">Add product</h1>
    <p class="text-secondary mb-0">Create a new item for your store.</p>
  </div>
  <div class="col-12 col-sm-auto">
    <a href="products.php" class="btn btn-outline-dark w-100"><i class="bi bi-arrow-left me-1"></i> All products</a>
  </div>
</div>

<div class="row g-4">

  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body p-4">

        <?php if ($message !== "") { ?>
          <div class="alert <?php echo $messageType === "ok" ? "alert-success" : "alert-danger"; ?> d-flex align-items-center gap-2" role="alert">
            <i class="bi <?php echo $messageType === "ok" ? "bi-check-circle-fill" : "bi-exclamation-circle-fill"; ?>"></i>
            <div><?php echo htmlspecialchars($message); ?></div>
          </div>
        <?php } ?>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="row g-3">

            <div class="col-md-7">
              <label for="pn" class="form-label">Product name</label>
              <input type="text" class="form-control" id="pn" name="product_name" placeholder="Product Name">
            </div>

            <div class="col-md-5">
              <label for="pp" class="form-label">Price</label>
              <div class="input-group">
                <span class="input-group-text">Rs</span>
                <input type="number" class="form-control" id="pp" name="product_price" placeholder="Product Price">
              </div>
            </div>

            <div class="col-12">
              <label for="pd" class="form-label">Description</label>
              <textarea class="form-control" id="pd" name="product_description" rows="5" placeholder="Product Description"></textarea>
            </div>

            <div class="col-12">
              <label for="pi" class="form-label">Product image</label>
              <input type="file" class="form-control" id="pi" name="product_image">
            </div>

            <div class="col-12 pt-2">
              <button type="submit" name="add_product" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-1"></i> Add Product</button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="h6 mb-3"><i class="bi bi-lightbulb-fill text-warning me-1"></i> Tips</h2>
        <ul class="text-secondary small ps-3 mb-0">
          <li class="mb-2">Use a short, clear product name.</li>
          <li class="mb-2">Square images with a plain background look best.</li>
          <li>Keep the description to the key details.</li>
        </ul>
      </div>
    </div>
  </div>

</div>

<?php include "../partials/admin_footer.php"; ?>

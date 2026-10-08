<?php
// SECURITY CHECK 
include "auth_check.php";

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

        // IMAGE FILE UPLOADED CHECK
        if($_FILES["product_image"]["error"] === UPLOAD_ERR_OK){
            $imgName = $_FILES["product_image"]["name"];
            $imgTmplocation = $_FILES["product_image"]["tmp_name"];

            move_uploaded_file($imgTmplocation, "../uploads/" . $imgName);

            // delete old image
            unlink("../uploads/" . $row["product_image"]);
        }else{
            $imgName = $row["product_image"];
        }


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

$pageTitle = "Edit product";
$adminActive = "products";
include "../partials/admin_header.php";
?>

<div class="page-head row align-items-center g-3 mb-4">
  <div class="col">
    <h1 class="mb-1">Edit product</h1>
    <p class="text-secondary mb-0">Update the details of this product.</p>
  </div>
  <div class="col-12 col-sm-auto">
    <a href="products.php" class="btn btn-outline-dark w-100"><i class="bi bi-arrow-left me-1"></i> All products</a>
  </div>
</div>

<form action="" method="post" enctype="multipart/form-data">
  <div class="row g-4">

    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <div class="row g-3">

            <div class="col-md-7">
              <label for="pn" class="form-label">Product name</label>
              <input type="text" class="form-control" id="pn" name="product_name" value="<?php echo htmlspecialchars($row["product_name"]); ?>" placeholder="Product Name">
            </div>

            <div class="col-md-5">
              <label for="pp" class="form-label">Price</label>
              <div class="input-group">
                <span class="input-group-text">Rs</span>
                <input type="number" class="form-control" id="pp" name="product_price" value="<?php echo htmlspecialchars($row["product_price"]); ?>" placeholder="Product Price">
              </div>
            </div>

            <div class="col-12">
              <label for="pd" class="form-label">Description</label>
              <textarea class="form-control" id="pd" name="product_description" rows="6" placeholder="Product Description"><?php echo htmlspecialchars($row["product_description"]); ?></textarea>
            </div>

            <div class="col-12 pt-2">
              <button type="submit" name="update_product" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Update Product</button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <label for="pi" class="form-label">Product image</label>

          <div class="preview-box ratio ratio-1x1 mb-3">
            <img src="../uploads/<?php echo htmlspecialchars($row["product_image"]); ?>" alt="<?php echo htmlspecialchars($row["product_name"]); ?>">
          </div>

          <input type="file" class="form-control" id="pi" name="product_image">
          <div class="form-text">Upload a new file only if you want to replace the current image.</div>
        </div>
      </div>
    </div>

  </div>
</form>

<?php include "../partials/admin_footer.php"; ?>

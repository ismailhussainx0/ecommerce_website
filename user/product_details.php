<?php
include "../config.php";

if(isset($_GET["product_id"])){
   $productId = $_GET["product_id"];

   $sql = "SELECT * FROM products WHERE product_id = ?";
   $statement = mysqli_prepare($connect, $sql);
   $statement->bind_param("i", $productId);
   $statement->execute();
   
   $result = $statement->get_result();

   $row = mysqli_fetch_assoc($result);
}

// ---- frontend helper (display only) ----
$row = $row ?? null;

$pageTitle = $row ? $row["product_name"] : "Product not found";
$navActive = "products";
include "../partials/user_header.php";
?>

<div class="container py-4 py-lg-5">

<?php if (!$row) { ?>

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="empty-state text-center py-5 px-3 mt-4">
        <div class="icon mb-3"><i class="bi bi-emoji-frown"></i></div>
        <h3 class="h4">Product not found</h3>
        <p class="text-secondary mb-4">This product may have been removed or the link is incorrect.</p>
        <a href="product.php" class="btn btn-primary">Back to products</a>
      </div>
    </div>
  </div>

<?php } else { ?>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="product.php">Products</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($row["product_name"]); ?></li>
    </ol>
  </nav>

  <div class="row g-4 g-lg-5 align-items-start">

    <div class="col-lg-6">
      <div class="detail-media ratio ratio-1x1">
        <img src="../uploads/<?php echo htmlspecialchars($row["product_image"]); ?>" alt="<?php echo htmlspecialchars($row["product_name"]); ?>">
      </div>
    </div>

    <div class="col-lg-6">
      <span class="soft-badge d-inline-block mb-3"><i class="bi bi-patch-check-fill me-1"></i> In stock</span>
      <h1 class="detail-title mb-3"><?php echo htmlspecialchars($row["product_name"]); ?></h1>
      <div class="detail-price mb-4"><small>Rs</small><?php echo htmlspecialchars($row["product_price"]); ?></div>

      <hr class="my-4">
      <p class="detail-desc mb-4"><?php echo htmlspecialchars($row["product_description"]); ?></p>
      <hr class="mb-4">

      <div class="row g-2">
        <div class="col-sm-8">
          <button type="button" class="btn btn-primary btn-lg w-100" id="addCartBtn"><i class="bi bi-bag-plus-fill me-1"></i> Add to cart</button>
        </div>
        <div class="col-sm-4">
          <a href="product.php" class="btn btn-outline-dark btn-lg w-100"><i class="bi bi-arrow-left me-1"></i> Back</a>
        </div>
      </div>
    </div>

  </div>

<?php } ?>

</div>

<!-- Bootstrap toast -->
<div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-3">
  <div id="cartToast" class="toast align-items-center text-bg-dark border-0" role="status" aria-live="polite" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body"><i class="bi bi-info-circle me-2"></i>Cart is not connected yet</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
  // frontend-only demo: cart backend isn't built yet
  var cartBtn = document.getElementById("addCartBtn");
  if (cartBtn) {
    cartBtn.addEventListener("click", function () {
      bootstrap.Toast.getOrCreateInstance(document.getElementById("cartToast"), { delay: 2200 }).show();
    });
  }
</script>

<?php include "../partials/user_footer.php"; ?>

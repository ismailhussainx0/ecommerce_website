<?php

include "auth_check.php";
include "../config.php";

// ROW COUNT
$countQuery = "SELECT COUNT(*) AS total_users FROM users"; 
$countResult = mysqli_query($connect, $countQuery); 
$countRow = mysqli_fetch_assoc($countResult);

// PRDOUCT COUNT
$productCount = "SELECT COUNT(*) AS total_products FROM products";
$productResult = mysqli_query($connect, $productCount);
$productRow = mysqli_fetch_assoc($productResult);

$pageTitle = "Dashboard";
$adminActive = "dashboard";
include "../partials/admin_header.php";
?>

<div class="page-head row align-items-center g-3 mb-4">
  <div class="col">
    <h1 class="mb-1">Hello, <?php echo htmlspecialchars($_SESSION["userName"]); ?> 👋</h1>
    <p class="text-secondary mb-0">Here's a quick look at your store.</p>
  </div>
  <div class="col-12 col-sm-auto">
    <a href="add_product.php" class="btn btn-primary w-100"><i class="bi bi-plus-lg me-1"></i> Add product</a>
  </div>
</div>

<!-- stats -->
<div class="row g-4 mb-4">

  <div class="col-12 col-sm-6 col-xl-4">
    <div class="card stat-card shadow-sm h-100">
      <div class="card-body p-4 d-flex align-items-center gap-3">
        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
        <div>
          <div class="text-secondary small fw-semibold mb-1">Total Users</div>
          <div class="stat-value"><?php echo $countRow["total_users"]; ?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-4">
    <div class="card stat-card shadow-sm h-100">
      <div class="card-body p-4 d-flex align-items-center gap-3">
        <div class="stat-icon sky"><i class="bi bi-box-seam-fill"></i></div>
        <div>
          <div class="text-secondary small fw-semibold mb-1">Total Products</div>
          <div class="stat-value"><?php echo $productRow["total_products"]; ?></div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- quick actions -->
<h2 class="h5 mb-3">Quick actions</h2>
<div class="row g-3">

  <div class="col-12 col-md-6 col-xl-4">
    <a href="add_product.php" class="quick-link d-flex align-items-center gap-3 p-3 h-100">
      <span class="qi"><i class="bi bi-plus-circle"></i></span>
      <span><b class="d-block">Add product</b><small class="text-secondary">Create a new item</small></span>
    </a>
  </div>

  <div class="col-12 col-md-6 col-xl-4">
    <a href="products.php" class="quick-link d-flex align-items-center gap-3 p-3 h-100">
      <span class="qi"><i class="bi bi-pencil-square"></i></span>
      <span><b class="d-block">Manage products</b><small class="text-secondary">Edit or delete items</small></span>
    </a>
  </div>

  <div class="col-12 col-md-6 col-xl-4">
    <a href="../user/product.php" class="quick-link d-flex align-items-center gap-3 p-3 h-100">
      <span class="qi"><i class="bi bi-shop"></i></span>
      <span><b class="d-block">View store</b><small class="text-secondary">See what customers see</small></span>
    </a>
  </div>

</div>

<?php include "../partials/admin_footer.php"; ?>

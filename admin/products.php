<?php
// SECURITY CHECK 
include "auth_check.php";

// DATABASE CONNECTION
include "../config.php";

$selectQuery = "SELECT * FROM products";
$result = mysqli_query($connect, $selectQuery);

$pageTitle = "Products";
$adminActive = "products";
include "../partials/admin_header.php";
?>

<div class="page-head row align-items-center g-3 mb-4">
  <div class="col">
    <h1 class="mb-1">Products</h1>
    <p class="text-secondary mb-0"><?php echo $result->num_rows; ?> total in your catalog</p>
  </div>
  <div class="col-12 col-sm-auto">
    <a href="add_product.php" class="btn btn-primary w-100"><i class="bi bi-plus-lg me-1"></i> Add product</a>
  </div>
</div>

<div class="card shadow-sm overflow-hidden">

  <?php if ($result->num_rows === 0) { ?>

    <div class="empty-state text-center py-5 px-3">
      <div class="icon mb-3"><i class="bi bi-box-seam"></i></div>
      <h3 class="h5">No products yet</h3>
      <p class="text-secondary mb-4">Add your first product to get started.</p>
      <a href="add_product.php" class="btn btn-primary">Add product</a>
    </div>

  <?php } else { ?>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>

<?php
while($row = mysqli_fetch_assoc($result)){
?>
        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <img class="thumb flex-shrink-0" src="../uploads/<?php echo htmlspecialchars($row["product_image"]); ?>" alt="<?php echo htmlspecialchars($row["product_name"]); ?>">
              <div>
                <div class="fw-bold"><?php echo htmlspecialchars($row["product_name"]); ?></div>
                <div class="desc-clip"><?php echo htmlspecialchars($row["product_description"]); ?></div>
              </div>
            </div>
          </td>
          <td><span class="price-pill">Rs <?php echo htmlspecialchars($row["product_price"]); ?></span></td>
          <td class="text-end text-nowrap">
            <a href="edit_product.php?id=<?php echo $row["product_id"]; ?>" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="delete.php?deleteId=<?php echo $row["product_id"]; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this product?');"><i class="bi bi-trash3 me-1"></i> Delete</a>
          </td>
        </tr>
<?php
}
?>

      </tbody>
    </table>
  </div>

  <?php } ?>

</div>

<?php include "../partials/admin_footer.php"; ?>

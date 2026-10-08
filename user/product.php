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

// ---- frontend helpers (display only) ----
$searchValue = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$totalFound  = $result ? $result->num_rows : 0;

$pageTitle = "Products";
$navActive = "products";
include "../partials/user_header.php";
?>

<!-- hero + search -->
<section class="hero py-5">
  <div class="container py-lg-4">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">
        <span class="eyebrow mb-3"><i class="bi bi-stars"></i> New arrivals</span>
        <h1 class="hero-title mt-3 mb-3">Find something you'll <span>love.</span></h1>
        <p class="hero-sub mb-4">Explore our latest products, carefully picked and ready to ship.</p>
      </div>

      <div class="col-md-10 col-lg-7">
        <!-- SEARCH BAR -->
        <form action="" method="GET">
          <div class="input-group input-group-lg search-box">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?php echo htmlspecialchars($searchValue); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- product container -->
<div class="container py-5">

  <div class="row align-items-end g-3 mb-4">
    <div class="col">
      <h2 class="h3 mb-1"><?php echo $searchValue !== "" ? "Search results" : "Our Products"; ?></h2>
      <span class="text-secondary small"><?php echo $totalFound; ?> item<?php echo $totalFound == 1 ? "" : "s"; ?> available</span>
    </div>

    <?php if ($searchValue !== "") { ?>
    <div class="col-auto">
      <a href="product.php" class="btn btn-outline-dark btn-sm">
        “<?php echo htmlspecialchars($searchValue); ?>” <i class="bi bi-x-lg ms-1"></i>
      </a>
    </div>
    <?php } ?>
  </div>

  <?php if ($totalFound === 0) { ?>

    <div class="empty-state text-center py-5 px-3">
      <div class="icon mb-3"><i class="bi bi-search-heart"></i></div>
      <h3 class="h4">No products found</h3>
      <p class="text-secondary mb-4">Try a different keyword or browse everything we have.</p>
      <a href="product.php" class="btn btn-primary">View all products</a>
    </div>

  <?php } else { ?>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">

<?php
while($row = mysqli_fetch_assoc($result)){
?>

    <div class="col">
      <article class="card product-card h-100 shadow-sm">

        <a href="product_details.php?product_id=<?php echo $row["product_id"]; ?>" class="product-media ratio ratio-1x1">
          <img
            class="product-image"
            loading="lazy"
            src="../uploads/<?php echo htmlspecialchars($row["product_image"]); ?>"
            alt="<?php echo htmlspecialchars($row["product_name"]); ?>"
          >
          <span class="price-badge">Rs <?php echo htmlspecialchars($row["product_price"]); ?></span>
        </a>

        <div class="card-body d-flex flex-column p-4">
          <h3 class="product-title mb-2"><?php echo htmlspecialchars($row["product_name"]); ?></h3>
          <p class="product-desc mb-4"><?php echo htmlspecialchars($row["product_description"]); ?></p>

          <a href="product_details.php?product_id=<?php echo $row["product_id"]; ?>" class="btn btn-outline-primary w-100 mt-auto">
            View Product <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>

      </article>
    </div>

<?php
}
?>

  </div>
  <?php } ?>

</div>

<?php include "../partials/user_footer.php"; ?>

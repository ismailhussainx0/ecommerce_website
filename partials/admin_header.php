<?php
/* Admin layout (Bootstrap grid + offcanvas sidebar) — frontend only. Expects $pageTitle, $adminActive */
$adminActive = $adminActive ?? "";
$cssFile     = "admin.css";
$adminName   = $_SESSION["userName"] ?? "Admin";
include __DIR__ . "/head.php";
?>
<body>

<!-- mobile top bar -->
<nav class="navbar mobile-bar d-md-none px-3">
  <a href="dashboard.php" class="side-brand"><span class="brand-mark"><i class="bi bi-bag-heart-fill"></i></span> Admin</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Menu">
    <i class="bi bi-list fs-3"></i>
  </button>
</nav>

<div class="container-fluid">
  <div class="row">

    <!-- sidebar -->
    <aside class="sidebar col-md-3 col-lg-2 p-0">
      <div class="offcanvas-md offcanvas-start d-flex flex-column h-100" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarLabel">

        <div class="offcanvas-header">
          <a href="dashboard.php" class="side-brand" id="sidebarLabel"><span class="brand-mark"><i class="bi bi-bag-heart-fill"></i></span> Admin</a>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column p-3 pt-md-4">

          <a href="dashboard.php" class="side-brand d-none d-md-flex px-2 mb-4"><span class="brand-mark"><i class="bi bi-bag-heart-fill"></i></span> Admin</a>

          <div class="side-label px-2 mb-2">Manage</div>
          <nav class="d-flex flex-column gap-1">
            <a href="dashboard.php"   class="side-link <?php echo $adminActive === "dashboard" ? "active" : ""; ?>"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="products.php"    class="side-link <?php echo $adminActive === "products" ? "active" : ""; ?>"><i class="bi bi-box-seam-fill"></i> Products</a>
            <a href="add_product.php" class="side-link <?php echo $adminActive === "add" ? "active" : ""; ?>"><i class="bi bi-plus-circle-fill"></i> Add product</a>
            <a href="../user/product.php" class="side-link"><i class="bi bi-shop"></i> View store</a>
          </nav>

          <div class="side-user mt-auto p-3">
            <div class="d-flex align-items-center gap-2 mb-3">
              <div class="side-avatar"><?php echo htmlspecialchars(strtoupper(substr($adminName, 0, 1))); ?></div>
              <div class="lh-sm">
                <div class="fw-bold text-white small"><?php echo htmlspecialchars($adminName); ?></div>
                <div class="small" style="color:rgba(255,255,255,.5)">Administrator</div>
              </div>
            </div>
            <a href="../user/logout.php" class="btn btn-outline-light btn-sm w-100"><i class="bi bi-box-arrow-right"></i> Logout</a>
          </div>

        </div>
      </div>
    </aside>

    <!-- main -->
    <main class="col-md-9 col-lg-10 px-md-4 px-3 py-4">

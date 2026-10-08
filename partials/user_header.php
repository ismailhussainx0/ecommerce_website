<?php
/* Store navbar (Bootstrap navbar) — frontend only. Expects $pageTitle, $navActive */
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$loggedIn  = isset($_SESSION["userId"]);
$role      = $_SESSION["role"] ?? "";
$navActive = $navActive ?? "";
$cssFile   = "user.css";
include __DIR__ . "/head.php";
?>
<body>

<header class="sticky-top">
  <nav class="navbar navbar-expand-lg site-nav border-bottom py-2">
    <div class="container">

      <a href="product.php" class="navbar-brand">
        <span class="brand-mark"><i class="bi bi-bag-heart-fill"></i></span> My Store
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-label="Toggle menu">
        <i class="bi bi-list fs-4"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mx-lg-auto gap-lg-1 mt-3 mt-lg-0">
          <li class="nav-item"><a href="product.php" class="nav-link <?php echo $navActive === "products" ? "active" : ""; ?>">Products</a></li>
          <?php if ($loggedIn && $role === "user") { ?>
            <li class="nav-item"><a href="dashboard.php" class="nav-link <?php echo $navActive === "dashboard" ? "active" : ""; ?>">Dashboard</a></li>
          <?php } ?>
        </ul>

        <div class="d-flex flex-column flex-lg-row gap-2 py-3 py-lg-0">
          <?php if ($loggedIn) { ?>
            <?php if ($role === "admin") { ?>
              <a href="../admin/dashboard.php" class="btn btn-outline-dark btn-sm"><i class="bi bi-speedometer2"></i> Admin panel</a>
            <?php } ?>
            <a href="logout.php" class="btn btn-dark btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
          <?php } else { ?>
            <a href="login.php" class="btn btn-outline-dark btn-sm">Login</a>
            <a href="register.php" class="btn btn-primary btn-sm">Create account</a>
          <?php } ?>
        </div>
      </div>

    </div>
  </nav>
</header>

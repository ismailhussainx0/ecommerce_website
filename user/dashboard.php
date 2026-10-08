<?php

include "auth_check.php";

if(isset($_SESSION["userId"]) && $_SESSION["role"] === "user"){
    
    $greeting = $_SESSION["userName"];
}else{
    header("Location: login.php");
    exit;
}

$pageTitle = "Dashboard";
$navActive = "dashboard";
include "../partials/user_header.php";
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <section class="card welcome-card">
        <div class="card-body p-4 p-md-5">
          <div class="row align-items-center g-4">
            <div class="col-md-8">
              <h1 class="display-6 mb-2">Hello, <?php echo htmlspecialchars($greeting); ?> 👋</h1>
              <p class="mb-4">Good to see you again. Ready to find something new?</p>
              <div class="d-flex flex-wrap gap-2">
                <a href="product.php" class="btn btn-light fw-bold"><i class="bi bi-bag me-1"></i> Browse products</a>
                <a href="logout.php" class="btn btn-outline-light"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>

<?php include "../partials/user_footer.php"; ?>

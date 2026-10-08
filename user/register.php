<?php
include "../config.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["name"], $_POST["email"], $_POST["password"])){

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        // Variables check empty or not 
        if(!empty($name) && !empty($email) && !empty($password)){

            // email validate 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                // password hashing 
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $role = "user";

                $insertQuery = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
                $insertStatment = mysqli_prepare($connect, $insertQuery);
                $insertStatment->bind_param("ssss", $name, $email, $hash_password, $role);
                $insertResult = $insertStatment->execute();

                if($insertResult){
                    header("Location: login.php");
                    exit;
                }else{
                    $error = "data not added";
                }

            }else{
                $error = "Enter Valid Email";
            }

        }else{
            $error = "Enter all the fields";
        }

    }

}

$pageTitle = "Create account";
include "../partials/head.php";
?>
<body>
<div class="container-fluid">
<div class="row min-vh-100">

  <!-- brand panel -->
  <div class="col-lg-6 auth-art d-none d-lg-flex flex-column justify-content-between p-5">
    <a href="product.php" class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4 text-white">
      <span class="brand-mark"><i class="bi bi-bag-heart-fill"></i></span> My Store
    </a>
    <div>
      <h2 class="mb-3">Join <span class="text-info">My Store</span> today.</h2>
      <p class="fs-5 mb-0" style="max-width:380px">Create a free account in seconds and start exploring our latest products.</p>
    </div>
    <small style="color:rgba(255,255,255,.5)">&copy; <?php echo date("Y"); ?> My Store</small>
  </div>

  <!-- form panel -->
  <div class="col-lg-6 d-flex align-items-center justify-content-center py-5 px-3 bg-white">
    <div class="auth-card w-100">

      <a href="product.php" class="text-secondary small fw-semibold d-inline-flex align-items-center gap-1 mb-4"><i class="bi bi-arrow-left"></i> Back to store</a>
      <h1 class="h2 mb-1">Create account</h1>
      <p class="text-secondary mb-4">It only takes a minute.</p>

      <?php if ($error !== "") { ?>
        <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
          <i class="bi bi-exclamation-circle-fill"></i>
          <div><?php echo htmlspecialchars($error); ?></div>
        </div>
      <?php } ?>

      <form action="" method="post">

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
          <label for="name">Full name</label>
        </div>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
          <label for="email">Email address</label>
        </div>

        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>

      </form>

      <p class="text-center text-secondary mt-4 mb-0">Already have an account? <a href="login.php" class="fw-bold">Log in</a></p>

    </div>
  </div>

</div>
</div>
</body>
</html>

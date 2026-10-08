<?php
session_start();
include "../config.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["email"], $_POST["password"])){
        $loginEmail = $_POST["email"];
        $loginPassword = $_POST["password"];

        $selectRowQuery = "SELECT * FROM users WHERE email = ?"; 
        $selectStatement = mysqli_prepare($connect, $selectRowQuery);
        $selectStatement->bind_param("s", $loginEmail);
        $selectStatement->execute();

        $result = $selectStatement->get_result();
        
        if($result->num_rows > 0){
            
            $row = mysqli_fetch_assoc($result);
            $storedHash = $row["password"];

            if(password_verify($loginPassword, $storedHash)){

                $_SESSION["userId"] = $row["user_id"];
                $_SESSION["userName"] = $row["name"];
                $_SESSION["role"] = $row["role"];


                if($row["role"] === "admin"){
                    header("Location: ../admin/dashboard.php");
                    exit;
                }else{
                    header("Location: dashboard.php");
                    exit; 
                }

            }else{
                $error = "Wrong Password!";
            }


        }else{
            $error = "Enter Correct Email";
        }

    }else{
        $error = "keys is not set in login page";
    }

}

$pageTitle = "Login";
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
      <h2 class="mb-3">Welcome back to <span class="text-info">My Store.</span></h2>
      <p class="fs-5 mb-0" style="max-width:380px">Log in to pick up where you left off and discover what's new.</p>
    </div>
    <small style="color:rgba(255,255,255,.5)">&copy; <?php echo date("Y"); ?> My Store</small>
  </div>

  <!-- form panel -->
  <div class="col-lg-6 d-flex align-items-center justify-content-center py-5 px-3 bg-white">
    <div class="auth-card w-100">

      <a href="product.php" class="text-secondary small fw-semibold d-inline-flex align-items-center gap-1 mb-4"><i class="bi bi-arrow-left"></i> Back to store</a>
      <h1 class="h2 mb-1">Log in</h1>
      <p class="text-secondary mb-4">Enter your details to access your account.</p>

      <?php if ($error !== "") { ?>
        <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
          <i class="bi bi-exclamation-circle-fill"></i>
          <div><?php echo htmlspecialchars($error); ?></div>
        </div>
      <?php } ?>

      <form action="" method="post">

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
          <label for="email">Email address</label>
        </div>

        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>

      </form>

      <p class="text-center text-secondary mt-4 mb-0">New here? <a href="register.php" class="fw-bold">Create an account</a></p>

    </div>
  </div>

</div>
</div>
</body>
</html>

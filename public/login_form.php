<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PWD Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="../../assets/css/global/login_signup.css">
</head>

<body>
  <div class="main-wrapper">
    <!-- Left Section -->
    <div class="left-panel">
      <div class="left-content">
        <h1>Welcome to PWD <br> Online Application</h1>
        <p>Log in to continue your PWD registration and updates.</p>
        <img src="../../assets/pictures/PWD.png" alt="PWD Illustration">
      </div>
    </div>

    <!-- Right Section -->
    <div class="right-panel">
      <div class="login-card">
        <img src="../../assets/pictures/Logo.jpg" class="logo" alt="PWD Logo">
        <p>Sign in to start your session</p>
        <form action="../../backend/auth/login.php" method="POST">
          <div class="form-group">
            <input type="email" name=email class="form-control" placeholder="Email" required>
            <span class="form-icon"><i class="fas fa-envelope"></i></span>
          </div>
          <div class="form-group">
            <input type="password" name=password class="form-control" placeholder="Password" required>  
            <span class="form-icon"><i class="fas fa-lock"></i></span>
          </div>
          <a href="#" class="forgot d-block text-start mb-1">I forgot my password</a>
          <p class="text-start mb-2" style="font-size: 0.85rem; color: #245c9a;">
            Don't have an account yet?
          <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/public/signup_form.php'; ?>" class="sign-up-link fw-semibold text-primary">Sign up</a>
          </p>

          <button type="submit" class="btn btn-login">Sign In</button>
        </form>
      </div>
      <img src="../../assets/pictures/iligan.png" class="iligan-logo" alt="Iligan Logo">
    </div>
  </div>

</body>

</html>
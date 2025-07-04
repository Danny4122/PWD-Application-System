<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PWD Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f4f7;
      overflow: hidden;
    }

    .main-wrapper {
      display: flex;
      height: 100vh;
      width: 100vw;
    }

    .left-panel {
      width: 55%;
      background-color: #f2f4f7;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .left-content {
      max-width: 600px;
      margin-left: 60px; 
    }

    .left-content h1 {
      font-size: 3.2rem;
      font-weight: 800;
      color: #012A44;
      margin-bottom: 15px;
      line-height: 1.3;
    }

    .left-content p {
      font-size: 1.15rem;
      font-weight: 500;
      color: #012A44;
      margin-bottom: 30px;
    }

    .left-content img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
        margin-left: 70px;
    }

    .right-panel {
      width: 45%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      position: relative;
    }

    .login-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.08);
      padding: 45px 35px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 0.7s ease;
      margin-left: -40px;
    }

    .login-card img.logo {
      width: 120px;
      margin-bottom: 20px;
    }

    .login-card p {
      color: #555;
      margin-bottom: 25px;
      font-size: 0.95rem;
    }

    .form-group {
      position: relative;
      margin-bottom: 18px;
    }

    .form-control {
      padding: 12px 40px 12px 12px;
      border-radius: 12px;
      font-size: 0.95rem;
    }

    .form-icon {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      color: #999;
    }

    .forgot {
      font-size: 0.85rem;
      display: block;
      text-align: left;
      color: #245c9a;
      text-decoration: none;
      margin-bottom: 15px;
    }

    .forgot:hover {
      text-decoration: underline;
    }
    .sign-up-link {
      text-decoration: none;
    }
    
    .sign-up-link:hover {
      text-decoration: underline;
    }

    .btn-login {
      background-color: #245c9a;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      width: 45%;
      font-size: 1rem;
      margin-top: 20px;
      transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
    }

    .btn-login:hover {
      background-color: #0056b3;
      color: white; 
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .right-panel img.iligan-logo {
      position: absolute;
      bottom: 20px;
      right: 30px;
      width: 75px;
    }

    @media (max-width: 992px) {
      html, body {
        overflow: auto;
      }

      .main-wrapper {
        flex-direction: column;
        height: auto;
      }

      .left-panel, .right-panel {
        width: 100%;
        text-align: center;
        padding: 30px 20px;
      }

      .left-content {
        margin-left: 0;
      }

      .left-content h1 {
        font-size: 2rem;
      }

      .left-content img {
        max-height: 300px;
      }
      .text-primary {
        color: #007bff;
        text-decoration: none;
      }

      .text-primary:hover {
        text-decoration: underline;
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="main-wrapper">
  <!-- Left Section -->
  <div class="left-panel">
    <div class="left-content">
      <h1>Welcome to PWD <br> Online Application</h1>
      <p>Log in to continue your PWD registration and updates.</p>
      <img src="/assets/PWD.png" alt="PWD Illustration">
    </div>
  </div>

  <!-- Right Section -->
  <div class="right-panel">
    <div class="login-card">
      <img src="/assets/Logo.jpg" class="logo" alt="PWD Logo">
      <p>Sign in to start your session</p>
      <form action="admin_login_process.php" method="POST">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email" required>
          <span class="form-icon"><i class="fas fa-envelope"></i></span>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" required>
          <span class="form-icon"><i class="fas fa-lock"></i></span>
        </div>
        <a href="#" class="forgot d-block text-start mb-1">I forgot my password</a>
        <p class="text-start mb-2" style="font-size: 0.85rem; color: #245c9a;">
          Don't have an account yet?
          <a href="register.php" class="sign-up-link fw-semibold text-primary">Sign up</a>
        </p>

        <button type="submit" class="btn btn-login">Sign In</button>
      </form>
    </div>
    <img src="/assets/iligan.png" class="iligan-logo" alt="Iligan Logo">
  </div>
</div>

</body>
</html>
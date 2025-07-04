<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PWD Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    html, body {
      margin: 0; padding: 0; height: 100%;
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
      max-width: 480px;
      text-align: center;
      animation: fadeIn 0.7s ease;
      margin-left: -40px;
    }

    .login-card img.logo {
      width: 130px;
      margin-bottom: 20px;
    }

    .login-card p {
      color: #555;
      margin-bottom: 20px;
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
      html, body { overflow: auto; }

      .main-wrapper { flex-direction: column; height: auto; }

      .left-panel, .right-panel {
        width: 100%;
        text-align: center;
        padding: 30px 20px;
      }

      .left-content { margin-left: 0; }

      .left-content h1 { font-size: 2rem; }

      .left-content img { max-height: 300px; }
    }

    .role-toggle .toggle-container {
        display: flex;
        background: #dcdcdc;
        border-radius: 10px;
        overflow: hidden;
        width: fit-content;
        margin: 0 auto 15px;
        border: 1px solid #ccc;
    }

    .toggle-option {
        flex: 1;
        padding: 10px 24px;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        color: #333;
        background-color: #f0f0f0;
    }

    .toggle-option.active {
        background-color: #245c9a;  
        color: #fff;
        border-radius: 10px;
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
      <h1>Welcome to PWD<br>Admin Portal</h1>
      <p>Dedicated to Better Accessibility<br> and Support.</p>
      <img src="/assets/admin.png" alt="PWD Illustration">
    </div>
  </div>

  <!-- Right Section -->
  <div class="right-panel">
    <div class="login-card">
      <img src="/assets/Logo.jpg" class="logo" alt="PWD Logo">
      <p style="font-size: 1.3rem; font-weight: 600;">Sign in as...</p>

      <!-- Toggle Role -->
      <div class="role-toggle mb-3">
        <input type="radio" name="role" id="admin" value="admin" checked hidden>
        <input type="radio" name="role" id="doctor" value="doctor" hidden>
        <div class="toggle-container">
          <label for="admin" class="toggle-option active">ADMIN</label>
          <label for="doctor" class="toggle-option">DOCTOR</label>
        </div>
      </div>

      <!-- Login Form -->
      <form action="admin_login_process.php" method="POST">
        <input type="hidden" name="role" id="selectedRole" value="admin">

        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <span class="form-icon"><i class="fas fa-envelope"></i></span>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <span class="form-icon"><i class="fas fa-lock"></i></span>
        </div>
        <a href="#" class="forgot">I forgot my password</a>
        <button type="submit" class="btn btn-login">Sign In</button>
      </form>
    </div>
    <img src="/assets/iligan.png" class="iligan-logo" alt="Iligan Logo">
  </div>
</div>

<!-- Toggle Logic -->
<script>
  const labels = document.querySelectorAll('.toggle-option');
  const roleInput = document.getElementById('selectedRole');

  labels.forEach(label => {
    label.addEventListener('click', () => {
      labels.forEach(l => l.classList.remove('active'));
      label.classList.add('active');
      roleInput.value = label.textContent.trim().toLowerCase();
    });
  });
</script>

</body>
</html>
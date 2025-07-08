<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PWD Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../../assets/css/global/login_signup.css">

</head>

<body>

  <div class="main-wrapper">
    <!-- Left Section -->
    <div class="left-panel">
      <div class="left-content">
        <h1>Welcome to PWD<br>Admin Portal</h1>
        <p>Dedicated to Better Accessibility<br> and Support.</p>
        <img src="../../assets/admin.png" alt="PWD Illustration">
      </div>
    </div>

    <!-- Right Section -->
    <div class="right-panel">
      <div class="login-card">
        <img src="../../assets/Logo.jpg" class="logo" alt="PWD Logo">
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
      <img src="../../assets/iligan.png" class="iligan-logo" alt="Iligan Logo">
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
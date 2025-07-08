<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PWD Online Application Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- Global CSS -->
  <link rel="stylesheet" href="css/landing.css">
</head>

<body>

  <section class="header-section">
    <div class="container-header text-center">
      <div class="header-text">
        <h1>Welcome to PWD Online Application</h1>
        <p>Easily apply for your PWD ID online with our user-friendly system</p>
      </div>
      <div class="logo-row justify-content-center">
        <img src="../../assets/white.png" alt="PDAO Logo" />
        <img src="../../assets/LGU.png" alt="City of Iligan Logo" />
      </div>
    </div>
  </section>

  <!-- Main content -->
  <main>
    <!-- Action Buttons -->
    <section class="action-buttons mt-5">
      <div class="container-lg px-4 d-flex justify-content-center flex-wrap gap-4 mb-4">
        <a href="pwd_application_form.php" class="btn-icon">
          <i class="bi bi-grid-fill"></i>
          New Registration
        </a>
        <a href="renew_id.php" class="btn-icon">
          <i class="bi bi-file-earmark-text"></i>
          Renew ID
        </a>
        <a href="lost_id.php" class="btn-icon">
          <i class="bi bi-clipboard-x"></i>
          Lost ID
        </a>
        <a href="check_status.php" class="btn-icon">
          <i class="bi bi-check2-square"></i>
          Check Status
        </a>
      </div>
      <a href="#requirements" class="btn btn-primary">Requirements</a>
    </section>

    <!-- Hero Message -->
    <section class="hero-section text-center mt-5 pt-7">
      <div class="container">
        <h1>Empowering Every Step</h1>
        <p>Welcome to the PWD Online ID Application—a digital space where accessibility meets simplicity. Apply,
          connect,
          and stay informed all in one place.</p>
        <a href="pwd_application_form.php" class="btn btn-start">Get Started</a>
      </div>
    </section>

    <!-- Qualifications -->
    <section class="section" id="qualifications">
      <h3 class="section-heading">Qualifications for Applying for a PWD ID</h3>
      <div class="info-card">
        <h5>Applicants must meet the following criteria:</h5>
        <ul>
          <li>Must be 59 years old or below</li>
          <li>Resident of Iligan City only</li>
          <li>Must be a Filipino Citizen</li>
          <li>Must have a specific type of disability</li>
        </ul>
      </div>
    </section>

    <!-- Requirements -->
    <section class="section" id="requirements">
      <h3 class="section-heading">Application Requirements</h3>
      <div class="req-grid">
        <div class="info-card">
          <h5>📂 New Application</h5>
          <ul>
            <li>Filled-out registration form</li>
            <li>1 pc 1x1 ID picture</li>
            <li>1 whole body picture</li>
            <li>Barangay Certificate of Residency / Indigency</li>
            <li>Doctor's Referral / Medical Certificate from City Health Office</li>
          </ul>
        </div>
        <div class="info-card">
          <h5>🔁 ID Renewal</h5>
          <ul>
            <li>Filled-out registration form</li>
            <li>Surrender old PWD ID</li>
            <li>Barangay Certificate of Residency / Indigency</li>
            <li>Doctor's Medical Certificate from City Health Office</li>
            <li>1 pc 1x1 ID picture</li>
          </ul>
        </div>
        <div class="info-card">
          <h5>📝 Lost ID</h5>
          <ul>
            <li>Affidavit of Loss</li>
            <li>Barangay Certificate of Residency / Indigency</li>
            <li>Medical Certificate Confirming Client's Disability</li>
            <li>1 pc 1x1 ID picture</li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 PWD Online ID Application. All Rights Reserved | Designed with care and inclusivity.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
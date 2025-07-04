<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PWD Online Application Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
  font-family: 'Quicksand', sans-serif;
  background-color: #eef4f8;
}

.header-section {
  background: linear-gradient(to right, #1F54DC 0%, #2B26AA 50%, #1E1E1E 100%);
  color: #fff;
  padding: 40px 60px;
}

.header-text {
  flex: 1;
  min-width: 280px;
}

.header-text h1 {
  font-size: 2.7rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.header-text p {
  font-size: 1.2rem;
  margin-bottom: 30px;
}

.logo-row {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
}

.logo-row img {
  height: 130px;
  width: 130px;
  object-fit: contain;
}

.logo-row img:last-child {
  transform: scale(1.35);
}

.action-buttons {
  padding: 50px 15px 30px;
  text-align: center;
  margin-top: 50px;
}

.action-buttons a.btn-primary {
  margin-top: 40px; 
}

.action-buttons .btn-icon {
  background-color: #2f41b9;
  color: #fff;
  width: 140px;
  height: 140px;
  border-radius: 16px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-weight: 600;
  font-size: 0.95rem;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
  transition: all 0.3s;
  text-decoration: none;
}

.btn-icon:hover {
  background-color: #1F54DC;
  transform: translateY(-3px);
}

.btn-icon i {
  font-size: 2.4rem;
  margin-bottom: 10px;
}

.btn-start {
  background-color: #64ccc5;
  color: #012a44;
  padding: 12px 30px;
  font-size: 1.1rem;
  border-radius: 50px;
  border: none;
  font-weight: 600;
  transition: 0.3s;
  text-decoration: none;
  display: inline-block;
  margin-top: 20px;
}

.btn-start:hover {
  background-color: #4fb2aa;
  color: #fff;
}

.btn-primary {
  background-color: #2B26AA;
  border: none;
  font-weight: 600;
  padding: 10px 30px;
  border-radius: 8px;
}

.btn-primary:hover {
  background-color: #1F54DC;
}

.hero-section {
  background-color: #eef4f8;
  text-align: center;
  padding: 60px 20px;
}

.header-section h1 {
  font-size: 2.8rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.header-section p {
  font-size: 1.2rem;
  margin-bottom: 30px;
}

.container-header {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.section {
  background-color: #eef4f8;
  padding: 60px 20px;
}

.section-heading {
  text-align: center;
  font-weight: 700;
  font-size: 2rem;
  color: #012a44;
  margin-bottom: 40px;
}

.info-card {
  background: #fff;
  border-left: 6px solid #072176;
  border-radius: 16px;
  padding: 30px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
  max-width: 720px;
  margin: 0 auto;
}

.info-card ul {
  padding: 0;
  list-style: none;
}

.info-card ul li {
  margin-bottom: 10px;
  padding-left: 20px;
  position: relative;
}

.info-card ul li::before {
  content: "✔";
  position: absolute;
  left: 0;
  color: #072176;
  font-weight: bold;
}

.req-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  max-width: 1000px;
  margin: 0 auto;
}

.footer {
  background: #012a44;
  color: white;
  text-align: center;
  padding: 20px 10px;
}

@media (max-width: 768px) {
  .header-text h1 {
    font-size: 2rem;
  }
}
  </style>
</head>
<body>

<section class="header-section">
  <div class="container-header text-center">
    <div class="header-text">
      <h1>Welcome to PWD Online Application</h1>
      <p>Easily apply for your PWD ID online with our user-friendly system</p>
    </div>
    <div class="logo-row justify-content-center">
      <img src="/assets/white.png" alt="PDAO Logo" />
      <img src="/assets/LGU.png" alt="City of Iligan Logo" />
    </div>
  </div>
</section>


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
      <p>Welcome to the PWD Online ID Application—a digital space where accessibility meets simplicity. Apply, connect, and stay informed all in one place.</p>
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

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 PWD Online ID Application. All Rights Reserved | Designed with care and inclusivity.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
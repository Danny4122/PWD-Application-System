<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PWD Online Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body { font-family: Arial;}
    .content { padding: 30px; }
    .table-container { margin-top: 30px; }
    .breadcrumb-link { color: inherit; text-decoration: none; transition: color 0.2s ease; }
    .breadcrumb-link:hover { color: #007bff; text-decoration: underline; }
    .view-link { color: #0d6efd; text-decoration: none; transition: color 0.2s ease, text-decoration 0.2s ease; }
    .view-link:hover { color: #0a58ca; text-decoration: underline; }
    .search-buttons-container { margin-top: 25px; }
    .shadow-custom { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    #personnelTable_wrapper { overflow-x: auto; }
  </style>
</head>
<body>
<?php include __DIR__ . '/../hero/navbar.php'; ?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PWD Online Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --nav-bg: #14255A;
      --primary-blue: #14258A;
      --light-gray: #F0F1F5;
      --border-gray: #CED4DA;
      --text-gray: #6C757D;
      --radius: 6px;
      --circle-size: 30px;
    }

    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }

    .navbar {
      background-color: var(--nav-bg);
    }

    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: 600;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    .navbar-brand:hover, .nav-link:hover {
      transform: scale(1.05);
      color: #e0e0e0;
    }

    .form-title {
      text-align: center;
      color: var(--primary-blue);
      font-size: 1.75rem;
      font-weight: 700;
      margin-top: 2rem;
    }

    .step-indicator-wrapper {
      display: flex;
      justify-content: center;
      margin: 2rem auto;
    }

    .step-indicator {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2rem;
      position: relative;
    }

    .step {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 0.85rem;
      min-width: 90px;
      z-index: 1;
    }

    .step:not(:last-child)::after {
      content: "";
      position: absolute;
      top: 15px;
      left: calc(50% + var(--circle-size) / 2);
      width: 100px;
      height: 2px;
      background-color: var(--border-gray);
      z-index: 0;
    }

    .step .circle {
      width: var(--circle-size);
      height: var(--circle-size);
      border-radius: 50%;
      border: 2px solid var(--border-gray);
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--border-gray);
      font-weight: 600;
      margin-bottom: 0.25rem;
      box-shadow: 0 0 0 3px #fff;
    }

    .step .label {
      color: var(--text-gray);
    }

    .step.active .circle {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
      color: #fff;
    }

    .step.active .label {
      color: var(--primary-blue);
      font-weight: 600;
    }

    .form-container {
      max-width: 1000px;
      margin: 2rem auto;
      background: #fff;
      border-radius: var(--radius);
      padding: 2rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    label {
      font-weight: 600;
      color: var(--primary-blue);
    }

    .form-control,
    .form-select {
      background-color: var(--light-gray);
      border: 1px solid var(--border-gray);
      border-radius: var(--radius);
      height: calc(1.5em + 0.75rem + 2px);
    }

    .form-check-input {
      border: 2px solid #999;
      width: 1.2em;
      height: 1.2em;
      background-color: #fff;
    }

    .form-check-input:checked {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
    }

    .photo-box {
      width: 1.5in;
      height: 1.5in;
      background: var(--light-gray, #f0f1f5);
      border: 2px dashed var(--border-gray, #ced4da);
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6c757d;
      font-weight: 600;
      text-align: center;
      box-sizing: border-box;
    }

  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="/assets/white.png" alt="Logo" width="32" height="32" class="me-2" />
          Persons with Disabilities Affairs Office
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <h1 class="form-title">PWD Application Form</h1>

  <div class="step-indicator-wrapper">
    <div class="step-indicator">
      <div class="step active">
        <div class="circle">1</div>
        <div class="label">Personal Information</div>
      </div>
      <div class="step">
        <div class="circle">2</div>
        <div class="label">Affiliation Section</div>
      </div>
      <div class="step">
        <div class="circle">3</div>
        <div class="label">Approval Section</div>
      </div>
      <div class="step">
        <div class="circle">4</div>
        <div class="label">Upload Documents</div>
      </div>
      <div class="step">
        <div class="circle">5</div>
        <div class="label">Submission Complete</div>
      </div>
    </div>
  </div>

<main class="form-container">
  <form novalidate>
    <!-- Row 1 -->
    <div class="row g-3 mb-3">
      <div class="col-md-3">
        <label class="form-label fw-semibold">Applicant Type</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" id="newApplicant" name="applicantType" required>
          <label class="form-check-label" for="newApplicant" style="color: black; font-size: 0.85rem;">New Applicant</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" id="renewal" name="applicantType">
          <label class="form-check-label" for="renewal" style="color: black; font-size: 0.85rem;">Renewal</label>
        </div>
      </div>
      <div class="col-md-4">
        <label for="pwdNumber" class="form-label fw-semibold">Persons with Disability Number</label>
        <input type="text" id="pwdNumber" class="form-control" placeholder="RR-PPMM-BBB-NNNNNNN" required>
      </div>
      <div class="col-md-3">
        <label for="dateApplied" class="form-label fw-semibold">Date Applied</label>
        <input type="date" id="dateApplied" class="form-control" required>
      </div>
      <div class="col-md-2">
        <div class="photo-box mx-auto">Upload Photo</div>
      </div>
    </div>

    <!-- Row 2 -->
    <div class="row g-3 mb-3" style="margin-top: -55px;">
      <div class="col-md-3"><label for="lastName" class="form-label fw-semibold">Last Name</label><input type="text" id="lastName" class="form-control" required></div>
      <div class="col-md-3"><label for="firstName" class="form-label fw-semibold">First Name</label><input type="text" id="firstName" class="form-control" required></div>
      <div class="col-md-3"><label for="middleName" class="form-label fw-semibold">Middle Name</label><input type="text" id="middleName" class="form-control"></div>
      <div class="col-md-3"><label for="suffix" class="form-label fw-semibold">Suffix</label><input type="text" id="suffix" class="form-control"></div>
    </div>

    <!-- Row 3 -->
    <div class="row g-3 mb-3">
      <div class="col-md-3"><label for="dob" class="form-label fw-semibold">Date of Birth</label><input type="date" id="dob" class="form-control" required></div>
      <div class="col-md-3">
        <label for="sex" class="form-label fw-semibold">Sex</label>
        <select id="sex" class="form-select" required>
          <option value="" disabled selected>Please Select</option>
          <option>Male</option>
          <option>Female</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="civilStatus" class="form-label fw-semibold">Civil Status</label>
        <select id="civilStatus" class="form-select">
          <option value="" disabled selected>Please Select</option>
          <option>Single</option>
          <option>Married</option>
          <option>Widowed</option>
          <option>Separated</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="disabilityType" class="form-label fw-semibold">Type of Disability</label>
        <select id="disabilityType" class="form-select">
          <option value="" disabled selected>Please Select</option>
          <option>Visual</option>
          <option>Hearing</option>
          <option>Mobility</option>
          <option>Mental</option>
        </select>
      </div>
    </div>

    <!-- Row 4 -->
    <div class="row g-3 mb-3">
      <div class="col-md-3">
        <label for="cause" class="form-label fw-semibold">Cause of Disability</label>
        <select id="cause" class="form-select">
          <option value="" disabled selected>Please Select</option>
          <option>Congenital</option>
          <option>Acquired</option>
        </select>
      </div>
      <div class="col-md-3"><label for="houseNo" class="form-label fw-semibold">House No. and Street</label><input type="text" id="houseNo" class="form-control"></div>
      <div class="col-md-3"><label for="barangay" class="form-label fw-semibold">Barangay</label><input type="text" id="barangay" class="form-control"></div>
      <div class="col-md-3"><label for="municipality" class="form-label fw-semibold">Municipality</label><input type="text" id="municipality" class="form-control"></div>
    </div>

    <!-- Row 5 -->
    <div class="row g-3 mb-3">
      <div class="col-md-3"><label for="province" class="form-label fw-semibold">Province</label><input type="text" id="province" class="form-control"></div>
      <div class="col-md-3"><label for="region" class="form-label fw-semibold">Region</label><input type="text" id="region" class="form-control"></div>
      <div class="col-md-3"><label for="landline" class="form-label fw-semibold">Landline No.</label><input type="tel" id="landline" class="form-control"></div>
      <div class="col-md-3"><label for="mobile" class="form-label fw-semibold">Mobile No.</label><input type="tel" id="mobile" class="form-control" required></div>
    </div>

    <!-- Row 6 -->
    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">E-mail Address:</label>
      <input type="email" id="email" class="form-control" placeholder="example@domain.com" required>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-primary px-4">Next</button>
    </div>
  </form>
</main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PWD Online Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    :root {
      --nav-bg: #14255A;
      --primary-blue: #14258A;
      --light-gray: #F0F1F5;
      --border-gray: #CED4DA;
      --text-gray: #6C757D;
      --radius: 6px;
      --circle-size: 30px;
    }
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }

    .navbar {
      background-color: var(--nav-bg);
    }

    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: 600;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    .navbar-brand:hover, .nav-link:hover {
      transform: scale(1.05);
      color: #e0e0e0;
    }
    
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="/assets/white.png" alt="Logo" width="32" height="32" class="me-2" />
        Persons with Disabilities Affairs Office
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
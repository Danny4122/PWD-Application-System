<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php'; // helper functions for draft

if (!isset($_SESSION['user_id']) || !isset($_SESSION['applicant_id'])) {
    // Redirect if not logged in
    header("Location: ../../public/login_form.php");
    exit;
}

$applicant_id = $_SESSION['applicant_id'];

$applicationType = strtolower($_GET['type'] ?? 'new');
$_SESSION['application_type'] = $applicationType;

// If no application_id yet, create a new application record
if (!isset($_SESSION['application_id'])) {
    $query = "INSERT INTO application (applicant_id, application_type, created_at)
              VALUES ($1, $2, NOW()) RETURNING application_id";
    $result = pg_query_params($conn, $query, [$applicant_id, $applicationType]);

    if (!$result) {
        die("Database Error: " . pg_last_error($conn));
    }

    if ($row = pg_fetch_assoc($result)) {
        $_SESSION['application_id'] = $row['application_id'];
    } else {
        die("Error creating application.");
    }
}


// ✅ If no application_id yet, create a new application record
if (!isset($_SESSION['application_id'])) {
    $query = "INSERT INTO application (applicant_id, application_type, created_at)
              VALUES ($1, $2, NOW()) RETURNING application_id";
    $result = pg_query_params($conn, $query, [$applicant_id, $applicationType]);

    if (!$result) {
        die("Database Error: " . pg_last_error($conn));
    }

    if ($row = pg_fetch_assoc($result)) {
        $_SESSION['application_id'] = $row['application_id'];
    } else {
        die("Error creating application.");
    }
}

$application_id = $_SESSION['application_id'];

// ✅ Step 1 draft handling
$step = 1;
$draftData = loadDraftData($step, $application_id);

// ✅ If form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    saveDraftData($step, $_POST, $application_id);

    // Save structured session data
    $_SESSION['applicant'] = [
        'application_type' => $_POST['applicantType'],
        'last_name' => $_POST['last_name'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'suffix' => $_POST['suffix'],
        'birthdate' => $_POST['birthdate'],
        'sex' => $_POST['sex'],
        'civil_status' => $_POST['civil_status'],
        'house_no_street' => $_POST['house_no_street'],
        'barangay' => $_POST['barangay'],
        'municipality' => $_POST['municipality'],
        'province' => $_POST['province'],
        'region' => $_POST['region'],
        'landline_no' => $_POST['landline_no'],
        'mobile_no' => $_POST['mobile_no'],
        'email_address' => $_POST['email_address']
    ];

    $_SESSION['causedetail'] = [
        'cause_detail' => $_POST['cause']
    ];

    $_SESSION['causedisability'] = [
        'cause_disability' => $_POST['cause_description']
    ];

    $_SESSION['disability'] = [
        'disability_type' => $_POST['disability_type']
    ];

    // Redirect to Form 2
    header("Location: form2.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PWD Online Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../assets/css/global/forms.css">

</head>

<body>
  <?php include __DIR__ . '/../../hero/navbar.php'; ?>

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
  <form method="post" id="form1">
    <!-- Row 1 -->
    <div class="row g-3 mb-3">
      <?php
        $applicationType = isset($_GET['type']) ? $_GET['type'] : 'new';
        $_SESSION['application_type'] = $applicationType;


    // Label map
    $applicationLabel = match($applicationType) {
      'new' => 'New Application',
      'renew' => 'Renewal Application',
      'lost' => 'Lost ID Application',
      default => ucfirst($applicationType) . ' Application'
    };
  ?>
  <div class="col-md-3">
    <label class="form-label fw-semibold">Application Type</label>
    <input type="hidden" name="applicantType" value="<?php echo htmlspecialchars($applicationType); ?>">
    <div class="form-control bg-light text-dark" style="font-size: 0.9rem;">
      <?php echo $applicationLabel; ?>
    </div>
  </div>

        <div class="col-md-4">
          <label for="pwdNumber" class="form-label fw-semibold">Persons with Disability Number</label>
          <input type="text" id="pwdNumber" class="form-control" placeholder="To be filled by PDAO once approved" disabled>
        </div>

        <div class="col-md-3">
        <label for="dateApplied" class="form-label fw-semibold">Date Applied</label>
        <input 
          type="date" 
          id="dateApplied" 
          name="date_applied" 
          class="form-control" 
          required 
          value="<?= htmlspecialchars($draftData['date_applied'] ?? '') ?>">
      </div>
        <div class="col-md-2">
          <div class="photo-box mx-auto">Upload Photo</div>
        </div>
      </div>

      <!-- Row 2 -->

    <div class="row g-3 mb-3" style="margin-top: -55px;">
      <div class="col-md-3">
        <label for="lastName" class="form-label fw-semibold">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control" required value="<?= htmlspecialchars($draftData['last_name'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label for="firstName" class="form-label fw-semibold">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" required value="<?= htmlspecialchars($draftData['first_name'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label for="middleName" class="form-label fw-semibold">Middle Name</label>
    <input type="text" name="middle_name" id="middle_name" class="form-control" value="<?= htmlspecialchars($draftData['middle_name'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label for="suffix" class="form-label fw-semibold">Suffix</label>
        <input type="text" name="suffix" id="suffix" class="form-control" value="<?= htmlspecialchars($draftData['suffix'] ?? '') ?>">
      </div>
    </div>

      <!-- Row 3 -->
  <div class="row g-3 mb-3">
    <div class="col-md-3">
      <label for="birthdate" class="form-label fw-semibold">Date of Birth</label>
    <input type="date" name="birthdate" id="birthdate" class="form-control" required value="<?= htmlspecialchars(string: $draftData['birthdate'] ?? '') ?>">
    </div>
        <div class="col-md-3">
          <label for="sex" class="form-label fw-semibold">Sex</label>
           <select name="sex" id="sex" class="form-select" required>
              <option value="">Please Select</option>
              <option value="Male" <?= ($draftData['sex'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= ($draftData['sex'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>
        <div class="col-md-3">
          <label for="civilStatus" class="form-label fw-semibold">Civil Status</label>
          <select name="civil_status" id="civil_status" class="form-select">
            <option value="">Please Select</option>
            <option value="Single" <?= ($draftData['civil_status'] ?? '') === 'Single' ? 'selected' : '' ?>>Single</option>
            <option value="Separated" <?= ($draftData['civil_status'] ?? '') === 'Separated' ? 'selected' : '' ?>>Separated</option>
            <option value="Cohabitation (live-in)" <?= ($draftData['civil_status'] ?? '') === 'Cohabitation (live-in)' ? 'selected' : '' ?>>Cohabitation (live-in)</option>
            <option value="Married" <?= ($draftData['civil_status'] ?? '') === 'Married' ? 'selected' : '' ?>>Married</option>
            <option value="Widow/er" <?= ($draftData['civil_status'] ?? '') === 'Widow/er' ? 'selected' : '' ?>>Widow/er</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="disabilityType" class="form-label fw-semibold">Type of Disability</label>
          <select name="disability_type" id="disability_type" class="form-select">
             <option value="">Please Select</option>
              <option value="Deaf or Hard of Hearing" <?= ($draftData['disability_type'] ?? '') === 'Deaf or Hard of Hearing' ? 'selected' : '' ?>>Deaf or Hard of Hearing</option>
              <option value="Intellectual Disability" <?= ($draftData['disability_type'] ?? '') === 'Intellectual Disability' ? 'selected' : '' ?>>Intellectual Disability</option>
              <option value="Learning Disability" <?= ($draftData['disability_type'] ?? '') === 'Learning Disability' ? 'selected' : '' ?>>Learning Disability</option>
              <option value="Mental Disability" <?= ($draftData['disability_type'] ?? '') === 'Mental Disability' ? 'selected' : '' ?>>Mental Disability</option>
              <option value="Physical Disability (Orthopedic)" <?= ($draftData['disability_type'] ?? '') === 'Physical Disability (Orthopedic)' ? 'selected' : '' ?>>Physical Disability (Orthopedic)</option>
              <option value="Psychosocial Disability" <?= ($draftData['disability_type'] ?? '') === 'Psychosocial Disability' ? 'selected' : '' ?>>Psychosocial Disability</option>
              <option value="Speech and Language Impairment" <?= ($draftData['disability_type'] ?? '') === 'Speech and Language Impairment' ? 'selected' : '' ?>>Speech and Language Impairment</option>
              <option value="Visual Disability" <?= ($draftData['disability_type'] ?? '') === 'Visual Disability' ? 'selected' : '' ?>>Visual Disability</option>
              <option value="Cancer (RA11215)" <?= ($draftData['disability_type'] ?? '') === 'Cancer (RA11215)' ? 'selected' : '' ?>>Cancer (RA11215)</option>
              <option value="Rare Disease (RA10747)" <?= ($draftData['disability_type'] ?? '') === 'Rare Disease (RA10747)' ? 'selected' : '' ?>>Rare Disease (RA10747)</option>
            </select>
        </div>
      </div>

      <!-- Row 4 -->
      <div class="row g-3 mb-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label fw-semibold text-primary">Cause of Disability</label>
          <div class="d-flex gap-3 mb-2" style="font-size: 0.75rem;">
            <div class="form-check mb-0">
              <input class="form-check-input" type="radio" id="causeCongenital" name="cause"
              value="Congenital/Inborn" onchange="updateOptions(this.value)"
              <?= ($draftData['cause_detail'] ?? '') === 'Congenital/Inborn' ? 'checked' : '' ?>> 
              <label class="form-check-label" for="causeCongenital">Congenital/Inborn</label>
            </div>
            <div class="form-check mb-0">
              <input class="form-check-input" type="radio" name="cause" 
              value="Acquired" onchange="updateOptions(this.value)"
              <?= ($draftData['cause_detail'] ?? '') === 'Acquired' ? 'checked' : '' ?>>
              <label class="form-check-label" for="causeAcquired">Acquired</label>
            </div>
          </div>

          <select id="cause_description" name="cause_description" class="form-select">
            <option value="">Please Select</option>
                </select>
              </div>

        <div class="col-md-3">
          <label for="houseNo" class="form-label fw-semibold">House No. and Street</label>
          <input type="text" name="house_no_street" id="house_no_street" id="house_no_street" class="form-control" value="<?= htmlspecialchars($draftData['house_no_street'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label for="barangay" class="form-label fw-semibold">Barangay</label>
         <input type="text" name="barangay" id="barangay" id="barangay" class="form-control" value="<?= htmlspecialchars($draftData['barangay'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label for="municipality" class="form-label fw-semibold">Municipality</label>
          <input type="text" name="municipality" id="municipality" id="municipality" class="form-control" value="<?= htmlspecialchars(string: $draftData['municipality'] ?? '') ?>">
        </div>
      </div>


      <!-- Row 5 -->
      <div class="row g-3 mb-3">
        <div class="col-md-3">
          <label for="province" class="form-label fw-semibold">Province</label>
          <input type="text" name="province" id="province" id="province" class="form-control"
            value="<?= htmlspecialchars(string: $draftData['province'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label for="region" class="form-label fw-semibold">Region</label>
          <input type="text" name="region" id="region" id="region" class="form-control"
            value="<?= htmlspecialchars($draftData['region'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label for="landline" class="form-label fw-semibold">Landline No.</label>
          <input type="tel" name="landline_no" id="landline_no" id="landline_no" class="form-control"
            value="<?= htmlspecialchars($draftData['landline_no'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label for="mobile" class="form-label fw-semibold">Mobile No.</label>
          <input type="tel" name="mobile_no" id="mobile_no" id="mobile_no" class="form-control" required
            value="<?= htmlspecialchars($draftData['mobile_no'] ?? '') ?>">
        </div>
      </div>

      <!-- Row 6 -->
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">E-mail Address:</label>
        <input type="email" name="email_address" id="email_address" id="email_address" class="form-control"
          placeholder="example@domain.com" required
          value="<?= htmlspecialchars($draftData['email_address'] ?? '') ?>">
      </div>


      <div class="text-end">
        <button type="submit" class="btn btn-primary px-4">Next</button>
      </div>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script>
  const causeSelect = document.getElementById('cause_description');

  function updateOptions(type) {
    let options = [];

      if (type === "Congenital/Inborn"){
      options = ["Autism", "ADHD", "Cerebral Palsy", "Down Syndrome"];
    } else if (type === "Acquired") {
      options = ["Chronic Illness", "Cerebral Palsy", "Injury"];
    }

    causeSelect.innerHTML = '<option value="">Please Select</option>';
    options.forEach(opt => {
      const optionElement = document.createElement('option');
      optionElement.textContent = opt;
      optionElement.value = opt;
      causeSelect.appendChild(optionElement);
    });
  }

  window.addEventListener('DOMContentLoaded', () => {
    const savedCause = "<?= $draftData['cause'] ?? '' ?>";
    const savedDesc = "<?= $draftData['cause_description'] ?? '' ?>";

    if (savedCause) {
      const radio = document.querySelector(`input[name="cause"][value="${savedCause}"]`);
      if (radio) {
        radio.checked = true;
        updateOptions(savedCause); // This repopulates dropdown
      }
    
      if (savedDesc) {
        setTimeout(() => {
          causeSelect.value = savedDesc;
        }, 100);
      }
    }
  });
</script>
</body>

</html>
<script>

    const form = document.querySelector('form');
    form.addEventListener('input', () => {
      const formData = Object.fromEntries(new FormData(form));
      fetch('autosave.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'formData=' + encodeURIComponent(JSON.stringify(formData)) + '&step=1'
      });
    });
</script>
</body>
</html>

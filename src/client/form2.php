<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['applicant_id']) || !isset($_SESSION['application_id'])) {
    header("Location: ../../public/login_form.php");
    exit;
}

$applicant_id = $_SESSION['applicant_id'];
$application_id = $_SESSION['application_id'];

$step = 2;
$draftData = loadDraftData($step, $application_id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
        saveDraftData($step, $_POST, $application_id);


    // Optional: structured session caching for final submit
    $_SESSION['affiliation'] = [
        'educational_attainment' => $_POST['educational_attainment'],
        'employment_status' => $_POST['employment_status'],
        'employment_category' => $_POST['employment_category'],
        'occupation' => $_POST['occupation'],
        'type_of_employment' => $_POST['type_of_employment'],
        'organization_affiliated' => $_POST['organization_affiliated'],
        'contact_person' => $_POST['contact_person'],
        'office_address' => $_POST['office_address'],
        'tel_no' => $_POST['tel_no'],
        'sss_no' => $_POST['sss_no'],
        'gsis_no' => $_POST['gsis_no'],
        'pagibig_no' => $_POST['pagibig_no'],
        'psn_no' => $_POST['psn_no'],
        'philhealth_no' => $_POST['philhealth_no']
    ];

    $_SESSION['accomplishedby'] = [
        'accomplished_by' => $_POST['accomplished_by'],
        'last_name' => $_POST['acc_last_name'],
        'first_name' => $_POST['acc_first_name'],
        'middle_name' => $_POST['acc_middle_name']
    ];

    $_SESSION['familybackground'] = [
        'father_name' => $_POST['father_name'],
        'mother_name' => $_POST['mother_name'],
        'guardian_name' => $_POST['guardian_name']
    ];

    header("Location: form3.php");
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
      <div class="step">
        <div class="circle">1</div>
        <div class="label">Personal Information</div>
      </div>
      <div class="step active">
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
  <form method="POST" novalidate>
    <div class="row g-2 align-items-start">
      <div class="col-md-4 pe-md-2">

        <!-- Educational Attainment -->
        <div class="mb-2">
          <label class="form-label fw-semibold">Educational Attainment</label>
          <select name="educational_attainment" id="educational_attainment" class="form-select">
            <option value="">Please Select</option>
            <option value="None" <?= ($draftData['educational_attainment'] ?? '') === 'None' ? 'selected' : '' ?>>None</option>
            <option value="Kindergarten" <?= ($draftData['educational_attainment'] ?? '') === 'Kindergarten' ? 'selected' : '' ?>>Kindergarten</option>
            <option value="Elementary" <?= ($draftData['educational_attainment'] ?? '') === 'Elementary' ? 'selected' : '' ?>>Elementary</option>
            <option value="Junior High School" <?= ($draftData['educational_attainment'] ?? '') === 'Junior High School' ? 'selected' : '' ?>>Junior High School</option>
            <option value="Senior High School" <?= ($draftData['educational_attainment'] ?? '') === 'Senior High School' ? 'selected' : '' ?>>Senior High School</option>
            <option value="College" <?= ($draftData['educational_attainment'] ?? '') === 'College' ? 'selected' : '' ?>>College</option>
            <option value="Vocational" <?= ($draftData['educational_attainment'] ?? '') === 'Vocational' ? 'selected' : '' ?>>Vocational</option>
            <option value="Post Graduate" <?= ($draftData['educational_attainment'] ?? '') === 'Post Graduate' ? 'selected' : '' ?>>Post Graduate</option>
          </select>
        </div>

        <!-- Status of Employment -->
        <div class="mb-2">
          <label class="form-label fw-semibold">Status of Employment</label>
          <select name="employment_status" class="form-select">
            <option value="" <?= empty($draftData['employment_status']) ? 'selected' : '' ?>>Please Select</option>
            <option value="Employed" <?= ($draftData['employment_status'] ?? '') === 'Employed' ? 'selected' : '' ?>>Employed</option>
            <option value="Unemployed" <?= ($draftData['employment_status'] ?? '') === 'Unemployed' ? 'selected' : '' ?>>Unemployed</option>
            <option value="Self-employed" <?= ($draftData['employment_status'] ?? '') === 'Self-employed' ? 'selected' : '' ?>>Self-employed</option>
          </select>
        </div>

        <!-- Category of Employment -->
        <div class="mb-2">
          <label class="form-label fw-semibold">Category of Employment</label>
          <select name="employment_category" class="form-select">
            <option value="" <?= empty($draftData['employment_category']) ? 'selected' : '' ?>>Please Select</option>
            <option value="Government" <?= ($draftData['employment_category'] ?? '') === 'Government' ? 'selected' : '' ?>>Government</option>
            <option value="Private" <?= ($draftData['employment_category'] ?? '') === 'Private' ? 'selected' : '' ?>>Private</option>
            <option value="Others" <?= ($draftData['employment_category'] ?? '') === 'Others' ? 'selected' : '' ?>>Others</option>
          </select>
        </div>

        <!-- Types of Employment -->
        <div class="mb-0">
          <label class="form-label fw-semibold">Types of Employment</label>
          <select name="type_of_employment" class="form-select">
            <option value="" <?= empty($draftData['type_of_employment']) ? 'selected' : '' ?>>Please Select</option>
            <option value="Permanent/Regular" <?= ($draftData['type_of_employment'] ?? '') === 'Permanent/Regular' ? 'selected' : '' ?>>Permanent / Regular</option>
            <option value="Seasonal" <?= ($draftData['type_of_employment'] ?? '') === 'Seasonal' ? 'selected' : '' ?>>Seasonal</option>
            <option value="Casual" <?= ($draftData['type_of_employment'] ?? '') === 'Casual' ? 'selected' : '' ?>>Casual</option>
            <option value="Emergency" <?= ($draftData['type_of_employment'] ?? '') === 'Emergency' ? 'selected' : '' ?>>Emergency</option>
          </select>
        </div>

        </div>
<!-- Right Column: Occupations -->
<div class="col-md-8">
  <label class="form-label fw-semibold mb-2" style="font-size: 1.25rem;">Occupation</label>
  <div class="row g-0">
    <div class="col-md-6">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Managers" id="managers"
          <?= ($draftData['occupation'] ?? '') === 'Managers' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="managers">Managers</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Professionals" id="professionals"
          <?= ($draftData['occupation'] ?? '') === 'Professionals' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="professionals">Professionals</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Technicians and Associate Professionals" id="tech"
          <?= ($draftData['occupation'] ?? '') === 'Technicians and Associate Professionals' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="tech">Technicians and Associate Professionals</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Clerical Support Workers" id="clerical"
          <?= ($draftData['occupation'] ?? '') === 'Clerical Support Workers' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="clerical">Clerical Support Workers</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Service and Sales Workers" id="service"
          <?= ($draftData['occupation'] ?? '') === 'Service and Sales Workers' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="service">Service and Sales Workers</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="occupation" value="Skilled Agricultural, Forestry and Fishery Workers" id="skilled"
          <?= ($draftData['occupation'] ?? '') === 'Skilled Agricultural, Forestry and Fishery Workers' ? 'checked' : '' ?>>
        <label class="form-check-label ms-1 text-dark" for="skilled">Skilled Agricultural, Forestry and Fishery Workers</label>
      </div>
    </div>

            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="occupation" value="Craft and Related Trade Workers" id="craft"
                  <?= ($draftData['occupation'] ?? '') === 'Craft and Related Trade Workers' ? 'checked' : '' ?>>
                <label class="form-check-label ms-1 text-dark" for="craft">Craft and Related Trade Workers</label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="occupation" value="Plant and Machinery Operators and Assemblers" id="plant"
                  <?= ($draftData['occupation'] ?? '') === 'Plant and Machinery Operators and Assemblers' ? 'checked' : '' ?>>
                <label class="form-check-label ms-1 text-dark" for="plant">Plant and Machinery Operators and Assemblers</label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="occupation" value="Elementary Occupations" id="elementary"
                  <?= ($draftData['occupation'] ?? '') === 'Elementary Occupations' ? 'checked' : '' ?>>
                <label class="form-check-label ms-1 text-dark" for="elementary">Elementary Occupations</label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="occupation" value="Armed Forces Occupations" id="armed"
                  <?= ($draftData['occupation'] ?? '') === 'Armed Forces Occupations' ? 'checked' : '' ?>>
                <label class="form-check-label ms-1 text-dark" for="armed">Armed Forces Occupations</label>
              </div>

              <div class="form-check d-flex align-items-center">
                <input class="form-check-input me-2" type="radio" name="occupation" value="Others" id="others"
                  <?= ($draftData['occupation'] ?? '') === 'Others' ? 'checked' : '' ?>>
                <label class="form-check-label me-2 text-dark" for="others">Others, specify:</label>
                <input type="text" class="form-control form-control-sm" style="width: 150px;" name="occupation_others"
                  value="<?= htmlspecialchars($draftData['occupation_others'] ?? '') ?>">
              </div>
            </div>
          </div>
        </div>

          <!-- Organization Info -->
      <div class="row g-2 mt-3">
        <label class="form-label fw-semibold text-primary mb-1" style="font-size: 1.2rem;">Organization Information:</label>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Organization Affiliated</label>
          <input class="form-control" name="organization_affiliated" value="<?= htmlspecialchars($draftData['organization_affiliated'] ?? '') ?>">
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Contact Person</label>
          <input class="form-control" name="contact_person" value="<?= htmlspecialchars($draftData['contact_person'] ?? '') ?>">
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Office Address</label>
          <input class="form-control" name="office_address" value="<?= htmlspecialchars($draftData['office_address'] ?? '') ?>">
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Tel No.</label>
          <input class="form-control" name="tel_no" value="<?= htmlspecialchars($draftData['tel_no'] ?? '') ?>">
        </div>
      </div>

          <div class="row g-3 mb-3">
      <label class="form-label fw-semibold text-primary mb-0" style="font-size: 1.2rem;">ID Reference No.:</label>

      <div class="col-md-3">
        <label for="sss_no" class="form-label fw-semibold">SSS No.</label>
        <input type="text" name="sss_no" id="sss_no" class="form-control"
          value="<?= htmlspecialchars($draftData['sss_no'] ?? '') ?>">
      </div>

      <div class="col-md-3">
        <label for="gsis_no" class="form-label fw-semibold">GSIS No.</label>
        <input type="text" name="gsis_no" id="gsis_no" class="form-control"
          value="<?= htmlspecialchars($draftData['gsis_no'] ?? '') ?>">
      </div>

      <div class="col-md-3">
        <label for="pagibig_no" class="form-label fw-semibold">Pag-ibig No.</label>
        <input type="text" name="pagibig_no" id="pagibig_no" class="form-control"
          value="<?= htmlspecialchars($draftData['pagibig_no'] ?? '') ?>">
      </div>

      <div class="col-md-3">
        <label for="philhealth_no" class="form-label fw-semibold">PhilHealth No.</label>
        <input type="text" name="philhealth_no" id="philhealth_no" class="form-control"
          value="<?= htmlspecialchars($draftData['philhealth_no'] ?? '') ?>">
      </div>
    </div>


    <!-- Family Background -->
    <div class="mt-4">
      <div class="row mb-1 align-items-end">
        <div class="col-md-3">
          <div class="fw-semibold text-primary" style="font-size: 1.20rem;">Family Background:</div>
        </div>
        <div class="col-md-3"><label class="form-label mb-0">Last Name</label></div>
        <div class="col-md-3"><label class="form-label mb-0">First Name</label></div>
        <div class="col-md-3"><label class="form-label mb-0">Middle Name</label></div>
      </div>

      <!-- Father's Name -->
      <div class="row g-2 align-items-center text-center">
        <div class="col-md-3"><label class="form-label" style="font-size: 0.95rem;">Father's Name:</label></div>
        <div class="col-md-3">
          <input type="text" name="father_last_name" id="father_last_name" class="form-control"
            value="<?= htmlspecialchars($draftData['father_last_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="father_first_name" id="father_first_name" class="form-control"
            value="<?= htmlspecialchars($draftData['father_first_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="father_middle_name" id="father_middle_name" class="form-control"
            value="<?= htmlspecialchars($draftData['father_middle_name'] ?? '') ?>">
        </div>
      </div>

      <!-- Mother's Name -->
      <div class="row g-2 align-items-end text-center mt-2">
        <div class="col-md-3"><label class="form-label" style="font-size: 0.95rem;">Mother's Name:</label></div>
        <div class="col-md-3">
          <input type="text" name="mother_last_name" id="mother_last_name" class="form-control"
            value="<?= htmlspecialchars($draftData['mother_last_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="mother_first_name" id="mother_first_name" class="form-control"
            value="<?= htmlspecialchars($draftData['mother_first_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="mother_middle_name" id="mother_middle_name" class="form-control"
            value="<?= htmlspecialchars($draftData['mother_middle_name'] ?? '') ?>">
        </div>
      </div>

      <!-- Guardian's Name -->
      <div class="row g-2 align-items-end text-center mt-2">
        <div class="col-md-3"><label class="form-label" style="font-size: 0.95rem;">Guardian's Name:</label></div>
        <div class="col-md-3">
          <input type="text" name="guardian_last_name" id="guardian_last_name" class="form-control"
            value="<?= htmlspecialchars($draftData['guardian_last_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="guardian_first_name" id="guardian_first_name" class="form-control"
            value="<?= htmlspecialchars($draftData['guardian_first_name'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <input type="text" name="guardian_middle_name" id="guardian_middle_name" class="form-control"
            value="<?= htmlspecialchars($draftData['guardian_middle_name'] ?? '') ?>">
        </div>
      </div>
    </div>


      <div class="row g-3 mt-3 align-items-center">

<!-- Accomplished By -->
<div class="row g-3 mb-3">
  <div class="col-md-3" style="margin-top: -10px;">
    <label class="form-label fw-semibold text-primary mb-2" style="font-size: 1.2rem;">Accomplished By:</label>

    <div class="d-grid gap-3">
      <div class="form-check d-flex align-items-center">
        <input class="form-check-input me-2" type="radio" name="accomplished_by" id="applicant" value="Applicant"
          <?= ($draftData['accomplished_by'] ?? '') === 'Applicant' ? 'checked' : '' ?>>
        <label class="form-check-label fw-semibold" for="applicant">Applicant</label>
      </div>
      <div class="form-check d-flex align-items-center">
        <input class="form-check-input me-2" type="radio" name="accomplished_by" id="guardian" value="Guardian"
          <?= ($draftData['accomplished_by'] ?? '') === 'Guardian' ? 'checked' : '' ?>>
        <label class="form-check-label fw-semibold" for="guardian">Guardian</label>
      </div>
      <div class="form-check d-flex align-items-center">
        <input class="form-check-input me-2" type="radio" name="accomplished_by" id="rep" value="Representative"
          <?= ($draftData['accomplished_by'] ?? '') === 'Representative' ? 'checked' : '' ?>>
        <label class="form-check-label fw-semibold" for="rep">Representative</label>
      </div>
    </div>
  </div>

  <!-- Name Fields -->
  <div class="col-md-9">
    <div class="row fw-semibold mb-1">
      <label class="col-md-4">Last Name</label>
      <label class="col-md-4">First Name</label>
      <label class="col-md-4">Middle Name</label>
    </div>

    <!-- Applicant Row -->
    <div class="row g-2 mb-2 text-center" data-group="Applicant">
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_last_name_applicant"
          value="<?= htmlspecialchars($draftData['acc_last_name_applicant'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_first_name_applicant"
          value="<?= htmlspecialchars($draftData['acc_first_name_applicant'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_middle_name_applicant"
          value="<?= htmlspecialchars($draftData['acc_middle_name_applicant'] ?? '') ?>">
      </div>
    </div>

    <!-- Guardian Row -->
    <div class="row g-2 mb-2 text-center" data-group="Guardian">
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_last_name_guardian"
          value="<?= htmlspecialchars($draftData['acc_last_name_guardian'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_first_name_guardian"
          value="<?= htmlspecialchars($draftData['acc_first_name_guardian'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_middle_name_guardian"
          value="<?= htmlspecialchars($draftData['acc_middle_name_guardian'] ?? '') ?>">
      </div>
    </div>

    <!-- Representative Row -->
    <div class="row g-2 text-center" data-group="Representative">
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_last_name_rep"
          value="<?= htmlspecialchars($draftData['acc_last_name_rep'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_first_name_rep"
          value="<?= htmlspecialchars($draftData['acc_first_name_rep'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="acc_middle_name_rep"
          value="<?= htmlspecialchars($draftData['acc_middle_name_rep'] ?? '') ?>">
      </div>
    </div>
  </div>
</div>

      <!-- Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='form1.php'">Back</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

 <script>
  document.addEventListener('DOMContentLoaded', () => {
    const radios = document.querySelectorAll('input[name="accomplished_by"]');
    const rows = document.querySelectorAll('[data-group]');

    function updateRows() {
      const selected = document.querySelector('input[name="accomplished_by"]:checked')?.value;
      rows.forEach(row => {
        const group = row.getAttribute('data-group');
        row.querySelectorAll('input').forEach(input => {
          input.disabled = (group !== selected);
        });
      });
    }

    radios.forEach(radio => {
      radio.addEventListener('change', updateRows);
    });

    updateRows(); // Initialize on page load
  });
</script>
  </body>
  <script>
    const form = document.querySelector('form');
    form.addEventListener('input', () => {
      const formData = Object.fromEntries(new FormData(form));
      fetch('autosave.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'formData=' + encodeURIComponent(JSON.stringify(formData)) + '&step=2'
      });
    });
  </script>

  </html>
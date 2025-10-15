<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php';

// ✅ Check session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['applicant_id']) || !isset($_SESSION['application_id'])) {
    header("Location: ../../public/login_form.php");
    exit;
}

$applicant_id   = (int)$_SESSION['applicant_id'];
$application_id = (int)$_SESSION['application_id'];

// ✅ Resolve application type (url -> post -> session)
$type = strtolower($_GET['type'] ?? $_POST['type'] ?? ($_SESSION['application_type'] ?? 'new'));
if ($type === 'renewal') $type = 'renew';
if (!in_array($type, ['new','renew','lost'], true)) $type = 'new';
$_SESSION['application_type'] = $type;

// ✅ Load draft data using application_id
$step = 3;
$draftData = loadDraftData($step, $application_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    saveDraftData($step, $_POST, $application_id);

    if (($_POST['nav'] ?? '') === 'back') {
        header("Location: form2.php?type=" . urlencode($type));
        exit;
    }
    header("Location: form4.php?type=" . urlencode($type));
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

  <div class="form-header">
    <h1 class="form-title">PWD Application Form - Step 3</h1>
    <div class="step-indicator-wrapper">
      <div class="step-indicator">
        <div class="step"><div class="circle">1</div><div class="label">Personal Information</div></div>
        <div class="step"><div class="circle">2</div><div class="label">Affiliation Section</div></div>
        <div class="step active"><div class="circle">3</div><div class="label">Approval Section</div></div>
        <div class="step"><div class="circle">4</div><div class="label">Upload Documents</div></div>
        <div class="step"><div class="circle">5</div><div class="label">Submission Complete</div></div>
      </div>
    </div>
  </div>

  <div class="form-container">
    <form method="POST">
      <!-- CHO-Filled Certification Section -->
      <div class="mb-3 border-start border-4 border-secondary bg-light rounded p-2 ps-3 fw-semibold text-secondary">
        TO BE FILLED OUT BY THE CITY HEALTH OFFICE (CHO)
      </div>

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <label class="form-label">Name of Certifying Physician:</label>
          <input type="text" class="form-control bg-light" name="certifying_physician"
            value="<?= htmlspecialchars($draftData['certifying_physician'] ?? '') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">License No.:</label>
          <input type="text" class="form-control bg-light" name="license_no"
            value="<?= htmlspecialchars($draftData['license_no'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Processing Officer:</label>
          <input type="text" class="form-control bg-light" name="processing_officer"
            value="<?= htmlspecialchars($draftData['processing_officer'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Approving Officer:</label>
          <input type="text" class="form-control bg-light" name="approving_officer"
            value="<?= htmlspecialchars($draftData['approving_officer'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Encoder:</label>
          <input type="text" class="form-control bg-light" name="encoder"
            value="<?= htmlspecialchars($draftData['encoder'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Reporting Unit (Office/Section):</label>
          <input type="text" class="form-control bg-light" name="reporting_unit"
            value="<?= htmlspecialchars($draftData['reporting_unit'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Control No.:</label>
          <input type="text" class="form-control bg-light" name="control_no"
            value="<?= htmlspecialchars($draftData['control_no'] ?? '') ?>" readonly>
        </div>
      </div>

      <!-- Emergency Contact Section -->
      <div class="mb-3 border-start border-4 border-primary bg-light rounded p-2 ps-3 fw-semibold text-primary">
        IN CASE OF EMERGENCY
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Contact Person’s Name:</label>
          <input type="text" class="form-control" name="contact_person_name"
            value="<?= htmlspecialchars($draftData['contact_person_name'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">Contact Person’s No.:</label>
          <input type="text" class="form-control" name="contact_person_no"
            value="<?= htmlspecialchars($draftData['contact_person_no'] ?? '') ?>">
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="d-flex justify-content-between">
  <button type="submit" name="nav" value="back" class="btn btn-outline-primary">Back</button>
  <button type="submit" name="nav" value="next" class="btn btn-primary px-4">Next</button>
</div>

    </form>
  </div>
</body>
</html>

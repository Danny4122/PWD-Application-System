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

$step = 4;
$draftData = loadDraftData($step, $application_id);

$type = $_SESSION['application_type'] ?? 'new';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    saveDraftData($step, $_POST, $application_id);

    // ✅ File upload handling
    $uploads = [
        'bodypic'      => 'bodypic_path',
        'barangaycert' => 'barangaycert_path',
        'medicalcert'  => 'medicalcert_path',
    ];

    if ($type === 'renewal') {
        $uploads['oldpwdid'] = 'old_pwd_id_path';
    }
    if ($type === 'lost') {
        $uploads['affidavit'] = 'affidavit_loss_path';
    }

    foreach ($uploads as $field => $column) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $filename = time() . '_' . basename($_FILES[$field]['name']);
            $targetPath = "../../uploads/" . $filename;
            move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath);

            $query = "UPDATE documentrequirements SET $column = $1 WHERE application_id = $2";
            pg_query_params($conn, $query, [$targetPath, $application_id]);
        }
    }

    header("Location: summary.php");
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
    <h1 class="form-title">PWD Application Form - Step 4 (<?= ucfirst($type) ?> Application)</h1>
  </div>

<div class="form-container" style="max-width: 800px;">
  <form method="POST" enctype="multipart/form-data">

    <!-- Whole Body Picture -->
    <div class="mb-4">
      <label class="form-label fw-semibold">Whole Body Picture:</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <input type="file" name="bodypic" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;">
      </div>
    </div>

    <!-- Barangay Certificate -->
    <div class="mb-4">
      <label class="form-label fw-semibold">Barangay Certificate:</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <input type="file" name="barangaycert" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;">
      </div>  
    </div>

    <!-- Medical Certificate -->
    <div class="mb-4">
      <label class="form-label fw-semibold">Medical Certificate:</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <input type="file" name="medicalcert" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;">
      </div>
    </div>

    <!-- Certificate from City Health Office (CHO) -->
    <div class="mb-4">
      <label class="form-label fw-semibold">Certificate from City Health Office (CHO):</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/1827/1827951.png" alt="Certificate Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Uploaded by CHO after verification</p>
        <input type="file" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;" disabled>
        <?php if (!empty($draftData['cho_cert_path'])): ?>
          <div class="mt-2">
            <a href="<?= htmlspecialchars($draftData['cho_cert_path']) ?>" target="_blank" class="btn btn-sm btn-success">
              View Certificate
            </a>
          </div>
        <?php else: ?>
          <div class="text-muted mt-2">Pending upload by CHO</div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Renewal Specific -->
    <?php if ($type === 'renew'): ?>
    <div class="mb-4">
      <label class="form-label fw-semibold">Old PWD ID:</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <input type="file" name="oldpwdid" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;">
      </div>
    </div>
    <?php endif; ?>

    <!-- Lost Specific -->
    <?php if ($type === 'lost'): ?>
    <div class="mb-4">
      <label class="form-label fw-semibold">Affidavit of Loss:</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <input type="file" name="affidavit" class="form-control mt-3" style="max-width: 300px; margin: 0 auto;">
      </div>
    </div>
    <?php endif; ?>

    <!-- Buttons -->
    <div class="d-flex justify-content-between mt-4">
      <a href="form3.php?type=<?= $type ?>" class="btn btn-outline-primary">Back</a>
      <button type="submit" class="btn btn-primary px-4">Submit</button>
    </div>

  </form>
</div>

</body>
</html>

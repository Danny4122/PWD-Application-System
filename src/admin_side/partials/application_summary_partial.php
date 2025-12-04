<?php
// partial: expects $draftData array in scope
// Defensive helpers
function safe($k, $default = 'N/A') {
    global $draftData;
    if (!isset($draftData[$k]) || $draftData[$k] === '') return $default;
    return htmlspecialchars($draftData[$k], ENT_QUOTES, 'UTF-8');
}
function safeDate($k) {
    global $draftData;
    $v = $draftData[$k] ?? null;
    if (!$v) return '';
    $ts = strtotime($v);
    return $ts ? date('Y-m-d', $ts) : htmlspecialchars($v);
}
?>
<!-- BEGIN read-only form summary (same layout as client form5, but static) -->
<main class="form-container">
  <div class="card p-4 mb-4">
    <h4 class="mb-3">Application Summary</h4>

    <div class="row g-3 mb-3">
      <div class="col-md-3">
        <label class="form-label fw-semibold">Applicant Type</label>
        <div class="form-control bg-light"><?= safe('application_type','N/A') ?></div>
      </div>
      <div class="col-md-4">
        <label class="form-label fw-semibold">PWD Number</label>
        <div class="form-control bg-light"><?= safe('pwd_number','To be filled by PDAO') ?></div>
      </div>
      <div class="col-md-3">
        <label class="form-label fw-semibold">Date Applied</label>
        <div class="form-control bg-light"><?= safe('application_date','') ?></div>
      </div>
      <div class="col-md-2 text-center">
        <label class="form-label fw-semibold">Photo</label><br>
        <?php if (!empty($draftData['pic_1x1_path'])): ?>
          <img src="<?= htmlspecialchars($draftData['pic_1x1_path']) ?>" class="img-thumbnail" width="120" alt="Applicant photo">
        <?php else: ?>
          <span class="text-muted">Not uploaded</span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Basic name rows -->
    <div class="row g-3 mb-3">
      <div class="col-md-3"><label class="form-label">Last Name</label><div class="form-control bg-light"><?= safe('last_name') ?></div></div>
      <div class="col-md-3"><label class="form-label">First Name</label><div class="form-control bg-light"><?= safe('first_name') ?></div></div>
      <div class="col-md-3"><label class="form-label">Middle Name</label><div class="form-control bg-light"><?= safe('middle_name','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Suffix</label><div class="form-control bg-light"><?= safe('suffix','') ?></div></div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-3"><label class="form-label">Date of Birth</label><div class="form-control bg-light"><?= safe('birthdate','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Sex</label><div class="form-control bg-light"><?= safe('sex','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Civil Status</label><div class="form-control bg-light"><?= safe('civil_status','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Type of Disability</label><div class="form-control bg-light"><?= safe('disability_type','') ?></div></div>
    </div>

    <!-- Cause + address -->
    <div class="row g-3 mb-3">
      <div class="col-md-3">
        <label class="form-label">Cause of Disability</label>
        <div class="form-control bg-light"><?= safe('cause_description', safe('cause','')) ?></div>
      </div>
      <div class="col-md-3"><label class="form-label">House No. & Street</label><div class="form-control bg-light"><?= safe('house_no_street','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Barangay</label><div class="form-control bg-light"><?= safe('barangay','') ?></div></div>
      <div class="col-md-3"><label class="form-label">Municipality</label><div class="form-control bg-light"><?= safe('municipality','') ?></div></div>
    </div>

    <!-- rest of fields simplified -->
    <div class="row g-3 mb-3">
      <div class="col-md-3"><label class="form-label">Province</label><div class="form-control bg-light"><?= safe('province') ?></div></div>
      <div class="col-md-3"><label class="form-label">Region</label><div class="form-control bg-light"><?= safe('region') ?></div></div>
      <div class="col-md-3"><label class="form-label">Landline No.</label><div class="form-control bg-light"><?= safe('landline_no','N/A') ?></div></div>
      <div class="col-md-3"><label class="form-label">Mobile No.</label><div class="form-control bg-light"><?= safe('mobile_no','N/A') ?></div></div>
    </div>

    <div class="mb-3"><label class="form-label">E-mail Address:</label><div class="form-control bg-light"><?= safe('email_address','N/A') ?></div></div>

    <!-- Files -->
    <div class="mb-3">
      <h6>Files</h6>
      <?php if (!empty($draftData['files']) && is_array($draftData['files'])): ?>
        <ul class="list-unstyled">
          <?php foreach($draftData['files'] as $f): ?>
            <li class="py-2 border-bottom d-flex justify-content-between">
              <div>
                <div class="fw-semibold"><?= htmlspecialchars($f['label']) ?></div>
                <div class="small text-muted"><?= htmlspecialchars(basename(parse_url($f['path'], PHP_URL_PATH) ?: $f['path'])) ?></div>
              </div>
              <div>
                <a class="link-primary me-2" href="<?= htmlspecialchars($f['path']) ?>" target="_blank">View</a>
                <a class="link-primary" href="<?= htmlspecialchars($f['path']) ?>" download>Download</a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div class="text-muted">No files uploaded.</div>
      <?php endif; ?>
    </div>

  </div>
</main>
<!-- END partial -->

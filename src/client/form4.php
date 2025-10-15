<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['applicant_id']) || !isset($_SESSION['application_id'])) {
    header("Location: ../../public/login_form.php");
    exit;
}

$applicant_id   = $_SESSION['applicant_id'];
$application_id = $_SESSION['application_id'];

$step = 4;
$draftData = loadDraftData($step, $application_id);

// after $draftData = loadDraftData($step, $application_id);
$docRes = pg_query_params(
  $conn,
  "SELECT bodypic_path, barangaycert_path, medicalcert_path, old_pwd_id_path, affidavit_loss_path, cho_cert_path
   FROM documentrequirements
   WHERE application_id = $1
   LIMIT 1",
  [$application_id]
);
if ($docRes && pg_num_rows($docRes) > 0) {
  $docRow = pg_fetch_assoc($docRes);
  $draftData = array_merge($draftData ?? [], $docRow ?: []);
}



    // normalize type to: new | renew | lost
    $type = strtolower($_SESSION['application_type'] ?? 'new');
    if ($type === 'renewal') $type = 'renew';
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // ---------- Save draft (fields) ----------
        saveDraftData($step, $_POST, $application_id);

        // ---------- File fields mapping ----------
        $uploads = [
            'barangaycert' => 'barangaycert_path',
            'medicalcert'  => 'medicalcert_path',
        ];
        if ($type === 'new') {
            $uploads['bodypic'] = 'bodypic_path';
        }
        if ($type === 'renew') {
            $uploads['oldpwdid'] = 'old_pwd_id_path';
        }
        if ($type === 'lost') {
            $uploads['affidavit'] = 'affidavit_loss_path';
        }

        // ---------- Prepare upload dirs ----------
        $publicDir = "uploads";                       // what you store in DB (URL used by browser)
        $serverDir = realpath(__DIR__ . "/../../");   // project root
        $uploadAbs = $serverDir . DIRECTORY_SEPARATOR . $publicDir;
        if (!is_dir($uploadAbs)) { @mkdir($uploadAbs, 0775, true); }

        // ---------- Process each file field ----------
        foreach ($uploads as $field => $column) {
            $newPublicPath = null;                               // if a NEW file is uploaded we set this
            $postedPath    = trim($_POST[$column] ?? '');        // hidden input value (empty if "Remove" pressed)

            // If a new file is uploaded
            if (!empty($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $origName  = $_FILES[$field]['name'];
                $ext       = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $base      = preg_replace('/[^A-Za-z0-9._-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                $filename  = time() . '_' . $base . ($ext ? '.' . $ext : '');

                $destAbs   = $uploadAbs . DIRECTORY_SEPARATOR . $filename;  // server path
                if (!move_uploaded_file($_FILES[$field]['tmp_name'], $destAbs)) {
                    die("Failed to save file for {$field}.");
                }

                // Store browser-accessible path (relative URL to use in <img>/<a>)
            $newPublicPath = '/PWD-Application-System/uploads/' . $filename;  // leading slash
            }

            // Decide what to persist to DB:
            // 1) If new upload: use new public path
            // 2) Else if hidden has a path: keep it
            // 3) Else: NULL (removed)
            $valueToSave = $newPublicPath ?? ($postedPath !== '' ? $postedPath : null);

            // --- Try UPDATE first
            $upd = pg_query_params(
                $conn,
                'UPDATE documentrequirements
                SET ' . $column . ' = $1, updated_at = NOW()
                WHERE application_id = $2',
                [$valueToSave, $application_id]
            );

            // --- If no row was updated, INSERT a new one with the column set
            if ($upd && pg_affected_rows($upd) === 0) {
                pg_query_params(
                    $conn,
                    'INSERT INTO documentrequirements (application_id, ' . $column . ', created_at, updated_at)
                    VALUES ($1, $2, NOW(), NOW())',
                    [$application_id, $valueToSave]
                );
            }
        } // end foreach

        // Continue your flow (e.g., redirect)
        if (($_POST['nav'] ?? '') === 'back') {
            header('Location: form3.php?type=' . urlencode($type));
            exit;
        }

        // default: forward
        header('Location: form5.php?type=' . urlencode($type)); 
        exit;
    } // end POST

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
        <h1 class="form-title">PWD Application Form - Step 4 (<?= htmlspecialchars(ucfirst($type)) ?> Application)</h1>
      </div>

      <div class="form-container" style="max-width: 800px;">
        <form method="POST" enctype="multipart/form-data">

          <?php
          // helper: is image
          function is_image_ext($p) {
              $e = strtolower(pathinfo((string)$p, PATHINFO_EXTENSION));
              return in_array($e, ['jpg','jpeg','png','gif','webp']);
          }
          ?>

    <!-- ================= WHOLE BODY PICTURE (jpg/png only) ================= -->
    <?php if ($type === 'new'): ?>
    <?php $hasBody = !empty($draftData['bodypic_path'] ?? ''); ?>
    <div class="mb-4">
      <label class="form-label fw-semibold">Whole Body Picture (JPG/PNG only):</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <!-- Placeholder -->
        <div id="bodypicPlaceholder"
            style="<?= $hasBody ? 'display:none;' : '' ?>; cursor:pointer"
            onclick="document.getElementById('bodypic').click()">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="" width="60" class="mb-2" />
          <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
          <div class="small text-muted">No file selected</div>
        </div>


        <!-- Preview state (when there is a file) -->
        <div id="bodypicPreviewWrap" style="<?= $hasBody ? '' : 'display:none;' ?>">
          <img id="bodypicPreview"
              src="<?= ($hasBody && is_image_ext($draftData['bodypic_path'])) ? htmlspecialchars($draftData['bodypic_path']) : '' ?>"
              style="max-height:240px; margin-top:20px; <?= ($hasBody && is_image_ext($draftData['bodypic_path'])) ? '' : 'display:none;' ?> object-fit:contain;"
              alt="">
          <div class="small text-muted mt-2" id="bodypicFileName">
            <?= $hasBody ? htmlspecialchars(basename($draftData['bodypic_path'])) : '' ?>
          </div>
          <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeFile('bodypic', event)">Remove</button>
        </div>
      </div>

      <input type="hidden" id="bodypic_path" name="bodypic_path" value="<?= htmlspecialchars($draftData['bodypic_path'] ?? '') ?>">
      <!-- ✅ Only JPG/PNG -->
      <input type="file" id="bodypic" name="bodypic" accept=".jpg,.jpeg,.png" class="d-none">
    </div>
    <?php endif; ?>


    <?php $hasBarangay = !empty($draftData['barangaycert_path'] ?? ''); ?>

    <!-- ================= BARANGAY CERTIFICATE (jpg/png OR any file) ================= -->
    <?php $hasBarangay = !empty($draftData['barangaycert_path'] ?? ''); ?>
    <div class="mb-4">
      <label class="form-label fw-semibold">Barangay Certificate (JPG/PNG or File):</label>
      <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
        <!-- Placeholder -->
        <div id="barangaycertPlaceholder"
            style="<?= $hasBarangay ? 'display:none;' : '' ?>; cursor:pointer"
            onclick="document.getElementById('barangaycert').click()">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="" width="50" class="mb-2" />
          <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
          <div class="small text-muted">No file selected</div>
        </div>

        <!-- Preview section (shown when there's a file) -->
        <div id="barangaycertPreviewWrap" style="<?= $hasBarangay ? '' : 'display:none;' ?>">
          <img id="barangaycertPreview"
              src="<?= ($hasBarangay && is_image_ext($draftData['barangaycert_path'])) ? htmlspecialchars($draftData['barangaycert_path']) : '' ?>"
              style="max-height:80px; margin-top:6px; <?= ($hasBarangay && is_image_ext($draftData['barangaycert_path'])) ? '' : 'display:none;' ?>"
              alt="">

          <div class="small text-muted mt-2" id="barangaycertFileName">
            <?= $hasBarangay ? htmlspecialchars(basename($draftData['barangaycert_path'])) : '' ?>
          </div>

          <button type="button" class="btn btn-sm btn-danger mt-2"
                  onclick="removeBarangayCert(event)">Remove</button>
        </div>
      </div>

      <input type="hidden" id="barangaycert_path" name="barangaycert_path" value="<?= htmlspecialchars($draftData['barangaycert_path'] ?? '') ?>">
      <!-- ✅ allow images or ANY file -->
      <input type="file" id="barangaycert" name="barangaycert"
       accept=".jpg,.jpeg,.png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
       class="d-none">
    </div>

  <!-- ================= MEDICAL CERTIFICATE (any file, no preview) ================= -->
  <?php $hasMedical = !empty($draftData['medicalcert_path'] ?? ''); ?>
  <div class="mb-4">
    <label class="form-label fw-semibold">Medical Certificate (File only):</label>
    <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
      <!-- Placeholder -->
      <div id="medicalcertPlaceholder"
          style="<?= $hasMedical ? 'display:none;' : '' ?>; cursor:pointer"
          onclick="document.getElementById('medicalcert').click()">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="" width="50" class="mb-2" />
        <p class="fw-semibold mb-1">Drag & Drop or Choose File</p>
        <div class="small text-muted">No file selected</div>
      </div>


      <!-- Preview -->
      <div id="medicalcertPreviewWrap" style="<?= $hasMedical ? '' : 'display:none;' ?>">
        <img id="medicalcertPreview"
            src="<?= ($hasMedical && is_image_ext($draftData['medicalcert_path'])) ? htmlspecialchars($draftData['medicalcert_path']) : '' ?>"
            style="max-height:240px; margin-top:20px; <?= ($hasMedical && is_image_ext($draftData['medicalcert_path'])) ? '' : 'display:none;' ?> object-fit:contain;" 
            alt="">
        <div class="small text-muted mt-2" id="medicalcertFileName">
          <?= $hasMedical ? htmlspecialchars(basename($draftData['medicalcert_path'])) : '' ?>
        </div>
        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeFile('medicalcert', event)">Remove</button>
      </div>
    </div>
    <input type="hidden" id="medicalcert_path" name="medicalcert_path" value="<?= htmlspecialchars($draftData['medicalcert_path'] ?? '') ?>">
    <!-- ✅ any file (PDF, DOC, etc.) -->
   <input type="file" id="medicalcert" name="medicalcert"
       accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/*"
       class="d-none">
  </div>

        <!-- CHO Certificate (read-only for applicants) -->
        <div class="mb-4">
          <label class="form-label fw-semibold">Certificate from City Health Office (CHO):</label>
          <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
            <img src="https://cdn-icons-png.flaticon.com/512/1827/1827951.png" width="50" class="mb-2" alt="">
            <p class="fw-semibold mb-1">Uploaded by CHO after verification</p>
            <?php if (!empty($draftData['cho_cert_path'])): ?>
              <div class="mt-2">
                <a href="<?= htmlspecialchars($draftData['cho_cert_path']) ?>" target="_blank" class="btn btn-sm btn-success">View Certificate</a>
              </div>
            <?php else: ?>
              <div class="text-muted mt-2">Pending upload by CHO</div>
            <?php endif; ?>
          </div>
          <input type="hidden" name="cho_cert_path" value="<?= htmlspecialchars($draftData['cho_cert_path'] ?? '') ?>">
        </div>

      <!-- Renewal only -->
      <?php if ($type === 'renew'): ?>
      <?php $hasOld = !empty($draftData['old_pwd_id_path'] ?? ''); ?>
      <div class="mb-4">
        <label class="form-label fw-semibold">Old PWD ID (File only):</label>
        <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
          <!-- Placeholder -->
          <div id="oldpwdidPlaceholder"
              style="<?= $hasOld ? 'display:none;' : '' ?>; cursor:pointer"
              onclick="document.getElementById('oldpwdid').click()">
            <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" width="50" class="mb-2" alt="">
            <p class="fw-semibold mb-1">Drag &amp; Drop or Choose File</p>
            <div class="small text-muted">No file selected</div>
          </div>

          <!-- Filename only (no image preview) -->
          <div id="oldpwdidPreviewWrap" style="<?= $hasOld ? '' : 'display:none;' ?>">
            <div class="small text-muted mt-2" id="oldpwdidFileName">
              <?= $hasOld ? htmlspecialchars(basename($draftData['old_pwd_id_path'])) : '' ?>
            </div>
                <button type="button" class="btn btn-sm btn-danger mt-2"
            onclick="removeFile('oldpwdid', event, 'old_pwd_id_path')">Remove</button>
          </div>
        </div>

        <input type="hidden" id="old_pwd_id_path" name="old_pwd_id_path" value="<?= htmlspecialchars($draftData['old_pwd_id_path'] ?? '') ?>">
        <!-- Allow image or PDF (same as before). If you want ANY file, widen accept. -->
        <input type="file" id="oldpwdid" name="oldpwdid" accept="image/*,application/pdf" class="d-none">
      </div>
      <?php endif; ?>


      <!-- Lost only -->
      <?php if ($type === 'lost'): ?>
      <?php $hasAff = !empty($draftData['affidavit_loss_path'] ?? ''); ?>
      <div class="mb-4">
        <label class="form-label fw-semibold">Affidavit of Loss (File only):</label>
        <div class="upload-box text-center p-4 border rounded bg-light shadow-sm">
          <!-- Placeholder -->
          <div id="affidavitPlaceholder"
              style="<?= $hasAff ? 'display:none;' : '' ?>; cursor:pointer"
              onclick="document.getElementById('affidavit').click()">
            <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" width="50" class="mb-2" alt="">
            <p class="fw-semibold mb-1">Drag &amp; Drop or Choose File</p>
            <div class="small text-muted">No file selected</div>
          </div>

          <!-- Filename only (no image preview) -->
          <div id="affidavitPreviewWrap" style="<?= $hasAff ? '' : 'display:none;' ?>">
            <div class="small text-muted mt-2" id="affidavitFileName">
              <?= $hasAff ? htmlspecialchars(basename($draftData['affidavit_loss_path'])) : '' ?>
            </div>
            <button type="button" class="btn btn-sm btn-danger mt-2"
            onclick="removeFile('affidavit', event, 'affidavit_loss_path')">Remove</button>
          </div>
        </div>

        <input type="hidden" id="affidavit_loss_path" name="affidavit_loss_path" value="<?= htmlspecialchars($draftData['affidavit_loss_path'] ?? '') ?>">
        <!-- Allow image or PDF (same as before). If you want ANY file, widen accept. -->
        <input type="file" id="affidavit" name="affidavit" accept="image/*,application/pdf" class="d-none">
      </div>
      <?php endif; ?>


        <!-- Buttons -->
        <div class="d-flex justify-content-between mt-4">
        <button type="submit" name="nav" value="back" class="btn btn-outline-primary">Back</button>
        <button type="submit" name="nav" value="next" class="btn btn-primary px-4">Save & Continue</button>
      </div>




        </form>
      </div>
    <script>
    (function initUploads(){
    setupUploadWithRemove('bodypic');
    setupUploadWithRemove('barangaycert');
    setupUploadWithRemove('medicalcert');
    setupUploadWithRemove('oldpwdid');   // ✅ add this
    setupUploadWithRemove('affidavit');  // ✅ add this
  })();

    function setupUploadWithRemove(baseId){
      const fileInput   = document.getElementById(baseId);
      const hiddenPath  = document.getElementById(baseId + '_path');
      const ph          = document.getElementById(baseId + 'Placeholder');
      const wrap        = document.getElementById(baseId + 'PreviewWrap');
      const img         = document.getElementById(baseId + 'Preview');
      const nameEl      = document.getElementById(baseId + 'FileName');

      if (!fileInput) return;

      fileInput.addEventListener('change', function(){
        const file = this.files && this.files[0];
        if (!file) return;

        ph.style.display = 'none';
        wrap.style.display = '';

        nameEl.textContent = file.name;

        if (img) {
          if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
              img.src = e.target.result;
              img.style.display = '';
            };
            reader.readAsDataURL(file);
          } else {
            img.src = '';
            img.style.display = 'none';
          }
        }

        hiddenPath.value = '';
      });
    }

    function removeFile(baseId, ev){
      if (ev && ev.stopPropagation) ev.stopPropagation();

      const fileInput   = document.getElementById(baseId);
      const hiddenPath  = document.getElementById(baseId + '_path');
      const ph          = document.getElementById(baseId + 'Placeholder');
      const wrap        = document.getElementById(baseId + 'PreviewWrap');
      const img         = document.getElementById(baseId + 'Preview');
      const nameEl      = document.getElementById(baseId + 'FileName');

      fileInput.value = '';
      hiddenPath.value = '';
      if (img) { img.src = ''; img.style.display = 'none'; }
      if (nameEl) nameEl.textContent = '';

      wrap.style.display = 'none';
      ph.style.display = '';
    }
    </script>


      <script>
      document.addEventListener('DOMContentLoaded', () => {
        function attachFilePreview(inputId, nameId, previewImgId) {
          const input = document.getElementById(inputId);
          if (!input) return;

          const nameEl = document.getElementById(nameId);
          const imgEl  = previewImgId ? document.getElementById(previewImgId) : null;

          input.addEventListener('change', () => {
            if (!input.files || !input.files[0]) {
              if (nameEl) nameEl.textContent = 'No file selected';
              if (imgEl) { imgEl.style.display = 'none'; imgEl.removeAttribute('src'); }
              return;
            }
            const f = input.files[0];
            if (nameEl) nameEl.textContent = f.name;

            if (imgEl) {
              if (f.type && f.type.startsWith('image/')) {
                imgEl.src = URL.createObjectURL(f);
                imgEl.style.display = 'block';
              } else {
                imgEl.style.display = 'none';
                imgEl.removeAttribute('src');
              }
            }
          });
        }

        attachFilePreview('bodypic',      'bodypicFileName',      'bodypicPreview');
        attachFilePreview('barangaycert', 'barangaycertFileName', 'barangaycertPreview');
        attachFilePreview('medicalcert',  'medicalcertFileName',  'medicalcertPreview');
        attachFilePreview('oldpwdid',     'oldpwdidFileName',     'oldpwdidPreview');
        attachFilePreview('affidavit',    'affidavitFileName',    'affidavitPreview');
      });
      </script>
    </body>
    </html>

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
    <h1 class="form-title">PWD Application Form</h1>
    <div class="step-indicator-wrapper">
      <div class="step-indicator">
        <div class="step">
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
        <div class="step active">
          <div class="circle">4</div>
          <div class="label">Upload Documents</div>
        </div>
        <div class="step">
          <div class="circle">5</div>
          <div class="label">Submission Complete</div>
        </div>
      </div>
    </div>
  </div>


  <div class="container my-4 p-5 bg-white rounded shadow-sm" style="max-width: 700px;">
    <form>
      <!-- Affidavit of Loss Upload -->
      <div class="mb-4">
        <label for="affidavitLoss" class="form-label fw-semibold">
          Upload Affidavit of Loss
          <span class="fw-normal">(Signed and Notarized by an Attorney)</span>
        </label>
        <div id="drop-area-affidavit" class="drop-area upload-box rounded d-flex flex-column justify-content-center align-items-center text-center p-2" style="height: 230px;">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" class="mb-2" width="50"/>
          <div class="fw-semibold mb-1">Upload a Photo</div>
          <div class="text-muted indicator mb-3">Drag and drop files here</div>
          <input id="affidavitLoss" name="affidavitLoss" type="file" accept="image/*,.pdf" class="form-control" style="max-width: 300px;"/>
        </div>
      </div>

      <div class="mb-4">
        <label for="wholeBodyPic" class="form-label">Upload 1 whole body picture:</label>
        <div class="upload-box drop-area rounded d-flex flex-column justify-content-center align-items-center text-center p-3 mb-2" style="height: 230px;">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="" class="mb-1" />
          <div class="fw-semibold mb-1">Upload a Photo</div>
          <div class="text-muted indicator mb-2">Drag and drop files here</div>
          <input id="wholeBodyPic" name="wholeBodyPic" type="file" accept="image/*"
                 class="form-control" style="max-width: 300px;" />
        </div>
      </div>

      <!-- Barangay Certificate -->
      <div class="mb-4">
        <label for="barangayCert" class="form-label">
          Upload Barangay Certificate of Residency / Certificate of Indigency:
        </label>
        <div class="upload-box drop-area rounded d-flex flex-column justify-content-center align-items-center text-center p-3 mb-2" style="height: 230px;">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" class="mb-1" />
          <div class="fw-semibold mb-1">Upload a Photo</div>
          <div class="text-muted indicator mb-2">Drag and drop files here</div>
          <input id="barangayCert" name="barangayCert" type="file" accept="image/*" class="form-control" style="max-width: 300px;" />
        </div>
      </div>

      <!-- Medical Certificate -->
      <div class="mb-4">
        <label for="medicalCert" class="form-label">Upload Medical Certificate:</label>
        <div class="upload-box drop-area rounded d-flex flex-column justify-content-center align-items-center text-center p-3 mb-2" style="height: 230px;">
          <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" class="mb-1" />
          <div class="fw-semibold mb-1">Upload a Photo</div>
          <div class="text-muted indicator mb-2">Drag and drop files here</div>
          <input id="medicalCert" name="medicalCert" type="file" accept="image/*" class="form-control" style="max-width: 300px;" />
        </div>
      </div>

      <!-- Proof of Disability -->
      <div class="mb-4">
        <label for="proofDisability" class="form-label">Upload Proof of Disability (PHOTO):</label>
        <div class="upload-box drop-area rounded d-flex flex-column justify-content-center align-items-center text-center p-3 mb-2" style="height: 230px;">
          <img src="/assets/pictures/add-image.png" alt="Upload Icon" class="mb-1" />
          <div class="fw-semibold mb-1">Upload a Photo</div>
          <div class="text-muted indicator mb-2">Drag and drop files here</div>
          <input id="proofDisability" name="proofDisability" type="file" accept="image/*" class="form-control" style="max-width: 300px;" />
        </div>
      </div>

      <!-- Buttons -->
      <div class="d-flex justify-content-between mt-5">
        <button type="button" class="btn btn-secondary">Back</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </div>

    <script>
      document.querySelectorAll('.drop-area').forEach(dropArea => {
        const input = dropArea.querySelector('input[type="file"]');
        input.addEventListener('click', e => e.stopPropagation());
        ['dragenter','dragover','dragleave','drop'].forEach(evt =>
          dropArea.addEventListener(evt, e => {
            e.preventDefault();
            e.stopPropagation();
          })
        );
        dropArea.addEventListener('dragover', () => dropArea.classList.add('drag-over'));
        dropArea.addEventListener('dragleave', () => dropArea.classList.remove('drag-over'));
        dropArea.addEventListener('drop', e => {
          dropArea.classList.remove('drag-over');
          if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
          }
        });
        dropArea.addEventListener('click', () => input.click());
      });
    </script>

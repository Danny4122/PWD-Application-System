<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PWD Online Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/forms.css">

</head>

<body>
  <?php include __DIR__ . '/../../hero/navbar.php'; ?>

  <div class="container">
    <h1 class="form-title">PWD Application Form</h1>

    <!-- Step Indicator -->
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

    <!-- Form Section -->
    <div class="form-container" style="max-width: 800px;">
      <form>
        <div class="mb-4">
          <label for="wholeBodyPic" class="form-label">Upload 1 whole body picture:</label>
          <div class="upload-box">
            <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50"
              class="mb-1" />
            <div class="fw-semibold mb-1">Upload a Photo</div>
            <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
            <input id="wholeBodyPic" name="wholeBodyPic" type="file" class="form-control mt-3"
              style="max-width: 300px;" />
          </div>
        </div>

        <div class="mb-4">
          <label for="barangayCert" class="form-label">Upload Barangay Certificate of Residency / Certificate of
            Indigency:</label>
          <div class="upload-box">
            <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50"
              class="mb-1" />
            <div class="fw-semibold mb-1">Upload a Photo</div>
            <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
            <input id="barangayCert" name="barangayCert" type="file" class="form-control mt-3"
              style="max-width: 300px;" />
          </div>
        </div>

        <div class="mb-4">
          <label for="medicalCert" class="form-label">Upload Medical Certificate:</label>
          <div class="upload-box">
            <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50"
              class="mb-1" />
            <div class="fw-semibold mb-1">Upload a Photo</div>
            <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
            <input id="medicalCert" name="medicalCert" type="file" class="form-control mt-3"
              style="max-width: 300px;" />
          </div>
        </div>

        <div class="mb-4">
          <label for="medicalCert" class="form-label">Upload Proof of Disability (PHOTO):</label>
          <div class="upload-box">
            <img src="/assets/add-image.png" alt="Upload Icon" width="50" class="mb-1" />
            <div class="fw-semibold mb-1">Upload a Photo</div>
            <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
            <input id="medicalCert" name="medicalCert" type="file" class="form-control mt-3"
              style="max-width: 300px;" />
          </div>
        </div>

        <div class="mb-4">
          <label for="medicalCert" class="form-label">Upload Proof of Disability (VIDEO):</label>
          <div class="upload-box text-center">
            <img src="/assets/upload.png" alt="Video Upload Icon" width="60" class="mb-1" />
            <div class="fw-semibold mb-1">Upload Video</div>
            <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
            <input id="medicalCert" name="medicalCert" type="file" class="form-control mt-3"
              style="max-width: 300px;" />
          </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-secondary">Back</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
</body>

</html>
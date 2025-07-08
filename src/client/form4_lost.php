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
    <div class="text-center">
      <label class="fw-semibold mb-1" style="font-size: 1.00rem;">
        Upload Affidavit of Loss
        <span class="fw-normal mb-1" style="font-size: 1.00rem;">(Signed and Notarized by an Attorney).</span>
      </label>


      <div class="rounded d-flex flex-column justify-content-center align-items-center text-center p-4 my-3"
        style="border: 2px dashed #ccc; background-color: #f8f9fa; height: 230px;">
        <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" alt="Upload Icon" width="50" class="mb-1" />
        <div class="fw-semibold mb-1">Upload a Photo</div>
        <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
        <input type="file" class="form-control mt-3" style="max-width: 300px;" />
      </div>


      <!-- Buttons -->
      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary">Back</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </div>

    <script>
      const dropArea = document.getElementById('drop-area');
      const fileInput = document.getElementById('fileElem');

      // Prevent default behavior for drag events
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => e.preventDefault(), false);
      });

      // Highlight drop area on dragover
      dropArea.addEventListener('dragover', () => {
        dropArea.classList.add('border-primary');
      });

      dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-primary');
      });

      dropArea.addEventListener('drop', (e) => {
        dropArea.classList.remove('border-primary');
        const files = e.dataTransfer.files;

        if (files.length > 0) {
          // Assign dropped files to input element
          fileInput.files = files;
          alert(`File dropped: ${files[0].name}`);
        }
      });
    </script>
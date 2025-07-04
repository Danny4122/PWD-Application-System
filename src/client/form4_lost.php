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

    .form-title {
      text-align: center;
      color: var(--primary-blue);
      font-size: 1.75rem;
      font-weight: 700;
      margin-top: 2rem;
    }

    .step-indicator-wrapper {
      width: 100%;
      display: flex;
      justify-content: center;
      margin: 2rem auto;
      position: relative;
    }

    .step-indicator {
      display: flex;
      justify-content: space-around;
      align-items: center;
      width: 100%;
      max-width: 700px;
      margin: 0 auto;
      position: relative;
    }

    .step:not(:last-child)::after {
      content: "";
      position: absolute;
      top: calc(var(--circle-size) / 2);
      left: 50%;
      width: 100%;
      height: 2px;
      background-color: var(--border-gray);
      z-index: 0;
    }

    .step {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
      z-index: 1;
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
      z-index: 2;
      padding: 0;
      margin: 0;
    }

    .step .label {
      color: var(--text-gray);
      font-size: 0.85rem;
      text-align: center;
      margin-top: 0.4rem;
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

    .upload-box {
    border: 2px dashed #ccc;
    border-radius: 6px;
    background-color: #f8f9fa;
    height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    transition: border-color 0.3s;
  }

  .upload-box.dragover {
    border-color: #007bff;
    background-color: #e9f5ff;
  }

  .upload-box img {
    width: 50px;
    margin-bottom: 10px;
  }
  </style>
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

  
    <div class="container my-4 p-5 bg-white rounded shadow-sm" style="max-width: 700px;" >
      <div class="text-center">
      <label class="fw-semibold mb-1" style="font-size: 1.00rem;">
        Upload Affidavit of Loss 
        <span class="fw-normal mb-1" style="font-size: 1.00rem;">(Signed and Notarized by an Attorney).</span>
      </label>
   

   <div class="rounded d-flex flex-column justify-content-center align-items-center text-center p-4 my-3"
     style="border: 2px dashed #ccc; background-color: #f8f9fa; height: 230px;">
      <img src="https://cdn-icons-png.flaticon.com/512/892/892692.png" 
          alt="Upload Icon" width="50" class="mb-1" />
      <div class="fw-semibold mb-1">Upload a Photo</div>
      <div class="text-muted" style="font-size: 0.85rem;">Drag and drop files here</div>
      <input type="file" class="form-control mt-3" style="max-width: 300px;"/>
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
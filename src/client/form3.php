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

    .form-check-input:checked {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
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
        <div class="step active">
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
  </div>

  <div class="form-container">
    <form>
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <label class="form-label">Name of Certifying Physician:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">License No.:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Processing Officer:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Approving Officer:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Encoder:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Name of Reporting Unit (Office/Section):</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Control No.:</label>
          <input type="text" class="form-control">
        </div>
      </div>

      <div class="mb-3 border-start border-4 border-primary bg-light rounded p-2 ps-3 fw-semibold text-primary">
        IN CASE OF EMERGENCY
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Contact Person’s Name:</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Contact Person’s No.:</label>
          <input type="text" class="form-control">
        </div>
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-primary">Back</button>
        <button type="submit" class="btn btn-primary px-4">Next</button>
      </div>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
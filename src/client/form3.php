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
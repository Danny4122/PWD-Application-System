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
        <div class="step">
          <div class="circle">4</div>
          <div class="label">Upload Documents</div>
        </div>
        <div class="step active">
          <div class="circle">5</div>
          <div class="label">Submission Complete</div>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-4">
    <div class="p-5 rounded-3 shadow bg-white" style="max-width: 720px; margin: 0 auto;">
      <h4 class="text-success fw-bold mb-3">Your application has been successfully submitted!</h4>
      <p class="mb-1 fw-bold">
        Your application is now under initial review by the PDAO office.
      </p>
      <p class="mb-4">
        Once your application is approved, you will proceed to the next step:
      </p>
      <p class="mb-2 fw-bold">Next Step: CHO Verification</p>
      <p class="mb-4">
        To continue with the application process, please proceed to the
        <strong>City Health Office (CHO)</strong> for an in-person assessment of your disability.
      </p>

      <div class="mb-3">
        <p class="mb-1 fw-bold">Assessment Details:</p>
        <ul class="mb-2">
          <li><strong>When:</strong> Every Wednesday only</li>
          <li><strong>Contact Person:</strong> Dr. Taisha Rose Magadan Lisondra</li>
        </ul>
        <p class="mb-1">Please bring the following documents:</p>
        <ul>
          <li>A copy of your submitted medical certificate (if available)</li>
          <li>A valid government-issued ID</li>
          <li>Any other supporting documents related to your condition</li>
        </ul>
      </div>

      <div class="text-end">
        <a href="index.html" class="btn btn-primary px-3">Go back to Homepage</a>
      </div>
    </div>
  </div>

  </div>
  </div>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accepted Applicant Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f4f8fb;
      font-family: 'Segoe UI', sans-serif;
      color: #1e1e1e;
    }

    .card-header-gradient {
      background: linear-gradient(to right, #1F54DC, #2B26AA);
      color: white;
      border-radius: 1rem 1rem 0 0;
    }

    .card-header-gradient .avatar-icon {
      width: 60px;
      height: 60px;
      background: #ffffff;
      color: #2B26AA;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      font-size: 1.8rem;
    }

    .card-body-section {
      background: white;
      border-radius: 0 0 1rem 1rem;
      padding: 2.5rem;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    }

    .section h6 {
      font-weight: bold;
      color: #2B26AA;
      margin-bottom: 1rem;
      border-bottom: 2px solid #eee;
      padding-bottom: 8px;
    }

    .info-label {
      font-weight: 600;
      color: #555;
      margin-bottom: 5px;
    }

    .info-value {
      margin-bottom: 5px;
    }

    .document-preview {
      max-height: 150px;
      width: auto;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .btn-back {
      background-color: #2B26AA;
      color: white;
      border-radius: 50px;
      padding: 12px 30px;
      text-decoration: none;
      font-weight: 600;
    }

    .btn-back:hover {
      background-color: #1F54DC;
      color: white;
    }

    .badge {
      border-radius: 50px;
      font-weight: 600;
      padding: 0.5rem 1rem;
      font-size: 0.85rem;
    }

    .btn-edit {
      font-weight: 600;
    }

    .row.g-1 {
  row-gap: 0.5rem !important; 
}


    @media (max-width: 768px) {
      .card-header-gradient h4 {
        font-size: 1.3rem;
      }
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <!-- Header Card -->
    <div class="card border-0 shadow rounded-4">
      <div class="card-header-gradient d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 p-4">
        <div class="d-flex align-items-center gap-3">
          <div class="avatar-icon"><i class="bi bi-person-lines-fill"></i></div>
          <div>
            <h4 class="mb-1 fw-bold">Applicant Profile</h4>
            <p class="mb-0 small">Review of accepted applicant details</p>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-success">Accepted</span>
          <a href="edit_applicant.php?id=123" class="btn btn-light btn-sm btn-edit">
            <i class="bi bi-pencil-square me-1"></i> Edit
          </a>
        </div>
      </div>

      <!-- Body -->
      <div class="card-body-section">
        <!-- Personal Info -->
        <div class="section mb-4">
  <h6><i class="bi bi-person-fill me-1"></i>Personal Information</h6>
  <div class="row g-1"> <!-- added g-1 for tighter spacing -->
    <div class="col-md-6">
      <div class="info-label">Full Name</div>
      <div class="info-value">Danny Boy Loberanes Jr.</div>
    </div>
    <div class="col-md-6">
      <div class="info-label">Barangay</div>
      <div class="info-value">Dalipuga, Iligan City</div>
    </div>
    <div class="col-md-6">
      <div class="info-label">Birthdate</div>
      <div class="info-value">January 10, 1995</div>
    </div>
    <div class="col-md-6">
      <div class="info-label">Contact</div>
      <div class="info-value">0917 123 4567</div>
    </div>
  </div>
</div>

        <!-- Disability Info -->
        <div class="section mb-5">
          <h6><i class="bi bi-eyeglasses me-1"></i>Disability Details</h6>
          <div class="row">
            <div class="col-md-6">
              <div class="info-label">Type of Disability</div>
              <div class="info-value">Visual Impairment</div>
            </div>
            <div class="col-md-6">
              <div class="info-label">Cause</div>
              <div class="info-value">Congenital</div>
            </div>
          </div>
        </div>

        <!-- Documents -->
        <div class="section mb-5">
          <h6><i class="bi bi-folder2-open me-1"></i>Uploaded Requirements</h6>
          <div class="row">
            <div class="col-md-4 text-center">
              <div class="info-label">1x1 Photo</div>
              <img src="/uploads/photo.jpg" alt="1x1 ID Photo" class="img-fluid document-preview" />
            </div>
            <div class="col-md-4">
              <div class="info-label">Medical Certificate</div>
              <a href="/uploads/medical.pdf" target="_blank" class="text-primary fw-semibold">
                <i class="bi bi-file-earmark-pdf me-1"></i>View Document
              </a>
            </div>
            <div class="col-md-4">
              <div class="info-label">Barangay Certificate</div>
              <a href="/uploads/brgy.pdf" target="_blank" class="text-primary fw-semibold">
                <i class="bi bi-file-earmark-pdf me-1"></i>View Document
              </a>
            </div>
          </div>
        </div>

        <!-- Application Summary -->
        <div class="section">
          <h6><i class="bi bi-info-circle me-1"></i>Application Summary</h6>
          <div class="row">
            <div class="col-md-3">
              <div class="info-label">Application No.</div>
              <div class="info-value">PWD-2025-00123</div>
            </div>
            <div class="col-md-3">
              <div class="info-label">Date Submitted</div>
              <div class="info-value">June 10, 2025</div>
            </div>
            <div class="col-md-3">
              <div class="info-label">Date Approved</div>
              <div class="info-value">June 15, 2025</div>
            </div>
            <div class="col-md-3">
              <div class="info-label">Approved By</div>
              <div class="info-value">Admin Jane Doe</div>
            </div>
          </div>
        </div>

        <!-- Back Button -->
        <div class="text-center pt-4">
          <a href="accept.php" class="btn-back">
            <i class="bi bi-arrow-left-short me-1"></i>Back to Accepted List
          </a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
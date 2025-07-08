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

  <h1 class="form-title">PWD Application Form</h1>

  <div class="step-indicator-wrapper">
    <div class="step-indicator">
      <div class="step">
        <div class="circle">1</div>
        <div class="label">Personal Information</div>
      </div>
      <div class="step active">
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
      <div class="step">
        <div class="circle">5</div>
        <div class="label">Submission Complete</div>
      </div>
    </div>
  </div>

  <main class="form-container">
    <form novalidate>
      <div class="row g-2 align-items-start">
        <div class="col-md-4 pe-md-2">
          <div class="mb-2">
            <label class="form-label fw-semibold">Educational Attainment</label>
            <select class="form-select">
              <option>Please Select</option>
              <option>None</option>
              <option>Kindergarten</option>
              <option>Elementary</option>
              <option>Junior High School</option>
              <option>Senior High School</option>
              <option>College</option>
              <option>Vocational</option>
              <option>Post Graduate</option>
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label fw-semibold">Status of Employment</label>
            <select class="form-select">
              <option>Please Select</option>
              <option>Employed</option>
              <option>Unemployed</option>
              <option>Self-Employed</option>
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label fw-semibold">Category of Employment</label>
            <select class="form-select">
              <option>Please Select</option>
              <option>Government</option>
              <option>Private</option>
            </select>
          </div>
          <div class="mb-0">
            <label class="form-label fw-semibold">Types of Employment</label>
            <select class="form-select">
              <option>Please Select</option>
              <option>Permanent / Regular</option>
              <option>Seasonal</option>
              <option>Casual</option>
              <option>Emergency</option>
            </select>
          </div>
        </div>

        <!-- Right Column: Occupations -->
        <div class="col-md-8">
          <label class="form-label fw-semibold mb-2" style="font-size: 1.25rem;">Occupation</label>
          <div class="row g-0">
            <div class="col-md-6">
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="managers"><label
                  class="form-check-label ms-1 text-dark" for="managers">Managers</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="professionals"><label
                  class="form-check-label ms-1 text-dark" for="professionals">Professionals</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="tech"><label
                  class="form-check-label ms-1 text-dark" for="tech">Technicians and Associate Professionals</label>
              </div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="clerical"><label
                  class="form-check-label ms-1 text-dark" for="clerical">Clerical Support Workers</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="service"><label
                  class="form-check-label ms-1 text-dark" for="service">Service and Sales Workers</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="skilled"><label
                  class="form-check-label ms-1 text-dark" for="skilled">Skilled Agricultural, Forestry and Fishery
                  Workers</label></div>
            </div>

            <div class="col-md-6">
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="craft"><label
                  class="form-check-label ms-1 text-dark" for="craft">Craft and Related Trade Workers</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="plant"><label
                  class="form-check-label ms-1 text-dark" for="plant">Plant and Machinery Operators and
                  Assemblers</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="elementary"><label
                  class="form-check-label ms-1 text-dark" for="elementary">Elementary Occupations</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="occ" id="armed"><label
                  class="form-check-label ms-1 text-dark" for="armed">Armed Forces Occupations</label></div>
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input me-2 text-dark" type="radio" name="occ" id="others">
                <label class="form-check-label me-2 text-dark" for="others">Others, specify:</label>
                <input type="text" class="form-control form-control-sm" style="width: 150px;">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Organization Info -->
      <div class="row g-2 mt-3">
        <label class="form-label fw-semibold text-primary mb-1" style="font-size: 1.2rem;">Organization
          Information:</label>
        <div class="col-md-3"><label class="form-label fw-semibold">Organization Affiliated</label><input
            class="form-control"></div>
        <div class="col-md-3"><label class="form-label fw-semibold">Contact Person</label><input class="form-control">
        </div>
        <div class="col-md-3"><label class="form-label fw-semibold">Office Address</label><input class="form-control">
        </div>
        <div class="col-md-3"><label class="form-label fw-semibold">Tel No.</label><input class="form-control"></div>
      </div>

      <!-- ID Reference -->
      <div class="row g-3 mt-1">
        <label class="form-label fw-semibold text-primary mb-0" style="font-size: 1.2rem;">ID Reference No.:</label>
        <div class="col-md-3"><label class="form-label fw-semibold">SSS No.</label><input class="form-control"></div>
        <div class="col-md-3"><label class="form-label fw-semibold">GSIS No.</label><input class="form-control"></div>
        <div class="col-md-3"><label class="form-label fw-semibold">Pag-ibig No.</label><input class="form-control">
        </div>
        <div class="col-md-3"><label class="form-label fw-semibold">PhilHealth No.</label><input class="form-control">
        </div>
      </div>

      <!-- Family Background -->
      <div class="mt-4">
        <div class="row mb-1 align-items-end">
          <div class="col-md-3">
            <div class="fw-semibold text-primary" style="font-size: 1.20rem;">Family Background:</div>
          </div>
          <div class="col-md-3">
            <label class="form-label mb-0">Last Name</label>
          </div>
          <div class="col-md-3">
            <label class="form-label mb-0">First Name</label>
          </div>
          <div class="col-md-3">
            <label class="form-label mb-0">Middle Name</label>
          </div>
        </div>

        <div class="row g-2 align-items-center text-center">
          <div class="col-md-3">
            <label class="form-label" style="font-size: 0.95rem;">Father's Name:</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
        </div>

        <div class="row g-2 align-items-end text-center mt-2">
          <div class="col-md-3">
            <label class="form-label" style="font-size: 0.95rem;">Mother's Name:</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
        </div>

        <div class="row g-2 align-items-end text-center mt-2">
          <div class="col-md-3">
            <label class="form-label" style="font-size: 0.95rem;">Guardian's Name:</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder>
          </div>
        </div>
      </div>

      <div class="row g-3 mt-3 align-items-center">
        <!-- Accomplished By -->
        <div class="col-md-3" style="margin-top: -10px;">
          <label class="form-label fw-semibold text-primary mb-2" style="font-size: 1.2rem;">Accomplished By:</label>

          <div class="d-grid gap-3">
            <div class="form-check d-flex align-items-center">
              <input class="form-check-input me-2" type="radio" name="accomplished" id="applicant">
              <label class="form-check-label fw-semibold" for="applicant">Applicant</label>
            </div>
            <div class="form-check d-flex align-items-center">
              <input class="form-check-input me-2" type="radio" name="accomplished" id="guardian">
              <label class="form-check-label fw-semibold" for="guardian">Guardian</label>
            </div>
            <div class="form-check d-flex align-items-center">
              <input class="form-check-input me-2" type="radio" name="accomplished" id="rep">
              <label class="form-check-label fw-semibold" for="rep">Representative</label>
            </div>
          </div>
        </div>

        <!-- Name Fields -->
        <div class="col-md-9">
          <div class="row fw-semibold mb-1">
            <label class="col-md-4">Last Name</label>
            <label class="col-md-4">First Name</label>
            <label class="col-md-4">Middle Name</label>
          </div>

          <!-- Row 1 -->
          <div class="row g-2 mb-2 text-center">
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
          </div>

          <!-- Row 2 -->
          <div class="row g-2 mb-2 text-center">
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
          </div>

          <!-- Row 3 -->
          <div class="row g-2 text-center">
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder></div>
          </div>
        </div>
      </div>


      <!-- Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary">Back</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
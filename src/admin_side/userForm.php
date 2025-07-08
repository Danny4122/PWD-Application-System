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

  <h1 class="form-title">PWD Application Form</h1>

  <main class="form-container">
    <form novalidate>
      <!-- Row 1 -->
      <div class="row g-3 mb-3">
        <div class="col-md-3">
          <label class="form-label fw-semibold">Applicant Type</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="newApplicant" name="applicantType" required>
            <label class="form-check-label" for="newApplicant" style="color: black; font-size: 0.85rem;">New
              Applicant</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="renewal" name="applicantType">
            <label class="form-check-label" for="renewal" style="color: black; font-size: 0.85rem;">Renewal</label>
          </div>
        </div>
        <div class="col-md-4">
          <label for="pwdNumber" class="form-label fw-semibold">Persons with Disability Number</label>
          <input type="text" id="pwdNumber" class="form-control" placeholder="RR-PPMM-BBB-NNNNNNN" required>
        </div>
        <div class="col-md-3">
          <label for="dateApplied" class="form-label fw-semibold">Date Applied</label>
          <input type="date" id="dateApplied" class="form-control" required>
        </div>
        <div class="col-md-2">
          <div class="photo-box mx-auto">Upload Photo</div>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="row g-3 mb-3" style="margin-top: -55px;">
        <div class="col-md-3"><label for="lastName" class="form-label fw-semibold">Last Name</label><input type="text"
            id="lastName" class="form-control" required></div>
        <div class="col-md-3"><label for="firstName" class="form-label fw-semibold">First Name</label><input type="text"
            id="firstName" class="form-control" required></div>
        <div class="col-md-3"><label for="middleName" class="form-label fw-semibold">Middle Name</label><input
            type="text" id="middleName" class="form-control"></div>
        <div class="col-md-3"><label for="suffix" class="form-label fw-semibold">Suffix</label><input type="text"
            id="suffix" class="form-control"></div>
      </div>

      <!-- Row 3 -->
      <div class="row g-3 mb-3">
        <div class="col-md-3"><label for="dob" class="form-label fw-semibold">Date of Birth</label><input type="date"
            id="dob" class="form-control" required></div>
        <div class="col-md-3">
          <label for="sex" class="form-label fw-semibold">Sex</label>
          <select id="sex" class="form-select" required>
            <option value="">Please Select</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="civilStatus" class="form-label fw-semibold">Civil Status</label>
          <select id="civilStatus" class="form-select">
            <option value="">Please Select</option>
            <option>Single</option>
            <option>Separated</option>
            <option>Cohabitation (live-in) </option>
            <option>Married</option>
            <option>Widow/er</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="disabilityType" class="form-label fw-semibold">Type of Disability</label>
          <select id="disabilityType" class="form-select">
            <option value="">Please Select</option>
            <option>Deaf or Hard of Hearing</option>
            <option>Intellectual Disability </option>
            <option>Learning Disability </option>
            <option>Mental Disability</option>
            <option>Physical Disability (Orthopedic)</option>
            <option>Psychosocial Disability</option>
            <option>Speech and Language Impairment</option>
            <option>Visual Disability</option>
            <option>Cancer (RA11215)</option>
            <option>Rare Disease (RA10747)</option>
          </select>
        </div>
      </div>

      <!-- Row 4 -->
      <div class="row g-3 mb-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label fw-semibold text-primary">Cause of Disability</label>
          <div class="d-flex gap-3 mb-2" style="font-size: 0.75rem;">
            <div class="form-check mb-0">
              <input class="form-check-input" type="checkbox" id="causeCongenital" name="cause[]"
                value="Congenital / Inborn">
              <label class="form-check-label" for="causeCongenital">Congenital / Inborn</label>
            </div>
            <div class="form-check mb-0">
              <input class="form-check-input" type="checkbox" id="causeAcquired" name="cause[]" value="Acquired">
              <label class="form-check-label" for="causeAcquired">Acquired</label>
            </div>
          </div>
          <select id="cause" class="form-select">
            <option value="">Please Select</option>
            <option>Autism</option>
            <option>ADHD</option>
            <option>Cerebral Palsy</option>
            <option>Down Syndrome</option>
            <option>Chronic Illness</option>
            <option>Injury</option>
          </select>
        </div>

        <div class="col-md-3">
          <label for="houseNo" class="form-label fw-semibold">House No. and Street</label>
          <input type="text" id="houseNo" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="barangay" class="form-label fw-semibold">Barangay</label>
          <input type="text" id="barangay" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="municipality" class="form-label fw-semibold">Municipality</label>
          <input type="text" id="municipality" class="form-control">
        </div>
      </div>


      <!-- Row 5 -->
      <div class="row g-3 mb-3">
        <div class="col-md-3"><label for="province" class="form-label fw-semibold">Province</label><input type="text"
            id="province" class="form-control"></div>
        <div class="col-md-3"><label for="region" class="form-label fw-semibold">Region</label><input type="text"
            id="region" class="form-control"></div>
        <div class="col-md-3"><label for="landline" class="form-label fw-semibold">Landline No.</label><input type="tel"
            id="landline" class="form-control"></div>
        <div class="col-md-3"><label for="mobile" class="form-label fw-semibold">Mobile No.</label><input type="tel"
            id="mobile" class="form-control" required></div>
      </div>

      <!-- Row 6 -->
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">E-mail Address:</label>
        <input type="email" id="email" class="form-control" placeholder="example@domain.com" required>
      </div>

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

      <div class="mt-4">
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
      </div>

      <!-- Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary">Back</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
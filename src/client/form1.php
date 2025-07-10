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

  <div class="step-indicator-wrapper">
    <div class="step-indicator">
      <div class="step active">
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
      <div class="step">
        <div class="circle">5</div>
        <div class="label">Submission Complete</div>
      </div>
    </div>
  </div>

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
              <input class="form-check-input" type="radio" id="causeCongenital" name="cause"
                value="Congenital / Inborn" onchange="updateOptions(this.value)">
              <label class="form-check-label" for="causeCongenital">Congenital / Inborn</label>
            </div>
            <div class="form-check mb-0">
              <input class="form-check-input" type="radio" id="causeAcquired" name="cause"
                value="Acquired" onchange="updateOptions(this.value)">
              <label class="form-check-label" for="causeAcquired">Acquired</label>
            </div>
          </div>

          <select id="causeSelect" class="form-select">
            <option value="">Please Select</option>
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

      <div class="text-end">
        <button type="submit" class="btn btn-primary px-4">Next</button>
      </div>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  const causeSelect = document.getElementById('causeSelect');

  function updateOptions(type) {
    let options = [];

    if (type === "Congenital / Inborn") {
      options = ["Autism", "ADHD", "Cerebral Palsy", "Down Syndrome"];
    } else if (type === "Acquired") {
      options = ["Chronic Illness", "Cerebral Palsy", "Injury"];
    }

    causeSelect.innerHTML = '<option value="">Please Select</option>';

    options.forEach(opt => {
      const optionElement = document.createElement('option');
      optionElement.textContent = opt;
      optionElement.value = opt;
      causeSelect.appendChild(optionElement);
    });
  }
</script>
</body>

</html>
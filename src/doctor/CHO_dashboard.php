<?php
session_start();
require_once __DIR__ . '/../../config/paths.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'doctor') {
    // if doctors share the same 'admin' role change the check accordingly
    header('Location: ' . ADMIN_BASE . '/signin.php');
    exit;
}

/*
  Replace the placeholder variables below with real DB queries.
  Examples:
  - $today_patients = SELECT COUNT(*) FROM consultations WHERE doctor_id = ? AND date = CURDATE();
  - $upcoming_appts = SELECT COUNT(*) FROM appointments WHERE doctor_id = ? AND date >= CURDATE() AND date <= CURDATE() + INTERVAL 7 DAY;
*/

$today_patients = 8;
$upcoming_appts = 12;
$pending_labs = 5;
$active_cases = 34;

// monthly appointment sample data (12 months)
$months = json_encode(array_map(function($i){ return "Month $i"; }, range(1,12)));
$appts_monthly = json_encode([40, 28, 55, 60, 72, 68, 40, 80, 74, 90, 85, 70]);

// Diagnoses (example labels + counts) -- replace with actual diagnosis names and counts
$diag_labels = json_encode(["Hypertension","Diabetes","TB","Asthma","Stroke"]);
$diag_values = json_encode([34, 28, 12, 18, 6]);

// Gender and age distributions
$gender_labels = json_encode(["Male","Female"]);
$gender_values = json_encode([52,48]);
$age_labels = json_encode(["0-10","11-20","21-30","31-40","41-50","51-60","61+"]);
$age_values = json_encode([2,6,18,20,12,8,6]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>CHO — Doctor Dashboard</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/base.css">
  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/layout.css">
  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/component.css">

  <style>
    :root{--accent:#2f2fbf;--card-bg:#fff;--muted:#6c757d;--shadow:0 6px 18px rgba(30,35,90,0.06);}
    body{background:#f6f7fb;font-family:Inter,system-ui,Segoe UI,Roboto,Arial;}
    .sidebar{width:260px;background:linear-gradient(180deg,#11174a,#163273);color:#fff;position:fixed;top:0;left:0;bottom:0;padding:18px;}
    .sidebar .logo{display:flex;gap:10px;align-items:center;margin-bottom:8px}
    .main{margin-left:280px;padding:26px;min-height:100vh}
    .topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
    .stat-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin-bottom:18px}
    .card-stat{background:var(--card-bg);padding:16px;border-radius:10px;box-shadow:var(--shadow);display:flex;justify-content:space-between;align-items:center}
    .dashboard-grid{display:grid;grid-template-columns:1fr 420px;gap:16px}
    .panel{background:var(--card-bg);padding:14px;border-radius:10px;box-shadow:var(--shadow)}
    .chart-card{height:230px}
    @media(max-width:1100px){.dashboard-grid{grid-template-columns:1fr}.main{margin-left:90px}.sidebar{width:90px}}
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <img src="<?= APP_BASE_URL ?>/assets/pictures/cho-logo.png" width="44" alt="CHO">
      <div>
        <h5 style="margin:0">CHO</h5>
        <small style="opacity:.85">Doctor</small>
      </div>
    </div>

    <a href="<?= ADMIN_BASE ?>/dashboard.php" class="nav-link active" style="display:flex;gap:10px;padding:10px;border-radius:8px;color:#fff;text-decoration:none;">
      <i class="fas fa-stethoscope"></i><span>Dashboard</span>
    </a>

    <a href="<?= ADMIN_BASE ?>/my_patients.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-users-medical"></i><span>My Patients</span></a>

    <a href="<?= ADMIN_BASE ?>/appointments.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-calendar-check"></i><span>Appointments</span></a>

    <a href="<?= ADMIN_BASE ?>/consultations.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-notes-medical"></i><span>Consultations</span></a>

    <a href="<?= ADMIN_BASE ?>/prescriptions.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-prescription-bottle-alt"></i><span>Prescriptions</span></a>

    <a href="<?= ADMIN_BASE ?>/lab_results.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-vials"></i><span>Lab Results</span></a>

    <a href="<?= ADMIN_BASE ?>/reports.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-file-medical-alt"></i><span>Reports</span></a>

    <div style="margin-top:auto">
      <a href="<?= APP_BASE_URL ?>/logout.php" class="nav-link" style="display:flex;gap:10px;padding:10px;color:#fff;text-decoration:none;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>
  </div>

  <div class="main">
    <div class="topbar">
      <div style="display:flex;gap:10px;align-items:center">
        <div class="toggle-btn" onclick="toggleSidebar()" style="background:#fff1;padding:8px;border-radius:8px;cursor:pointer"><i class="fas fa-bars"></i></div>
        <h4 style="margin:0">Doctor Dashboard — City Health Office</h4>
      </div>

      <div style="display:flex;align-items:center;gap:12px">
        <div style="text-align:right">
          <div style="font-weight:700"><?= htmlspecialchars($_SESSION['username'] ?? 'Doctor') ?></div>
          <div style="font-size:.85rem;color:#6c757d">Physician</div>
        </div>
        <i class="fas fa-user-circle" style="font-size:2rem;color:#6c757d"></i>
      </div>
    </div>

    <div class="stat-row">
      <div class="card-stat">
        <div><small>Today's Patients</small><h3><?= number_format($today_patients) ?></h3></div>
        <i class="fas fa-user-injured" style="color:#2f2fbf"></i>
      </div>
      <div class="card-stat">
        <div><small>Upcoming Appts (7d)</small><h3><?= number_format($upcoming_appts) ?></h3></div>
        <i class="fas fa-calendar-plus" style="color:#2f2fbf"></i>
      </div>
      <div class="card-stat">
        <div><small>Pending Labs</small><h3><?= number_format($pending_labs) ?></h3></div>
        <i class="fas fa-vial" style="color:#2f2fbf"></i>
      </div>
      <div class="card-stat">
        <div><small>Active Cases</small><h3><?= number_format($active_cases) ?></h3></div>
        <i class="fas fa-procedures" style="color:#2f2fbf"></i>
      </div>
    </div>

    <div class="dashboard-grid">
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="panel" style="height:420px">
          <div style="font-weight:700;margin-bottom:10px">Appointments This Year</div>
          <canvas id="apptsChart" style="height:100%"></canvas>
        </div>

        <div class="panel">
          <div style="font-weight:700;margin-bottom:10px">Diagnoses Breakdown</div>
          <div class="chart-card">
            <canvas id="diagBar"></canvas>
          </div>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="panel chart-card">
          <div style="font-weight:700;margin-bottom:6px">Patient Gender</div>
          <canvas id="genderPie" style="max-width:260px;margin:0 auto"></canvas>
        </div>

        <div class="panel chart-card">
          <div style="font-weight:700;margin-bottom:6px">Patient Age Distribution</div>
          <canvas id="ageLine"></canvas>
        </div>

        <div class="panel">
          <div style="font-weight:700;margin-bottom:10px">Quick Actions</div>
          <div style="display:flex;gap:8px;flex-wrap:wrap">
            <a class="btn btn-sm btn-primary" href="<?= ADMIN_BASE ?>/appointments.php">View Appointments</a>
            <a class="btn btn-sm btn-outline-primary" href="<?= ADMIN_BASE ?>/my_patients.php">My Patients</a>
            <a class="btn btn-sm btn-outline-secondary" href="<?= ADMIN_BASE ?>/lab_results.php">Review Labs</a>
            <a class="btn btn-sm btn-outline-success" href="<?= ADMIN_BASE ?>/prescriptions.php">Prescribe</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const months = <?= $months ?>;
    const apptsMonthly = <?= $appts_monthly ?>;
    const diagLabels = <?= $diag_labels ?>;
    const diagValues = <?= $diag_values ?>;
    const genderLabels = <?= $gender_labels ?>;
    const genderValues = <?= $gender_values ?>;
    const ageLabels = <?= $age_labels ?>;
    const ageValues = <?= $age_values ?>;

    // Appointments area/line (big)
    new Chart(document.getElementById('apptsChart'), {
      type: 'line',
      data: { labels: months, datasets: [{ label: 'Appointments', data: apptsMonthly, fill:true, backgroundColor:'rgba(63,81,181,0.12)', borderColor:'#3f51b5', tension:0.3, pointRadius:4 }] },
      options:{ maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } }, plugins:{ legend:{display:false} } }
    });

    // Diagnoses horizontal bar
    new Chart(document.getElementById('diagBar'), {
      type: 'bar',
      data:{ labels: diagLabels, datasets:[{ label:'Count', data: diagValues, barThickness:14, borderRadius:6 }]},
      options:{ indexAxis:'y', maintainAspectRatio:false, plugins:{ legend:{display:false} }, scales:{ x:{ beginAtZero:true } } }
    });

    // Gender pie
    new Chart(document.getElementById('genderPie'), {
      type: 'pie',
      data:{ labels: genderLabels, datasets:[{ data: genderValues, hoverOffset:8 }]},
      options:{ maintainAspectRatio:false, plugins:{ legend:{position:'bottom'} } }
    });

    // Age distribution line
    new Chart(document.getElementById('ageLine'), {
      type: 'line',
      data:{ labels: ageLabels, datasets:[{ label:'Patients', data: ageValues, fill:false, borderColor:'#2f2fbf', tension:0.3, pointRadius:3 }]},
      options:{ maintainAspectRatio:false, plugins:{ legend:{display:false} }, scales:{ y:{ beginAtZero:true } } }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar(){
      const sb = document.querySelector('.sidebar'), m = document.querySelector('.main');
      if(sb.style.width && sb.style.width === '90px'){
        sb.style.width = '260px'; m.style.marginLeft = '280px';
      } else {
        sb.style.width = '90px'; m.style.marginLeft = '110px';
      }
    }
  </script>
</body>
</html>

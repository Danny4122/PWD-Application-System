<?php
// src/doctor/accepted.php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/paths.php';

// create a CSRF token once per session (safe to call repeatedly)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
}

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE); }

// --- AUTH: allow DOCTOR / CHO / ADMIN as appropriate ---
if (!isset($_SESSION['username']) || (($_SESSION['role'] ?? '') !== 'doctor' && ($_SESSION['role'] ?? '') !== 'CHO' && ($_SESSION['role'] ?? '') !== 'ADMIN')) {
    header('Location: ' . ADMIN_BASE . '/signin.php');
    exit;
}

// --- Get search input (optional) ---
$search = trim((string)($_GET['q'] ?? $_GET['search'] ?? ''));
$barangayFilter = trim((string)($_GET['barangay'] ?? ''));

// Build SQL: join application -> applicant, select applicant fields properly (ap.*)
// NOTE: removed ap.address because that column doesn't exist in your schema
$baseSql = "
  SELECT
    a.application_id,
    a.application_date,
    a.status,
    a.application_type,
    a.applicant_id,
    COALESCE(ap.pwd_number, '') AS pwd_number,
    COALESCE(ap.barangay, '') AS barangay,
    COALESCE(ap.last_name, '') AS last_name,
    COALESCE(ap.first_name, '') AS first_name,
    COALESCE(ap.middle_name, '') AS middle_name
  FROM application a
  JOIN applicant ap ON ap.applicant_id = a.applicant_id
  WHERE a.status IN ('For CHO Verification','CHO Verified')
";

$params = [];
$conds = [];
if ($search !== '') {
    $s = '%' . str_replace('%', '\\%', $search) . '%';
    $conds[] = "(ap.last_name ILIKE $1 OR ap.first_name ILIKE $1 OR ap.pwd_number ILIKE $1 OR ap.barangay ILIKE $1)";
    $params[] = $s;
}
if ($barangayFilter !== '') {
    $idx = '$' . (count($params) + 1);
    $conds[] = "ap.barangay = {$idx}";
    $params[] = $barangayFilter;
}
if (!empty($conds)) {
    $baseSql .= ' AND ' . implode(' AND ', $conds);
}

$baseSql .= " ORDER BY a.application_date DESC LIMIT 200";

$res = false;
if (!empty($params)) {
    $res = @pg_query_params($conn, $baseSql, $params);
} else {
    $res = @pg_query($conn, $baseSql);
}

$rows = [];
if ($res === false) {
    $dbErr = pg_last_error($conn);
} else {
    while ($r = pg_fetch_assoc($res)) $rows[] = $r;
}

// For the barangay dropdown, build a small list from the results (unique)
$barangays = [];
foreach ($rows as $r) {
    if (!empty($r['barangay'])) $barangays[$r['barangay']] = $r['barangay'];
}
asort($barangays);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CHO — Accepted Applicants</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- reuse your global css -->
  <link rel="stylesheet" href="../../assets/css/global/base.css">
  <link rel="stylesheet" href="../../assets/css/global/layout.css">
  <link rel="stylesheet" href="../../assets/css/global/component.css">

  <style>
    /* layout */
    body { background:#f4f6f8; font-family:Inter,system-ui,Segoe UI,Roboto,Arial; margin:0; }
    .sidebar{
      position:fixed; left:0; top:0; bottom:0; width:260px;
      background: linear-gradient(180deg,#11174a,#163273);
      color:#fff; padding:18px 14px; box-shadow:2px 0 12px rgba(0,0,0,.08);
    }
    .sidebar .logo { display:flex; gap:10px; align-items:center; margin-bottom:12px; }
    .sidebar hr{ border-color: rgba(255,255,255,.06); margin:8px 0 14px; }
    .sidebar a{ color:#fff; display:block; padding:10px 8px; border-radius:8px; text-decoration:none; margin-bottom:6px; }
    .sidebar a.active, .sidebar .submenu .active{ background: rgba(255,255,255,0.06); }
    .sidebar .submenu { margin-top:8px; padding-left:6px; }
    .sidebar .submenu a{ padding:8px 8px; display:flex; align-items:center; gap:10px; color:#fff; border-radius:8px; }
    .main { margin-left:260px; padding:26px; min-height:100vh; }
    .topbar { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:16px; }
    .topbar .username { text-align:right; color:#333; }
    /* search & filters */
    .search-row { display:flex; gap:10px; align-items:center; width:100%; }
    .search-row .form-control { min-width:340px; }
    .filters { display:flex; gap:10px; align-items:center; }

    /* list card */
    .list-card { background:#fff; border-radius:6px; box-shadow:0 6px 18px rgba(30,35,90,0.04); padding:0; overflow:hidden; }
    .list-card .card-header { background:#2f4fa2; color:#fff; padding:14px 18px; font-weight:700; font-size:1rem; }
    .app-row { display:flex; align-items:center; justify-content:space-between; padding:14px 18px; border-top:1px solid #eef0f3; }
    .app-row:first-of-type { border-top: none; }
    .app-left { display:flex; gap:12px; align-items:center; min-width:0; }
    .app-name { font-weight:600; color:#2b2b2b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .app-sub { font-size:.92rem; color:#6b7280; }
    .app-actions { display:flex; align-items:center; gap:14px; }
    .badge-accepted { background:#2ea44f; color:#fff; padding:.5rem .7rem; border-radius:6px; font-weight:700; }
    .view-link { color:#1f6feb; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:8px; }
    .view-link .fa-eye { color:#2b6cb0; }

    /* empty hero */
    .empty-hero { padding:28px; background:#fff; border-radius:8px; color:#0b7285; border:1px solid #c6eef5; }

    /* responsive */
    @media (max-width: 900px) {
      .sidebar{ width:90px; }
      .main{ margin-left:110px; padding:16px; }
      .search-row .form-control { min-width:120px; }
    }
  </style>
</head>
<body>

  <!-- SIDEBAR (same style as screenshot) -->
  <aside class="sidebar" role="navigation" aria-label="Main">
    <div class="logo">
      <img src="../../assets/pictures/white.png" alt="logo" width="44">
      <div>
        <div style="font-weight:700; font-size:1.05rem;">CHO</div>
        <div style="font-size:.78rem; opacity:.9;">Health Office</div>
      </div>
    </div>
    <hr>

    <a class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="members.php"><i class="fas fa-wheelchair me-2"></i> PWDs</a>
    <a href="applications.php"><i class="fas fa-users me-2"></i> Applications</a>

    <div style="margin-top:10px; padding-top:10px; border-top:1px solid rgba(255,255,255,.04);">
      <a class="active" style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:8px;">
        <i class="fas fa-list-check"></i> Manage Applications
      </a>
      <div class="submenu" style="margin-top:8px;">
        <a href="../doctor/accepted.php" class="active"><i class="fas fa-check-circle"></i> Accepted Applicants</a>
        <a href="../doctor/pending.php"><i class="fas fa-hourglass"></i> Pending Applicants</a>
        <a href="../doctor/denied.php"><i class="fas fa-times-circle"></i> Denied Applicants</a>
      </div>
    </div>

    <a href="../doctor/logout.php" style="margin-top:18px;"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </aside>

  <!-- MAIN -->
  <main class="main" role="main">
    <div class="topbar">
      <div style="display:flex;align-items:center;gap:12px;">
        <button class="btn btn-light" id="menuToggle" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>

        <form class="search-row" method="get" action="">
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input name="q" type="text" class="form-control" placeholder="Search applicants" value="<?= h($search) ?>">
          </div>

          <div class="filters">
            <select name="barangay" class="form-select" aria-label="Filter by barangay">
              <option value="">All Barangays</option>
              <?php foreach ($barangays as $b): ?>
                <option value="<?= h($b) ?>" <?= $b === $barangayFilter ? 'selected' : '' ?>><?= h($b) ?></option>
              <?php endforeach; ?>
            </select>

            <button class="btn btn-outline-primary" type="submit">Filter</button>
          </div>
        </form>
      </div>

      <div class="username">
        <div style="font-weight:700;"><?= h($_SESSION['username'] ?? 'User') ?></div>
        <?php if (!empty($_SESSION['role'])): ?>
          <div style="font-size:.85rem;color:#6b7280"><?= h(ucfirst($_SESSION['role'])) ?></div>
        <?php endif; ?>
      </div>
    </div>

    <!-- LIST CARD -->
    <section class="list-card" aria-labelledby="listTitle" role="region">
      <div class="card-header" id="listTitle">
        LIST OF APPLICANTS
      </div>

      <?php if (!empty($dbErr)): ?>
        <div class="p-3"><div class="alert alert-danger">Database error: <?= h($dbErr) ?></div></div>
      <?php endif; ?>

      <?php if (empty($rows)): ?>
        <div class="p-4">
          <div class="empty-hero">No accepted applicants found.</div>
        </div>
      <?php else: ?>
        <?php foreach ($rows as $r):
          $fullname = trim(($r['first_name'] ?? '') . ' ' . ($r['middle_name'] ?? '') . ' ' . ($r['last_name'] ?? ''));
          $status = $r['status'];
          $viewUrl = 'view_a.php?id=' . urlencode($r['application_id']);
        ?>
          <div class="app-row">
            <div class="app-left">
              <div style="width:48px;height:48px;border-radius:6px;background:#eef2ff;display:flex;align-items:center;justify-content:center;color:#2f4fa2;font-weight:700;">
                <?= strtoupper(substr($r['first_name'] ?? 'U',0,1)) ?><?= strtoupper(substr($r['last_name'] ?? '',0,1)) ?>
              </div>
              <div style="min-width:0;">
                <div class="app-name"><?= h($fullname ?: '—') ?></div>
                <div class="app-sub"><?= h($r['barangay'] ?: '—') ?></div>
              </div>
            </div>

            <div class="app-actions">
              <div class="badge-accepted"><?= h($status) ?></div>
              <a class="view-link" href="<?= h($viewUrl) ?>" title="View Applicant">
                <i class="fa-regular fa-eye"></i> View Applicant
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

  </main>

<script>
  // menu toggle: collapse sidebar on small screens
  document.getElementById('menuToggle').addEventListener('click', function(){
    const sb = document.querySelector('.sidebar');
    const main = document.querySelector('.main');
    sb.classList.toggle('closed');
    main.classList.toggle('shifted');
  });

  // close by default on small screens
  if (window.innerWidth < 900) {
    document.querySelector('.sidebar').classList.add('closed');
    document.querySelector('.main').classList.add('shifted');
  }
</script>

<style>
  .sidebar.closed { width:90px !important; }
  .main.shifted { margin-left:110px !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

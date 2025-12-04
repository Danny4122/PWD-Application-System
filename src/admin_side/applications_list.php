<?php
// admin/applications_list.php
session_start();
require_once __DIR__ . '/../config/db.php';
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
    header('Location: /public/login_form.php');
    exit;
}

// Fetch submitted/pdao_review queue
$res = pg_query($conn, "
  SELECT a.application_id, a.application_number, ap.first_name, ap.last_name,
         a.application_date, a.workflow_status, a.updated_at
  FROM application a
  JOIN applicant ap ON ap.applicant_id = a.applicant_id
  WHERE a.workflow_status IN ('submitted','pdao_review')
  ORDER BY a.application_date DESC
  LIMIT 500
");

$applications = [];
if ($res) while ($r = pg_fetch_assoc($res)) $applications[] = $r;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PDAO — Applications for Review</title>
  <link rel="stylesheet" href="/assets/css/style.css"> <!-- adjust -->
</head>
<body>
  <?php include __DIR__ . '/_sidebar.php'; /* optional include for your sidebar */ ?>
  <main>
    <h1>Applications — For PDAO Review</h1>

    <table border="1" cellpadding="8" width="100%">
      <thead>
        <tr>
          <th>App #</th><th>Applicant</th><th>Submitted</th><th>Status</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($applications as $a): ?>
        <tr>
          <td><?=htmlspecialchars($a['application_number'])?></td>
          <td><?=htmlspecialchars($a['first_name'].' '.$a['last_name'])?></td>
          <td><?=htmlspecialchars($a['application_date'])?></td>
          <td><?=htmlspecialchars($a['workflow_status'])?></td>
          <td><a href="/admin/application_view.php?id=<?= (int)$a['application_id'] ?>">Review</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  <script>
    // optional auto-refresh to see new submissions
    setInterval(()=>fetch(window.location).then(()=>location.reload()), 30000);
  </script>
</body>
</html>

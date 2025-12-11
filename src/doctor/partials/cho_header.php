<?php
// src/doctor/partials/cho_header.php
// Reusable CHO / Doctor header partial (top-right user info).
// Expects session started and APP/ADMIN constants available.

function _h($s){ return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE); }
$username = $_SESSION['username'] ?? ($_SESSION['user_name'] ?? null);
$role = $_SESSION['role'] ?? ($_SESSION['user_role'] ?? null);
?>
<div class="d-flex flex-column align-items-end">
  <div class="d-flex align-items-center ms-3 mt-2 mb-2" style="font-size:1.15rem;">
    <strong><?= $username ? _h($username) : 'User' ?></strong>
    <i class="fas fa-user-circle ms-3 me-2 mb-2 mt-2" style="font-size:2.2rem;"></i>
  </div>
  <?php if (!empty($role)): ?>
    <small style="color:#6c757d; margin-right:6px; text-transform:capitalize;"><?= _h(strtolower($role)) ?></small>
  <?php endif; ?>
</div>

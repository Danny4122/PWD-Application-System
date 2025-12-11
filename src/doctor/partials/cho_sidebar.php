<?php
// src/doctor/partials/cho_sidebar.php

// Safe function
function _h($s){ return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE); }

// Ensure constants exist (avoid fatal errors)
$base = defined('APP_BASE_URL') ? rtrim(APP_BASE_URL, '/') : '';
$adminBase = defined('ADMIN_BASE') ? rtrim(ADMIN_BASE, '/') : '';

// Current script
$current = basename($_SERVER['SCRIPT_NAME'] ?? '');

// Active function
function is_active($names) {
    if (!is_array($names)) $names = [$names];
    $cur = basename($_SERVER['SCRIPT_NAME'] ?? '');
    return in_array($cur, $names) ? 'active' : '';
}
?>

<div class="sidebar">
  <div class="logo">
    <img src="<?= _h($base) ?>/assets/pictures/white.png" alt="logo" width="45">
    <img src="<?= _h($base) ?>/assets/pictures/CHO logo.png" alt="logo 2" width="45">
    <h4>CHO</h4>
  </div>
  <hr>

  <a class="<?= is_active(['CHO_dashboard.php','dashboard.php']) ?>">
    <i class="fas fa-chart-line me-2"></i><span>Dashboard</span>
  </a>

  <a href="<?= _h($adminBase) ?>/members.php" class="<?= is_active('members.php') ?>">
    <i class="fas fa-wheelchair me-2"></i><span>Members</span>
  </a>

  <a href="<?= _h($adminBase) ?>/applications.php" class="<?= is_active('applications.php') ?>">
    <i class="fas fa-users me-2"></i><span>Applications</span>
  </a>

  <div class="sidebar-item">
    <div class="toggle-btn d-flex justify-content-between align-items-center">
      <span class="no-wrap d-flex align-items-center">
        <i class="fas fa-folder me-2"></i><span>Manage Applications</span>
      </span>
      <i class="fas fa-chevron-down chevron-icon"></i>
    </div>

    <div class="submenu">
      <a href="<?= _h($base) ?>/src/doctor/accepted.php"
         class="submenu-link ps-4 <?= is_active('accepted.php') ?>">
         <i class="fas fa-user-check" style="width:18px;"></i><span class="ms-2">Accepted</span>
      </a>

      <a href="<?= _h($base) ?>/src/doctor/pending.php"
         class="submenu-link ps-4 <?= is_active('pending.php') ?>">
         <i class="fas fa-hourglass-half" style="width:18px;"></i><span class="ms-2">Pending</span>
      </a>

      <a href="<?= _h($base) ?>/src/doctor/denied.php"
         class="submenu-link ps-4 <?= is_active('denied.php') ?>">
         <i class="fas fa-user-times" style="width:18px;"></i><span class="ms-2">Denied</span>
      </a>
    </div>
  </div>

  <a href="<?= _h($base) ?>/src/doctor/logout.php">
    <i class="fas fa-sign-out-alt me-2"></i><span>Logout</span>
  </a>
</div>

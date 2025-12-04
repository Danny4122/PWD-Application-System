<?php
session_start();
require_once __DIR__ . '/../../config/paths.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . ADMIN_BASE . '/signin.php');
    exit;
}

// (optional) you can access the logged-in username via:
// $loggedInUsername = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDAO Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Global CSS -->
  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/base.css">
  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/layout.css">
  <link rel="stylesheet" href="<?= APP_BASE_URL ?>/assets/css/global/component.css">

</head>

<body>

<div class="sidebar">
  <div class="logo">
    <img src="<?= APP_BASE_URL ?>/assets/pictures/white.png" alt="logo" width="40">
    <h4>PDAO</h4>
  </div>
  <hr>

  <a href="<?= ADMIN_BASE ?>/dashboard.php" class="nav-link active">
    <i class="fas fa-chart-line me-2"></i><span>Dashboard</span>
  </a>

  <a href="<?= ADMIN_BASE ?>/members.php" class="nav-link">
    <i class="fas fa-users me-2"></i><span>Members</span>
  </a>

  <div class="sidebar-item">
    <div class="submenu-toggle d-flex justify-content-between align-items-center" role="button" tabindex="0">
      <span class="no-wrap d-flex align-items-center">
        <i class="fas fa-folder me-2"></i>
        <span>Manage Applications</span>
      </span>
      <i class="fas fa-chevron-down chevron-icon"></i>
    </div>

    <div class="submenu">
      <a href="<?= ADMIN_BASE ?>/application_review.php" class="submenu-link d-flex align-items-center ps-4">
        <i class="fas fa-file-alt me-1"></i> Application Review
      </a>

      <a href="<?= ADMIN_BASE ?>/accepted.php" class="submenu-link d-flex align-items-center ps-4">
        <i class="fas fa-user-check me-1"></i> Accepted
      </a>

      <a href="<?= ADMIN_BASE ?>/pending.php" class="submenu-link d-flex align-items-center ps-4">
        <i class="fas fa-hourglass-half me-1"></i> Pending
      </a>

      <a href="<?= ADMIN_BASE ?>/denied.php" class="submenu-link d-flex align-items-center ps-4">
        <i class="fas fa-user-times me-1"></i> Denied
      </a>
    </div>
  </div>

  <a href="<?= APP_BASE_URL ?>/logout.php" class="nav-link">
    <i class="fas fa-sign-out-alt me-2"></i><span>Logout</span>
  </a>
</div>



        <a href="/logout.php"><i class="fas fa-sign-out-alt me-2"></i><span>Logout</span></a>
      </div>


  <div class="main">
    <div class="topbar d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <div class="toggle-btn" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </div>
      </div>

      <div class="d-flex flex-column align-items-end">
        <div class="d-flex align-items-center ms-3 mt-2 mb-2" style="font-size: 1.4rem;">
          <strong>Danny Boy Loberanes Jr.</strong>
          <i class="fas fa-user-circle ms-3 me-2 mb-2 mt-2" style="font-size: 2.5rem;"></i>
        </div>

      </div>
    </div>

    <div class="cards">
      <div class="card-stat">
        <div>
          <small>PWDs</small>
          <h3>1025</h3>
        </div>
        <i class="fas fa-users"></i>
      </div>
      <div class="card-stat">
        <div>
          <small>NEW</small>
          <h3>44</h3>
        </div>
        <i class="fas fa-user-plus"></i>
      </div>
      <div class="card-stat">
        <div>
          <small>RENEW</small>
          <h3>150</h3>
        </div>
        <i class="fas fa-id-card"></i>
      </div>
      <div class="card-stat">
        <div>
          <small>LOST ID</small>
          <h3>65</h3>
        </div>
        <i class="fas fa-id-badge"></i>
      </div>
    </div>

    <div class="chart-container">
      <canvas id="statsChart"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('statsChart');
    ctx.height = 460;

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: Array.from({ length: 12 }, (_, i) => `Month ${i + 1}`),
        datasets: [
          {
            label: 'New Applications',
            data: [400, 200, 500, 250, 700, 450, 100, 600, 300, 700, 500, 400],
            backgroundColor: 'rgba(66, 135, 245, 0.3)',
            borderColor: '#4287f5',
            borderWidth: 2,
            pointBackgroundColor: '#4287f5',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            fill: true,
            lineTension: 0.3
          },
          {
            label: 'Renew Applications',
            data: [750, 600, 700, 900, 950, 850, 300, 700, 200, 600, 700, 500],
            backgroundColor: 'rgba(102, 51, 255, 0.3)',
            borderColor: '#6633ff',
            borderWidth: 2,
            pointBackgroundColor: '#6633ff',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            fill: true,
            lineTension: 0.3
          },
          {
            label: 'Lost ID Applications',
            data: [150, 120, 180, 210, 170, 160, 140, 220, 180, 250, 230, 210],
            backgroundColor: 'rgba(255, 99, 132, 0.3)',
            borderColor: '#FF6384',
            borderWidth: 2,
            pointBackgroundColor: '#FF6384',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            fill: true,
            lineTension: 0.3
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: '#ddd',
            },
            ticks: {
              font: {
                size: 12,
              }
            }
          },
          x: {
            grid: {
              color: '#ddd',
            },
            ticks: {
              font: {
                size: 12,
              }
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              font: {
                size: 14,
              },
              color: '#333'
            }
          },
          tooltip: {
            backgroundColor: '#444',
            titleColor: '#fff',
            bodyColor: '#fff'
          }
        }
      }
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.querySelectorAll('.toggle-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const submenu = btn.nextElementSibling;
        const icon = btn.querySelector('.chevron-icon');
        submenu.style.maxHeight = submenu.style.maxHeight ? null : submenu.scrollHeight + "px";
        icon.classList.toggle('rotate');
      });
    });

    // Toggle Sidebar visibility
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const main = document.querySelector('.main');
      sidebar.classList.toggle('closed');
      main.classList.toggle('shifted');
    }
  </script>

  <style>
    .rotate {
      transform: rotate(180deg);
      transition: transform 0.3s ease;
    }
  </style>

  <script>
document.addEventListener('DOMContentLoaded', function() {

  // Find toggles
  const toggles = Array.from(document.querySelectorAll('.submenu-toggle'));
  if (toggles.length === 0) {
    console.warn('Sidebar: no .submenu-toggle found');
  }

  // helper to animate by setting maxHeight to scrollHeight for smooth transition
  function openSubmenu(parentItem) {
    const submenu = parentItem.querySelector('.submenu');
    if (!submenu) return;
    parentItem.classList.add('open');
    // set explicit maxHeight to trigger transition
    submenu.style.maxHeight = '0px';
    // force reflow
    void submenu.offsetHeight;
    submenu.style.maxHeight = submenu.scrollHeight + 'px';
    // rotatate chevron
    const ch = parentItem.querySelector('.chevron-icon');
    if (ch) ch.classList.add('rotate');
    parentItem.querySelector('.submenu-toggle').setAttribute('aria-expanded', 'true');
  }

  function closeSubmenu(parentItem) {
    const submenu = parentItem.querySelector('.submenu');
    if (!submenu) return;
    // animate to 0
    submenu.style.maxHeight = submenu.scrollHeight + 'px';
    void submenu.offsetHeight;
    submenu.style.maxHeight = '0px';
    // remove open class after transitionend
    submenu.addEventListener('transitionend', function handler(e){
      if (e.propertyName === 'max-height' && submenu.style.maxHeight === '0px') {
        parentItem.classList.remove('open');
        submenu.removeEventListener('transitionend', handler);
      }
    });
    const ch = parentItem.querySelector('.chevron-icon');
    if (ch) ch.classList.remove('rotate');
    parentItem.querySelector('.submenu-toggle').setAttribute('aria-expanded', 'false');
  }

  function toggleParent(parentItem) {
    if (!parentItem) return;
    const isOpen = parentItem.classList.contains('open') || (parentItem.querySelector('.submenu').style.maxHeight && parentItem.querySelector('.submenu').style.maxHeight !== '0px');
    if (isOpen) {
      closeSubmenu(parentItem);
    } else {
      // close any other open siblings (keeps only one open)
      document.querySelectorAll('.sidebar-item.open').forEach(si => {
        if (si !== parentItem) closeSubmenu(si);
      });
      openSubmenu(parentItem);
    }
  }

  // Listen for click on toggle (use delegation to handle inner icon clicks)
  document.addEventListener('click', function(e) {
    const toggle = e.target.closest('.submenu-toggle');
    if (!toggle) return;
    e.preventDefault();
    const parentItem = toggle.closest('.sidebar-item');
    toggleParent(parentItem);
  });

  // keyboard support: Enter or Space toggles
  document.addEventListener('keydown', function(e) {
    const active = document.activeElement;
    if (!active) return;
    if (!active.classList || !active.classList.contains('submenu-toggle')) return;
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      const parentItem = active.closest('.sidebar-item');
      toggleParent(parentItem);
    }
  });

  // Make sure toggles are focusable and have role/aria attributes
  toggles.forEach(t => {
    if (!t.hasAttribute('tabindex')) t.setAttribute('tabindex', '0');
    if (!t.hasAttribute('role')) t.setAttribute('role', 'button');
    if (!t.hasAttribute('aria-expanded')) t.setAttribute('aria-expanded', 'false');
  });

  // Optional: Auto-open submenu if current URL is inside manage_applications
  try {
    const path = location.pathname.toLowerCase();
    if (path.includes('/manage_applications') || path.includes('/application_review') || path.includes('/accepted') || path.includes('/pending') || path.includes('/denied')) {
      // find the first submenu-toggle for Manage Applications and open it
      const maToggle = document.querySelector('.submenu-toggle');
      if (maToggle) {
        const parentItem = maToggle.closest('.sidebar-item');
        openSubmenu(parentItem);
      }
    }
  } catch (err) {
    /* ignore */
  }

});
</script>


</body>



</html>
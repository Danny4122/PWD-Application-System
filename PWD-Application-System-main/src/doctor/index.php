<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHO Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Global CSS -->
  <link rel="stylesheet" href="../../assets/css/global/base.css">
  <link rel="stylesheet" href="../../assets/css/global/layout.css">
  <link rel="stylesheet" href="../../assets/css/global/component.css">
  
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <img src="../../assets/pictures/white.png" alt="logo" width="45">
      <img src="../../assets/pictures/CHO logo.png" alt="logo 2" width="45">
      <h4>CHO</h4>
    </div>
    <hr> <!-- Horizontal line stretching from logo area -->
    <a class="active"><i class="fas fa-chart-line me-2"></i><span>Dashboard</span></a>
    <a><i class="fas fa-wheelchair me-2"></i><span>Members</span></a>
    <a><i class="fas fa-users me-2"></i><span>Applications</span></a>

    <div class="sidebar-item">
      <div class="toggle-btn d-flex justify-content-between align-items-center">
        <span class="no-wrap d-flex align-items-center"><i class="fas fa-folder me-2"></i><span>Manage
            Applications</span></span>
        <i class="fas fa-chevron-down chevron-icon"></i>
      </div>
      <div class="submenu">
        <a href="#" class="submenu-link d-flex align-items-center ps-4"
          style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
          <span class="icon" style="width: 18px;"><i class="fas fa-user-check"></i></span>
          <span class="ms-2">Accepted</span>
        </a>
        <a href="#" class="submenu-link d-flex align-items-center ps-4"
          style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
          <span class="icon" style="width: 18px;"><i class="fas fa-hourglass-half"></i></span>
          <span class="ms-2">Pending</span>
        </a>
        <a href="#" class="submenu-link d-flex align-items-center ps-4"
          style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
          <span class="icon" style="width: 18px;"><i class="fas fa-user-times"></i></span>
          <span class="ms-2">Denied</span>
        </a>
      </div>
    </div>

    <a><i class="fas fa-sign-out-alt me-2"></i><span>Logout</span></a>
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

</body>

</html>
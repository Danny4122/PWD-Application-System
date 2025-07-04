<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDAO Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
    }
    .sidebar {
      width: 260px;
      height: 100vh;
      background: linear-gradient(to bottom, #191654, rgb(67, 130, 198));
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      padding: 20px;
      padding-bottom: 40px;
      transition: width 0.3s ease, opacity 0.3s ease;
      opacity: 1;
    }
    .sidebar.closed {
      width: 80px;
      padding: 20px 10px;
      opacity: 1;
      overflow: hidden;
      transition: width 0.3s ease, opacity 0.3s ease;
    }
    .sidebar .logo {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 30px;
      transition: all 0.3s ease;
    }
    .sidebar.closed .logo {
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 3px;
    }
    .sidebar.closed .logo img {
      width: 50px;
      height: 48px;
    }
    .sidebar h4 {
      margin: 0;
      font-weight: bold;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      margin: 10px 0;
      padding: 8px 12px;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: rgba(255, 255, 255, 0.1);
      color: white !important;
    }
    .sidebar.closed .toggle-btn .no-wrap span {
      display: none !important;
    }
    .sidebar.closed .toggle-btn .chevron-icon {
      display: none;
    }
    .sidebar.closed .submenu {
      max-height: 0 !important;
    }
    .sidebar-item .toggle-btn:hover {
      background-color: rgba(255, 255, 255, 0.1); 
      color: #f5f5f5 !important;
    }
    .sidebar.closed a {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
    }
    .sidebar.closed i {
      font-size: 1.4rem;
      margin: 0;
    }
    .sidebar.closed a span {
      display: none;
    }
    .sidebar.closed .toggle-btn {
      justify-content: center;
    }
    .main {
      margin-left: 260px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    .main.shifted {
      margin-left: 80px;
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .cards {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .card-stat {
      flex: 1;
      position: relative;
      min-width: 200px;
      background-color:  #2b2bb2;
      color: white;
      padding: 20px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }
    .card-stat::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      height: 20px;
      width: 100%;
      background-color:rgb(26, 26, 35);
      opacity: 30%;
      border-bottom-left-radius: 5px;
      border-bottom-right-radius: 5px;
    }
    
    .card-stat i {
      font-size: 2rem;
    }
    .chart-container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .dropdown-menu {
      background: transparent;
    }
    .dropdown-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .sidebar-item {
      margin-top: 10px;
    }
    .toggle-btn {
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }
    
    .chevron-icon {
      transition: transform 0.3s ease;
    }
    .rotate {
      transform: rotate(180deg);
    }
    .submenu {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.4s ease;
    }
    .submenu-link {
      display: block;
      padding: 8px 20px;
      color: white;
      font-size: 0.95rem;
      border-radius: 6px;
      margin: 4px 0;
      text-decoration: none;
      transition: background 0.3s;
    }
    .submenu-link:hover {
      background-color: rgba(255, 255, 255, 0.15);
      color: white !important; 
    }
    .no-wrap {
      white-space: nowrap;
    }
    hr {
      border: 0;
      height: 1px;
      background: white;
      margin: 10px 0;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
      <img src="/assets/white.png" alt="logo" width="40">
      <h4>PDAO</h4>
    </div>
  <hr> <!-- Horizontal line stretching from logo area -->
  <a class="active"><i class="fas fa-chart-line me-2"></i><span>Dashboard</span></a>
  <a><i class="fas fa-users me-2"></i><span>Members</span></a>

  <div class="sidebar-item">
    <div class="toggle-btn d-flex justify-content-between align-items-center">
      <span class="no-wrap d-flex align-items-center"><i class="fas fa-folder me-2"></i><span>Manage Applications</span></span>
      <i class="fas fa-chevron-down chevron-icon"></i>
    </div>
    <div class="submenu">
      <a href="#" class="submenu-link d-flex align-items-center ps-4" style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
        <span class="icon"><i class="fas fa-file-alt"></i></span>
        <span class="ms-2">Application Review</span>
      </a>
      <a href="#" class="submenu-link d-flex align-items-center ps-4" style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
        <span class="icon" style="width: 18px;"><i class="fas fa-user-check"></i></span>
        <span class="ms-2">Accepted</span>
      </a>
      <a href="#" class="submenu-link d-flex align-items-center ps-4" style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
        <span class="icon" style="width: 18px;"><i class="fas fa-hourglass-half"></i></span>
        <span class="ms-2">Pending</span>
      </a>
      <a href="#" class="submenu-link d-flex align-items-center ps-4" style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
        <span class="icon" style="width: 18px;"><i class="fas fa-user-times"></i></span>
        <span class="ms-2">Denied</span>
      </a>
    </div>
  </div>

  <a><i class="fas fa-sign-out-alt me-2"></i><span>Logout</span></a>
</div>
<div class="main">
  <div class="topbar">
    <div class="d-flex align-items-center">
      <div class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </div>
      <h5 class="ms-3" style="font-weight: bold;">Dashboard</h5>
    </div>
    <p><strong>Danny Boy Loberanes Jr.</strong> <i class="fas fa-user-circle ms-2"></i></p>
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
      labels: Array.from({length: 12}, (_, i) => `Month ${i+1}`),
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
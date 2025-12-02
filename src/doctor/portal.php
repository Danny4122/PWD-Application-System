<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDAO Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Global CSS -->
  <link rel="stylesheet" href="../../assets/css/global/base.css">
  <link rel="stylesheet" href="../../assets/css/global/layout.css">
  <link rel="stylesheet" href="../../assets/css/global/component.css">

    <style>
    body { background:#f6f7fb; font-family: system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial; margin:0; }
    .sidebar { width:260px; position:fixed; top:0; left:0; bottom:0; padding:20px; background:linear-gradient(180deg,#191654,#274aa6); color:#fff; }
    .main { margin-left:260px; padding:20px; }

    .container-inner { padding: 24px; max-width: 1200px; margin: 0 auto; }

    .chart-grid { display:grid; grid-template-columns: 2fr 1fr; gap:18px; align-items:start; margin-bottom:20px; }
    @media (max-width:900px){ .chart-grid { grid-template-columns: 1fr; } }

    .chart-card { background:#fff; padding:14px; border-radius:8px; box-shadow:0 6px 16px rgba(0,0,0,.06); }
    .canvas-wrap { height:260px; }
    .chart-card.gender .canvas-wrap { height:300px; }
    canvas { width:100% !important; height:100% !important; display:block; }

    .chart-legend { display:flex; flex-wrap:wrap; gap:12px; margin-top:10px; font-size:.9rem; align-items:center; }
    .chart-legend-item { display:flex; align-items:center; gap:8px; }
    .legend-color-box { width:14px; height:14px; border-radius:3px; display:inline-block; }

    /* small layout bits */
    .cards { display:flex; gap:12px; margin-bottom:18px; flex-wrap:wrap; }
    .card-stat { background:#2b2bb2; color:#fff; padding:14px; border-radius:8px; min-width:160px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 6px 16px rgba(0,0,0,.08); }
    .card-stat small{opacity:.85}
  </style>
</head>
<body>

  <div class="sidebar">
    <div class="logo">
      <img src="../../assets/pictures/white.png" width="40">
      <img src="../../assets/pictures/CHO logo.png" width="40">
      <h4>CHO</h4>
    </div>
    <hr>

    <a class="active"><i class="fas fa-chart-line me-2"></i><span>Dashboard</span></a>
    <a><i class="fas fa-users me-2"></i><span>Members</span></a>
    <a><i class="fas fa-clipboard me-2"></i><span>Applications</span></a>

    <div class="sidebar-item">
      <div class="toggle-btn d-flex justify-content-between align-items-center">
        <span class="d-flex align-items-center"><i class="fas fa-folder me-2"></i>Manage Applications</span>
        <i class="fas fa-chevron-down chevron-icon"></i>
      </div>

      <div class="submenu">
        <a class="submenu-link ps-4"><i class="fas fa-user-check me-2"></i>Accepted Applicants</a>
        <a class="submenu-link ps-4"><i class="fas fa-hourglass-half me-2"></i>Pending Applicants</a>
        <a class="submenu-link ps-4"><i class="fas fa-user-times me-2"></i>Denied Applicants</a>
      </div>
    </div>

    <a><i class="fas fa-sign-out-alt me-2"></i><span>Logout</span></a>
  </div>


  <!-- MAIN CONTENT -->
  <div class="main">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
      <div>
        <div class="toggle-btn" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </div>
      </div>

      <div class="d-flex align-items-center">
        <strong class="me-3">Danny Boy Loberanes Jr.</strong>
        <i class="fas fa-user-circle" style="font-size:2.3rem;"></i>
      </div>
    </div>

    <!-- STAT CARDS -->
    <div class="cards">
      <div class="card-stat"><div><small>PWDs</small><h3>1025</h3></div><i class="fas fa-users fa-2x"></i></div>
      <div class="card-stat"><div><small>NEW</small><h3>44</h3></div><i class="fas fa-user-plus fa-2x"></i></div>
      <div class="card-stat"><div><small>RENEW</small><h3>150</h3></div><i class="fas fa-id-card fa-2x"></i></div>
      <div class="card-stat"><div><small>LOST ID</small><h3>65</h3></div><i class="fas fa-id-badge fa-2x"></i></div>
      <div class="card-stat"><div><small>Non-Renewable IDs</small><h3>65</h3></div><i class="fas fa-id-card-alt fa-2x"></i></div>
    </div>


    <div class="chart-grid">
        <!-- LEFT -->
        <div>
          <div class="chart-card mb-3">
            <h6 style="margin:0 0 10px 0">Verified PWDs by Month</h6>
            <div class="canvas-wrap"><canvas id="chartMonths"></canvas></div>
            <div class="chart-legend" id="legendMonths"></div>
          </div>

          <div class="chart-card" style="margin-top:18px;">
            <h6 style="margin:0 0 10px 0">PWDs by Age</h6>
            <div class="canvas-wrap"><canvas id="chartAge"></canvas></div>
            <div class="chart-legend" id="legendAge"></div>
          </div>
        </div>

        <!-- RIGHT -->
        <div>
          <div class="chart-card gender">
            <h6 style="margin:0 0 10px 0">PWDs by Gender</h6>
            <div class="canvas-wrap"><canvas id="chartGender"></canvas></div>
            <div class="chart-legend justify-content-center" id="legendGender"></div>
          </div>
        </div>
      </div>
    </div>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    function generateLegend(chart, legendId) {
      const legendContainer = document.getElementById(legendId);
      if (!legendContainer || !chart || !chart.data) return;
      legendContainer.innerHTML = '';

      const data = chart.data;
      const ds = data.datasets[0];

      if (Array.isArray(ds.backgroundColor)) {
        (data.labels || []).forEach((label, i) => {
          const color = ds.backgroundColor[i] || '#999';
          const item = document.createElement('div');
          item.className = 'chart-legend-item';
          item.innerHTML = `<span class="legend-color-box" style="background:${color};"></span><span>${label}</span>`;
          legendContainer.appendChild(item);
        });
        return;
      }

      const color = ds.borderColor || ds.backgroundColor || '#333';
      const labelText = ds.label || 'Series';
      const item = document.createElement('div');
      item.className = 'chart-legend-item';
      item.innerHTML = `<span class="legend-color-box" style="background:${color};"></span><span>${labelText}</span>`;
      legendContainer.appendChild(item);
    }

    /*************** sample data (replace with backend values later) ***************/
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const verified = [80,420,320,300,460,210,90,290,120,300,320,360];

    const genderData = [560,440]; // male, female

    const ageLabels = ['0-10','11-20','21-30','31-40','41-50','51-59'];
    const ageData = [12,18,28,30,24,20];

    /*************** plugin: draw percentages inside pie center ***************/
    const pieCenterText = {
      id: 'pieCenterText',
      afterDraw(chart) {
        if (chart.config.type !== 'pie' && chart.config.type !== 'doughnut') return;

        const { ctx, chartArea } = chart;
        const { top, left, width, height } = chartArea;

        const dataset = chart.data.datasets[0].data || [];
        const total = dataset.reduce((a,b) => a + b, 0);
        if (!total) return;

        const malePct = ((dataset[0] / total) * 100).toFixed(0); // integer %
        const femalePct = ((dataset[1] / total) * 100).toFixed(0);

        ctx.save();
        ctx.fillStyle = '#ffffff';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = '700 20px Arial';
        ctx.fillText(`${malePct}% • ${femalePct}%`, left + width / 2, top + height / 2);
        ctx.restore();
      }
    };


    // 1) Verified by month (line)
    const chartMonths = new Chart(document.getElementById('chartMonths').getContext('2d'), {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Verified',
          data: verified,
          borderColor: '#1f5bd8',
          backgroundColor: 'rgba(31,91,216,0.15)',
          fill: true,
          tension: 0.35,
          pointRadius: 4,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#1f5bd8',
          pointBorderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { beginAtZero:true, grid: { color:'#f0f0f0' }, title: { display:true, text: 'Count' } },
          x: { grid: { color:'#f8f8f8' } }
        },
        plugins: {
          legend: { display: false },
          tooltip: { mode: 'index', intersect: false }
        }
      }
    });

    // 2) Gender (pie) 
    const chartGender = new Chart(document.getElementById('chartGender').getContext('2d'), {
      type: 'pie',
      plugins: [pieCenterText],
      data: {
        labels: ['Male','Female'],
        datasets: [{
          data: genderData,
          backgroundColor: ['#2346d6','#45a3ff'],
          borderColor: '#ffffff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function(ctx) {
                const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                const v = ctx.raw;
                const pct = total ? ((v/total)*100).toFixed(1) : 0;
                return `${ctx.label}: ${v} (${pct}%)`;
              }
            }
          }
        }
      }
    });
    generateLegend(chartGender, 'legendGender');
    document.getElementById('legendGender').style.justifyContent = 'center';

    // 3) Age (line)
    const chartAge = new Chart(document.getElementById('chartAge').getContext('2d'), {
      type: 'line',
      data: {
        labels: ageLabels,
        datasets: [{
          label: 'Number of PWDs',
          data: ageData,
          borderColor: '#2b2bb2',
          backgroundColor: 'rgba(43,43,178,0.08)',
          fill: true,
          tension: 0.35,
          pointRadius: 4,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#2b2bb2',
          pointBorderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Number of PWDs' }
          },
          x: {
            title: { display: true, text: 'Age Group' }
          }
        },
        plugins: { legend: { display: false } }
      }
    });

    
document.querySelectorAll('.toggle-btn').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const submenu = btn.nextElementSibling;
    if(!submenu) return;
    submenu.style.maxHeight = submenu.style.maxHeight ? null : submenu.scrollHeight + 'px';
    btn.querySelector('.chevron-icon')?.classList.toggle('rotate');
  });
});

function toggleSidebar(){
  const sidebar = document.querySelector('.sidebar');
  const main = document.querySelector('.main');
  sidebar.classList.toggle('closed');
  if(sidebar.classList.contains('closed')){
    sidebar.style.width = '80px';
    main.style.marginLeft = '80px';
  } else {
    sidebar.style.width = '260px';
    main.style.marginLeft = '260px';
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

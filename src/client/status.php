<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PWD Online Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
        background: linear-gradient(135deg, #f5f7fa, #e4e9f0);
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .status-card {
        background-color: #ffffff;
        padding: 3rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        max-width: 400px;
        width: 100%;
        transition: all 0.3s ease-in-out;
    }

    .status-card:hover {
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    .status-card h4 {
        color: #2c2bce;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .status-card label {
        font-weight: 600;
        color: #444;
        margin-bottom: 0.5rem;
    }

    #refCode {
        height: 48px;
        font-size: 1rem;
        color: #000;
        transition: border 0.2s ease-in-out;
    }

    #refCode:focus {
        border-color: #2c2bce;
        box-shadow: 0 0 0 0.1rem rgba(44, 43, 206, 0.25);
    }

    .check-btn {
        background-color: #2c2bce;
        padding: 0.6rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .check-btn:hover {
        background-color: #1a1a9e;
    }
  </style>
</head>
<body>

<?php include __DIR__ . '/../../hero/navbar.php'; ?>

<div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh; padding-top: 100px;">
  <div class="status-card text-center">
    <h4>Check Application Status</h4>
    <form id="statusForm">
      <div class="mb-4 text-start">
        <input type="text" id="refCode" class="form-control shadow-sm rounded-3" placeholder="Enter your name" required>
      </div>

      <!-- Check Status Button -->
      <button id="checkBtn" type="submit" class="btn check-btn text-white shadow-sm">
        Check Status
      </button>

      <!-- Status Found Message -->
      <div id="statusMsg" 
           class="mt-3 fw-semibold text-center"
           style="display: none; background-color: #d4edda; color: #1b1e21; border-radius: 6px; padding: 10px 0; width: 100%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 0.95rem;">
        Status Found!
      </div>

      <!-- Application Details -->
      <div id="applicationDetails" style="display: none; text-align: left;" class="mt-3">
        <div id="applicationDetails" style="display: none; text-align: left;" class="mt-3">
        <p><strong>Full Name:</strong> <span id="fullName"></span></p>
        <p><strong>Application Type:</strong> <span id="appType"></span></p>
        <p><strong>Status:</strong> <span id="appStatus"></span></p>
        <p><strong>Remarks:</strong> <span id="remarks"></span></p>
        </div>
    </form>
  </div>
</div>

<script>
  document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const refCode = document.getElementById('refCode').value.trim();
    document.getElementById('refCodeDisplay').textContent = refCode;
    document.getElementById('fullName').textContent = "";       
    document.getElementById('appType').textContent = "";        
    document.getElementById('appStatus').textContent = "";      
    document.getElementById('remarks').textContent = "";        
    document.getElementById('statusMsg').style.display = 'block';
    document.getElementById('applicationDetails').style.display = 'block';
  });
</script>
</body>
</html>

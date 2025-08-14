<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /public/login_form.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>PWD Online Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- ✅ Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Import Poppins Font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">


  <!-- ✅ Custom Styles -->
  <style>
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Initially hide the Empowering Section */
    .empowering-section {
      opacity: 0;
      transform: translateY(50px);
      transition: opacity 0.5s, transform 0.5s;
    }

    .empowering-section.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body class="bg-white flex flex-col min-h-screen text-gray-800">

<!-- Header Section -->
<header class="relative bg-gradient-to-r from-blue-700 to-blue-900 text-white py-6 px-4">

  <!-- Main Header Content -->
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 mt-4 md:mt-0">
    
<!-- Welcome Section -->
<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 mt-4 md:mt-0">

<!-- Logos -->
<div class="flex items-center gap-4">
  <img src="../assets/pictures/pdao_logo.png" alt="PWD Logo" class="w-32 h-32 object-contain" />
  <img src="../assets/pictures/iligan_logo.png" alt="Iligan Logo" class="w-32 h-32 object-contain" />
</div>

  <!-- Welcome Text and Action Buttons -->
  
<?php if (isset($_SESSION['first_name'])): ?>
  <a href="/public/logout.php" 
     class="absolute top-4 right-6 text-sm text-white-200 underline hover:text-red-400 z-50">
     Logout
  </a>
<?php endif; ?>
      <div>
        <h1 class="text-2xl md:text-3xl font-bold">
          <?php
            if (isset($_SESSION['first_name'])) {
              echo "Welcome to PWD Online Application, " . htmlspecialchars($_SESSION['first_name']) . "!";
            } else {
              echo "Welcome to PWD Online Application!";
            }
          ?>
        </h1>
        <p class="text-sm md:text-base mt-1">
          Iligan City's official platform for empowering Persons with Disabilities through fast and inclusive ID processing.
        </p>
      </div>
    </div>
  </div>
</header>

      
<!-- Buttons Section -->
<section class="bg-white py-7 px-5 text-center mt-20">
  <div class="max-w-7xl mx-auto">
    <!-- Flex container with no wrapping to keep buttons on one line -->
    <div class="flex justify-center gap-5 mb-6">

      <!-- New Registration -->
     <a href="<?php echo isset($_SESSION['user_id']) ? '../src/client/form1.php?type=new' : '/public/login_form.php'; ?>"
        class="bg-blue-800 text-white font-semibold px-8 py-6 rounded-lg shadow-md hover:bg-blue-800 transition w-56 sm:w-64 flex flex-col items-center">
        <img src="../assets/pictures/newreg.png" alt="New Registration" class="w-16 h-16 mb-3" />
        <span class="text-lg font-semibold">New Registration</span>
      </a>

     <!-- Renew ID -->
      <a href="<?php echo isset($_SESSION['user_id']) ? '/src/client/form1.php?type=renew' : '/public/login_form.php'; ?>"
        class="bg-blue-800 text-white font-semibold px-8 py-6 rounded-lg shadow-md hover:bg-blue-800 transition w-56 sm:w-64 flex flex-col items-center">
        <img src="../assets/pictures/renewreg.png" alt="Renew ID" class="w-16 h-16 mb-3" />
        <span class="text-lg font-semibold">Renew ID</span>
      </a>

      <!-- Lost ID -->
      <a href="<?php echo isset($_SESSION['user_id']) ? '/src/client/form1.php?type=lost' : '/public/login_form.php'; ?>"
        class="bg-blue-800 text-white font-semibold px-8 py-6 rounded-lg shadow-md hover:bg-blue-800 transition w-56 sm:w-64 flex flex-col items-center">
        <img src="../assets/pictures/lostid.png" alt="Lost ID" class="w-16 h-16 mb-3" />
        <span class="text-lg font-semibold">Lost ID</span>
      </a>

      <!-- Check Status -->
      <a href="check_status.php" class="bg-blue-800 text-white font-semibold px-8 py-6 rounded-lg shadow-md hover:bg-blue-800 transition w-56 sm:w-64 flex flex-col items-center">
        <img src="../assets/pictures/checkstatus.png" alt="Check Status" class="w-16 h-16 mb-3" />
        <span class="text-lg font-semibold">Check Status</span>
      </a>

    </div>

<!-- Button Group: Requirements + Login/Signup -->
<div class="flex flex-col items-center gap-4 mt-10">
  
  <!-- Requirements Button -->
  <a href="#requirements" class="mt-20 bg-blue-800 text-white text-lg font-semibold px-12 py-2 rounded shadow hover:bg-blue-900 transition mb-40">
    Requirements
  </a>
  
</div>


<!-- Empowering Section (Force Full-Width Background and Content) -->
<section class="w-full bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center py-20 px-6 mt-60">

    <h2 class="text-3xl md:text-4xl font-bold mb-6">Empowering Every Step</h2>
    <p class="text-sm md:text-base leading-relaxed max-w-3xl mx-auto">
      Welcome to the PWD Online ID Application — a digital space where accessibility meets simplicity.
      Apply, connect, and stay informed all in one place.
    </p>
    <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/public/login_form.php'; ?>"  class="mt-8 inline-block bg-[#4177B2] text-white font-semibold px-8 py-3 rounded-[30px] shadow border border-black hover:bg-[#3577e6] transition">
      Get Started
    </a>
  </section>



<!-- Qualifications Section (Adjusted size and margin) -->
<section id="qualifications" class="py-20 px-4 bg-white text-center mt-16">
  <h3 class="text-2xl md:text-3xl font-extrabold mb-8" style="font-family: 'Quicksand', sans-serif; color: #072176;">Qualifications for Applying for a PWD ID</h3> 
  <div class="bg-blue-50 max-w-md mx-auto p-10 rounded-lg shadow-lg text-left space-y-4 text-sm leading-relaxed border border-blue-200" style="box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
    <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Must be 59 years old or below</p>
    <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Resident of Iligan City only</p>
    <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Must be a Filipino citizen</p>
    <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Must have a specific type of disability</p>
  </div>
</section>


<!-- Application Requirements Section -->
<section id="requirements" class="py-20 px-4 bg-white mt-10 mb-20">
  <h3 class="text-2xl md:text-3xl font-extrabold text-center mb-12" style="font-family: 'Quicksand', sans-serif; color: #072176;">Application Requirements</h3>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto text-sm">

    <!-- New Application -->
    <div class="bg-blue-50 p-8 rounded-lg shadow border border-blue-200 space-y-4 text-left">
      <div class="flex items-center gap-2">
    <img src="../assets/pictures/new_icon.png" alt="New" class="w-6 h-6" />
        <h4 class="text-blue-700 font-semibold text-lg mb-3">New Application</h4>
      </div>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Filled-out registration form</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> 1 whole body picture</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Barangay Certificate of Residency / Indigency</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Doctor's Referral / Medical Certificate</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Certificate from City Health Office</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> 1 pc 1x1 ID picture</p>

    </div>

    <!-- ID Renewal -->
    <div class="bg-blue-50 p-8 rounded-lg shadow border border-blue-200 space-y-4 text-left">
      <div class="flex items-center gap-2">
        <img src="../assets/pictures/renew_icon.png" alt="Renew" class="w-6 h-6" />
        <h4 class="text-blue-700 font-semibold text-lg mb-3">ID Renewal</h4>
      </div>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Filled-out registration form</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Surrender old PWD ID</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Barangay Certificate of Residency / Indigency</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Doctor's Referral / Medical Certificate</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Certificate from City Health Office</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> 1pc 1x1 ID picture</p>
    </div>

    <!-- Lost ID -->
    <div class="bg-blue-50 p-8 rounded-lg shadow border border-blue-200 space-y-4 text-left">
      <div class="flex items-center gap-2">
        <img src="../assets/pictures/lostid_icon.png" alt="Lost" class="w-6 h-6" />
        <h4 class="text-blue-700 font-semibold text-lg mb-3">Lost ID</h4>
      </div>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Filled-out registration form</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Affidavit of Loss</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Barangay Certificate of Residency / Indigency</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Doctor's Referral / Medical Certificate</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> Certificate from City Health Office</p>
      <p><img src="../assets/pictures/check.png" alt="Check" class="w-4 h-4 inline-block" /> 1pc 1x1 ID picture</p>
    </div>

<!-- Footer (No changes needed, but adjusted the padding) -->
<footer class="fixed bottom-0 left-0 w-full bg-gradient-to-tr from-blue-600 to-blue-950 text-white text-center py-7 px-4 shadow-inner">
  <p class="text-sm font-semibold">© 2025 PWD Online ID Application. All Rights Reserved.</p>
  <p class="text-xs mt-1 italic text-gray-100">Designed with care and inclusivity.</p>
</footer>

  <!-- ✅ JavaScript to detect when the Empowering Section is in view -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const empoweringSection = document.querySelector('.empowering-section');
        if (!empoweringSection) return; // no target, nothing to observe (prevents error)

        const observer = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              empoweringSection.classList.add('visible');
              obs.disconnect();
            }
          });
        }, { threshold: 0.5 });

        observer.observe(empoweringSection);
      });
    </script>

</body>
</html>
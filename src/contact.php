<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Contact Us</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <style>
    :root {
      --brand: #14258A;
      --text-dark: #212529;
      --bg-page: #f4f5f5;
      --gap: 2rem;
    }
    body {
      margin: 0;
      background: var(--bg-page);
      color: var(--text-dark);
      font-family: system-ui, sans-serif;
    }
    .contact-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: var(--gap) 1rem;
    }
    .contact-wrapper {
      max-width: 900px;
      width: 100%;
      margin: 0 auto;
    }
    .pretitle {
      font-size: 1.2rem;
      font-weight: 500;
      color: var(--brand);
      margin-bottom: 0.5rem;
    }
    .title {
      font-size: 3rem;
      font-weight: 700;
      color: var(--brand);
      margin-bottom: var(--gap);
      line-height: 1.1;
    }
    .intro {
      font-size: 1.2rem;
      line-height: 1.6;
      margin-bottom: var(--gap);
      max-width: 550px;
    }
    .contact-info li {
      list-style: none;
      display: flex;
      align-items: center;
      margin-bottom: 1.25rem;
      font-size: 1.1rem;
    }
    .contact-info i {
      color: var(--brand);
      font-size: 1.5rem;
      width: 2rem;
      text-align: center;
      margin-right: 0.75rem;
    }
    .contact-info a {
      color: var(--text-dark);
      text-decoration: none;
    }
    .contact-info a:hover {
      text-decoration: underline;
    }
    .illustration {
      max-width: 150%;
      width: auto;
      height: auto;
      display: block;
      margin: 0 auto var(--gap);
    }

    @media (min-width: 768px) {
      .left-shift {
        margin-left: -4rem;
      }
    }

    @media (max-width: 991px) {
      .contact-page {
        flex-direction: column;
        text-align: center;
        padding: calc(var(--gap)/2) 1rem;
      }
      .illustration {
        margin: 0 0 var(--gap) 0;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <main class="contact-page">
    <div class="contact-wrapper">
      <div class="row gx-4 align-items-center">
        <!-- Left Column, nudged left on md+ -->
        <div class="col-12 col-md-6 left-shift">
          <p class="pretitle">How can we help you?</p>
          <h1 class="title">Contact us</h1>
          <p class="intro">
            Your concerns matter to us. If you have any questions or need support,
            don’t hesitate to contact us — we’re here to help.
          </p>
          <ul class="contact-info p-0 mb-0">
            <li>
              <i class="fa-solid fa-location-dot"></i>
              Zone 3B, Del Carmen, Iligan City, 9200 Lanao del Norte
            </li>
            <li>
              <i class="fa-solid fa-phone"></i>
              <a href="tel:+6322289471">228 – 9471</a>
            </li>
            <li>
              <i class="fa-regular fa-envelope"></i>
              <a href="mailto:support@yourdomain.com">support@yourdomain.com</a>
            </li>
          </ul>
        </div>

        <!-- Right Column -->
        <div class="col-12 col-md-6">
          <img
            src="/assets/pictures/contact.png"
            alt="Customer support illustration"
            class="illustration"
          />
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DogoManager</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css"
      rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" ></script>
  </head>

  <body class="pt-5">

    <?php include("encabezado.php")?>
    <?php include 'modalsignup.php'; ?>
    <?php include 'modallogin.php'; ?>

    <!-- NAVBAR -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black bg-opacity-50 shadow">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <i class="fa-solid fa-house me-2"></i>
          DogoManager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <!-- SignUp button -->
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
            </li>
            <li class="nav-item">
              <!-- Login button -->
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</a>
            </li>
        </ul>
        </div>
      </div>
    </nav>

    <!-- HEADER -->
    <header class="header-bg d-flex align-items-center text-center py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h1 class="display-4 text-white fw-bold mb-3 hero-title">
              Welcome to DogoManager
            </h1>
            <p class="lead text-white hero-subtitle">
              The best platform for safe and reliable dog walking.
            </p>
          </div>
        </div>
      </div>
    </header>

    <!-- MAIN -->
    <main class="bg-light p-5 rounded shadow my-5 mx-auto" style="margin-top:-3rem; max-width:90%; z-index:3">
      <!-- General Information -->
      <section id="info-general" class="mb-5">
        <h2 class="h2 fw-bold" style="font-family:'Poppins',sans-serif">General Information</h2>
        <p class="text-center">
          DogoManager connects dog owners with professional walkers.
          Sign up, add your furry friends and book walks easily.
        </p>
      </section>
      <!-- Walkers List (mejorar esta parte)-->
      <section id="list-walkers">
        <h2 class="h2 fw-bold" style="font-family:'Poppins',sans-serif">Available Walkers</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <!-- Walker Card -->
          <div class="col">
            <div class="card border-0 rounded-3 shadow-sm overflow-hidden h-100">
              <img
                src="https://via.placeholder.com/350x200"
                class="card-img-top"
                style="height: 200px; object-fit: cover;"
                alt="Photo of Juan Pérez walker"
              >
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">Juan Pérez</h5>
                <p class="card-text text-muted mb-2">Rate: $10 / hour</p>
                <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">
                  <i class="fa-solid fa-user-lines me-1"></i> View Profile
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-light py-4">
      <div class="container text-center small">
        ©2025 DogoManager • Contact: info@dogomng.com
      </div>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>
  
  </body>
</html>
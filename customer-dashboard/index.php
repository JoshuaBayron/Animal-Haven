<?php
session_start();

if (!isset($_SESSION['Customerid'])) {
    header("Location: ../PHP/PetOwner.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>iPortfolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>


  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/profile-img.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">Alex Smith</a></h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="user.html" class="nav-link scrollto"><i class="bx bx-user"></i> <span>My Account</span></a></li>
          <li><a href="#pet-information" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Pet Information</span></a></li>
          <li><a href="#pet-status" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Pet Status</span></a></li>
          <li><a href="add.html" class="nav-link scrollto"><i class="bx bx-add-to-queue"></i> <span>Add Pet</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="pet-information" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Animal Information</h2>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">

            <div style="width: 100%; overflow-x: auto;">
              <table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 10%;">Sex</th>
                    <th style="width: 5%;">Age</th>
                    <th style="width: 10%;">Birthdate</th>
                    <th style="width: 15%;">Species</th>
                    <th style="width: 15%;">Breed</th>
                    <th style="width: 5%;">Quantity</th>
                    <th style="width: 15%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Your table rows go here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
    
  </main><!-- End #main -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="pet-status" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Animal Status</h2>
        </div>

      <div class="row" data-aos="fade-in">
        <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
          
          <div style="width: 100%; overflow-x: auto;">
            <table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
              <thead>
                <tr>
                  <th style="width: 10%;">No</th>
                  <th style="width: 20%;">Name</th>
                  <th style="width: 20%">Service</th> <!-- Hide Service column on small screens -->
                  <th style="width: 20%;">Date</th>
                  <th style="width: 15%;">Time</th>
                  <th style="width: 15%;">Status</th>
                </tr>
              </thead>
              <tbody>
                <!-- Your table rows go here -->
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
    </section><!-- End Contact Section -->
    
  </main><!-- End #main -->
  <!-- <h2>Welcome, !<?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html> 

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../PHP/PetOwner.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pawpointment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM customertbl WHERE UserName = '$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Error retrieving user data.";
}


$conn->close();
?>
<!--
  Columns for customer tbl
  CustomerID
  FirstName
  LastName
  MiddleInitial
  UserName
  Password
  ContactNumber
  Address
  Email
  -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>iPortfolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        <img src="../img/logo.png" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">PawPointment</a></h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="user.html" class="nav-link scrollto active"><i class="bx bx-user"></i> <span>My Account</span></a></li>
          <li><a href="index.html" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Dashboard</span></a></li>
          <li><a href="add.html" class="nav-link scrollto"><i class="bx bx-add-to-queue"></i> <span>Add Pet</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <main id="main">

   <!-- ======= Contact Section ======= -->
   <section id="add" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Your Account/ <span>Settings</span></h2>
      </div>

      <div class="row" data-aos="fade-in">

        <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            
            <div class="row">
              <div class="img-profile">
                <div class="profile-image-container">
                  <img id="profile-image" src="../img/logo.png" alt="Profile Picture">
                  <div class="edit-icon" id="edit-icon">&#9998;</div>
                  <h1>Welcome, <?php echo $user['FirstName']; ?>!</h1>
                </div>
              </div>
              <div class="modal" id="image-modal">
                <span class="close-modal" id="close-modal">&times;</span>
                <img class="modal-content" id="modal-image">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Last Name</label>
                <input type="text" class="form-control" name="lname" id="lname" required value="<?php echo $user['LastName']; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name="fname" id="fname" required value="<?php echo $user['FirstName']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="name">Email</label>
              <input type="text" class="form-control" name="email" id="email" required value="<?php echo $user['Email']; ?>">
            </div>
            
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control" name="password" id="password" required value="<?php echo $user['Password']; ?>">
            </div>
            
            <div class="form-group">
              <label for="name">Contact Number</label>
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="0929-***-****" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" required value="<?php echo $user['ContactNumber']; ?>">
            </div>

            <div class="text-center" style="display: inline-block;"><button type="submit">Update</button></div>
            <div class="text-center" style="display: inline-block;">
              <button type="reset">Reset</button>
            </div>
            <div class="text-center" style="display: inline-block;">
              <p><a href="../PHP/pet_owner_logout.php">Logout</a></p>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  </main><!-- End #main -->

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
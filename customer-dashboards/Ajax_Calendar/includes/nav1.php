
<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <div class="d-flex flex-column">

      <div class="profile">
      <?php

      // Customer ID (assuming it's a string)
      $customerId = $_SESSION['customer_id'];

      // Sanitize and escape the customer ID to prevent SQL injection
    $customerId = $conn->real_escape_string($customerId);

      // Construct the SQL query to retrieve the image based on customer ID
      $sql = "SELECT image
        FROM customer_profile_infos
        WHERE customer_id = '$customerId'";

        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $imageData = $row['image'];

        // Display the image using an HTML img tag
          // echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image">';
               echo '<img src="img/' . htmlspecialchars($imageData) . '" alt="' . htmlspecialchars($imageData) . '" title="' . htmlspecialchars($imageData) . '" class="img-fluid rounded-circle">';
      } else {
            echo "Image not found for this customer.";
          }
        // require_once 'backend/connection.php';
        // $userId = $_SESSION['customer_id'];

        // // Use prepared statement to prevent SQL injection
        // $fetch_image = "SELECT image FROM customer_profile_infos WHERE customer_id = ?";
        // $stmt = $conn->prepare($fetch_image);

        // if ($stmt) {
        //     $stmt->bind_param("i", $userId); // 'i' for integer, adjust if $userId is not an integer
        //     $stmt->execute();
        //     $stmt->bind_result($image);

        //     if ($stmt->fetch()) {
                // echo '<img src="../logins/backend/img/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($image) . '" title="' . htmlspecialchars($image) . '" class="img-fluid rounded-circle">';
        //     } else {
        //         echo "No available image";
        //     }

        //     $stmt->close();
        // } else {
        //     echo "Error preparing statement.";
        // }

        // $conn->close();
      ?>


      <h1 class="text-light">
          <div class="dropdown">
            <a href="#" title="User Options">
              <i class="fas fa-user"></i>
            </a>

            <div class="dropdown-menu" id = "dropdown">
              <a href="user.php"><i class="bx bx-user"></i> <span>My Account</span></a>
              <a href="notifications.php"><i class="bx bx-bell"></i> <span>Notifications</span></a>
              <a onclick="confirmLogout()" id="" title="Logout Dashboard">
                <i class="fas fa-sign-out-alt"></i> Sign Out
              </a>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
        <script>
            function confirmLogout() {
            Swal.fire({
            title: 'Logout Confirmation',
            text: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to logout.php for handling logout logic
        window.location.href = 'includes/logout.php';
      }
    });
  }
        </script>
               <?php
        $conn = mysqli_connect("localhost","root","","pawheaven");

        $customerId = $_SESSION['customer_id'];; // Replace with the actual customer ID

        // Construct the SQL query to retrieve the image based on customer ID
        $sql = "SELECT customers.*, customer_profile_infos.* 
                FROM customers
                INNER JOIN customer_profile_infos ON customers.customer_id = customer_profile_infos.customer_id
                WHERE customers.customer_id = '$customerId'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        // Assuming 'image' is the column name in the customer_profiles table
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        // Display the image using an HTML img tag
        //echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image">';
        } else {
        //echo "Image not found for this customer.";
      }

      ?>
          </div>

          <?php echo $lname.", ".$fname; ?>    
        </h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="animal-info.php" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Pet List</span></a></li>
          <li><a href="animal-status.php" class="nav-link scrollto"><i class="bx bx-add-to-queue"></i> <span>Pet Status</span></a></li>
          <li><a href="add.php" class="nav-link scrollto"><i class="bx bx-add-to-queue"></i> <span>Add Pet</span></a></li>
          <li><a href="add-appointment.php" class="nav-link scrollto"><i class="bx bx-add-to-queue"></i> <span>Add Appointment</span></a></li>
          
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown .dropdown-toggle {
        cursor: pointer;
    }

    .dropdown .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #4C3D3D;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 99;
        border-radius: 10px;
        transition: ease-in-out 0.3s;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
    }

    .dropdown-menu a:hover {
        background-color: #C07F00;
        border-radius: 100px;
        transition: ease-in-out 0.3s;
    }
</style>
<script>
         document.addEventListener("DOMContentLoaded", function () {
        var dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener("click", function () {
                this.querySelector(".dropdown-menu").classList.toggle("show");
            });
        });

        window.addEventListener("click", function (e) {
            dropdowns.forEach(function (dropdown) {
                if (!dropdown.contains(e.target)) {
                    dropdown.querySelector(".dropdown-menu").classList.remove("show");
                }
            });
        });
        const signOutLink = document.getElementById("sign-out-link");

      // Add a click event listener to the link
      signOutLink.addEventListener("click", function (event) {
        // Prevent the default link behavior (navigation)
        event.preventDefault();

        // Show the SweetAlert confirmation dialog
        Swal.fire({
          title: "Are you sure?",
          text: "You are about to sign out. Do you want to continue?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
        }).then((result) => {
          if (result.isConfirmed) {
            // If the user confirms, navigate to the logout page
           
            setTimeout(function() {
                        swal({
                            title: "SUCCESS",
                            text: "Successfully Signed Out",
                            type: "success",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                            }, function() {
                                window.location.href = "includes/logout.php";
                            });
                        });
          }
        });
      });
    });
    </script>
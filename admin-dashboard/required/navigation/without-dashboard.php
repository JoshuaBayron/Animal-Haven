<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="../assets/img/logo.png" alt="" class="img-fluid rounded-circle">
        
        <h1 class="text-light">
          <div class="dropdown">
            <a href="#" title="User Options">
              <i class="fas fa-user"></i>
            </a>

            <div class="dropdown-menu">
              <a href="login-form/index.php"><i class="bx bx-user"></i> <span>My Account</span></a>
              <!-- <a href="notification.php"><i class="bx bx-bell"></i> <span>Notifications</span></a> -->
              <a href="index.php"><i class="fas fa-calendar"></i> <span>Calendar</span></a>
              <a href="#" id="sign-out-link" title="Logout Dashboard">
                <i class="fas fa-sign-out-alt"></i> Sign Out
              </a>
            </div>
          </div>
          Howdy! <?php  echo $user_name;?>
        </h1>

      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <!-- <li><a href="../calendar/dynamic-full-calendar.php" class="nav-link scrollto"><i class="fas fa-calendar-alt"></i> <span>Staff Calendar</span></a></li> -->
          <li><a href="services.php" class="nav-link scrollto"><i class="bx bx-comment-detail"></i> <span>Services</span></a></li>
          <li><a href="staff.php" class="nav-link scrollto"><i class="bx bxs-group"></i> <span>Staff</span></a></li>
          <li><a href="pet-status.php" class="nav-link scrollto"><i class="fas fa-laptop"></i><span>Online Schedules</span></a></li>
          <!-- <li><a href="unscheduled.php" class="nav-link scrollto"><i class="fas fa-wifi"></i><span>To be Scheduled</span></a></li> -->
          <li><a href="walk-in.php" class="nav-link scrollto"><i class="fas fa-walking"></i><span>Walk-in Schedules</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
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
                                window.location.href = "required/navigation/logout.php";
                            });
                        });
          }
        });
      });
    });
    </script>
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
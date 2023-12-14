<body>

  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

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
              <a href="#" id="sign-out-link" title="Logout Dashboard">
                <i class="fas fa-sign-out-alt"></i> Sign Out
              </a>
            </div>
          </div>
          <?php
          // Display the staff's first and last name from the session
          if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
              echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
          } else {
              echo 'User'; // Default text if session data is not set
          }
          ?>
        </h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
        
          <li><a href="animal-status.php" class="nav-link scrollto"><i class="bx bx-stats"></i> <span>Animal Status</span></a></li>
          <li><a href="animal-owner-info.php" class="nav-link scrollto"><i class="bx bx-search"></i> <span>Owners and Animals</span></a></li>
        </ul>
      </nav>
    </div>
  </header>

  
<style>
      .buttonContainer {
      text-align: center; /* Center the content horizontally */
      margin-top: 20px; /* Adjust the top margin as needed */
    }
      .button {
              padding: 10px;
              cursor: pointer;
                }
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
    function toggleUpdateForm(appointmentId) {
      var updateFormRow = document.getElementById('updateFormRow' + appointmentId);
      if (updateFormRow.style.display === 'none') {
        updateFormRow.style.display = 'table-row';
      } else {
        updateFormRow.style.display = 'none';
      }
    }

    function confirmDelete(appointmentId) {
      if (confirm('Are you sure you want to delete this appointment?')) {
        document.getElementById('deleteForm' + appointmentId).submit();
      }


    }
 
    </script>
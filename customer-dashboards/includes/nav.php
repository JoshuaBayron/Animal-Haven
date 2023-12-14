


<style>
    .red

    .upload{
      width: 140px;
      position: relative;
      margin: auto;
      text-align: center;

    }
    .upload img{
      border-radius:  50%;
      border: 8px solid #DCDCDC;
      width: 125px;
      height: 125px;

    }
</style>
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
              if(!empty($imageData)){
                echo '<div class="upload"><img src="img/' . htmlspecialchars($imageData) . '" alt="' . htmlspecialchars($imageData) . '" title="' . htmlspecialchars($imageData) . '" width = 125 height = 125 ></div>';
              }else
              {
                 echo '<div class="upload"><img src="img/noprofile.jpg" alt="noprofil.jpg" title="noprofil.jpg" width = 125 height = 125 ></div>';
              }
               
              
              
            } else {
            echo '<div class="upload"><img src="img/noprofile.jpg" alt="noprofil.jpg" title="noprofil.jpg" width = 125 height = 125 ></div>';
          }
     
      ?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <h1 class="text-light">
          <div class="dropdown">
            <a href="#" title="User Options">
              <i class="fas fa-user"></i>
            </a>

            <div class="dropdown-me" id = "dropdown">
              <a href="user.php"><i class="bx bx-user"></i> <span>My Account</span></a>
              <div class="dropdown-menuu" id = "dropdown">

                <!-- <a href="notifications.php" class="dropdown-toggle"><i class="bx bx-bell"></i> <span>Notifications</span></a> -->
                
                    <li class="dropdown">
            
                    <a href="notifications.php" class="dropdown-toggle" ><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <i class="bx bx-bell"></i><span >Notifications</span></a>
                    <ul href = "notifications.php" class="dropdown-menu"></ul>

                     </li>
                
            <ul href = "notifications.php" class="dropdown-menu"></ul>


                </div>
              <a onclick="confirmLogout()" id="" title="Logout Dashboard">
                <i class="fas fa-sign-out-alt"></i> Sign Out
              </a>
            </div>

            <script>
                $(document).ready(function(){
 
  function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"notifications-backend/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 
 load_unseen_notification();
 // load_unseen_notification_appointment();
 

 $(document).on('click', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){ 
  load_unseen_notification();;
 });
 

});

            </script>

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
          <li><a href="animal-info.php" class="nav-link scrollto"><i class="fas fa-list-ul"></i> <span>Pet List</span></a></li>
          <li><a href="animal-status.php" class="nav-link scrollto"><i class="fas fa-heartbeat"></i> <span>Pet Status</span></a></li>
          <li><a href="add.php" class="nav-link scrollto"><i class="fas fa-paw"></i> <span>Add Pet</span></a></li>
          <li><a href="add-appointment.php" class="nav-link scrollto"><i class="bx bx-alarm-add"></i> <span>Add Appointment</span></a></li>
          <li><a href="Ajax_Calendar/index.php" class="nav-link scrollto"><i class="far fa-calendar-plus"></i> <span>Calendar</span></a></li>
         
          
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

    .dropdown .dropdown-me {
        display: none;
        position: absolute;
        background-color: #4C3D3D;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 99;
        border-radius: 10px;
        transition: ease-in-out 0.3s;
    }

    .dropdown:hover .dropdown-me {
        display: block;
    }

    .dropdown-me a {
        display: block;
        padding: 10px;
        text-decoration: none;
        font-size: 14px;
        color: #333;
    }

    .dropdown-me a:hover {
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
                this.querySelector(".dropdown-me").classList.toggle("show");
            });
        });

        window.addEventListener("click", function (e) {
            dropdowns.forEach(function (dropdown) {
                if (!dropdown.contains(e.target)) {
                    dropdown.querySelector(".dropdown-me").classList.remove("show");
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
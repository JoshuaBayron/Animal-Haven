<?php include 'header.php';?>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    <!-- Navbar Start -->
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
        <a href="index.html" class="navbar-brand ml-lg-3">
            <h1 class="m-0 display-5"><span class="text-primary">Animal</span>Haven</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-lg-3" id="navbarCollapse">
            <div class="navbar-nav m-auto py-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#service" class="nav-item nav-link">Service</a>
                <a href="#contact" class="nav-item nav-link">Contacts</a>
            </div>
            <a class="btn btn-outline-primary d-none d-lg-block" onclick="openForm()">LOGIN</a>
                <div class="form-popup" id="myForm">
                    <div class="form-container">
                        <i class="fas fa-times close-icon" onclick="closeForm()"></i>
                        <h1>Login</h1>
                        <div class="btn">
                        <form action="logins/backend/crude.php" method="POST">
                                <input class="input100" type="text" name="username" id="username" placeholder="Please Enter Your Email">	
                                <input class="input100" type="password" name="pass" id="pass" placeholder="Please Enter Your Password"> 
                                <select class="select" name="role" id="role">
									<option value="none" selected >Select Role</option>
                                    <option value="customer" class="light">Customer</option>
									<option value="staff" class="light">Staff</option>
								</select>
                                <button type="submit" class="button"> 	
                                    Login
                                </button>
                                <br>
                                <a href="logins/customer-reg.php" style="color:white">Register Here!</a><br>
                                <a href="logins/password-reset.php" style="color:white">Forgot your Password?</a>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary d-flex align-items-center mb-5 py-5" id="home" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 px-5 pl-lg-0 pb-5 pb-lg-0">
                    <img class="img-fluid w-100 rounded-circle shadow-sm flying-dog" src="assets/img/logo.png" alt="">
                </div>
                <div class="col-lg-7 text-center text-lg-left">
                    <h3 class="text-white font-weight-normal mb-3">Welcome!</h3>
                    <h1 class="display-3 text-uppercase text-primary mb-2" style="-webkit-text-stroke: 2px #C07F00;">ANIMAL HAVEN</h1>
                    <h1 class="display-4 text-primary mb-5" style="-webkit-text-stroke: 2px #C07F00;"> Veterinary Clinic</h1>
                    <h1 class="typed-text-output d-inline font-weight-lighter text-white"></h1>
                    <div class="typed-text d-none">Pet Vaccination, Pet Treatment, Pet Consultation, Pet Surgery, Pet Grooming, Others</div>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="#about" onclick="openForm()" class="btn btn-outline-light mr-5">Getting Started</a>
                        <button type="button" class="btn-play" data-toggle="modal"
                            data-src="assets/img/dog-rocket.png" data-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="font-weight-normal text-white m-0 ml-4 d-none d-sm-block">Play Video</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">About</h1>
                <h1 class="position-absolute text-uppercase text-primary">About Us</h1>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <img class="img-fluid rounded w-100 flying-dog" src="assets/img/muscle-cat.png" alt="">
                </div>
                <div class="col-lg-7">
                    <h3 class="mb-4">Animal Haven Veterinary Clinic</h3>
                    <p>Situated in Km 6 La Trinidad Benguet, Animal Haven Veterinary Clinic is a comprehensive facility providing an array of services encompassing preventive care, treatment for sick and injured animals, surgical and dental procedures, grooming, and boarding. The clinic, operational from 9:00 AM to 5:00 PM on weekdays and from 9:00 AM to 12:00 PM on Saturdays, boasts a team of skilled veterinarians and technicians devoted to delivering optimal care for your pets. Beyond medical assistance, Animal Haven Veterinary Clinic extends its offerings to include various pet-related products and services like food, supplies, grooming items, training classes, and pet sitting services, consolidating all your pet needs under one roof. The clinic's commitment to excellence is evident through its modern facilities, friendly staff, and a dedication to ensuring clients receive the highest quality care. Choosing Animal Haven Veterinary Clinic ensures a seamless and reliable experience for your beloved pets, meeting their diverse requirements with a holistic approach.</p>
                    
                    <a onclick="openForm()" class="btn btn-outline-primary mr-4">Avail Services</a>
                    <a href="#service" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid pt-5" id="service">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Service</h1>
                <h1 class="position-absolute text-uppercase text-primary">Our Services</h1>
            </div>
            <div class="row pb-3">
            <?php
                // Get the search query from the form.
                $searchQuery = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

                // Connect to the MySQL database.
                $db = new PDO('mysql:host=localhost;dbname=pawheaven', 'root', '');

                // Create a SQL query to select the services that match the search query.
                $sql = "SELECT services_id, services_title, services_description, services_image FROM services WHERE services_title LIKE '%$searchQuery%'";

                // Execute the SQL query and get the results.
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display the results to the user.
                foreach ($services as $service) {
                    echo '<div class="col-lg-4 col-md-6 text-center mb-5">';
                    echo '<div class="d-flex align-items-center justify-content-center mb-4">';
                    echo '<img src="assets/img/' . $service['services_image'] . '" class="service-icon bg-primary text-white mr-3">';
                    echo '<h4 class="font-weight-bold m-0">' . $service['services_title'] . '</h4>';
                    echo '</div>';

                    // Display only the first 20 words of services_description.
                    $shortDescription = implode(' ', array_slice(explode(' ', $service['services_description']), 0, 20));
                    echo '<p>' . $shortDescription . '...</p>';

                    // Corrected link generation with services_id.
                    echo '<a class="border-bottom border-primary text-decoration-none" href="readmore.php?service_id=' . $service["services_id"] . '">Read More</a>';
                    echo '</div>';
                }

                if (empty($services)) {
                    echo '<div class="alert alert-info">No services found.</div>';
                }
            ?>
                  </div>
    </div>
    <!-- Services End -->


   <!-- Contact Start -->
    <div class="container-fluid py-5" id="contact">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Contact</h1>
                <h1 class="position-absolute text-uppercase text-primary">Contact Us</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php
                    ini_set('display_errors', 1);

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "pawheaven";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch contacts from the database
                    $query = "SELECT `contacts_id`, `contacts`, `admin_id` FROM `admin_contacts_infos` WHERE 1";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $contacts = $row['contacts'];

                            // Print the contacts inside the HTML structure
                            echo '<div class="contact-form text-center">
                                    <div id="success"></div>
                                    
                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                        <img src="assets/img/pet-vaccine.png" class="service-icon bg-primary text-white mr-3">
                                        <h4 class="font-weight-bold m-0">' . $contacts . '</h4>
                                    </div>
                                </div>';
                        }
                    } else {
                        // Handle the case when no contacts are found
                        echo '<p>No contacts found.</p>';
                    }

                    // Close the database connection here if needed
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-primary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="container text-center py-5">
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-light btn-social mr-2" href="https://www.facebook.com/joshua.bayron.96387"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-light btn-social mr-2" href="https://www.linkedin.com/in/joshua-bayron-3642a9258/"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-light btn-social" href="https://www.instagram.com/jayzesotero/"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <a class="text-white" href="#">Privacy</a>
                <span class="px-3">|</span>
                <a class="text-white" href="#">Terms</a>
                <span class="px-3">|</span>
                <a class="text-white" href="#">FAQs</a>
                <span class="px-3">|</span>
                <a class="text-white" href="#">Help</a>
            </div>
            <p class="m-0">&copy; <a class="text-white font-weight-bold" href="#">PAWPOINTMENT</a>. All Rights Reserved. Designed by <a class="text-white font-weight-bold" href="https://github.com/JoshuaBayron">Juswa</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->

<?php include 'footer.php'?>
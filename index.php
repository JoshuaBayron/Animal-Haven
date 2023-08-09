<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Animal Haven</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/logo.png" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

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
                        <button type="submit" class="btn">
                            <i class="fas fa-user"></i> Customer
                        </button>
                    
                        <button type="submit" class="btn">
                            <i class="fas fa-user-tie"></i> Staff
                        </button>
                    
                        <button type="submit" class="btn">
                            <i class="fas fa-user-shield"></i> Admin
                        </button>
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
                    <img class="img-fluid w-100 rounded-circle shadow-sm flying-dog" src="img/dog-rocket.png" alt="">
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
                            data-src="img/dog-rocket.png" data-target="#videoModal">
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
                    <img class="img-fluid rounded w-100 flying-dog" src="img/muscle-cat.png" alt="">
                </div>
                <div class="col-lg-7">
                    <h3 class="mb-4">Animal Haven Veterinary Clinic</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    
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
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/pet-vaccine.png" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Pet Vaccination</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/pet-treatment.webp" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Pet Treatment</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/pet-consultation.png" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Pet Consultation</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/pet-surgery.png" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Pet Surgery</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/pet-grooming.png" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Pet Grooming</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="img/animals.jpg" class="service-icon bg-primary text-white mr-3">
                        <h4 class="font-weight-bold m-0">Others</h4>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                    <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                </div>
            </div>
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
                    <div class="contact-form text-center">
                        <div id="success"></div>
                        
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <img src="img/pet-vaccine.png" class="service-icon bg-primary text-white mr-3">
                            <h4 class="font-weight-bold m-0">0928 502 5154  DOC Abi</h4>
                        </div>

                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <img src="img/pet-vaccine.png" class="service-icon bg-primary text-white mr-3">
                            <h4 class="font-weight-bold m-0">0968 879 1877 DOC Gina</h4>
                        </div>
                    </div>
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

    <!-- Scroll to Bottom -->
    <a href="#about" onclick="openForm()"><i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i></a>

    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-dark px-0 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/typed/typed.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

<?php include 'header.php';?>
<?php
// Check if the service_id is set in the URL
if (isset($_GET['service_id'])) {
    // Retrieve the service_id from the URL
    $service_id = $_GET['service_id'];

    // Connect to your MySQL database
    $mysqli = new mysqli("localhost", "root", "", "pawheaven");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare and execute the query to fetch service details based on service_id
    $query = "SELECT * FROM services WHERE services_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $service_title = $row['services_title'];
        $service_description = $row['services_description'];
        $service_image = $row['services_image'];
        // Add other fields as needed

        // Close the prepared statement and result set
        $stmt->close();
        $result->close();
    } else {
        // Handle the case when no service is found with the given service_id
        $service_title = "Service Not Found";
        $service_description = "Sorry, the requested service was not found.";
        $service_image = "Sorry, the requested service was not found.";
    }

    // Close the database connection
    $mysqli->close();
} else {
    // Handle the case when no service_id is provided in the URL
    $service_title = "Service ID Missing";
    $service_description = "Please provide a valid service ID.";
}
?>
    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
               <div class="position-relative d-flex align-items-center justify-content-center">
                    <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;"><?php echo $service_title; ?></h1>
                    <h1 class="position-absolute text-uppercase text-primary"><?php echo $service_title; ?></h1>
            </div>
    <div class="row align-items-center">
        <div class="col-lg-5 pb-4 pb-lg-0">
            <img class="img-fluid rounded w-100 flying-dog" src="assets/img/<?php echo $service_image?>" alt="">
        </div>
        <div class="col-lg-7">
            <p><?php echo $service_description; ?></p>
            
            <a href="index.php" class="btn btn-outline-primary mr-4">Avail Services</a>
            
        </div>
    </div>
        </div>
    </div>
    <!-- About End -->

<?php include 'footer.php'?>
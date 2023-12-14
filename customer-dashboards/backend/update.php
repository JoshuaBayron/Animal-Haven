<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer_id from the form
    $userId = $_POST['customer_id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    //$phone = $_POST['contact'];
    
    if ($_FILES["image"]["error"] === 4) {
        echo "<script>alert('Image Does Not Exist')</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
    
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    
        if (!in_array($imageExtension, $validImageExtension)) {
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "ERROR",
                    text: "Invalid Image Extension",
                    type: "error",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                    }, function() {
                        window.location = "../../customer-dashboards/animal-info.php";
                    });
                });
            </script>';

        } else if ($fileSize > 1000000) {
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "ERROR",
                    text: "Image Size is Too Large",
                    type: "error",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                    }, function() {
                        window.location = "../../customer-dashboards/animal-info.php";
                    });
                });
            </script>';

        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $uploadPath = 'img/' . $newImageName;
    
            if (move_uploaded_file($tmpName, $uploadPath)) {
                // Establish your database connection here
                  include 'connection.php';

                // Use prepared statements to prevent SQL injection
                $updateSql = "UPDATE `customer` SET `lastname`=?, `firstname`=?, `email`=?, `pass`=?, `contact`=? WHERE `customer_id` = ?";
                $stmt = mysqli_prepare($conn, $updateSql);
                mysqli_stmt_bind_param($stmt, "sssssi", $lname, $fname, $email, $password, $phone, $userId);
                $updateResult = mysqli_stmt_execute($stmt);
    
                    if ($updateResult) {
                        // Update successful, provide feedback to the user
                        echo '<script>
                                setTimeout(function() {
                                    swal({
                                        title: "SUCCESS",
                                        text: "Updated Successfully",
                                        type: "success",
                                        timer: 2000,
                                        showCancelButton: false,
                                        showConfirmButton: false
                                        }, function() {
                                            window.location = "../../customer-dashboards/animal-info.php";
                                        });
                                    });
                                </script>';
                    } else {
                        echo '<script>
                            setTimeout(function() {
                                swal({
                                    title: "ERROR",
                                    text: "Updated Unsuccessful",
                                    type: "error",
                                    timer: 5000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                    }, function() {
                                        window.location = "../../customer-dashboards/animal-info.php";
                                    });
                                });
                            </script>';
                    }
    
                    mysqli_stmt_close($stmt);
                }
    
                mysqli_close($conn);
            } 
        }
    }
    

?>
<?php require 'required/head.php'; ?>
<?php require 'required/navigation/without-dashboard.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style media="screen">
    .row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        }

    .form-group {
        flex-basis: 30%;
        }

    .upload {
        width: 140px;
        position: relative;
        margin: auto;
        text-align: center;
    }

    .upload img {
        border-radius: 50%;
        border: 8px solid #DCDCDC;
        width: 125px;
        height: 125px;
    }

    .upload .rightRound {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00BFFF;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload .leftRound {
        position: absolute;
        bottom: 0;
        left: 0;
        background: red;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload .fa {
        color: white;
    }

    .upload input {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    .upload input::-webkit-file-upload-button,
    .upload input[type="submit"] {
        cursor: pointer;
    }
</style>

<main id="main">
    <section id="add" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Staff Account/ <span>Edit</span></h2>
            </div>
            <div class="d-flex justify-content-end">
                <div class="form-inline">
                    <div class="form-group">
                    <button type="button" style="margin:0" onclick="user()"><i class="bx bx-user"></i></button>
                    <button type="button" style="margin:0" onclick="calendar()"><i class="fas fa-calendar"></i></button>
                    <button type="button" style="margin:0" onclick="signout()"><i class="fas fa-sign-out-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-in">
            <?php
                require_once 'backend/connection.php';

                $row = []; // Initialize $row as an empty array

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $staff_id = $_GET["staff_id"];
                    $sql = "SELECT * FROM staff WHERE staff_id = $staff_id";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                <form class="form" id="form" action="backend/crude.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="roles" value="update-staff">	
                <input type="hidden" name="staff_id" value="<?php echo $row["staff_id"]; ?>">  
                <input type="hidden" name="email" id="email" value="<?= $row["email"];?>"readonly>  
                    <div class="row">
                        <div class="form-group">
                            <label for="services_title">First Name:</label>
                            <input type="text" name="fname" id="fname" value="<?= $row["firstname"];?>" maxlength="20" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="services_image">Last Name:</label>
                            <input type="text" name="lname" id="lname"  value="<?= $row["lastname"];?>" maxlength="20" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="services_image">Middle Initial:</label>
                            <input type="text" name="mname" id="mname"  value="<?= $row["MI"];?>" maxlength="1" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="services_image">Sex:</label>
                            <select style="width: 55%;" name="gender" id="gender">
                                <option value="<?= $row["gender"]; ?>" style="color:black"><?= $row["gender"]; ?></option>
                                <option value="Male" style="color:black">Male</option>
                                <option value="Female" style="color:black">Female</option>
                                <option value="Prefer Not to Say" style="color:black">Prefer Not to Say</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="services_image">Position:</label>
                            <select style="width: 53%;" name="position" id="position">
                                <option value="<?= $row["position"]; ?>" style="color:black"><?= $row["position"]; ?></option>
                                <option value="Staff" style="color:black">Staff</option>
                                <option value="Doctor 1" style="color:black">Doctor 1</option>
                                <option value="Doctor 2" style="color:black">Doctor 2</option>
                                <option value="Cashier" style="color:black">Cashier</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" style="width:23%; margin-top: 1%">Update</button>
                    </div>
                </form>
                
                <div style="height:5%"></div>
                
                <form class="form" id="form" action="backend/crude.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="roles" value="send-reset-password">	
                <input type="hidden" name="staff_id" value="<?php echo $row["staff_id"]; ?>">  
                <input type="hidden" name="email" id="email" value="<?= $row["email"];?>"readonly>
                <input type="hidden" name="fname" value="<?php echo $row["firstname"]; ?>">
                <input type="hidden" name="lname" value="<?php echo $row["lastname"]; ?>">    
                <button type="submit" style="background-color: white; color:black; border: 2px solid #f2f2f2;">Update or Reset Password</button>
                </form>
                <?php
                    } else {
                        echo "Staff data not found.";
                    }
                }

                mysqli_close($conn);
                ?>
                <script type="text/javascript">
                    function previewServiceImage(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var serviceImagePreview = document.getElementById('serviceImagePreview');
                                serviceImagePreview.src = e.target.result;
                                serviceImagePreview.style.display = 'block';
                            };
                            reader.readAsDataURL(input.files[0]);
                            // Add logic for showing/hiding the cancel and confirm buttons
                        }
                        // Add event handling for cancel and confirm buttons
                    }
                </script>

            </div>
        </div>
    </section>
</main>
<script src="required/details/redirect.js"></script>
<?php require 'required/btp.php'; ?>
<?php require 'required/script.php'; ?>

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
                <h2>Services/ <span>Edit</span> <span style="font-size:10px">On this page, you can edit details of services. </span></h2>
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
                <form class="form" id="form" action="backend/crude.php" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="roles" value="update-services">
                    <?php
                    require_once 'backend/connection.php';

                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        $services_id = $_GET["services_id"];

                        $sql = "SELECT * FROM services WHERE services_id = $services_id";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_assoc($result);
                    ?>
                    <input type="hidden" name="services_ID" value="<?php echo $services_id; ?>" readonly style="width:10%">
                            <div class="row">
                                <div class="form-group">
                                    <label for="services_title">Service Title:</label>
                                    <input type="text" name="services_title" value="<?php echo $row['services_title']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="services_image">Service Image:</label>
                                    <input type="file" name="services_image" id="services_image" accept="image/*" value = "<?php echo $row['services_image']?>" onchange="previewServiceImage(this)">
                                </div>

                                <div class="form-group">
                                    <img id="serviceImagePreview" src="../assets/img/<?php echo $row["services_image"]?>" alt="Service Image Preview" style="max-width: 200px; border-radius: 50%; width:40%; height: auto;  border: 2px solid #4C3D3D;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="services_description">Service Description:</label>
                                <textarea name="services_description" required style="width:100%; height:300px"><?php echo $row['services_description']; ?></textarea>
                            </div>
                            <button type="submit">Update Service</button>
                    <?php
                        } else {
                            echo "Service data not found.";
                        }
                    }

                    mysqli_close($conn);
                    ?>
                </form>

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
                <?php
                // Handle image upload and form submission here
                if (isset($_POST['updateProfile'])) {
                    // Handle profile image update and other profile fields
                }
                if (isset($_POST['updateUser'])) {
                    // Handle user profile update
                }
                ?>
            </div>
        </div>
    </section>
</main>
<script src="required/details/redirect.js"></script>
<?php 
require 'required/btp.php'; 
require 'required/script.php'; 
?>

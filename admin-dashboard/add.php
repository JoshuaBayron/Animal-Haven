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
                <h2>Your Account/ <span>Settings</span></h2>
            </div>
            <div class="row" data-aos="fade-in">
                <form class="form" id="form" action="backend/crude.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="roles" value="add-services">	
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="services_title">Service Title:</label>
                            <input type="text" name="services_title" id="services_title" required>
                        </div>

                        <div class="form-group">
                            <label for="services_image">Service Image:</label>
                            <input type="file" name="services_image" id="services_image" accept="image/*" onchange="previewServiceImage(this)">
                        </div>

                        <div class="form-group">
                            <img id="serviceImagePreview" src="#" alt="Service Image Preview" style="max-width: 200px; display: none;">
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="services_description">Service Description:</label>
                        <textarea name="services_description" id="services_description" required style="width:100%; height:300px"></textarea>
                    </div>
                    <button type="submit" >Upload Service</button>
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
<?php require 'required/btp.php'; ?>
<?php require 'required/script.php'; ?>

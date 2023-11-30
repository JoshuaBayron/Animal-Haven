<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        .cancel-button {
            position: absolute;
            top: 30px;
            right: 20%;
            background-color: transparent;
            border: none;
            color: red;
            cursor: pointer;
        }

        #password-strength {
        margin-top: 5px;
        color: #999;
        }
        .weak {
            color: red;
        }
        .medium {
            color: orange;
        }
        .strong {
            color: green;
        }
    </style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('bgR.png');">
            <div class="wrap-login500">
                <h2 class="login100-form-title p-b-34 p-t-27">Change Password</h2>
                <?php
                require_once 'backend/connection.php';

                $row = []; // Initialize $row as an empty array

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $staff_id = $_GET["id"];
                    $sql = "SELECT * FROM staff WHERE staff_id = $staff_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                <form method="post" action="backend/updateStaff.php" class="login100-form validate-form">
                    <input type="hidden" name="roles" value="updateStaffPassword">
                    <input type="hidden" name="staffID" value="<?= $staff_id?>">
                    <div class="form-container">
                        <div class="wrap-input500 validate-input" data-validate="Email">
                            <input class="input100" type="text" id="email" name="email" value="<?= htmlspecialchars($row["email"]) ?>" required>
                            <span class="focus-input100" data-placeholder="&#x2709; Email"></span>
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="wrap-input500 validate-input" data-validate="Password">
                            <input class="input100" type="password" id="new_password" name="new_password" oninput="checkPasswordStrength(this.value)" required>
                            <span class="focus-input100" data-placeholder="&#xf191; New Password"></span>
                            <div id="password-strength"></div>
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="wrap-input500 validate-input" data-validate="Confirm Password">
                            <input class="input100" type="password" id="confirm_password" name="confirm_password" required>
                            <span class="focus-input100" data-placeholder="&#xf191; Confirm Password"></span>
                        </div>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="password_update" class="btn-submit">Update Password</button>
                    </div>
                </form>
                <?php
                    } else {
                        echo "Staff data not found.";
                    }
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <script>
        function checkPasswordStrength(password) {
        var strength = 0;
        var regex = /[A-Za-z]/; 
        if (regex.test(password)) {
            strength += 1;
        }
        regex = /\d/;
        if (regex.test(password)) {
            strength += 1;
        }
        regex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;
        if (regex.test(password)) {
            strength += 1;
        }
        var passwordStrengthElement = document.getElementById('password-strength');
        if (strength <= 1) {
            passwordStrengthElement.innerHTML = '<span class="weak">Weak</span>';
        } else if (strength === 2) {
            passwordStrengthElement.innerHTML = '<span class="medium">Medium</span>';
        } else {
            passwordStrengthElement.innerHTML = '<span class="strong">Strong</span>';
        }
        }
        document.addEventListener("DOMContentLoaded", function () {
            // Get the email input and the associated span
            var emailInput = document.getElementById("email");
            var placeholderSpan = emailInput.nextElementSibling;

            // Add the 'has-value' class if the email input already has a value
            if (emailInput.value.trim() !== "") {
                placeholderSpan.classList.add("has-value");
            }

            // Add an event listener to the email input to dynamically update the class
            emailInput.addEventListener("input", function () {
                if (emailInput.value.trim() !== "") {
                    placeholderSpan.classList.add("has-value");
                } else {
                    placeholderSpan.classList.remove("has-value");
                }
            });
        });

    </script>
    <?php include 'footer.php'; ?>
</body>
</html>

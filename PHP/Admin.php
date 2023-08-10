<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
   
    <link rel="stylesheet" href="../css/petownerstyle.css">
    <style>
       

        .password-input {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 250px;
            top: 57%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <img src="../img/scorpion-removebg.png" alt="tarantula" class="tarantula" style="width: 600px; float: left;">
    <div class="login-container">

        <!--<img src="../img/tarantula-removebg.png" alt="tarantula" class="tarantula">-->
        <div class="login-box">   
        <div class="container">

            <h2>Login Form</h2>
            <form action="petowner_login_process.php" method="post">

                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="input-field" required><br>
                </div>   
                <div class="input-group">    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="input-field" required><br>
                    <span class="eye-icon" onclick="togglePasswordVisibility()">&#128065;</span>
                </div>        
                <input type="submit" value="Login" class="submit-button">
    </form>
        </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
    <script src="script.js"></script>
</body>
</html>







<!--<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
    <div class="login-container">
    <h2>Login</h2>
    <form action="admin_login_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>-->

<!--
<!DOCTYPE html>
<html>
<head>
    <title>Login Result</title>
</head>
<body>
    <h2>Login Result</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
   <p><a href="index.php">Back to Login</a></p>
</body>
</html>-->
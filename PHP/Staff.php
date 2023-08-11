<!DOCTYPE html>
<html>
<head>
    <title>Staff Login</title>
    <link rel="stylesheet" href="../css/staffstyle.css">

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
    <img src="../img/tarantula-removebg.png" alt="tarantula" class="tarantula" style="width: 600px; float: left;">
    <div class="login-container">

        <!--<img src="../img/tarantula-removebg.png" alt="tarantula" class="tarantula">-->
        <div class="login-box">   
        <div class="container">

            <h2>Login Form</h2>
            <form action="staff_login_process.php" method="post">

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
</body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Advanced Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="input-field" required>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html> -->
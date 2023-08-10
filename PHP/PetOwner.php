<!--<!DOCTYPE html>
<html>
<head>
    <title>Pet Owner</title>
</head>
<body>
    <h2>Login</h2>
    <form action="petowner_login_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>-->

<!DOCTYPE html>
<html>
<head>
    <title>Pet Owner Login</title>
    <link rel="stylesheet" href="../css/petownerstyle.css">
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
                </div>        
                <input type="submit" value="Login" class="submit-button">
    </form>
        </div>
        </div>
    </div>
</body>
</html>

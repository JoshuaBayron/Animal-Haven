<?php include 'header.php'?>
<!DOCTYPE html>
<html>
<head>
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
</style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('bgR.png');">
            <div class="wrap-login100">
                <h2 class="login100-form-title p-b-34 p-t-27">Password Reset</h2>
                <form method="post" action="backend/password-reset-code.php" class="login100-form validate-form">
                    <div class="form-container">
                        <div class="wrap-input100 validate-input" data-validate = "Email">
                            <input class="input100" type="email" name="email" placeholder="Enter your email" required>
                            
                        </div>
                        
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="password-reset-link">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    
    </div>


<?php include 'footer.php' ?>
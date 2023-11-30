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
                <h2 class="login100-form-title p-b-34 p-t-27">Change Password</h2>
                <form method="post" action="backend/password-reset-code.php" class="login100-form validate-form">
                    <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token']; } ?>">
                    <div class="form-container">
                        <div class="wrap-input100 validate-input" data-validate = "Email">
                            
                            <label  for="email">Email:</label>
                            <input class="input100" type="text" id="email" name="email" value = "<?php if(isset($_GET['email'])){echo $_GET['email']; } ?>" required>
                        </div>
                        
                    </div>
                    <div class="form-container">
                        <div class="wrap-input100 validate-input" data-validate = "Email">
                            
                           <label  for="new_password">New Password:</label>
                           <input class="input100" type="text" id="new_password" name="new_password" required>
                        </div>
                        
                    </div>
                      <div class="form-container">
                        <div class="wrap-input100 validate-input" data-validate = "Email">
                            
                          <label for="confirm_password">Confirm Password:</label>
                            <input class="input100" type="text" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn"  type="submit" name = "password_update" class="btn-submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    
    </div>


<?php include 'footer.php' ?>
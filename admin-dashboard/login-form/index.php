<?php 
    include 'include/header.php';
	require_once '../backend/fetch_user.php';
    include 'nav.html';
?>
    <br>
    <form action="../backend/crude.php" method="POST" id="admin" class="login100-form validate-form" enctype="multipart/form-data">
        <input type="hidden" name="roles" value="admin">
        
        <div class="wrap-input500 validate-input" data-validate="Enter username">
            <input class="input100" type="text" name="username" id="username" placeholder="<?php echo $user_name; ?>" value="<?php echo $user_name; ?>">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>
        <div class="wrap-input500 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="pass" id="pass" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn" style="background-color: green">
                <i class="fas fa-check" style="color:white"></i> 
            </button>
            <a href="../services.php">
				<button type="button" class="login100-form-btn" style="background-color: green">
					<i class="fas fa-times" style="color:white"></i> 
				</button>
            </a>
        </div>
    </form>
 
</div>
	
<?php 
include 'include/footer.php' 
?>
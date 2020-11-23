<!DOCTYPE html>
<html>
<head>
    <title>Welcome homme page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_MAIN; ?>node_modules/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_MAIN; ?>resources/css/main.css">


</head>
<div class="login">
	
	<div class="errors">
		<?php 
		if(isset($_SESSION['login_error'])){
			$errors = $_SESSION['login_error'];
				if(is_array($errors)){
					foreach($_SESSION['login_error'] as $error) {
						?>
						<li><?php echo $error;  ?></li>

						<?php
					}
				}
				else{?>
					<p><?php echo $errors;  ?></p>
				<?php
			}
		}
		 ?>
	</div>


	<?php
	unset($_SESSION['login_error']);
	 ?>

	<div class="login-register-mainpage">
		<a href="<?php echo URL_MAIN;?>">
	        <img src="<?php echo URL_MAIN; ?>resources/images/site-icon.png" alt="site-icon" class="icon-site-img"/>
	    </a> 
	</div>

	<div class="div-register-form">
			<form action="login/check" class="register-form" method="POST">
				<h2>Sign In</h2>
				<input type="hidden" required="required" name="csrf_token" value="<?php echo $csrf_token; ?>">
				<label for="login_email">Username</label>
				<input type="email" required="required" name="email" id="login_email" >
				<label for="login_password">Password</label>
				<input type="password" required="required"  name="password" id="login_password">
				<input type="submit" class="register-form-submit" value="Login">
				<p><a href="<?php echo URL_MAIN; ?>register">Create Account</a></p>
			</form>
	</div>
		
</div>
	
</body>

  <script src="<?php echo URL_MAIN; ?>resources/bundle.js"></script>

</html>
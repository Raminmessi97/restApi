<?php require_once("resources/views/layouts/header.php");?>

<main class="content">

	<article>
	
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

	<div class="div-register-form">
				

				<form action="login/check" class="register-form" method="POST">
					<h2>Авторизация</h2>
					<input type="hidden" required="required" name="csrf_token" value="<?php echo $csrf_token; ?>" >
					<input type="email" required="required" name="email" placeholder="Email">
					<input type="password" required="required"  name="password" placeholder="Password">
					<input type="submit" class="register-form-submit" value="Login">
				</form>
	</div>
		
	</article>




	

	<?php require_once("resources/views/layouts/aside.php")?>

</main>

<?php require_once("resources/views/layouts/footer.php")?>





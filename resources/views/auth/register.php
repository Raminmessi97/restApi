<?php require_once("resources/views/layouts/header.php");?>

<main class="content">

	<article>
	
	<div class="errors">
		<?php 
		if(isset($_SESSION['user_create_errors'])){
			$errors = $_SESSION['user_create_errors'];
				if(is_array($errors)){
					foreach($_SESSION['user_create_errors'] as $error) {
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
	unset($_SESSION['user_create_errors']);
	 ?>

	<div class="div-register-form">
				

				<form action="register/create" class="register-form" method="POST">
					<h2>Регистрация</h2>
					<input type="hidden" required="required" name="csrf_token" value="<?php echo $csrf_token; ?>" >
					<input  type="text" required="required" name="name" placeholder="Name">
					<input type="email" required="required" name="email" placeholder="Email">
					<input type="password" required="required"  name="password" placeholder="Password">
					<input type="submit" class="register-form-submit" value="Create">
				</form>
	</div>
		
	</article>




	

	<?php require_once("resources/views/layouts/aside.php")?>

</main>

<?php require_once("resources/views/layouts/footer.php")?>





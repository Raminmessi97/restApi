<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
			
		<div class="errors">
		<?php 
		if(isset($_SESSION['article_update_error'])){
			$errors = $_SESSION['article_update_error'];
				if(is_array($errors)){
					foreach($_SESSION['article_update_error'] as $error) {
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

	<div class="successes">
		<?php 
		if(isset($_SESSION['article_update_success'])){?>
			<p><?php echo $_SESSION['article_update_success'];?></p>
		<?php } ?>

	</div>

		<?php
	unset($_SESSION['article_update_success']);
	unset($_SESSION['article_update_error']);

	 ?>


		<form action="<?php echo URL_MAIN ?>articles/<?php echo $article->id?>" method="post">
			<input type="hidden" required="required" name="csrf_token" value="<?php echo $csrf_token; ?>">
			<input type="hidden" name="REQUEST_METHOD" value="PUT"/>
			<input type="text" name="title" placeholder="Title of article" value="<?php echo $article->title?>">
			<input type="textarea" name="text" placeholder="Text of article" value="<?php echo $article->text?>">
			<input type="submit" value="Update">
		</form>

	</article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>


<?php require_once("resources/views/layouts/footer.php")?>





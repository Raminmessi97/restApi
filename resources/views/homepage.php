<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>

    	<p>Homepage</p>

    	<div class="successes">
			<?php 
			if(isset($_SESSION['article_delete_success'])){?>
				<p><?php echo $_SESSION['article_delete_success'];?></p>
			<?php } ?>	
		</div>

		<div class="errors">
			<?php if(isset($_SESSION['article_delete_error'])){?>
				<p><?php echo $_SESSION['article_delete_error'];?></p>
			<?php } ?>
		</div>

		<?php
		unset($_SESSION['article_delete_success']);
		unset($_SESSION['article_delete_error']);
		 ?>
    
        
    </article>




    

    <?php require_once("resources/views/layouts/aside.php")?>

</main>

<?php require_once("resources/views/layouts/footer.php")?>





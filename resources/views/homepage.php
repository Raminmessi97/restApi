<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>

		<div class="errors">
			<?php if(isset($_SESSION['access_error'])){?>
			<p><?php echo $_SESSION['access_error'];?></p>
			<span class="close_errors">&times;</span>
		<?php } ?>

		</div>

		<?php
		unset($_SESSION['article_delete_success']);
		unset($_SESSION['article_delete_error']);
		unset($_SESSION['login_success']);
		unset($_SESSION['user_create_success']);
		unset($_SESSION['user_logout']);
		unset($_SESSION['access_error']);
		 ?>



		<div class="category_articles">
		 	<?php foreach ($data  as $article) {?>

			 		<div class="category_article">

			 			<div class="cat_title">
			 				  <a href="<?php echo URL_MAIN; ?>article/<?php echo $article->id;  ?>">
			 				  	<p><?php echo $article->title;  ?></p>
			 				  </a>
			 			</div>
			 			<hr>

				 		<div class="cat_body">

				 			<div class="cat_image">
				 				<img class="cat_articles_images" src="<?php echo $article->image ?>">
				 			</div>

				 			<div class="cat_text">
				 				<p><?php echo $article->title; ?></p>
				 			</div>
				 			
				 		</div>

				 		<hr>

				 		<div class="cat_footer">
				 			<div class="article-create-date">
				 				<p>Опубликовано:<?php echo $article->created_at;?></p>
				 			</div>

				 			<div class="article-read">
				 				  <a href="<?php echo URL_MAIN; ?>article/<?php echo $article->id;  ?>">Читать далее</a>
				 			</div>
				 			

				 		</div>
					    
				    </div>
	  		<?php } ?>
	 </div>

	 <p><?php echo $links; ?></p>
    
        
    </article>




    

    <?php require_once("resources/views/layouts/aside.php")?>

</main>

<?php require_once("resources/views/layouts/footer.php")?>





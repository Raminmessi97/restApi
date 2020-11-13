<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
    	<?php if(is_array($data)){ ?>
			<div class="category_articles">
			 	<?php foreach ($data  as $article) {?>

			 		<a href="<?php echo URL_MAIN; ?>article/<?php echo $article->id;  ?>">
				 		<div class="category_article">

				 			<div class="cat_image">
				 				<img class="cat_articles_images" src="<?php echo $article->image ?>">
				 			</div>
				 			
				 			<div class="cat_title">
				 				  <p><?php echo $article->title;  ?></p>
				 			</div>

						    
					    </div>
				    </a>
		  		<?php } ?>
		 	</div>

	 <p><?php echo $links; ?></p>

	<?php }else{?>
		<p>Нет статей</p>
	<?php } ?>
    
        
    </article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>

<?php require_once("resources/views/layouts/footer.php")?>





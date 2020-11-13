<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
			
	 <div class="one_article">
	 	<div class="one_article_title nice_border">
	 		<p><?php echo $article->title; ?></p>
	 	</div>

	 	<div class="one_article_text nice_border">
	 		<p><?php echo $article->text; ?></p>
	 	</div>

	 	<div class="one_article_comment nice_border">
	 		<p>Comments</p>
	 	</div>

	 </div>
	 
		

	</article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>


<?php require_once("resources/views/layouts/footer.php")?>





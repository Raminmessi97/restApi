<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
				
	<div class="one_article_info">
	 		<div class="nav_to_article">
	 			<div class="arrow1">
					<a href="<?php echo URL_MAIN;?>">
                    <p>Главная страница</p>
                  </a>
				</div>
				<div class="arrow2">
					<a href="<?php echo URL_MAIN; ?>category/<?php echo $category->route_name; ?>/">
                        <?php echo $category->name;?>
                    </a>
				</div>
	 		</div>

	 		 <div class="one_article_upd_date">
	 			<p>Статья обновлена:<?php echo $article->updated_at;?></p>
	 		</div>
	 </div>
	 			
	 <div class="one_article">

	 	<div class="one_article_title">
	 		<p><?php echo $article->title; ?></p>
	 	</div>

	 	<div class="one_article_text ">
	 		<p><?php echo $article->text; ?></p>
	 	</div>

	 </div>

	 <div class="one_article_comment">
	 		<p>Комментарии</p>
	 </div>
	 
		

	</article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>


<?php require_once("resources/views/layouts/footer.php")?>





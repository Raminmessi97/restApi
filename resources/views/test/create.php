<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
		<form action="<?php echo URL_MAIN ?>test/store" method="post">
			<input type="text" name="title" placeholder="Title of article" required="required">
			<input type="textarea" name="text" placeholder="Text of article" required="required">
			<input type="submit" value="Create">
		</form>

	</article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>


<?php require_once("resources/views/layouts/footer.php")?>





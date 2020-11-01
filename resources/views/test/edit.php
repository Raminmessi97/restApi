<?php require_once("resources/views/layouts/header.php")?>

<main class="content">

    <article>
			
		<form action="<?php echo URL_MAIN ?>test/<?php echo $id; ?>" method="post">
			<input type="hidden" name="REQUEST_METHOD" value="PUT" />
			<input type="text" name="title" placeholder="Title of article">
			<input type="textarea" name="text" placeholder="Text of article">
			<input type="submit" value="Update">
		</form>

	</article>

    <?php require_once("resources/views/layouts/aside.php")?>

</main>


<?php require_once("resources/views/layouts/footer.php")?>





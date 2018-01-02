<?php
	$content = 'index.php'; 

	include 'database/init.php';
	include 'template_files/top_page.php';
?>

	<div class="container">

		<?php include 'template_files/main_content.php'; ?>

	</div>

<?php include 'template_files/bottom_page.php'; ?>
<?php
	$content = 'index.php'; 
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include 'database/init.php';
	include 'template_files/page_structure/top_page.php';
?>

	<div class="container">

		<?php 
			include 'template_files/main_content.php';
		?>

	</div>

<?php include 'template_files/page_structure/bottom_page.php'; ?>
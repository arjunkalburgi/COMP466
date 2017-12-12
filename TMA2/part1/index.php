<?php
	$content = 'index.php'; 

	include 'database/init.php';
	check_to_show_bookmark();
	include 'template_files/page_structure/top_page.php';
?>

	<div class="container">

		<!-- Bookmarking tools -->


		<!-- Login/logout/register -->
		<?php include 'template_files/bookmark_side.php'; ?>

	</div>

<?php include 'template_files/page_structure/bottom_page.php'; ?>
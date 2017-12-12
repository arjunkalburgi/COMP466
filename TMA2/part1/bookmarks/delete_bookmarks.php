<?php
   include 'core/init.php';
   protect_page();
   include 'includes/overall/top_page.php';
?>

<div class="index_splash">
   <h1 class="header_text">Update Bookmark(s)</h1>
</div>

<h2 class="bookmark_list_header">Select Bookmarks To Update</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<?php
		//a form which contains only check box and a button (like our case) will have only one element if no checkbox element was checked
		if(count($_POST) > 1) {     //the count of POST tells us the number of elements in the form.
			if(delete_selected_bookmarks($_POST) === true) {
				header("Location: index.php?content=bookmarks/bookmark.php");
				exit();
			} else {
				echo output_errors($GLOBALS['errors']);
			}
		} else {
			//output a list of bookmarks to select. We expect this function to execute first
			output_bookmarks_to_check();
		}
	?>
	<p class="create_bk_submit">
		<?php
			echo '<input type="submit" name="delete" value="Delete Bookmark(s)" class="create_bk_submit" >';
		?>
	</p>
</form>
<?php include 'includes/overall/bottom_page.php'; ?>
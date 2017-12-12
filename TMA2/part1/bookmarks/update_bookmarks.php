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
		if(count($_POST) > 1){     //the count of POST tells us the number of elements in the form.
			//we only want to update the DB if the Update Bookmark(s) was previously clicked
			//we check for name: commit. if true, this means the Update Bookmark(s) button was clicked
			if(array_key_exists('commit', $_POST) === true){
					if(validate_bookmark_update($_POST)){
						//do the update here
						if(update_selected_bookmarks($_POST, $_SESSION['selected_bookmarks']) === true){
							header("Location: index.php?content=bookmarks/bookmark.php");
							exit();
						}else{echo output_errors($GLOBALS['errors']);}
					}else{
						echo output_errors($errors);
					}
			}else{
					//this should execute after the Modify Bookmark(s) butt$on has been clicked
					//we store the array in the session, so we can retrieve later
					$_SESSION['selected_bookmarks'] = output_bookmarks_to_modify($_POST);   //returns an array of bookmarks to be modified
			}
		}else{
			//output a list of bookmarks to select. We expect this function to execute first
			output_bookmarks_to_check();
		}
	?>

	<p class="create_bk_submit">
		<?php
			//when count of a _POST is greater than 1, this means some values were submitted, and so we want to modify our output as the submit button is clicked
			if(count($_POST) > 1){
				echo '<input type="submit" name="commit" value="Update Bookmark(s)" class="create_bk_submit" >';
			}else{
				echo '<input type="submit" name="select" value="Modify Bookmark(s)" class="create_bk_submit" >';
			}
		?>
	</p>
</form>

<?php include 'includes/overall/bottom_page.php'; ?>
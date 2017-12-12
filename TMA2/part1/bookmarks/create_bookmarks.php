
<?php
include 'core/init.php';
protect_page();
include 'includes/overall/top_page.php';
//execute the logic below only when the user has submitted a form
if(empty($_POST) === false) {
	//first ensure that all required fields on the form has been filled
	foreach ($_POST as $key => $value) {
		//if any of the submitted values from the POST are empty, and if its a required field, then break
		if (empty($value)) {
			$errors[] = 'All fields are required!';
			break 1;    //even if we find one
		}
	}
	if(empty($errors) === true) {
		//checking the entered bookmark urls
		if(check_url_bookmark($_POST) === false){
		//the GLOBAL errors array has been set inside the check_url_bookmark function
		}
	}
}
//we check if insertion into the DB went well
if(isset($_GET['success']) && empty($_GET['success'])){
}else {
	//only insert into DB if the POST array is not empty, and if there were no validation errors
	if (empty($_POST) === false && empty($errors) === true) {
		//insert urls into DB
		//does the actual insertion into the DB
		if (create_bookmarks($_POST) === false) {
			$errors[] = 'An error occurred during creation of bookmark!';
			//echo output_errors($errors);
			//header('Location: register.php');   //redirect the user back to the registration page.
		} else {
			//sets the success variable in the GET method
			header('Location: index.php?content=bookmarks/bookmark.php&success');
			exit();
		}
	} else if (empty($errors) === false) {
		//if we had other validation errors, display them
		//echo output_errors($errors);
	}
}
?>

<div class="index_splash">
   <h1 class="header_text">Create Bookmark(s)</h1>
</div>

<div class="create_bk_widget">
   <form action="" method="post">
	  <h3 class="create_bk_header">Add a bookmark</h3>
	  <?php echo output_errors($errors); ?>
	  <div id="create_0" class="create_bk_inner_first">
		 <p class="register_boxes">
			<input type="text" name="bookmark_name_0" placeholder="Enter Bookmark Name">*
			<input type="text" name="bookmark_url_0" placeholder="Enter Bookmark URL (E.g. https://www.google.com)">*
		 </p>
	  </div>

	  <p class="create_bk_submit">
		 <input type="submit" name="commit" value="Create Bookmark(s)" class="create_bk_submit" >
		 <input type="button" name="add_bk" value="Add More Bookmark" class="create_bk_submit" id="add_another" >
	  </p>
   </form>

</div>

<?php include 'includes/overall/bottom_page.php'; ?>
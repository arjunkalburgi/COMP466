<?php
	protect_page();

	// did user submit a form and was the form to Create bookmarks? 
	if (empty($_POST) === false && $_POST["commit"] === "Create Bookmark(s)") {

		// ensure fields are filled 
		foreach ($_POST as $key => $value) {
			if (empty($value)) {
				$errors[] = 'All fields are required!';
				break 1;
			}
		}

		// if all good and bookmark good, commit. 
		if(empty($errors) === true && check_url_bookmark($_POST)) {
			create_bookmarks($_POST); 
		}
		
	}
?>

<div class="index_splash">
   <h1 class="header_text">Create Bookmark</h1>
</div>

<div class="create_bk_widget collection" style="padding: 0.5rem;">
   <form action="" method="post">
	  
	  <div style="color: red; font-weight: 600;"><?php echo output_errors($errors); ?></div>
	  <div id="create_0" class="create_bk_inner_first">
	  	<div class="row">
	  		<div class="col s12 m6">
		 		<p class="register_boxes">
					<input required="yes" type="text" name="bookmark_name" placeholder="Enter Bookmark Name*">
				</p>
	  		</div>
	  		<div class="col s12 m6">
		 		<p class="register_boxes">
					<input required="yes" type="text" type="url" name="bookmark_url" placeholder="Enter Bookmark URL* (E.g. https://www.google.com)">
				</p>
	  		</div>
	  	</div>
	  </div>

	  <p class="create_bk_submit">
		 <input type="submit" name="commit" value="Create Bookmark(s)" class="create_bk_submit" >
	  </p>
   </form>

</div>


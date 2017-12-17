<?php
	is_logged_in();

	// did user submit a form and was the form to update bookmarks? 
	if (empty($_POST) === false) {
		if ($_POST["commit"] === "Update Bookmark") {

			// ensure fields are filled 
			foreach ($_POST as $key => $value) {
				if (empty($value)) {
					$errors[] = 'All fields are required!';
					break 1;
				}
			}

			// if all good and bookmark good, commit. 
			if(empty($errors) === true) {
				// refresh content after deletion to make sure the correct content is on the page
				if (update_bookmark($_POST)) {
					header("Refresh:0");
				}

			}

		} elseif ($_POST["commit"] === "Delete Bookmark") {
			
			// ensure fields are filled 
			foreach ($_POST as $key => $value) {
				if (empty($value)) {
					$errors[] = 'All fields are required!';
					break 1;
				}
			}

			// if all good and bookmark good, commit. 
			if(empty($errors) === true) {
				// refresh content after deletion to make sure the correct content is on the page
				if (delete_bookmarks($_POST)) {
					header("Refresh:0");
				}
			}

		}
	}

?>

<ul class="collection with-header">
	<li class="collection-header"><b>link to bookmark, pencil to edit, trash to delete</b></li>
	<?php	output_bookmarks();	?>
</ul>

<div id="modal1" class="modal">
	<form class="edit-bookmark-form" action="" method="post">
		<div class="modal-content">
			<h4>Edit Bookmark</h4>
			<p class="register_boxes name">
				<input required="yes" type="text" name="bookmark_name" placeholder="Enter Bookmark Name*">
			</p>
			<p class="register_boxes url">
				<input required="yes" type="text" type="url" name="bookmark_url" placeholder="Enter Bookmark URL* (E.g. https://www.google.com)">
			</p>
			<input type="text" name="old_name" class="old_name" value="" style="display: none;" />
			<input type="text" name="old_url" class="old_url" value="" style="display: none;" />
		</div>
		<div class="modal-footer">
			<input type="submit" name="commit" value="Update Bookmark" class="modal-action modal-close waves-effect waves-green btn-flat" >
		</div>
	</form>
</div>


<script type="text/javascript">
	
	function updateButtonClick(bookmark_name, bookmark_url) {

		$('#modal1 .edit-bookmark-form .register_boxes.name input').attr("value", bookmark_name); 
		$('#modal1 .edit-bookmark-form input.old_name').attr("value", bookmark_name); 
		$('#modal1 .edit-bookmark-form .register_boxes.url input').attr("value", bookmark_url);
		$('#modal1 .edit-bookmark-form input.old_url').attr("value", bookmark_url); 

		$('#modal1').modal("open");
	}

	function deleteButtonClick(bookmark_name, bookmark_url) {

		// * * * * * * * * * * * * * * * * * * * *
		// from https://stackoverflow.com/a/133997
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "");

		// bookmark name field
	    var bookmarkfield = document.createElement("input");
		bookmarkfield.setAttribute("type", "text");
		bookmarkfield.setAttribute("name", "bookmark_name");
		bookmarkfield.setAttribute("value", bookmark_name);
		form.appendChild(bookmarkfield);

		// bookmark url field
	    var bookmarkfield = document.createElement("input");
		bookmarkfield.setAttribute("type", "text");
		bookmarkfield.setAttribute("name", "bookmark_url");
		bookmarkfield.setAttribute("value", bookmark_url);
		form.appendChild(bookmarkfield);

		// commit field
	    var commitfield = document.createElement("input");
		commitfield.setAttribute("type", "text");
		commitfield.setAttribute("name", "commit");
		commitfield.setAttribute("value", "Delete Bookmark");
		form.appendChild(commitfield);


		document.body.appendChild(form);
		form.submit();
	}
	
</script>
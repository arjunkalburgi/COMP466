<?php
	protect_page();

	// did user submit a form and was the form to update bookmarks? 
	if (empty($_POST) === false) {
		if ($_POST["commit"] === "Update Bookmark(s)") {

		// ensure fields are filled 
		foreach ($_POST as $key => $value) {
			if (empty($value)) {
				$errors[] = 'All fields are required!';
				break 1;
			}
		}

		// if all good and bookmark good, commit. 
		if(empty($errors) === true) {
			echo "Update Bookmark(s)"; 
			// update_bookmarks($_POST); 
		}

		} elseif ($_POST["commit"] === "Delete Bookmark(s)") {
			
			// ensure fields are filled 
			foreach ($_POST as $key => $value) {
				if (empty($value)) {
					$errors[] = 'All fields are required!';
					break 1;
				}
			}

			// if all good and bookmark good, commit. 
			if(empty($errors) === true) {
				// echo "Delete Bookmark(s)"; 
				if (delete_bookmarks($_POST)) {
					header("Refresh:0");
				}
			}

	}

?>

<ul class="collection with-header">
	<li class="collection-header"><b>link to bookmark, pencil to edit, trash to delete</b></li>
	<?php	output_editable_bookmarks();	?>
</ul>

<script type="text/javascript">
	
	function updateButtonClick(thing) {
		console.log("update thing"); 
		console.log(thing); 

		// * * * * * * * * * * * * * * * * * * * *
		// from https://stackoverflow.com/a/133997
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "");

		// bookmark field
	    var bookmarkfield = document.createElement("input");
		bookmarkfield.setAttribute("type", "text");
		bookmarkfield.setAttribute("name", "bookmark_name");
		bookmarkfield.setAttribute("value", thing);
		form.appendChild(bookmarkfield);

		// commit field
	    var commitfield = document.createElement("input");
		commitfield.setAttribute("type", "text");
		commitfield.setAttribute("name", "commit");
		commitfield.setAttribute("value", "Update Bookmark(s)");
		form.appendChild(commitfield);


		document.body.appendChild(form);
		form.submit();
	}

	function deleteButtonClick(thing) {
		console.log("delete thing"); 
		console.log(thing); 

		// * * * * * * * * * * * * * * * * * * * *
		// from https://stackoverflow.com/a/133997
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "");

		// bookmark field
	    var bookmarkfield = document.createElement("input");
		bookmarkfield.setAttribute("type", "text");
		bookmarkfield.setAttribute("name", "bookmark_name");
		bookmarkfield.setAttribute("value", thing);
		form.appendChild(bookmarkfield);

		// commit field
	    var commitfield = document.createElement("input");
		commitfield.setAttribute("type", "text");
		commitfield.setAttribute("name", "commit");
		commitfield.setAttribute("value", "Delete Bookmark(s)");
		form.appendChild(commitfield);


		document.body.appendChild(form);
		form.submit();
	}
</script>
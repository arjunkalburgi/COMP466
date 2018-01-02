<?php

	// if unit hasn't been choosen
	if (!isset($_GET['unitchoosen'])) {
		// force back to course choosing 
		exit(0);
	}

	// did user ask for a lesson? 
	if (empty($_POST) === false && $_POST["commit"] === "Get Lesson") {

		// ensure fields are filled 
		foreach ($_POST as $key => $value) {
			if (empty($value)) {
				$errors[] = 'All fields are required!';
				break 1;
			}
		}

		// if all good move to lesson picker:  
		if(empty($errors)) {
			echo "this is where we'll go get the lesson stuff.";
			// header('Location: index.php?content=learning/lesson.php&coursechoosen='.$_GET['coursechoosen'].'&unitchoosen='.$_POST["unitId"]); // contains nothing or select a lesson or lesson info or quiz + ans
		}
	  
	} else {
	  
		// allow the user to ask for another course/unit and display unit info: 
		$unit = getunitdatafromID($_GET["unitchoosen"]); 
		
		?>

		<div class="index_splash">
			<h1 class="header_text">
				Course: <?php echo getcourseTitlefromID($unit["courseID_Ref"]); ?>
				<br>
				Unit: <?php echo $unit["title"]; ?>
				<br>
				<a href="index.php">select again</a>
			</h1>
		</div>

		<div class="parsed">
			<?php echo parse($unit["abstract"]); ?>
		</div>


		<!-- // select a lesson -->

		<ul class="collection with-header">
			<li class="collection-header"><b>press the button to select the unit</b></li>

			<?php
				echo implode('', getunitsaslist());
			?>

		</ul>

		<script type="text/javascript">
		 
		 function selectButtonClick(unitTitle, unitId) {

		    // * * * * * * * * * * * * * * * * * * * *
		    // from https://stackoverflow.com/a/133997
		    var form = document.createElement("form");
		    form.setAttribute("method", "post");
		    form.setAttribute("action", "");

		    // bookmark name field
		     var formfield = document.createElement("input");
		    formfield.setAttribute("type", "text");
		    formfield.setAttribute("name", "unitTitle");
		    formfield.setAttribute("value", unitTitle);
		    form.appendChild(formfield);

		    // bookmark url field
		     var formfield = document.createElement("input");
		    formfield.setAttribute("type", "text");
		    formfield.setAttribute("name", "unitId");
		    formfield.setAttribute("value", unitId);
		    form.appendChild(formfield);

		    // commit field
		     var commitfield = document.createElement("input");
		    commitfield.setAttribute("type", "text");
		    commitfield.setAttribute("name", "commit");
		    commitfield.setAttribute("value", "Get Unit");
		    form.appendChild(commitfield);


		    document.body.appendChild(form);
		    form.submit();
		 }
		</script>

<?php } ?>

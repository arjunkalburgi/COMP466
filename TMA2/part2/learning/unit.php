<?php


	// if course hasn't been choosen
	if (!isset($_GET['coursechoosen'])) {
		// force back to course choosing 
		exit(0);
	}

	// did user ask for a unit? 
	if (empty($_POST) === false && $_POST["commit"] === "Get Unit") {

		// ensure fields are filled 
		foreach ($_POST as $key => $value) {
			if (empty($value)) {
				$errors[] = 'All fields are required!';
				break 1;
			}
		}

		// if all good display units:  
		if(empty($errors)) {
			// display unit info: 
			// get unit content 

			?>

			<div class="index_splash">
			<h1 class="header_text">
			   Unit: <?php echo $_POST["unitTitle"]; ?>
			   <br>
			   <a href="index.php">selectagain</a>
			</h1>
			</div>


			<?php 
			echo "poooooop";
			// header('Location: index.php?content=learning/lesson.php&coursechoosen='.$_GET['coursechoosen'].'&unitchoosen='.$_POST["unitId"]); // contains nothing or select a lesson or lesson info or quiz + ans
		}
	  
	} else {
	  

		// allow the user to ask for another course 
		?>

        <div class="index_splash">
            <h1 class="header_text">
            	<a href="index.php">select a different course</a>
            </h1>
        </div>

		<!-- // select a unit -->

		<ul class="collection with-header">
			<li class="collection-header"><b>press the button to select the unit</b></li>

			<?php

				// get units from sql 
				$getidquery = "SELECT * FROM units WHERE courseID_Ref = " . $_GET['coursechoosen'];
				$result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
				$units = mysqli_fetch_all($result, MYSQLI_ASSOC);

				$output = array();
				foreach ($units as $unit) {
				$output[] = '<li class="collection-item">
				      '.$unit['title'].'
				      <div class="secondary-content">
				      <button onclick="selectButtonClick(\''.$unit['title'].'\', \''.$unit['id'].'\')"><i class="material-icons">fast_forward</i></button>
				      </div>
				      </li>';
				}

				echo implode('', $output);
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

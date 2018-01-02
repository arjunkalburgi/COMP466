<?php

	// if lessonchoosen hasn't been choosen
	if (!isset($_GET['lessonchoosen'])) {
		// force back to course choosing 
		exit(0);
	}

	$lesson = getlessondatafromID($_GET["lessonchoosen"]);
	$quiz = getquizdatafromlessonID($lesson["id"]); 


	// quizzing parse $lesson["quiz"]
	if (!empty($_POST) && $_POST["commit"] === "Try Quiz Now") {

	}

	// Are we showing the quiz answers
	else if (!empty($_POST) && $_POST["commit"] === "Post Quiz") {

	}

	// Teaching the lesson show $lesson["content"]
	else {
		?>
		<div class="index_splash">
			<h1 class="header_text">
				Course: <?php echo getcourseTitlefromID($lesson["courseID_Ref"]); ?>
				<br>
				unit: <?php echo getunitTitlefromID($lesson["unitID_Ref"]); ?>
				<br>
				Lesson: <?php echo $lesson["title"]; ?>
				<br>
				<a href="index.php">select again</a>
			</h1>
		</div>

		<div class="parsed">
			<?php echo parse($lesson["content"]); ?>
		</div>

		<form action="" method="post">
			<input type="submit" name="commit" value="Try Quiz Now" class="create_bk_submit" >
		</form>
		<?php 
	}
?>
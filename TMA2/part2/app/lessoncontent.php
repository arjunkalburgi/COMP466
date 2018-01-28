<?php

	// if lessonchoosen hasn't been choosen
	if (!isset($_GET['lessonchoosen'])) {
		// force back to course choosing 
		exit(0);
	}

	$lesson = getlessondatafromID($_GET["lessonchoosen"]);
	$quizzes = getquizdatafromlessonID($lesson["id"]); 

	// quizzing parse $lesson["quiz"]
	if (!empty($_POST) && $_POST["commit"] === "Try Quiz Now") {
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
			<form action="" method="post">
				
				<?php
					foreach ($quizzes as $quiz) {
						echo '<p>'.parsequizquestion($quiz["question"], $quiz["id"]).'</p>'; 
					}
				?>

				<input type="submit" name="commit" value="Post Quiz" class="create_bk_submit" >
			</form>
		</div>

		<?php 
	}

	// Are we showing the quiz answers
	elseif (!empty($_POST) && $_POST["commit"] === "Post Quiz") {
		// show quiz answers 
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

		<ul class="collection with-header">
			<li class="collection-header"><b>your quiz results</b></li>

			<?php
			echo implode('', getquizresultsaslist($quizzes, $_POST));
			?>
		</ul>

		<form action="" method="post">
			<input type="submit" name="commit" value="Try Quiz Now" class="create_bk_submit" >
			<input type="submit" name="commit" value="Reread lesson" class="create_bk_submit" >
			<input type="submit" name="commit" value="Pick another lesson" class="create_bk_submit" >
		</form>

		<?php 
	}

	elseif (!empty($_POST) && $_POST["commit"] === "Pick another lesson") {
        header('Location: index.php?content=app/lessonpicker.php&unitchoosen='.$lesson["unitID_Ref"]); 
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
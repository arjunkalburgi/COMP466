<div class="content">
    <?php

    	if ((!empty($_POST) && $_POST["commit"] === "Log out") || !logged_in()) {
    		if (isset($_GET['content'])) {
	        	include $_GET['content']; 
	        } else {
            	include 'authentication/login.php';
	        }
    	} else {
            include 'bookmarks/bookmark.php';
            include 'template_files/loggedin.php';
    	}

    ?>
</div>
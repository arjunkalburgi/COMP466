<div class="content">
    <?php
    	if (isset($_GET['content'])) {
    		// echo "we are a go people"; 
            if(logged_in() === true){
                include 'bookmarks/bookmark.php';
                include 'template_files/loggedin.php';
            } else {
                include $_GET['content']; 
            }

    	} else {
    		// echo "we are not a go"; 
	        if(logged_in() === true){
	            include 'template_files/loggedin.php';
	        }else{
	            include 'template_files/login.php';
	        }
    	}
    ?>
</div>
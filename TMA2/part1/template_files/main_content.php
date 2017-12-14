<div class="content">
    <?php
    	if (isset($_GET['content'])) {
    		// echo "we are a go people"; 
            include 'bookmarks/bookmark.php';
            include 'template_files/loggedin.php';
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
<div class="bookmark_side">
    <?php
    	if (isset($_GET['content'])) {
    		// echo "we are a go people"; 
            include $_GET['content'];
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
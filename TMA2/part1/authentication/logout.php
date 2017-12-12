<?php
	
	//this page gets called when the user is logged out
	session_start();
	session_destroy();
	//redirect to the main page
	header('Location: index.php');

?>
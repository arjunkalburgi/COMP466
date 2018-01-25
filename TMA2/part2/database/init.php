<?php

	session_name('sec_session_id');
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	require 'database/connect.php';
	require 'database/db_functions/courses.php';
	require 'database/db_functions/quiz.php';
	require 'database/db_functions/lessons.php';
	require 'database/db_functions/units.php';
	require 'database/helper.php';

	$errors = array();


	resetdbs(mysqli_query($GLOBALS['connect'], "SELECT 1 FROM courses LIMIT 1") === false); 

	// if (logged_in()) {
	//     $session_user_id = $_SESSION['user_id'];
	//     $user_data = user_data($session_user_id);
	//     $bookmark_data = get_all_bookmarks($session_user_id, 'bookmark_name', 'bookmark_url');
	// }
	

?>
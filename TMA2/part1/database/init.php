<?php

	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	require 'database/connect.php';
	require 'database/users.php';
	require 'database/bookmarker.php';
	require 'database/helper.php';


	$userquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM users LIMIT 1");
	if ($userquery === false) {
	    $createuserstable = "CREATE TABLE users (
	        user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        username varchar (30) NOT NULL,
	        password varchar (33) NOT NULL,
	        first_name varchar (30) NOT NULL,
	        last_name varchar (30) NOT NULL,
	        email varchar (30) NOT NULL
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $createuserstable) or die (mysqli_error($GLOBALS['connect']));

	    echo "hiiiiiiii from createuserstable"; 
	}
	$bookmarkquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM bookmarks LIMIT 1");
	if ($bookmarkquery === false) {
	    echo "hiiiiiiii from createbookmarktable"; 

	    $createbookmarktable = "CREATE TABLE bookmarks (
	        bookmark_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        user_id_ref varchar (30) NOT NULL,
	        bookmark_name varchar (50) NOT NULL,
	        bookmark_url varchar (50) NOT NULL
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $createbookmarktable) or die (mysqli_error($GLOBALS['connect']));
	}


	// print(logged_in())
	if (logged_in() === true) {
	    $session_user_id = $_SESSION['user_id'];
	    $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');
	    $bookmark_data = get_all_user_bookmarks($session_user_id, 'bookmark_name', 'bookmark_url');
	}
	
	$errors = array();

?>
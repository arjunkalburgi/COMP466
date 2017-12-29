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

	// set up dbs
	$coursesquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM courses LIMIT 1");
	if ($coursesquery === false) {
	    echo "hiiiiiiii from createcoursestable"; 
	    
	    $createcoursestable = "CREATE TABLE courses (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        courseTitle varchar (30) NOT NULL
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $createcoursestable) or die (mysqli_error($GLOBALS['connect']));
	}
	$unitsquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM units LIMIT 1");
	if ($unitsquery === false) {
	    echo "hiiiiiiii from unitsquery"; 

	    $unitstable = "CREATE TABLE units (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        title varchar (30) NOT NULL,
	        contributors varchar (3000) NOT NULL,
	        abstract varchar (3000) NOT NULL,
	        courseID_Ref int NOT NULL REFERENCES course(id)
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $unitstable) or die (mysqli_error($GLOBALS['connect']));
	}
	$lessonquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM lessons LIMIT 1");
	if ($lessonquery === false) {
	    echo "hiiiiiiii from lessonquery"; 

	    $createlessontable = "CREATE TABLE lessons (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        title varchar (30) NOT NULL,
	        content varchar (3000) NOT NULL,
	        quizID_Ref int NOT NULL REFERENCES quiz(id),
	        unitID_Ref int NOT NULL REFERENCES unit(id),
	        courseID_Ref int NOT NULL REFERENCES course(id)
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $createlessontable) or die (mysqli_error($GLOBALS['connect']));
	}
	$quizquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM quizzes LIMIT 1");
	if ($quizquery === false) {
	    echo "hiiiiiiii from quizquery"; 

	    $createquiztable = "CREATE TABLE quizzes (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        question  varchar (50) NOT NULL,
	        answer varchar (50) NOT NULL
	        )";
	    $results = mysqli_query($GLOBALS['connect'], $createquiztable) or die (mysqli_error($GLOBALS['connect']));
	}


	// if (logged_in()) {
	//     $session_user_id = $_SESSION['user_id'];
	//     $user_data = user_data($session_user_id);
	//     $bookmark_data = get_all_bookmarks($session_user_id, 'bookmark_name', 'bookmark_url');
	// }
	

?>
<?php
	// $myarray = &$_POST; 
	// echo $myarray; 

	$q1 = htmlspecialchars($_POST["q1"]);
	$q1answer = htmlspecialchars($_POST["q1answer"]);
	$q2 = htmlspecialchars($_POST["q2"]);
	$q2answer = htmlspecialchars($_POST["q2answer"]);
	$q3 = htmlspecialchars($_POST["q3"]);
	$q3answer = htmlspecialchars($_POST["q3answer"]);
	$q4 = htmlspecialchars($_POST["q4"]);
	$q4answer = htmlspecialchars($_POST["q4answer"]);
	$q5 = htmlspecialchars($_POST["q5"]);
	$q5answer = htmlspecialchars($_POST["q5answer"]);
	$q6 = htmlspecialchars($_POST["q6"]);
	$q6answer = htmlspecialchars($_POST["q6answer"]);
	$q7 = htmlspecialchars($_POST["q7"]);
	$q7answer = htmlspecialchars($_POST["q7answer"]);   
	echo $q1 . "," . $q1answer . "," . $q2 . "," . $q2answer . "," . $q3 . "," . $q3answer . "," . $q4 . "," . $q4answer . "," . $q5 . "," . $q5answer . "," . $q6 . "," . $q6answer . "," . $q7 . "," . $q7answer;?>

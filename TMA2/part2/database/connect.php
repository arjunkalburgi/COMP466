

<?php
	error_reporting(E_ALL); 
	ini_set('display_errors',1);

	// connect sql
	$link = mysqli_connect("127.0.0.1", "root", "password", "mysql", "3306");
	mysqli_select_db($link, 'mysql')or die("error connecting to db mysql");
	
	$GLOBALS['connect'] = $link; 

	if (!$link) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	// echo "Success: A proper connection to MySQL was made! The mysql database is great." . PHP_EOL;
	// echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

	// mysqli_close($link);
?>

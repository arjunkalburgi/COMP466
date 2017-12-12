<?php
	// include 'database/init.php';
	// echo get_included_files(); 
	echo "4 ";

	//login program logic is specified here at the top
	if(empty($_POST) === false){
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo "3 ";
		echo " 3 ";

		if(empty($username) === true || empty($password) === true){
			$errors[] = 'The username and password cannot be empty';
		}else if(user_exists($username) === false){
			$errors[] = 'Username cannot be found';
		}else{

			echo "2 ";
			$login = login($username, $password);
			if($login === false){
				$errors[] = 'The username/password combination is incorrect';
			}else{
				echo "1 ";
				//set the user session
				$_SESSION['user_id'] = $login;
				//redirect user to home
				ECHO "DLSKJFADLS;KFJAL;SK";
				// header('Location: index.php?content=bookmarks/bookmark.php');
				// exit();
			}
			
		}
	}else{
		$errors[] = 'No data received';
	}
	// include 'template_files/page_structure/top_page.php';
	if(empty($errors) === false){
?>

<h2>We tried to log you in, but...</h2>

<?php
	}
	echo output_errors($errors);
	// include 'template_files/page_structure/bottom_page.php';
	if(empty($errors) === false){
?>

<p><a href="index.php">try again :)</a></p>

<?php
	}
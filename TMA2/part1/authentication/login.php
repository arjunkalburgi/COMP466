<?php

	// when login data has been posted 
	if (empty($_POST) === false && $_POST["commit"] === "Log in") {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) || empty($password)) {
			
			$errors[] = 'Fill in user data.';

		} else if (!user_exists($username)) {

			$errors[] = 'No user with this username.';

		} else {

			$login = login($username, $password);

			if (!$login) {

				$errors[] = 'Incorrect username/password.';

			} else {

				// send back to main content
				$_SESSION['user_id'] = $login;
				header('Location: index.php?content=template_files/main_content.php');

			}
		}
	} elseif (empty($_POST) === false && $_POST["commit"] === "Log out") {
		session_name('sec_session_id');
		session_start();
		$_SESSION = array(0);
		session_destroy();
		header('Location: index.php?content=template_files/main_content.php');
	}


	if (!empty($errors)) {
		echo "Insuficient login: " . output_errors($errors);
	}
?>

<div class="widget">
    <h5 class="widget_header">Login/Register</h5>
    <div class="bookmark_inner">
        <form method="post" action="">
            <fieldset>

                <p><input type="text" name="username" placeholder="Username"></p>
                <p><input type="password" name="password" placeholder="Password"></p>
                <p><input type="submit" name="commit" value="Log in"></p>
                <p>
                    <a href="index.php?content=authentication/register.php">
                        <span class="register_text">Click here to Register</span>
                    </a>
                </p>

            </fieldset>
        </form>
    </div>
</div>

<?php

    // did user submit a form and was the form to register? 
    if (empty($_POST) === false && $_POST["commit"] === "Register") {
        
        $required_fields = array('username', 'password', 'password_retype', 'first_name', 'last_name', 'email');
        
        if (user_exists($_POST['username'])) {
            $errors[] = 'The username \'' . $_POST['username'] . '\' is in use. Please choose another.';
        }

        if (preg_match("/\\s/", $_POST['username'])) {
            $errors[] = 'No spaces allowed in the username.';
        }

        if($_POST['password'] !== $_POST['password_retype']){
            $errors[] = 'Passwords do not match';
        }
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required';
        }

        if(email_exists($_POST['email']) === true){
            $errors[] = 'The email \'' . $_POST['email'] . '\' is in use. Please choose another.';
        }

        if (empty($errors)) {

            $register_data = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email']
            );

            if (register_user($register_data)) {
                // user registered! send to app
                header('Location: index.php');
                exit();
            } else {
                $errors[] = 'An error occurred during registration! ' . mysqli_error($GLOBALS['connect']);

            }
        }

        echo output_errors($errors);
    }
?>

<div class="index_splash">
    <h1 class="header_text">Register to use this Bookmark app</h1>
</div>

<form action="" method="post">
    <fieldset>

        <p class="register_boxes"><input type="text" name="username" placeholder="Username" required=""></p>
        <p class="register_boxes"><input type="password" name="password" placeholder="Password" required=""></p>
        <p class="register_boxes"><input type="password" name="password_retype" placeholder="ReType Password" required=""></p>
        <p class="register_boxes"><input type="text" name="first_name" placeholder="First Name" required=""></p>
        <p class="register_boxes"><input type="text" name="last_name" placeholder="Last Name" required=""></p>
        <p class="register_boxes"><input type="text" name="email" placeholder="Enter Email" required=""></p>
        <p class="register_boxes"><input type="submit" name="commit" value="Register"></p>

    </fieldset>
</form>


<?php

function register_user($register_data){
    array_walk($register_data, 'array_sanitize');
    $register_data['password'] = md5($register_data['password']);
    echo var_dump($register_data); 

    $data = '\'' . implode('\', \'', $register_data) . '\'';
    $fields = implode(', ', array_keys($register_data));

    $query_string = "INSERT INTO users ($fields) VALUES ($data)";

    $query = mysqli_query($GLOBALS['connect'], $query_string);
    return $query;
}

function user_data($user_id){
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();   //this gets the count of the arguments that was sent to the function
    $func_get_args = func_get_args();   //this returns an array of the actual arguments

    if($func_num_args > 1){
        unset($func_get_args[0]);   //we pop out the user_id from the array variable

        $fields = implode(', ', $func_get_args);
        $query = "SELECT $fields FROM users WHERE user_id = '$user_id'";

        $result = mysqli_query($GLOBALS['connect'], $query);

        $data = mysqli_fetch_assoc($result);
        return $data;
    }
}

//checks if a user is logged in, by checking if the session has been set.
function logged_in(){
    return (isset($_SESSION['user_id'])) ? true : false;
}

//this checks the database for this user name
function user_exists($username){
    $username = sanitize($username);
    $query_string = "SELECT COUNT(user_id) FROM users WHERE username = '$username'";

    $query = mysqli_query($GLOBALS['connect'], $query_string ) or die (mysqli_error($GLOBALS['connect']));
    $row = mysqli_fetch_row($query);

    echo "user_exists: " . $row[0]; 

    return ($row[0] == 1) ? true : false;
}

//this checks the database for this email, we don't want to have the similar email in DB for different users
function email_exists($email){
    $email = sanitize($email);
    $query_string = "SELECT COUNT(user_id) FROM users WHERE email = '$email'";

    $query = mysqli_query($GLOBALS['connect'], $query_string ) or die (mysqli_error($GLOBALS['connect']));
    $row = mysqli_fetch_row($query);

    return ($row[0] == 1) ? true : false;
}

function user_id_from_username($username){
    $username = sanitize($username);
    $query_string = "SELECT user_id FROM users WHERE username = '$username'";
    $query = mysqli_query($GLOBALS['connect'], $query_string);

    $row_id = mysqli_fetch_assoc($query);
    return (($result = $row_id['user_id']) != null ) ? $result : -1;
}


function login ($username, $password){
    $user_id = user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    $query_string = "SELECT COUNT(user_id) FROM users WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($GLOBALS['connect'], $query_string );
    $result = mysqli_fetch_row($query);
    return ($result[0] == 1) ? $user_id : false;
}

?>
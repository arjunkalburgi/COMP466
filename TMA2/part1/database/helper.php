<?php

function is_logged_in(){
    if(logged_in() === false){
        header('Location: authentication/permissiondenied.php');
        exit();
    }
}

function array_sanitize(&$item){
    $item = mysqli_real_escape_string($GLOBALS['connect'], $item);
}

function sanitize($data){
    return mysqli_real_escape_string($GLOBALS['connect'], $data);
}

function output_errors($errors){
    $output = array();

    foreach ($errors as $error) {
        $output[] = '<li>'. $error . '</li>';
    }
    
    return '<ul>'. implode('', $output) . '</ul>';
}

?>
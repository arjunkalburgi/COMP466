<?php

function logged_in_redirect(){
    if(logged_in() === true){
        header('Location: index.php');
        exit();
    }
}
function protect_page(){
    if(logged_in() === false){
        header('Location: authentication/permissiondenied.php');
        exit();
    }
}

function array_sanitize(&$item){
    // echo "globals"; var_dump($GLOBALS); echo "globals";
    $item = mysqli_real_escape_string($GLOBALS['connect'], $item);
}
function sanitize($data){

    // echo $data; 
    return mysqli_real_escape_string($GLOBALS['connect'], $data);
}

function output_errors($errors){
    $output = array();
    foreach($errors as $error){
        $output[] = '<li>'. $error . '</li>';
    }
    //takes each error element in the output array and implode it as a string
    return '<ul>'. implode('', $output) . '</ul>';
}

?>
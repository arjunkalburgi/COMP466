<?php

// insert 
function insertcourses2db($title) {
    $query_string = "INSERT INTO courses (courseTitle) VALUES ('$title');";
    $results = mysqli_query($GLOBALS['connect'], $query_string) or die (mysqli_error($GLOBALS['connect']));  
    if ($results === false) {
      echo "Error courses: Could not commit the insertion, please try again.";
    }
}


// get 
function getcourseIDfromtitle($title) {
   $getidquery = "SELECT id FROM courses WHERE courseTitle = '$title'";
   $result = mysqli_query($GLOBALS['connect'], $getidquery);
   $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
   if (($data !== null) && (empty($data) === false)) {
    return $data[0]["id"]; 
   } else {
    echo "error retrieving from courses db";
    exit(0); 
   }
}

function getcourseTitlefromID($id) {
   $getidquery = "SELECT courseTitle FROM courses WHERE id = '$id'";
   $result = mysqli_query($GLOBALS['connect'], $getidquery);
   $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
   if (($data !== null) && (empty($data) === false)) {
      return $data[0]["courseTitle"]; 
   } else {
      echo "error retrieving from courses db";
      exit(0); 
   }

}

function getcoursesaslist() {
    // get courses from sql 
    $getidquery = "SELECT * FROM courses";
    $result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // echo var_dump($courses);

    $output = array();
    foreach ($courses as $course) {
      $output[] = '<li class="collection-item">
            '.$course['courseTitle'].'
            <div class="secondary-content">
            <button onclick="selectButtonClick(\''.$course['courseTitle'].'\', \''.$course['id'].'\')"><i class="material-icons">fast_forward</i></button>
            </div>
            </li>';
    }

    return $output; 
}


?>
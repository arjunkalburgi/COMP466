<?php


function insertlesson2db($title, $content, $quizID_Ref, $unitID_Ref, $courseID_Ref) {
    $query_string = "INSERT INTO lessons (title, content, quizID_Ref, unitID_Ref, courseID_Ref) VALUES ('$title', '$content', '$quizID_Ref', '$unitID_Ref', '$courseID_Ref');";
    $results = mysqli_query($GLOBALS['connect'], $query_string) or die (mysqli_error($GLOBALS['connect']));  
    if ($results === false) {
      echo "Error lessons: Could not commit the insertion, please try again.";
    }
}
function getlessonIDfromtitle($title) {
  $getidquery = "SELECT id FROM lessons WHERE title = '$title'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data[0]["id"]; 
  } else {
    echo "error retrieving from lessons db";
    exit(0); 
  }
}


?>
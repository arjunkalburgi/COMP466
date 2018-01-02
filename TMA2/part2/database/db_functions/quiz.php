<?php


function insertquiz2db($question, $answer) {
    $query_string = "INSERT INTO quizzes (question, answer) VALUES ('$question', '$answer');";
    $results = mysqli_query($GLOBALS['connect'], $query_string) or die (mysqli_error($GLOBALS['connect']));  
    if ($results === false) {
      echo "Error quizzes: Could not commit the insertion, please try again.";
    }
}

function getquizIDfromquestion($question) {
  $getidquery = "SELECT id FROM quizzes WHERE question = '$question'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data[0]["id"]; 
  } else {
    echo "error retrieving from quizzes db";
    exit(0); 
  }
}

?>
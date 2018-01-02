<?php


function insertquiz2db($question, $answer,  $lessonID_Ref) {
    $query_string = "INSERT INTO quizzes (question, answer, lessonID_Ref) VALUES ('$question', '$answer', '$lessonID_Ref');";
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

function getquizdatafromlessonID($id) {
  $getidquery = "SELECT * FROM quizzes WHERE lessonID_Ref = '$id'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
      return $data[0]; 
  } else {
      echo "error retrieving from quizzes db";
      exit(0); 
  }
}

?>
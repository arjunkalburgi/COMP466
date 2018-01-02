<?php


function insertlesson2db($title, $content, $unitID_Ref, $courseID_Ref) {
    $query_string = "INSERT INTO lessons (title, content, unitID_Ref, courseID_Ref) VALUES ('$title', '$content', '$unitID_Ref', '$courseID_Ref');";
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
        echo "error retrieving from courses db";
        exit(0); 
    }

}

function getlessonsaslist() {
    // get units from sql 
    $getidquery = "SELECT * FROM lessons WHERE unitID_Ref = " . $_GET['unitchoosen'];
    $result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
    $lessons = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $output = array();
    foreach ($lessons as $lesson) {
    $output[] = '<li class="collection-item">
          '.$lesson['title'].'
          <div class="secondary-content">
          <button onclick="selectButtonClick(\''.$lesson['title'].'\', \''.$lesson['id'].'\')"><i class="material-icons">fast_forward</i></button>
          </div>
          </li>';
    }

    return $output; 
}

function getlessondatafromID($id) {
  $getidquery = "SELECT * FROM lessons WHERE id = '$id'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
      return $data[0]; 
  } else {
      echo "error retrieving from lessons db";
      exit(0); 
  }
}


?>
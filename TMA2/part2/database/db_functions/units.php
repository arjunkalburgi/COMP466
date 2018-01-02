<?php

function insertunit2db($title, $abstract, $courseID_Ref) {
    $query_string = "INSERT INTO units (title, abstract, courseID_Ref) VALUES ('$title', '$abstract', '$courseID_Ref');";
    $results = mysqli_query($GLOBALS['connect'], $query_string) or die (mysqli_error($GLOBALS['connect']));  
    if ($results === false) {
      echo "Error units: Could not commit the insertion, please try again.";
    }
}

// get 
function getunitIDfromtitle($title) {
  $getidquery = "SELECT id FROM units WHERE title = '$title'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
      return $data[0]["id"]; 
  } else {
      echo "error retrieving from units db";
      exit(0); 
  }
}

function getunitdatafromID($id) {
  $getidquery = "SELECT * FROM units WHERE id = '$id'";
  $result = mysqli_query($GLOBALS['connect'], $getidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
      return $data[0]; 
  } else {
      echo "error retrieving from units db";
      exit(0); 
  }
}


function getunitsaslist() {
    // get units from sql 
    $getidquery = "SELECT * FROM units WHERE courseID_Ref = " . $_GET['coursechoosen'];
    $result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
    $units = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $output = array();
    foreach ($units as $unit) {
    $output[] = '<li class="collection-item">
          '.$unit['title'].'
          <div class="secondary-content">
          <button onclick="selectButtonClick(\''.$unit['title'].'\', \''.$unit['id'].'\')"><i class="material-icons">fast_forward</i></button>
          </div>
          </li>';
    }

    return $output; 
}


?>
<?php


//returns an array of all the various courses details from the db
function get_all_courses() {

   $query = "SELECT * FROM courses";
   $result = mysqli_query($GLOBALS['connect'], $query);
   $answer = mysqli_fetch_all($result, MYSQLI_ASSOC);

   return $answer;
}

function show_courses_dropdown(){

   if(empty($GLOBALS['courses']) === false){
      foreach($GLOBALS['courses'] as $course_row){
         echo '<li><a href="course.php?data='.$course_row['courseID'].'">'.$course_row['courseTitle'].'</a></li>';
      }
   }else{
      echo '<li><a href="#">There are no courses</a></li>';
   }
}

//this outputs the thumbnails on the home page
function show_courses_thumbnails(){

   if(empty($GLOBALS['courses']) === false){ //always check if our course global array is empty
      foreach($GLOBALS['courses'] as $course_row){
         $thumbnail = '<div class="col-md-4">';
         $thumbnail .= '<h1 class="text-center"><a href="course.php?data='.$course_row['courseID'].'" class="thumbnail">'.$course_row['courseTitle'].'</a></h1>';
         //$thumbnail .= '<h1 class="text-center"><a href="course.php" onclick="passCourseId('.$course_row['courseID'].');" class="thumbnail">'.$course_row['courseTitle'].'</a></h1>';
         $thumbnail .= '</div>';
         echo $thumbnail;
      }
   }
}

//given a specific courseID return an entire row for that courseID
function specific_course_row($courseID){
   $result = array();
   if(empty($GLOBALS['courses']) === false){
      foreach($GLOBALS['courses'] as $course_row){
         if($course_row['courseID'] === $courseID){
            $result = $course_row;
            break 1;
         }
      }
   }
   return (empty($result) === false) ? $result : false;
}

function output_all_units_for_course($courseID){

   $answer = get_all_units_for_course($courseID);

   $construct_unit_string = "";
   foreach($answer as $row){
      $unit_id = $row['unitID'];
      $unit_title = $row['unitTitle'];

      $construct_unit_string .= '<li><a href="unit.php?unit='.$unit_id.'">'.$unit_title.'</a></li>';
   }

   return $construct_unit_string;
}

?>
<?php

//this function returns an array of all the units required for a course
function get_all_units_for_course($courseID){
   $courseID = (int)$courseID;
   $query = "SELECT unitID, unitTitle FROM units WHERE courseID_Ref = '$courseID'";
   $result = mysqli_query($GLOBALS['connect'], $query);
   $answer = mysqli_fetch_all($result, MYSQLI_ASSOC);

   return $answer;
}

//this function should return an array containing a row of unit data
function get_specific_unit_details($unitID){
   $courseID = (int)$_SESSION['currentCourse']; //the SESSION ought to have been set when this function gets called
   $query = "SELECT unitTitle, objective, review, quiz FROM units WHERE courseID_Ref = '$courseID' AND unitID = '$unitID'";
   $result = mysqli_query($GLOBALS['connect'], $query);

   $answer = mysqli_fetch_assoc($result);

   return $answer;
}

//this function outputs the unit side bar which contains links to all lessons associated with this unit
function output_all_lessons_for_unit($unitID){

   $answer = get_all_lessons_for_unit($unitID);
   $construct_lesson_string = "";

   foreach($answer as $row){
      $lesson_id = $row['lessonID'];
      $lesson_title = $row['lessonTitle'];

      $construct_lesson_string .= '<a href="lesson.php?lesson='.$lesson_id.'" class="list-group-item">'.$lesson_title.'</a>';
   }

   return $construct_lesson_string;
}

?>
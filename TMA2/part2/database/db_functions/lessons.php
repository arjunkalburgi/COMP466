<?php

function get_all_lessons_for_unit($unitID){
   $unitID = (int)$unitID;
   $courseID = $_SESSION['currentCourse'];
   $query = "SELECT lessonID, lessonTitle, lessonContent FROM lessons WHERE courseID_Ref = '$courseID' AND unitID_Ref = '$unitID'";
   $result = mysqli_query($GLOBALS['connect'], $query);
   $answer = mysqli_fetch_all($result, MYSQLI_ASSOC);

   return $answer;
}

function get_specific_lesson($lessonID){
   $answer = array();
   $lessonID = (int)$lessonID;
   $courseID =  $_SESSION['currentCourse'];
   $unitID =  $_SESSION['currentUnit'];
   $query = "SELECT lessonTitle, lessonContent FROM lessons WHERE courseID_Ref = '$courseID' AND unitID_Ref = '$unitID' AND lessonID = '$lessonID'";

   $result = mysqli_query($GLOBALS['connect'], $query);
   if($result !== false){
      $answer = mysqli_fetch_assoc($result);
   }
   return $answer;
}

function output_lesson_content($xml_array){
   $construct_lesson_string = "";

   foreach($xml_array->object as $objects){

      if($objects->attributes()->type == 'image'){

         $construct_lesson_string .= construct_img_object($objects->attributes());

      }elseif($objects->attributes()->type == 'htmltext'){

         $construct_lesson_string .= construct_html_object($objects->attributes());
      }


   }
   return $construct_lesson_string;
}

function construct_img_object($attr_array){

   $img_string = "";

   if(empty($attr_array) === false){
      $img_db_details = explode(".", $attr_array->ref);

      $object_table = $img_db_details[0];
      $object_field = $img_db_details[1];
      $object_id = $img_db_details[2];

      $query = "SELECT ".$object_field." FROM ".$object_table." WHERE imgID = ".$object_id;
      echo "what is this query anyway????";
      $result = mysqli_query($GLOBALS['connect'], $query) or die("One or more errors from querying DB_table".$object_table);
      if($result !== false){
         $answer = mysqli_fetch_assoc($result);

         if($attr_array->size == 'medium'){
            $img_string .= '<p><img src="'.$answer['imgurl'].'" class="img-responsive lesson_img_med" alt="Responsive image"></p>';

         }elseif($attr_array->size == 'small'){
            $img_string .= '<p><img src="'.$answer['imgurl'].'" class="img-responsive lesson_img_sm" alt="Responsive image"></p>';

         }
      }
   }

   return $img_string;
}

function construct_html_object($attr_array){


   $html_string = "";

   if(empty($attr_array) === false){
      $html_db_details = explode(".", $attr_array->ref);

      $object_table = $html_db_details[0];
      $object_field = $html_db_details[1];
      $object_id = $html_db_details[2];

      $query = "SELECT ".$object_field." FROM ".$object_table." WHERE htmltextID = ".$object_id;
      echo "what is this query anyway????";
      $result = mysqli_query($GLOBALS['connect'], $query) or die("One or more errors from querying DB_table".$object_table);
      if($result !== false){
         $answer = mysqli_fetch_assoc($result);

         $html_string .= $answer['htmltext'];
      }
   }

   return $html_string;
}





?>
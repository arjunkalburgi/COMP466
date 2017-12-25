<?php


function output_quiz_content($courseID, $unitID){
   $construct_quiz_string = "";

   $query = "SELECT quizContent FROM quizzes WHERE courseID_Ref = '$courseID' AND unitID_Ref = '$unitID'";
   $result = mysqli_query($GLOBALS['connect'], $query) or die("<p>Found Errors Getting Quiz Content!</p>");
   $answer = mysqli_fetch_all($result, MYSQLI_ASSOC);
   $_SESSION['quizContent'] = $answer;
   foreach($answer as $quiz_row){
      $construct_quiz_string .= '<div class="form-group quiz_form-group">';
      $construct_quiz_string .= $quiz_row['quizContent'];
      $construct_quiz_string .= '</div>';
   }
   $construct_quiz_string .= '<button type="submit" class="btn btn-primary">Submit</button>';

   return $construct_quiz_string;
}

function get_quiz_answers($courseID, $unitID){
   //$answer_feedback = array();

   $query = "SELECT quizAnswer FROM quizzes WHERE courseID_Ref = '$courseID' AND unitID_Ref = '$unitID'";
   $result = mysqli_query($GLOBALS['connect'], $query) or die("<p>Found Errors Getting Quiz Content!</p>");
   $answer = mysqli_fetch_all($result, MYSQLI_ASSOC);

   return $answer;
}

function output_quiz_content_with_feedback($answers_array, $post_array){

   $feedback_quiz_string = "";
   $feedback_array = array();
   $key_index = array_keys($post_array);
   $index = 0;
   foreach($answers_array as $answers_row){
      $actual_answer = "";
      $submitted_answer = "";

      $actual_answer .= trim($answers_row['quizAnswer']);
      $submitted_answer .= trim($post_array[$key_index[$index]]);

      if(strcmp($actual_answer, $submitted_answer) === 0){
         $feedback_array [] = '<p class="bg-success col-md-4">'. $answers_row['quizAnswer'] .': Correct</p>';
      }else{
         $feedback_array [] = '<p class="bg-danger col-md-4">'. $post_array[$key_index[$index]] .': Wrong Answer</p>' . '<p class="bg-success col-md-4 left-pad">'. $answers_row['quizAnswer'] .': Correct</p>';
      }

      $index++;
   }

   $contents = $_SESSION['quizContent'];
   $index = 0;
   foreach($contents as $quiz_row){
      $feedback_quiz_string .= '<div class="form-group quiz_form-group">';
      $feedback_quiz_string .= $quiz_row['quizContent'];
      $feedback_quiz_string .= $feedback_array[$index];
      $feedback_quiz_string .= '</div>';

      $index++;
   }
   $feedback_quiz_string .= '<button type="submit" class="btn btn-primary" disabled="disabled">Submit</button>';
   $feedback_quiz_string .= '<a class="left-pad" href="unit.php?unit='.$_SESSION['currentUnit'].'">Go Back</a>';

   return $feedback_quiz_string;
}


?>
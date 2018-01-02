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
	  return $data; 
  } else {
	  echo "error retrieving from quizzes db";
	  exit(0); 
  }
}

// parser 
function parsequizquestion($str, $id) {
  return str_replace("_____", '<input required type="text" name="answer'.$id.'" placeholder="Answer">', $str); 
}

function getquizresultsaslist($quizobj, $formobj) {
	$output = array();
	foreach ($quizobj as $quizq) {
		$quizans = $quizq['answer']; 
		$formans = $formobj['answer'.$quizq['id']];

		$output[] = '<li class="collection-item avatar">
			<span class="title">'.$quizq['question'].'</span>
			<p>The  answer: '.$quizans.' <br>
			Your answer: '.$formans.'
			</p>
			</li>';
	}
	return $output;
}

?>
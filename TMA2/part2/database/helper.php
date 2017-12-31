<?php


function array_sanitize(&$item){
    $item = mysqli_real_escape_string($GLOBALS['connect'], $item);
}

function sanitize($data){
    return mysqli_real_escape_string($GLOBALS['connect'], $data);
}

function output_errors($errors){
    $output = array();

    foreach ($errors as $error) {
        $output[] = '<li>'. $error . '</li>';
    }
    
    return '<ul style="color:red;font-weight:600;">'. implode('', $output) . '</ul>';
}

libxml_use_internal_errors(true);
function spit_xml_content($xml_string){
   $xml_array = array();

   if(empty($xml_string) === false){
      $xml_array = simplexml_load_string($xml_string);
      if($xml_string === false){
         foreach(libxml_get_errors() as $error){
            $errors [] = 'Failed loading xml' . $error->message . '<br>';
         }
      }
   }

   return (empty($xml_array) === false) ? $xml_array : false;
}

// init functions 
function resetdbs($resetornah) {
  if ($resetornah) {
    $resetdbsquery = "TRUNCATE TABLE courses; 
              TRUNCATE TABLE units; 
              TRUNCATE TABLE lessons; 
              TRUNCATE TABLE quizzes";
    $results = mysqli_query($GLOBALS['connect'], $resetdbsquery) or die (mysqli_error($GLOBALS['connect']));  
  }
}

function setupdbs() {
  $coursesquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM courses LIMIT 1");
  if ($coursesquery === false) {
      echo "hiiiiiiii from createcoursestable"; 
      
      $createcoursestable = "CREATE TABLE courses (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          courseTitle varchar (30) NOT NULL
          )";
      $results = mysqli_query($GLOBALS['connect'], $createcoursestable) or die (mysqli_error($GLOBALS['connect']));
  }
  $unitsquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM units LIMIT 1");
  if ($unitsquery === false) {
      echo "hiiiiiiii from unitsquery"; 

      $unitstable = "CREATE TABLE units (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          title varchar (30) NOT NULL,
          abstract varchar (3000) NOT NULL,
          courseID_Ref int NOT NULL REFERENCES course(id)
          )";
      $results = mysqli_query($GLOBALS['connect'], $unitstable) or die (mysqli_error($GLOBALS['connect']));
  }
  $lessonquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM lessons LIMIT 1");
  if ($lessonquery === false) {
      echo "hiiiiiiii from lessonquery"; 

      $createlessontable = "CREATE TABLE lessons (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          title varchar (30) NOT NULL,
          content varchar (3000) NOT NULL,
          quizID_Ref int NOT NULL REFERENCES quiz(id),
          unitID_Ref int NOT NULL REFERENCES unit(id),
          courseID_Ref int NOT NULL REFERENCES course(id)
          )";
      $results = mysqli_query($GLOBALS['connect'], $createlessontable) or die (mysqli_error($GLOBALS['connect']));
  }
  $quizquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM quizzes LIMIT 1");
  if ($quizquery === false) {
      echo "hiiiiiiii from quizquery"; 

      $createquiztable = "CREATE TABLE quizzes (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          question  varchar (50) NOT NULL,
          answer varchar (50) NOT NULL
          )";
      $results = mysqli_query($GLOBALS['connect'], $createquiztable) or die (mysqli_error($GLOBALS['connect']));
  }
}

// upload from xml to db
function xml2db() {
  $xml = simplexml_load_file("./courses.xml");

  echo $xml === false;

  // for each course
  foreach ($xml->course as $course) {
    $title = (string)$course->title;
    insertcourses2db($title);
    $courseID_Ref = getcourseIDfromtitle($title);

    // for each unit 
    foreach ($course->units->unit as $unit) {
      $title = (string)$unit->title;
      $abstract = (string)$unit->abstract;
      insertunit2db($title, $abstract, $courseID_Ref);
      $unitID_Ref = getcourseIDfromtitle($title);

      // for each lesson
      foreach ($unit->lessons->lesson as $lesson) {

        $question = (string)$lesson->quiz->question->text;
        $answer = (string)$lesson->quiz->question->answer;
        insertquiz2db($question, $answer);
        $quizID_Ref = getquizIDfromquestion($question);

        $title = (string)$lesson->title;
        $content = (string)$lesson->content;
        insertlesson2db($title, $content, $quizID_Ref, $unitID_Ref, $courseID_Ref);
      }
    }
  }
}

// insert 
function insertcourses2db($title) {
    $course_string = "INSERT INTO courses (courseTitle) VALUES ('$title');";
    if (mysqli_multi_query($GLOBALS['connect'], $quiz_string) === false) {
      echo "Error courses: Could not commit the insertion, please try again.";
    }
}

function insertunit2db($title, $abstract, $courseID_Ref) {
    $unit_string = "INSERT INTO units (title, abstract, courseID_Ref) VALUES ('$title', '$abstract', '$courseID_Ref');";
    if (mysqli_multi_query($GLOBALS['connect'], $quiz_string) === false) {
      echo "Error units: Could not commit the insertion, please try again.";
    }
}

function insertlesson2db($title, $content, $quizID_Ref, $unitID_Ref, $courseID_Ref) {
    $course_string = "INSERT INTO lessons (title, content, quizID_Ref, unitID_Ref, courseID_Ref) VALUES ('$title', '$content', '$quizID_Ref', '$unitID_Ref', '$courseID_Ref');";
    if (mysqli_multi_query($GLOBALS['connect'], $quiz_string) === false) {
      echo "Error lessons: Could not commit the insertion, please try again.";
    }
}

function insertquiz2db($question, $answer) {
    $unit_string = "INSERT INTO quizzes (question, answer) VALUES ('$question', '$answer');";
    if (mysqli_multi_query($GLOBALS['connect'], $quiz_string) === false) {
      echo "Error quizzes: Could not commit the insertion, please try again.";
    }
}

// get id
function getcourseIDfromtitle($title) {
  $courseidquery = "SELECT $id FROM courses WHERE courseTitle = '$title'";
  $result = mysqli_query($GLOBALS['connect'], $courseidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data; 
  } else {
    echo "error retrieving from courses db";
    exit(0); 
  }
}
function getunitIDfromtitle($title) {
  $courseidquery = "SELECT $id FROM units WHERE title = '$title'";
  $result = mysqli_query($GLOBALS['connect'], $courseidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data; 
  } else {
    echo "error retrieving from units db";
    exit(0); 
  }
}
function getlessonIDfromtitle($title) {
  $courseidquery = "SELECT $id FROM lessons WHERE title = '$title'";
  $result = mysqli_query($GLOBALS['connect'], $courseidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data; 
  } else {
    echo "error retrieving from lessons db";
    exit(0); 
  }
}
function getquizIDfromquestion($question) {
  $courseidquery = "SELECT $id FROM quizzes WHERE question = '$question'";
  $result = mysqli_query($GLOBALS['connect'], $courseidquery);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (($data !== null) && (empty($data) === false)) {
    return $data; 
  } else {
    echo "error retrieving from quizzes db";
    exit(0); 
  }
}

?>
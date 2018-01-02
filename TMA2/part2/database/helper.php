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

// init functions 
function resetdbs($resetornah) {
  if ($resetornah) {
    $resetdbsquery = "DROP TABLE courses"; 
    $results = mysqli_query($GLOBALS['connect'], $resetdbsquery) or die (mysqli_error($GLOBALS['connect']));  
    $resetdbsquery = "DROP TABLE units";
    $results = mysqli_query($GLOBALS['connect'], $resetdbsquery) or die (mysqli_error($GLOBALS['connect']));  
    $resetdbsquery = "DROP TABLE lessons"; 
    $results = mysqli_query($GLOBALS['connect'], $resetdbsquery) or die (mysqli_error($GLOBALS['connect']));  
    $resetdbsquery = "DROP TABLE quizzes";
    $results = mysqli_query($GLOBALS['connect'], $resetdbsquery) or die (mysqli_error($GLOBALS['connect']));  

    setupdbs();
    xml2db();
  }
}

function setupdbs() {
  $coursesquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM courses LIMIT 1");
  if ($coursesquery === false) {
      echo "courses dropped and being made\n"; 
      
      $createcoursestable = "CREATE TABLE courses (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          courseTitle varchar (100) NOT NULL
          )";
      $results = mysqli_query($GLOBALS['connect'], $createcoursestable) or die (mysqli_error($GLOBALS['connect']));
  }
  $unitsquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM units LIMIT 1");
  if ($unitsquery === false) {
      echo "units dropped and being made\n"; 

      $unitstable = "CREATE TABLE units (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          title varchar (1000) NOT NULL,
          abstract text NOT NULL,
          courseID_Ref int NOT NULL REFERENCES course(id)
          )";
      $results = mysqli_query($GLOBALS['connect'], $unitstable) or die (mysqli_error($GLOBALS['connect']));
  }
  $lessonquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM lessons LIMIT 1");
  if ($lessonquery === false) {
      echo "lesson dropped and being made\n"; 

      $createlessontable = "CREATE TABLE lessons (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          title varchar (1000) NOT NULL,
          content longtext NOT NULL,
          quizID_Ref int NOT NULL REFERENCES quiz(id),
          unitID_Ref int NOT NULL REFERENCES unit(id),
          courseID_Ref int NOT NULL REFERENCES course(id)
          )";
      $results = mysqli_query($GLOBALS['connect'], $createlessontable) or die (mysqli_error($GLOBALS['connect']));
  }
  $quizquery = mysqli_query($GLOBALS['connect'], "SELECT 1 FROM quizzes LIMIT 1");
  if ($quizquery === false) {
      echo "quiz dropped and being made\n"; 

      $createquiztable = "CREATE TABLE quizzes (
          id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          question  varchar (1000) NOT NULL,
          answer varchar (100) NOT NULL
          )";
      $results = mysqli_query($GLOBALS['connect'], $createquiztable) or die (mysqli_error($GLOBALS['connect']));
  }
  echo "------------------------------------------------------------------------------------------------------------------------\n"; 
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
      $title = (string)$unit->unitMeta->title;
      $abstract = (string)$unit->unitMeta->abstract;
      insertunit2db($title, $abstract, $courseID_Ref);
      $unitID_Ref = getunitIDfromtitle($title);

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

// parser 
function parse($str) {
  return str_replace("{{{", "<", $str); 
}

?>
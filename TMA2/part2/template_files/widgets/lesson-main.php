<?php

$lesson_row = get_specific_lesson($_SESSION['currentLesson']);
if($lesson_row === null){
   $errors [] = 'Could not find the current lesson in DB!';
}else{
   $xml_array = spit_xml_content($lesson_row['lessonContent']);
}


?>

<div class="col-xs-12 col-sm-9">
   <div class="jumbotron">
      <h1><?php echo $lesson_row['lessonTitle']; ?></h1>
   </div>

   <?php
      echo output_lesson_content($xml_array);
   ?>

<!--   <h1 class="page-header">Objectives</h1>
   <h1 class="page-header">Learning Objects</h1>-->
<!--   <div class="panel panel-default">
      <div class="panel-heading">Create a Table in MySQL</div>
      <div class="panel-body">

         <p><img src="../shared/images/db_course/unit4/mysql_primary_key_1.png" class="img-responsive lesson_img_med" alt="Responsive image"></p>

      </div>
   </div>-->
</div>

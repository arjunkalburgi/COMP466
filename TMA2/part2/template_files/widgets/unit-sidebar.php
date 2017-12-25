
<?php
   $lesson_string_sidebar = output_all_lessons_for_unit($_SESSION['currentUnit']);  //we construct our lesson side bar to output
   if(strlen($lesson_string_sidebar) == 0){
      $errors[] = 'There are no lessons for this unit';
   }
?>
<div class="col-xs-6 col-sm-3">
   <div class="list-group">
      <a href="unit.php?unit=<?php echo $_SESSION['currentUnit'] ?>" class="list-group-item active">Unit Overview</a>
      <?php
         echo $lesson_string_sidebar;
      ?>
      <a href="course.php?data=<?php echo $_SESSION['currentCourse']?>" class="list-group-item"> Back to Course </a>
   </div>
</div>
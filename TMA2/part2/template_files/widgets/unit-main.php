
<?php

$unit_row = get_specific_unit_details($_SESSION['currentUnit']);
if($unit_row === null){
   $errors[] = 'Could not find the specified unit';
}else{
   //print_r($unit_row);
}
?>

<div class="col-xs-12 col-sm-9">
   <div class="jumbotron">
      <h1>
         <?php
            echo $unit_row['unitTitle'];
         ?>
      </h1>
   </div>
   <?php
      echo part2_output_errors($errors);
   ?>
   <h1 class="page-header">Objectives</h1>
   <?php echo $unit_row['objective']; ?>
   <h1 class="page-header">Review</h1>
   <?php echo $unit_row['review']; ?>
   <h1 class="page-header">Quiz</h1>
   <?php echo $unit_row['quiz']; ?>
</div>
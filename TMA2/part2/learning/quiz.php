<?php
include 'core/init.php';
include 'includes/overall/top_page.php';


$construct_quiz_content = output_quiz_content($_SESSION['currentCourse'], $_SESSION['currentUnit']);
$construct_quiz_feedback = "";

if(empty($_POST) === false){
   $quiz_answers = get_quiz_answers($_SESSION['currentCourse'], $_SESSION['currentUnit']);

   if(count($_POST) !== count($quiz_answers)){
      $errors[] = 'All Questions Are Required!';
   }else{
      $construct_quiz_feedback = output_quiz_content_with_feedback($quiz_answers, $_POST);
   }
}

?>

<div class="container">
   <div class="row">

      <div class="col-xs-18 col-sm-12">
         <div class="jumbotron">
            <h1>Quiz Title</h1>
         </div>
         <?php
         if(empty($errors) === false){
            echo part2_output_errors($errors);
         }
         ?>
         <h1 class="page-header">Quiz</h1>
         <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

            <?php
            if(empty($_POST) === true || empty($errors) === false){
               echo $construct_quiz_content;
            } else{
               echo $construct_quiz_feedback;
            }
            ?>

            <?php

            ?>
         </form>
      </div>
   </div>
</div>
<?php include 'includes/overall/bottom_page.php'; ?>

<?php
include 'core/init.php';
include 'includes/overall/top_page.php';

//data holds the courseID of a specific course
if(isset($_GET['data'])){
   $_SESSION['currentCourse'] = part2_sanitize($_GET['data']);  //we maintain a global variable of the current course in session
   $course_row = specific_course_row($_SESSION['currentCourse']); //takes in a course ID and returns the entire row for that course
   if($course_row === false){
      $errors [] = 'Could not find the specified course';
   }
}
?>

   <div class="container">
      <div class="row">
         <div class="col-sm-4 col-md-3 sidebar">
            <ul class="nav nav-sidebar">
               <li class="active"><a href="#"><h3>Overview<span class="sr-only">(current)</span></h3></a></li>
               <?php echo output_all_units_for_course($_SESSION['currentCourse']);?>
            </ul>
         </div>

         <div class="col-sm-8 col-md-9 main">
            <div class="jumbotron">
               <h1><?php echo $course_row['courseTitle']; ?></h1>
               <p>
                  <?php
                     echo $course_row['introduction'];
                  ?>
               </p>
            </div>
            <?php
               echo part2_output_errors($errors);
            ?>
            <h1 class="page-header">Syllabus</h1>
            <?php echo $course_row['syllabus']; ?>
            <h1 class="page-header">Summary</h1>
            <?php echo $course_row['summary']; ?>
            <h1 class="page-header">Research</h1>
            <?php echo $course_row['research']; ?>
            <h1 class="page-header">Books</h1>
            <?php echo $course_row['books']; ?>
            <h1 class="page-header">Assignments</h1>
            <?php echo $course_row['assignment']; ?>
         </div>
      </div>
   </div>

<?php include 'includes/overall/bottom_page.php'; ?>

<?php
include 'core/init.php';
include 'includes/overall/top_page.php';

//lesson holds the unitID of a specific course
if(isset($_GET['lesson'])){
   $_SESSION['currentLesson'] = part2_sanitize($_GET['lesson']);  //we maintain a global variable of the current unit in session
}

?>

<div class="container-fluid">
   <div class="row">
      <?php include 'includes/widgets/lesson-main.php'; ?>

      <?php include 'includes/widgets/unit-sidebar.php'; ?>
   </div>
</div>
<?php include 'includes/overall/bottom_page.php'; ?>

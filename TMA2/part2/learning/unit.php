<?php
include 'core/init.php';
include 'includes/overall/top_page.php';

//unit holds the unitID of a specific course
if(isset($_GET['unit'])){
   $_SESSION['currentUnit'] = part2_sanitize($_GET['unit']);  //we maintain a global variable of the current unit in session
}
?>

<div class="container">
   <div class="row">
      <?php include 'includes/widgets/unit-main.php'; ?>

      <?php include 'includes/widgets/unit-sidebar.php'; ?>
   </div>
</div>
<?php include 'includes/overall/bottom_page.php'; ?>

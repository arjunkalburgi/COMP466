<div class="content">
    <?php
    	if (!empty($_POST) && isset($_GET['content'])) {
        	include $_GET['content']; 
    	} else {
        include 'learning/course.php'; // contains select a course or course info 
    ?>
    <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Unit 4</span>
              <p>Databases for the Web in MySQL, relational database system.</p>
            </div>
            <div class="card-action">
              <a href="index.php/content=unit4/study.php">STUDY UNIT 4</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Unit 5</span>
              <p>Server-side Scripting with PHP, Apache server and MySQL db.</p>
            </div>
            <div class="card-action">
              <a href="index.php/content=unit5/study.php">STUDY UNIT 5</a>
            </div>
          </div>
        </div>

    </div>
            
    <?php
    	}
    ?>
</div>
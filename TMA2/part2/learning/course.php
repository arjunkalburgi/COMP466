<?php

   // did user ask for a course? 
   if (empty($_POST) === false) {

      // ensure fields are filled 
      foreach ($_POST as $key => $value) {
         if (empty($value)) {
            $errors[] = 'All fields are required!';
            break 1;
         }
      }

      // if all good display units:  
      if(empty($errors)) {
         // display course info: 
         header('Location: index.php?content=learning/unit.php&coursechoosen='.$_POST["courseId"]); // contains nothing or select a unit or unit info 
      }
      
   } else {
      ?>

      <ul class="collection with-header">
         <li class="collection-header"><b>press the button to select this course</b></li>

      <?php

         // get courses from sql 
         $getidquery = "SELECT * FROM courses";
         $result = mysqli_query($GLOBALS['connect'], $getidquery) or die (mysqli_error($GLOBALS['connect']));  
         $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

         // echo var_dump($courses);

         $output = array();
         foreach ($courses as $course) {
            $output[] = '<li class="collection-item">
                  '.$course['courseTitle'].'
                  <div class="secondary-content">
                  <button onclick="selectButtonClick(\''.$course['courseTitle'].'\', \''.$course['id'].'\')"><i class="material-icons">fast_forward</i></button>
                  </div>
                  </li>';
         }

         echo implode('', $output);

      ?>
      </ul>

      <script type="text/javascript">
         
         function selectButtonClick(courseTitle, courseId) {

            // * * * * * * * * * * * * * * * * * * * *
            // from https://stackoverflow.com/a/133997
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "");

            // bookmark name field
             var formfield = document.createElement("input");
            formfield.setAttribute("type", "text");
            formfield.setAttribute("name", "courseTitle");
            formfield.setAttribute("value", courseTitle);
            form.appendChild(formfield);

            // bookmark url field
             var formfield = document.createElement("input");
            formfield.setAttribute("type", "text");
            formfield.setAttribute("name", "courseId");
            formfield.setAttribute("value", courseId);
            form.appendChild(formfield);

            // commit field
             var commitfield = document.createElement("input");
            commitfield.setAttribute("type", "text");
            commitfield.setAttribute("name", "commit");
            commitfield.setAttribute("value", "Get Course");
            form.appendChild(commitfield);


            document.body.appendChild(form);
            form.submit();
         }
         
      </script>

<?php } ?>

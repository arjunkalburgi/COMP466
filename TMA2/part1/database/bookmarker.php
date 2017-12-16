<?php


//we insert into the database, an array of multiple bookmarks, returns true on success
function create_bookmarks($post_array){

   $create_result = false;
   if(count($post_array) > 0){

      $user_id = $_SESSION['user_id']; 
      $bookmark_name = sanitize($post_array["bookmark_name"]); 
      $bookmark_url = sanitize($post_array["bookmark_url"]);


      $sql_string = "INSERT INTO bookmarks (user_id_ref, bookmark_name, bookmark_url) VALUES ('$user_id', '$bookmark_name', '$bookmark_url');";


      if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
         $create_result = true;
      } else {
         $GLOBALS['errors'][] = "Error: Could not commit the bookmark, please try again.";
      }
   }

   return $create_result;
}

// validates an entered bookmark url
function check_url_bookmark($post_array){


   $validate_url = true;
   if(count($post_array) > 0){

      $bookmark_name = $post_array["bookmark_name"]; 
      $bookmark_url = sanitize($post_array["bookmark_url"]);

      $validate_url = check_url($bookmark_url); 

   }

   return $validate_url;
}

//validate a url given a string, returns true if the url is valid
function check_url($url_string){
   $validate_url = true;
   if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i", $url_string)) {
      $validate_url = false;
      $GLOBALS['errors'][] = 'The URL entered is invalid!';
   }

   return $validate_url;
}

//search the DB to find all bookmark associated with this user_id.
//returns an array of bookmark name and url, or false on error
function get_all_user_bookmarks($user_id){
   $data = array();
   $user_id = (int)$user_id;

   $func_num_args = func_num_args();   //this gets the count of the arguments that was sent to the function
   $func_get_args = func_get_args();   //this returns an array of the actual arguments

   if($func_num_args > 1){
      unset($func_get_args[0]);   //we pop out the user_id from the array variable

      $fields = implode(', ', $func_get_args);

      $query = "SELECT $fields FROM bookmarks WHERE user_id_ref = '$user_id'";
      $result = mysqli_query($GLOBALS['connect'], $query);
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
      return (($data !== null) && (empty($data) === false)) ? $data : false;
   }
}

//this is used in the home page of a logged in bookmark application
function output_bookmarks(){

   $my_bookmarks = $GLOBALS['bookmark_data'];      //global data of all the bookmarks related to a specific user
   if($my_bookmarks !== false){
      $output = array();
      foreach($my_bookmarks as $bookmark ){
         $output[] = '<li class="collection-item"><a href='.$bookmark['bookmark_url'].' target="_blank">' . $bookmark['bookmark_name'] . ' - ' .$bookmark['bookmark_url']. '</a></li>';
      }
      echo  implode('', $output);
   }else{
      echo '<div class="bookmark_select">No stored bookmarks.';
   }
}

function output_editable_bookmarks() {

   $my_bookmarks = $GLOBALS['bookmark_data'];

   if ($my_bookmarks !== false) {
      $output = array();
      foreach($my_bookmarks as $bookmark ){
         $output[] = '<li class="collection-item">
                     <a href='.$bookmark['bookmark_url'].' target="_blank">' . $bookmark['bookmark_name'] . ' - ' .$bookmark['bookmark_url']. '</a>
                     <div class="secondary-content"><button onclick="updateButtonClick(\''.$bookmark['bookmark_name'].'\')"><i class="material-icons">edit</i></button>
                     <button onclick="deleteButtonClick(\''.$bookmark['bookmark_name'].'\')"><i class="material-icons">delete</i></button></div></li>';
      }
      echo  implode('', $output);
   }else{
      echo '<div class="bookmark_select">No stored bookmarks.';
   }

}

/*
 * This function, validates the update_bookmark page, to ensure that the user is doing the right thing while modifying
 * returns a true if validation was successful, and false if otherwise
 */
function validate_bookmark_update($post_array){

   $validate = true;
   if(empty($post_array) === false) {
      array_pop($post_array); //remove the last element, because it contains the submit buttons data

      //first ensure that all required fields on the form has been filled
      foreach ($post_array as $key => $value) {
         //if any of the submitted values from the $post_array are empty, then break
         if (empty($value[0]) || empty($value[1])) {  //here, the post array values is also an assoc array
            $GLOBALS['errors'][] = 'All fields are required!';
            $validate = false;
            break 1;    //even if we find one
         }

         if($validate === true){
            //checking the entered bookmark urls
            if(check_url($value[1]) === false){
               $validate = false;
               $GLOBALS['errors'][] = 'A URL entered, is invalid!';
               break 1;
            }
         }
      }

   }

   return $validate;
}

function update_selected_bookmarks($post_array, $old_data_array){

   $update_result = false;
   if(empty($post_array) === false && empty($old_data_array) === false) {
      array_pop($post_array); //remove the last element, because it contains the submit buttons data

      $sql_string = '';
      $index_old_data = 0;
      $user_id = $GLOBALS['session_user_id'];


      //we know that the the position of element in the post_array, corresponds with the position of element in the old_data_array
      foreach ($post_array as $key => $value) {

         $old_name = key($old_data_array[$index_old_data]);
         $old_url = $old_data_array[$index_old_data][$old_name];

         $sql_string .= "UPDATE bookmarks SET bookmark_name='$value[0]', bookmark_url='$value[1]' WHERE user_id_ref='$user_id' AND bookmark_name='$old_name' AND bookmark_url='$old_url';";

         $index_old_data++;
      }

      if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
         $update_result = true;
      } else {
         $update_result = false;
      }

   }
   return $update_result;

}

function delete_bookmarks($post_array) {

   $result = true; 

   if (count($post_array) > 0) {

      $user_id = $_SESSION['user_id']; 
      $bookmark_name = sanitize($post_array["bookmark_name"]); 


      $sql_string = "DELETE FROM bookmarks WHERE user_id_ref='$user_id' AND bookmark_name='$bookmark_name';";


      if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
         $create_result = true;
      } else {
         $GLOBALS['errors'][] = "Error: Could not commit the bookmark, please try again.";
      }
   }

   return $result;
}

?>

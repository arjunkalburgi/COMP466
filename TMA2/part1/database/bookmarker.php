<?php


//we insert into the database, an array of multiple bookmarks, returns true on success
function create_bookmarks($post_array){
   $create_result = false;
   if(count($post_array) > 0){

      $sql_string = '';       //construct the insertion SQL statement
      $user_id = $_SESSION['user_id']; //we need to insert foreign key user_id into the bookmarks database
      array_pop($post_array); //remove the last element, because it contains the submit button's data
      $length = count($post_array);
      $my_keys = array_keys($post_array); //get an array of keys, because the post_array, is an associative array and we want to be able to index correctly
      // we loop through the post_array to construct our query
      for($index = 0; $index < $length; $index=$index+2){
         $bookmark_name = $post_array[$my_keys[$index]];
         $bookmark_url = $post_array[$my_keys[$index + 1]];

         $bookmark_url = sanitize($bookmark_url);  //sanitize first of all
         $bookmark_name = sanitize($bookmark_name);

         $sql_string .= "INSERT INTO bookmarks (user_id_ref, bookmark_name, bookmark_url) VALUES ('$user_id', '$bookmark_name', '$bookmark_url');";
      }

      if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
         $create_result = true;
      } else {
         //$GLOBALS['errors'][] = "Error: " . $sql_string . "<br>" . mysqli_error($GLOBALS['connect']);
      }
   }

   return $create_result;
}

// validates an entered bookmark url
function check_url_bookmark($post_array){

   $validate_url = true;
   if(count($post_array) > 0){
      array_pop($post_array); //remove the last element, because it contains the submit buttons data
      $length = count($post_array);
      $my_keys = array_keys($post_array); //get an array of keys, because the post_array, is an associative array and we want to be able to index correctly

      //we are indirectly looping through the post_array, and parsing the bookmark_name and url
      for($index = 0; $index < $length; $index=$index+2){
         $bookmark_name = $post_array[$my_keys[$index]];
         $bookmark_url = $post_array[$my_keys[$index + 1]]; //we add index + 1 because the bookmark_url is stored at the next index position

         $bookmark_url = sanitize($bookmark_url);  //sanitize first of all
         //regex expression for URLs
         if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i",$bookmark_url)) {
            $validate_url = false;
            $GLOBALS['errors'][] = 'A URL entered, is invalid!';
            break 1;
         }
      }
   }

   return $validate_url;
}

//validate a url given a string, returns true if the url is valid
function check_url($url_string){
   $validate_url = true;
   if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i", $url_string)) {
      $validate_url = false;
      //$GLOBALS['errors'][] = 'A URL entered, is invalid!';
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

/* responsible for outputting the list of bookmarks for selection purposes */
function output_bookmarks_to_check(){
   $my_bookmarks = $GLOBALS['bookmark_data'];      //global data of all the bookmarks related to a specific user

   if(empty($my_bookmarks) === false && $my_bookmarks !== false){
      $output = array();
      foreach($my_bookmarks as $bookmark ){
         $name = $bookmark['bookmark_name'];
         $url = $bookmark['bookmark_url'];
         $output[] = '<div class="bookmark_check"><input type="checkbox" name="'.$name.'" value="'.$url.'"><span class="shift_label">'.$name.'</span></div>';
         //$output[] = '<div class="bookmark_check"><input type="text" name='.$url.' value="'.$name.'"><input type="text" name='.$url.' value="'.$url.'"></div>';
      }
      echo  implode('', $output);
   }else{
      echo '<div class="bookmark_select">No stored bookmarks.';
   }
}

//this function outputs the bookmarks previously selected by the user, in a input text field; that way the user can easily modify the data.
//returns an array of old data in the same order
function output_bookmarks_to_modify($post_array){

   if(count($post_array) > 1){
      array_pop($post_array); //remove the last element, because it contains the submit buttons data
      $length = count($post_array);
      $my_keys = array_keys($post_array); //get an array of keys, because the post_array, is an associative array and we want to be able to index correctly

      $output = array();     //this array outputs a list of input text fields on screen
      $old_data = array(); //because we are doing an update, this array holds the old bookmark data that the user is about to update
      for($index = 0; $index < $length; $index++){
         $url_value = $post_array[$my_keys[$index]];
         $name_value = str_replace('_', ' ', $my_keys[$index]);   //the POST array, formats the name/value pairs by removing the whitespaces, and (.). So we are changing that

         $old_data[] = array("$name_value" => "$url_value");

         //we are creating two text fields that has an array as it's name. This allows us to save multiple values
         $output[] = '<div class="bookmark_check"><input type="text" name="index'.$index.'[]" value="'.$name_value.'"><input type="text" name="index'.$index.'[]" value="'.$url_value.'"></div>';
      }
      //echo print_r($old_data);
      echo implode('', $output);

      return $old_data;
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

function delete_selected_bookmarks($post_array){

   $result = true;
   if(count($post_array) > 1){
      $user_id = $GLOBALS['session_user_id'];
      array_pop($post_array); //remove the last element, because it contains the submit buttons data
      $length = count($post_array);
      $my_keys = array_keys($post_array); //get an array of keys, because the post_array, is an associative array and we want to be able to index correctly
      $sql_string = '';

      for($index = 0; $index < $length; $index++){
         $url_value = $post_array[$my_keys[$index]];
         $name_value = str_replace('_', ' ', $my_keys[$index]);   //the POST array, formats the name/value pairs by removing the whitespaces, and (.). So we are changing that

         $sql_string .= "DELETE FROM bookmarks WHERE user_id_ref='$user_id' AND bookmark_name='$name_value' AND bookmark_url='$url_value';";
      }

      if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
         $result = true;
      } else {
         $result = false;
         $GLOBALS['errors'] = 'Encountered error during deletion!';
      }

   }
   return $result;
}

?>

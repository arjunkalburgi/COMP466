<?php


function get_all_bookmarks($user_id){
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


// list bookmarks

function output_bookmarks() {

	$my_bookmarks = $GLOBALS['bookmark_data'];

	if ($my_bookmarks !== false) {
		$output = array();
		foreach($my_bookmarks as $bookmark ) {
			$output[] = '<li class="collection-item">
					 <a href='.$bookmark['bookmark_url'].' target="_blank">' . $bookmark['bookmark_name'] . ' - ' .$bookmark['bookmark_url']. '</a>
					 <div class="secondary-content">
						<button onclick="updateButtonClick(\''.$bookmark['bookmark_name'].'\', \''.$bookmark['bookmark_url'].'\')"><i class="material-icons">edit</i></button>
						<button onclick="deleteButtonClick(\''.$bookmark['bookmark_name'].'\', \''.$bookmark['bookmark_url'].'\')"><i class="material-icons">delete</i></button>
					 </div></li>';
		}
		echo implode('', $output);

	} else {
		echo '<li class="collection-item">No stored bookmarks.</li>';
	}
}


// actions

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

function update_bookmark($post_array) {

	$result = true; 

	if (count($post_array) > 0) {

		$user_id = $_SESSION['user_id']; 
		$bookmark_name = sanitize($post_array["bookmark_name"]); 
		$bookmark_url = sanitize($post_array["bookmark_url"]); 
		$old_name = sanitize($post_array["old_name"]);
		$old_url = sanitize($post_array["old_url"]);

		$sql_string = "UPDATE bookmarks SET bookmark_name='$bookmark_name', bookmark_url='$bookmark_url' WHERE user_id_ref='$user_id' AND bookmark_name='$old_name' AND bookmark_url='$old_url';";

		if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
			$create_result = true;
		} else {
			$GLOBALS['errors'][] = "Error: Could not commit the action, please try again.";
		}
	}

	return $result;
}

function delete_bookmarks($post_array) {

	$result = true; 

	if (count($post_array) > 0) {

		$user_id = $_SESSION['user_id']; 
		$bookmark_name = sanitize($post_array["bookmark_name"]); 
		$bookmark_url = sanitize($post_array["bookmark_url"]);

		$sql_string = "DELETE FROM bookmarks WHERE user_id_ref='$user_id' AND bookmark_name='$bookmark_name' AND bookmark_url='$bookmark_url';";

		if (mysqli_multi_query($GLOBALS['connect'], $sql_string)) {
			$create_result = true;
		} else {
			$GLOBALS['errors'][] = "Error: Could not commit the action, please try again.";
		}
	}

	return $result;
}


// helpers 

function check_url_bookmark($post_array){


	$validate_url = true;
	if(count($post_array) > 0){

		$bookmark_name = $post_array["bookmark_name"]; 
		$bookmark_url = sanitize($post_array["bookmark_url"]);

		$validate_url = check_url($bookmark_url); 

	}

	return $validate_url;
}

function check_url($url_string){
	$validate_url = true;

	if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i", $url_string)) {
		$validate_url = false;
		$GLOBALS['errors'][] = 'The URL entered is invalid!';
	}

	return $validate_url;
}

?>

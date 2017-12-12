<?php

/* responsible for outputting the list of bookmarks for selection purposes */
include 'core/init.php';
protect_page();

$my_bookmarks = $GLOBALS['bookmark_data'];      //global data of all the bookmarks related to a specific user

if(empty($my_bookmarks) === false){

}

?>
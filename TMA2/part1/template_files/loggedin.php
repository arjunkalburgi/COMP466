<div class="widget">
    <h3 class="widget_header">User Menu</h3>
    <div class="bookmark_inner">
        <p>Welcome, <?php echo $user_data['first_name']; ?> </p>
        <p><a href="index.php?content=authentication/logout.php">Sign Out</a></p>
    </div>
</div>

<div class="widget">
    <h3 class="widget_header">Bookmark Menu</h3>
    <div class="bookmark_inner">
        <p><a href="index.php?content=bookmarks/create_bookmarks.php">Create Bookmark(s)</a></p>
        <p><a href="index.php?content=bookmarks/update_bookmarks.php">Update Bookmark(s)</a></p>
        <p><a href="index.php?content=bookmarks/delete_bookmarks.php">Delete Bookmark(s)</a></p>
    </div>
</div>
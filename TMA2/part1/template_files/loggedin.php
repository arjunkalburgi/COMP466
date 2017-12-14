<hr style="margin-top: 10%;">
<div class="row">
    <div class="col s12 m6">
        <div class="card light-blue darken-1">
            <div class="card-content white-text">
                <span class="card-title">Menu</span>
                <p>Hey <?php echo $user_data['first_name']; ?>, feel free to sign out or email your feedback!</p>
            </div>
            <div class="card-action">
                <a href="index.php?content=authentication/logout.php">Sign Out</a>
                <a href="mailto:askalburgi@gmail.com">Email feedback</a>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card light-blue darken-1">
            <div class="card-content white-text">
                <span class="card-title">Bookmark Menu</span>
                <p>Hey <?php echo $user_data['first_name']; ?>, these are quick links for you to create, update and delete bookmarks</p>
            </div>
            <div class="card-action">
                <a href="index.php?content=bookmarks/create_bookmarks.php">Create</a>
                <a href="index.php?content=bookmarks/update_bookmarks.php">Update</a>
                <a href="index.php?content=bookmarks/delete_bookmarks.php">Delete</a>
            </div>
        </div>
    </div>
</div>

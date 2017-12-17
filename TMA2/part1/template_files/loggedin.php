<hr style="margin-top: 10%;">
<div class="row">
    <div class="col s12 m6">
        <div class="card light-blue darken-1">
            <div class="card-content white-text">
                <span class="card-title">App Actions</span>
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
                <span class="card-title">Bookmark Actions</span>
                <p>Hey <?php echo $user_data['first_name']; ?>, with this application, you can conduct 3 actions with your bookmarks: </p>
            </div>
            <div class="card-action">
                <a>Create</a>
                <a>Update</a>
                <a>Delete</a>
            </div>
        </div>
    </div>
</div>

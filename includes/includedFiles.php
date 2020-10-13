<?php
// This file is used for checking whether the request was sent by ajax or the user manually navigated to that page
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ // If request was sent with AJAX
    include("includes/config.php"); //to use sessions
    include("includes/classes/User.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    include("includes/classes/Playlist.php");

    if (isset($_GET['userLoggedIn'])){
        $userLoggedIn = new User($conn, $_GET['userLoggedIn']);
    }
    else {
        echo "Error: Username variable was not passed into the page. Check the openPage() function.";
        exit();
    }
}
else {
    include("includes/header.php");
    include("includes/footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
    exit();
}
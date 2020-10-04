<?php
include("includes/config.php"); //to use sessions

session_destroy(); //force the user to log out

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}
?>

<html>
<head>
    <title>Welcome to Slotify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">

    </div>

</div>
</body>
</html>
<?php
include("includes/config.php"); //to use sessions

// session_destroy(); //force the user to log out

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
<div id="mainContainer">

    <div id="topContainer">

        <?php include("includes/navBarContainer.php"); ?>

    </div>

    <div id="nowPlayingBarContainer">

        <?php include("includes/nowPlayingBar.php"); ?>

    </div>

</div>


</body>
</html>
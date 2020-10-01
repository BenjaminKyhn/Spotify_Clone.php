<?php
include("includes/config.php"); //to use sessions

session_destroy(); //force the user to log out

if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
    header("Location: register.php");
}
?>

<html>
<head>
    <title>Spotify Clone</title>
</head>
<body>
</body>
</html>
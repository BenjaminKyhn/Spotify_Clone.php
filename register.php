<?php
include("includes/classes/Account.php");

$account = new Account();

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
?>

<html>
<head>
    <title>Spotify Clone</title>
</head>
<body>
<div id="inputContainer">
    <form id="loginForm" action="register.php" method="POST">
        <h2>Login to your account</h2>
        <p>
            <label for="loginUsername">Username</label>
            <input id="loginUsername" name="loginUsername" type="text" placeholder="type here" required>
        </p>
        <p>
            <label for="loginPassword">Password</label>
            <input id="loginPassword" name="loginPassword" type="password" placeholder="your password" required>
        </p>
        <button type="submit" name="loginButton">Log in</button>
    </form>

    <form id="registerForm" action="register.php" method="POST">
        <h2>Create an account</h2>
        <p>
            <?php echo $account -> getError("Your username must be between 5 and 25 characters"); ?>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="type here" required>
        </p>
        <p>
            <?php echo $account -> getError("Your first name must be between 2 and 25 characters"); ?>
            <label for="firstName">First Name</label>
            <input id="firstName" name="firstName" type="text" placeholder="first name" required>
        </p>
        <p>
            <?php echo $account -> getError("Your last name must be between 2 and 25 characters"); ?>
            <label for="lastName">Last Name</label>
            <input id="lastName" name="lastName" type="text" placeholder="last name" required>
        </p>
        <p>
            <?php echo $account -> getError("Your emails don't match"); ?>
            <?php echo $account -> getError("Email is invalid"); ?>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="email@example.com" required>
        </p>
        <p>
            <label for="email2">Confirm Email</label>
            <input id="email2" name="email2" type="email" placeholder="email@example.com" required>
        </p>
        <p>
            <?php echo $account -> getError("Your passwords don't match"); ?>
            <?php echo $account -> getError("Your password can only contain numbers and letters"); ?>
            <?php echo $account -> getError("Your password must be between 5 and 30 characters"); ?>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="your password" required>
        </p>
        <p>
            <label for="password2">Confirm Password</label>
            <input id="password2" name="password2" type="password" placeholder="your password" required>
        </p>
        <button type="submit" name="registerButton">Sign up</button>
    </form>
</div>

</body>
</html>
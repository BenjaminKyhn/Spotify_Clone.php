<?php
include("includes/handlers/register-handler.php")
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
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="type here" required>
        </p>
        <p>
            <label for="firstName">First Name</label>
            <input id="firstName" name="firstName" type="text" placeholder="first name" required>
        </p>
        <p>
            <label for="lastName">Last Name</label>
            <input id="lastName" name="lastName" type="text" placeholder="last name" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="email@example.com" required>
        </p>
        <p>
            <label for="email2">Confirm Email</label>
            <input id="email2" name="email2" type="email" placeholder="email@example.com" required>
        </p>
        <p>
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
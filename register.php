<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($conn);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<html>
<head>
    <title>Spotify Clone</title>

    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>

<?php
if (isset($_POST['registerButton'])){
    echo '<script>
    $(document).ready(function(){

            $("#loginForm").hide();
            $("#registerForm").show();
    });
</script>';
}
else {
    echo '<script>
    $(document).ready(function(){

            $("#loginForm").show();
            $("#registerForm").hide();
    });
</script>';
}
?>


<div id="background">
    <div id="loginContainer">
        <div id="inputContainer">
            <form id="loginForm" action="register.php" method="POST">
                <h2>Login to your account</h2>
                <p>
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <label for="loginUsername">Username</label>
                    <input id="loginUsername" name="loginUsername" type="text" placeholder="username" required>
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input id="loginPassword" name="loginPassword" type="password" placeholder="your password" required>
                </p>
                <button type="submit" name="loginButton">Log in</button>
                <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Sign up here.</span>
                </div>
            </form>

            <form id="registerForm" action="register.php" method="POST">
                <h2>Create an account</h2>
                <p>
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="username"
                           value="<?php getInputValue('username'); ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="firstName">First Name</label>
                    <input id="firstName" name="firstName" type="text" placeholder="first name"
                           value="<?php getInputValue('firstName'); ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName">Last Name</label>
                    <input id="lastName" name="lastName" type="text" placeholder="last name"
                           value="<?php getInputValue('lastName'); ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="email@example.com"
                           value="<?php getInputValue('email'); ?>" required>
                </p>
                <p>
                    <label for="email2">Confirm Email</label>
                    <input id="email2" name="email2" type="email" placeholder="email@example.com"
                           value="<?php getInputValue('email2'); ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="your password"
                           value="<?php getInputValue('password'); ?>" required>
                </p>
                <p>
                    <label for="password2">Confirm Password</label>
                    <input id="password2" name="password2" type="password" placeholder="your password"
                           value="<?php getInputValue('password2'); ?>" required>
                </p>
                <button type="submit" name="registerButton">Sign up</button>
                <div class="hasAccountText">
                    <span id="hideRegister">Already have an account? Log in here.</span>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
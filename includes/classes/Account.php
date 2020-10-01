<?php

class Account
{
    private $conn;
    private $errorArray;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->errorArray = array();
    }

    public function register($username, $firstName, $lastName, $email, $email2, $password, $password2)
    {
        $this->validateUsername($username);
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validateEmail($email, $email2);
        $this->validatePassword($password, $password2);

        if (empty($this->errorArray)) {
            //TODO: Insert into DB
            return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
        } else {
            return false;
        }
    }

    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($username, $firstName, $lastName, $email, $password)
    {
        $encryptedPw = md5($password);
        $profilePic = "assets/images/profile-pics/head_emerald.png";
        $date = date("Y-m-d");

        // Returns true or false
        $result = mysqli_query($this->conn, "INSERT INTO users VALUES ('', '$username', '$firstName', '$lastName', '$email', '$encryptedPw', '$date', '$profilePic')");

        return $result;
    }

    private function validateUsername($username)
    {
        if (strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        //TODO: check if username exists already
    }

    private function validateFirstName($firstName)
    {
        if (strlen($firstName) > 25 || strlen($firstName) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateLastName($lastName)
    {
        if (strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }
    }

    private function validateEmail($email, $email2)
    {
        if ($email != $email2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        //TODO: check if email exists already
    }

    private function validatePassword($password, $password2)
    {
        if ($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if (strlen($password) > 30 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }
    }
}
<?php
class Account {
    private $errorArray;

    public function __construct() {
        $this -> errorArray = array();
    }

    public function register($username, $firstName, $lastName, $email, $email2, $password, $password2){
        $this -> validateUsername($username);
        $this -> validateFirstName($firstName);
        $this -> validateLastName($lastName);
        $this -> validateEmail($email, $email2);
        $this -> validatePassword($password, $password2);

        if (empty($this -> errorArray)){
            //TODO: Insert into DB
            return true;
        }
        else {
            return false;
        }
    }

    public function getError($error){
        if (!in_array($error, $this -> errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function validateUsername($username){
        if (strlen($username) > 25 || strlen($username) < 5){
            array_push($this -> errorArray, "Your username must be between 5 and 25 characters");
            return;
        }

        //TODO: check if username exists already
    }

    private function validateFirstName($firstName){
        if (strlen($firstName) > 25 || strlen($firstName) < 2){
            array_push($this -> errorArray, "Your first name must be between 2 and 25 characters");
            return;
        }
    }

    private function validateLastName($lastName){
        if (strlen($lastName) > 25 || strlen($lastName) < 2){
            array_push($this -> errorArray, "Your last name must be between 2 and 25 characters");
            return;
        }
    }

    private function validateEmail($email, $email2){
        if ($email != $email2){
            array_push($this -> errorArray, "Your emails don't match");
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this -> errorArray, "Email is invalid");
            return;
        }

        //TODO: check if email exists already
    }

    private function validatePassword($password, $password2){
        if ($password != $password2){
            array_push($this -> errorArray, "Your passwords don't match");
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($this -> errorArray, "Your password can only contain numbers and letters");
            return;
        }

        if (strlen($password) > 30 || strlen($password) < 5){
            array_push($this -> errorArray, "Your password must be between 5 and 30 characters");
            return;
        }
    }
}
<?php
ob_start();
session_start(); //Enables the use of sessions

$timezone = date_default_timezone_set("Europe/Copenhagen");

$conn = mysqli_connect("localhost", "root", "", "slotify");

if (mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}
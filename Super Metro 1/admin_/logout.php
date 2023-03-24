<?php
//Include const-connect
include('../partials/const-connect.php');
//1.Destroy the session
session_destroy(); //Unsets $_SESSION['user']

//2. Redirrect to login page
header('location: '.SITEURL.'admin_/login.php');

?>

<?php

//start session
session_start();

define('SITEURL', 'http://localhost:8080/proj%20try1/Super%20Metro%201/');
define('LOCALHOST', 'localhost:3307');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'super-metro');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //connect to DB 
$dbselect = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // select DB
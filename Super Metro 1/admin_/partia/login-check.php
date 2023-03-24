<?php 

//Authorization - Access control
//Check whether user is logged in or not, if not, they cannot access the login panel
if (!ISSET($_SESSION['user'])) {
    # User is not logged in
    $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel...</div>";
    header('location: '.SITEURL.'admin_/login.php');
}
?>
<?php include('../partials/const-connect.php'); ?>

<html>
    <head>
        <title>Login Bus Booking</title>
        <link rel="stylesheet" href="partia/style-admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php 
            //Session variables
            if (ISSET($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (ISSET($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            ?>

            <br>

            <!--Login form starts-->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter your username..."><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-blue"><br><br>
            </form>
            <!--Login form ends-->

            <p class="text-center">Created by - <a href="https://www.instagram.com/thee_zillah/">Thee_zillah</a></p>
        </div>
    </body>
</html>

<?php 
//Form processing

//Check whether submit button is clicked or not
if (ISSET($_POST['submit'])) {
    # 1. Get the data from login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //2. SQL to Check whether user with username and password exist
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password';";

    //3. Execute the query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether user exists or not
    $count = mysqli_num_rows($res);

    if ($count==1) {
        # User available and login successful
        $_SESSION['login'] = "<div class = 'success'>Login successful</div>";
        $_SESSION['user'] = $username; //To check whether user is logged in or not, and logout will unset this session
        //Redirrect to dashboad
        header('location: '.SITEURL.'admin_/admin-index.php');
    }
    else {
        $_SESSION['login'] = "<div class = 'error text-center'>Username or password did not match</div>";
        header(';ocation: '.SITEURL.'admin_/login.php');
    }
}




?>
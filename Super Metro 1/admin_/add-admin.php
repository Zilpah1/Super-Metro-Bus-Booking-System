<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
        //Session var
        ?>

        <form action="" method="POST">
            
            <table class="tbl-2">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name..."></td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="username" placeholder="Your username..."></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter password..."></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-green"></td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php //footer ?>

<?php 
//Process the form

if (ISSET($_POST['submit'])) {
    //echo "Clicked"; -Check whether button is clicked

    //1. Get the data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL query to save data in db
    $sql = "INSERT INTO tbl_admin SET
    full_name = '$full_name',
    username = '$username',
    password = '$password';";
    
    //3. Execute the query and save data in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //Check whether data is inserted in a DB or not, and display message
    if ($res == true) {
        # Data in inserted, create session vars to display message
        $_SESSION['add'] = "<div class = 'success'>Admin added successfully...</div>";
        header('location: '.SITEURL.'admin_/manage-admin.php');
    }
    else {
        $_SESSION['add'] = "<div class = 'error'>Failed to add Admin...</div>";
        header('location: '.SITEURL.'admin_/add-admin.php');
    }

}
include('partia/footer.php');
?>
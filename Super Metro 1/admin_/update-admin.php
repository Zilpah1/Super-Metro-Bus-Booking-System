<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
        //1.Get the ID of the selected admin
        $id = $_GET['id'];

        //2.Create sql query to get the details
        $sql = "SELECT * FROM tbl_admin WHERE id = $id;";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Check whether query is executed or not
        if ($res == true) {
            # Query executed, check whether data is available or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                # Get the details
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else {
                # redirrect to manage-admin page
                header('location: '.SITEURL.'admin_/manage-admin.php');
            }

        }else {
            # Query did not execute
            # redirrect to manage-admin page
            header('location: '.SITEURL.'admin_/manage-admin.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-2">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-green">

                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 
//Check hether submit button is clicked or not
if (ISSET($_POST['submit'])) {
    //echo "clicked";
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Create SQL query to update query
    $sql2 = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id = $id;";

    //Execute the query
    $res2 = mysqli_query($conn, $sql2);

    //Check whether the query executed successfully or not
    if ($res2 == true) {
        # Query executed successfully, and admin is updated
        $_SESSION['update'] = "<div class='success'>Admin updated successfully...</div>";
        header('location: '.SITEURL.'admin_/manage-admin.php');
    }
    else {
        # Query failed to execute
        $_SESSION['update'] = "<div class = 'error'>Failed to update Admin...</div>";
        header('location: '.SITEURL.'admin_/manage-admin.php');
    }
}

include('partia/footer.php');
?>
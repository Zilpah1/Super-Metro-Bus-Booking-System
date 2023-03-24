<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<!-- Main content -->

<div class="main-content">
    <div class="wrapper">
        <h1>Admin</h1>
        <br><br>

        <?php 
        //Session variables
        if (ISSET($_SESSION['add'])) { //check whether session is set or not
            echo $_SESSION['add']; //dislpay session message if set
            unset ($_SESSION['add']); //remove session message
        }

        if (ISSET($_SESSION['changed-pwd'])) {
            echo $_SESSION['changed-pwd'];
            unset($_SESSION['changed-pwd']);
        }

        if (ISSET($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (ISSET($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (ISSET($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset ($_SESSION['update']);
        }

        if (ISSET($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        
        
        <br><br>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-blue">Add Admin</a>

        <br><br><br>
        <table class="tbl-1">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>

            <?php 
            //Query to get all admins from the database
            $sql = "SELECT * FROM tbl_admin;";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //Check whether query is executed or not
            if ($res==true) {
                # Query executed, count the number of rows
                $count = mysqli_num_rows($res);

                $sn = 1;

                //Check the number of rows
                if ($count > 0) {
                    # There is data in Database
                    while ($row = mysqli_fetch_assoc($res)) {
                        # Using while loop to get all the data from the db
                        //Get individual data
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin_/change-password.php?id=<?php echo $id; ?>" class="btn-blue">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin_/update-admin.php?id=<?php echo $id; ?>" class="btn-green">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin_/delete-admin.php?id=<?php echo $id; ?>" class="btn-red">Delete Admin</a>
                            </td>
                        </tr>
                        
                        <?php
                    }
                }
                else {
                    # No data in database
    
                }
            }
            
            ?>

        </table>
    </div>
</div>

<!--Main-content ends -->

<?php include('partia/footer.php'); ?>
<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<div class="main-content">
    <div class="wrapper">
        <br><br>

        <?php 
        //Setting and unsetting sessions
        if (ISSET($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (ISSET($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (ISSET($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (ISSET($_SESSION['no-vehicle'])) {
            echo $_SESSION['no-vehicle'];
            unset($_SESSION['no-vehicle']);
        }
        if (ISSET($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (ISSET($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (ISSET($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>
        <!--button to add vehicle-->
        <a href="<?php echo SITEURL; ?>admin_/add-vehicle.php" class="btn-blue">Add Vehicle</a>

        <br><br>
        <table class="tbl-1">
            <tr>
                <th>S.N</th>
                <th>Leaving from</th>
                <th>Going to</th>
                <th>Date</th>
                <th>Time</th>
                <th>Fare</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
            //A query to get all data from the database
            $sql = "SELECT * FROM tbl_vehicles;";

            //Execute query
            $res= mysqli_query($conn, $sql);

            //Create a serial number value and assign it to 1
            $sn = 1;

            //Count rows in a db
            $count = mysqli_num_rows($res);

            //Check whether there is data in the db or not
            if ($count > 0) {
                # We have data in the db, get the data and dislplay it
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $departure = $row['departure'];
                    $arrival = $row['arrival'];
                    $date = $row['date'];
                    $time = $row['time'];
                    $fare = $row['fare'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $departure; ?></td>
                        <td><?php echo $arrival; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $time; ?></td>
                        <td><?php echo $fare; ?></td>

                        <td>
                            <?php 
                            //check whether image is available or not
                            if ($image_name!= "") 
                            {
                                # display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>Pics/vehicle/<?php echo $image_name; ?>" width="100px" height="100px">
                                <?php
                            }
                            else {
                                // Display message
                                echo "<div class = 'error'>Image not added!!!</div>";

                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin_/update-vehicle.php?id=<?php echo $id; ?>" class="btn-green">Update Vehicle</a>
                            <a href="<?php echo SITEURL; ?>admin_/delete-vehicle.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete Vehicle</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                //there is no data, we display message inside table
                ?>
                <tr>
                    <td colspan="10"><div class="error">No vehicle added!!!</div></td>
                </tr>
                <?php
            }
            ?>

        </table>

    </div>

</div>
<?php include('partia/footer.php'); ?>



<?php

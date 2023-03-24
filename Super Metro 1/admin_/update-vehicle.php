<?php
include('partia/menu.php');
include('../const/const-connect.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Vehicle</h1>
        <br><br>

        <?php 
       // echo "The time is: " .date("d-m-Y h:i:s")."<br>";
       // echo date_default_timezone_get()."<br>";
        date_default_timezone_set("Africa/Nairobi");
        //echo date_default_timezone_get()."<br>";
        echo "The time is: " .date("d-m-Y h:i:s")."<br>";
    
        //Check whether ID is set or not
        if (ISSET($_GET['id'])) {
            $id = $_GET['id'];

            //Create SQL to get all other details
            $sql = "SELECT * FROM tbl_vehicles WHERE id = $id;";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count the rows to check whether ID is valid or not
            $count = mysqli_num_rows($res);
            if ($count==1) {
                # Get all data
                $row = mysqli_fetch_assoc($res);
                $departure = $row['departure'];
                $arrival = $row['arrival'];
                $date = $row['date'];
                $time = $row['time'];
                $fare = $row['fare'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }
            else {
                //Redirrect to manage-vehicle page with message
                $_SESSION['no-vehicle'] = "<div class = 'error'>Vehicle not found</div>";
                header('location: '.SITEURL.'admin_/manage-vehicle.php');
            }
        }
        else {
            header('location: '.SITEURL.'admin_/manage-vehicle.php');       
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-2">
                <tr>
                    <td>Leaving from: </td>
                    <td><input type="text" name="departure" value="<?php echo $departure; ?>"></td>
                </tr>

                <tr>
                    <td>Going to: </td>
                    <td><input type="text" name="arrival" value="<?php echo $arrival; ?>"></td>
                </tr>

                <tr>
                    <td>Date: </td>
                    <td><input type="date" name="date" value="<?php echo $date; ?>"></td>
                </tr>

                <tr>
                    <td>Time: </td>
                    <td><input type="time" name="time" value="<?php echo $time; ?>"></td>
                </tr>

                <tr>
                    <td>Fare: </td>
                    <td><input type="number" name="fare" value="<?php echo $fare; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                        if ($current_image != "") {
                            //Display image
                            ?>
                            <img src="<?php echo SITEURL; ?>Pics/vehicle/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                        else {
                            //Display message
                            echo "<div class = 'error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td><input <?php if ($featured == "Yes") {echo "checked"; }?> type="radio" name="featured" value="Yes">Yes</td>
                    <td><input <?php if ($featured == "No") {echo "checked"; }?> type="radio" name="featured" value="No">No</td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td><input <?php if ($featured == "Yes") {echo "checked"; }?> type="radio" name="active" value="Yes">Yes</td>
                    <td><input <?php if ($featured == "No") {echo "checked"; }?> type="radio" name="active" value="No">No</td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Vehicle" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>
        <?php 
        if (ISSET($_POST['submit'])) {
            //1. Get all values from the form
            $id = $_POST['id'];
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $fare = $_POST['fare'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active =  $_POST['active'];

            //2. Update new image if selected
            //Check whether image is selected or not
            if (ISSET($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    # Image available
                    //A. Upload new image
                    //Auto rename image
                    //Get the extension of the image
                    $ext = end(explode('.', $image_name));

                    //Rename the image
                    $image_name = "Vehicle_".rand(000, 999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../Pics/vehicle/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //Check whether image is uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class = 'error'>Failed to upload image</div>";
                        header('location: '.SITEURL.'admin_/manage-vehicle.php');
                        die();
                    }

                    //B. Remove current image if available
                    if ($current_image != "") {
                        $remove_path = "../Pics/vehicle/".$current_image;
                        $remove = unlink($remove_path);
                        //Check whether image is removed or not
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class = 'error'>Failed to remove image</div>";
                            header('location: '.SITEURL.'admin_/manage-vehicle.php');
                            die(); //Stop the process
                        }
                    }

                }
                else {
                    $image_name = $current_image;
                }
                
            }
            else {
                $image_name = $current_image;
            }

            //3. Update the database
            $sql2 = "UPDATE tbl_vehicles SET
            departure = '$departure',
            arrival = '$arrival',
            date = '$date',
            time = '$time',
            fare = '$fare',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id='$id';";
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);
            //4. Redirrect to manage category with message
            //Check whether query executed or not
            if ($res2==true) {
                $_SESSION['update'] = "<div class = 'success'>Vehicle updated successfully...</div>";
                header('location: '.SITEURL.'admin_/manage-vehicle.php');
            }
            else {
                $_SESSION['update'] = "<div class = 'error'>Failed to update Vehicle.</div>";
                header('location: '.SITEURL.'admin_/manage-vehicle.php');
            }

        }
        ?>
    </div>
</div>
<?php include('partia/footer.php'); ?>
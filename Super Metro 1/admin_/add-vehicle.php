<?php include('partia/menu.php'); 
include('../partials/const-connect.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Vehicles</h1>
        <br><br>

        <?php 
        if (ISSET($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (ISSET($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!--Add vehicle form starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-2">
                <tr>
                    <td>Leaving from: </td>
                    <td>
                        <input type="text" name="departure" placeholder="vehicle departure...">
                    </td>
                </tr>

                <tr>
                    <td>Going to: </td>
                    <td>
                        <input type="text" name="arrival" placeholder="vehicle arrival...">
                    </td>
                </tr>

                <tr>
                    <td>Travel date: </td>
                    <td>
                        <input type="date" name="date" placeholder="Date of travel...">
                    </td>
                </tr>

                <tr>
                    <td>Time: </td>
                    <td>
                        <input type="time" name="time" placeholder="Time...">
                    </td>
                </tr>

                <tr>
                    <td>Fare: </td>
                    <td>
                        <input type="number" name="fare" placeholder="Fare...">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Vehicle" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        //Process the form
        //Check whether submit button is clicked or not
        if (ISSET($_POST['submit'])) 
        {
            //echo "clicked";

            //1. Get the values from the form
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $fare = $_POST['fare'];

            //For radio input, we check whether button is selected or not
            if (ISSET($_POST['featured'])) 
            {
                # get value from form
                $featured = $_POST['featured'];
            }
            else {
                # set default value
                $featured = "No";
            }
            if (ISSET($_POST['active'])) 
            {
                $active = $_POST['active'];
            }
            else {
                $active = "No";
            }

            //Check whether the image is selected or not and set the value for image name accordingly
           if (ISSET($_FILES['image']['name'])) {
            # Upload the image
            $image_name = $_FILES['image']['name'];

            //Upload image if only it is selected
            if ($image_name !="") {
                # Auto rename image
                //A. get the extension of image
                $ext = end(explode('.', $image_name));
                //B. Rename the image
                $image_name= "Vehicle_".rand(000, 999).'.'.$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../Pics/vehicle/".$image_name;

                //C. Finally upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                //Check whether image is uploaded or not
                //if image is not uploaded, we stop and redirrect with an error message
                if ($upload == false) 
                {
                    $_SESSION['upload'] = "<div class = 'error'>Failed to upload image!!!</div>";
                    header('location: '.SITEURL.'admin_/add-vehicle.php');
                    die();
                }

            }
           }
           else {
            // Image is not uploaded and image name is blank
            $image_name = "";
           }

           //2. Create SQL query to insert vehicle data into database
           $sql = "INSERT INTO tbl_vehicles set
           departure = '$departure',
           arrival = '$arrival',
           date = '$date',
           time = '$time',
           fare = '$fare',
           image_name = '$image_name',
           featured = '$featured',
           active = '$active';
           ";

           //3. Execute the query and save the data in a database
           $res = mysqli_query($conn, $sql);

           //4. Check whether query has executed or not, and whether data is added or not
           if ($res == true) {
            # code...
            $_SESSION['add'] = "<div class = 'success'>Vehicle data added successfully...</div>";
            header('location: '.SITEURL.'admin_/manage-vehicle.php');
           }
           else {
            $_SESSION['add'] = "<div class = 'error'>Failed to add Vehicle data!!!</div>";
            header('location: '.SITEURL.'admin_/manage-vehicle.php');
           }


        }

        ?>
        <!--Add Vehicle form ends here-->

        
    </div>
</div>
<?php include('partia/footer.php'); ?>
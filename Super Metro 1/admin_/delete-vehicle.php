<?php
//Include the header and connecting page
include('partia/menu.php');
include('../partials/const-connect.php');

//check whether ID and image_name value is set or not
if (ISSET($_GET['id']) AND ISSET($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the image file if available
    if ($image_name !="") {
        # Image is available, so remove it
        $path = "../Pics/vehicle/".$image_name;
        $remove = unlink($path);

        //If failed to remove image, then output error message and stop the process
        if ($remove==false) {
            //Set the session message
            $_SESSION['remove'] = "<div class = 'error'>Failed o remove image</div>";
            //Redirrect to manage vehicle page with message
            header('location: '.SITEURL.'admin_/manage-vehicle.php');
            //Stop the process
            die();
        }
    }

    //Delete data from database
    $sql = "DELETE FROM tbl_vehicles WHERE id = $id;";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    //Chech whether data is deleted from database or not
    if ($res == true) {
        $_SESSION['delete'] = "<div class = 'success'>Vehicle deleted successfully</div>";
        header('location:'.SITEURL.'admin_/manage-vehicle.php');
    }
    else {
        $_SESSION['delete'] = "<div class = 'error'>Failed to delete...</div>";
        header('location:'.SITEURL.'admin_/manage-vehicle.php');
    }
}
else {
    //Redirrect to manage vehicle page
    header('location: '.SITEURL.'admin_/manage-vehicle.php');
}
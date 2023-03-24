<?php
include('../partials/const-connect.php');

//1. Get the id of the admin to be deleted
$id = $_GET['id'];

//2. Create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id = $id;";

//Execute the query
$res = mysqli_query($conn, $sql);

//Check whether query executed or not
if ($res == true) {
    # Query executed successfully and admin deleted
    //echo "admin del";
    $_SESSION['delete'] = "<div class = 'success'>Admin deleted successfullly...</div>";
    header('location: '.SITEURL.'admin_/manage-admin.php');

}else {
    # Failed to delete admin
    $_SESSION['delete'] = "<div class = 'error'>Failed to delete Admin...</div>";
    header('location: '.SITEURL.'admin_/manage-admin.php');

}
<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Booking Information</h1>
        <br><br>

        <?php 
        //Check whether id is set or not
        if (ISSET($_GET['id'])) {
            # Get the details
            $id = $_GET['id'];

            //Get all the details based on the id
            $sql = "SELECT * FROM tbl_book WHERE id=$id;";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //Count rows
            $count = mysqli_num_rows($res);
            
            if ($count==1) {
                # Details are available
                $row = mysqli_fetch_assoc($res);

                $departure = $row['departure'];
                $arrival = $row['arrival'];
                $fare = $row['fare'];
                $date = $row['date'];
                $time = $row['time'];
                $qty = $row['qty'];
                $total = $row['total'];
                $bookdate = $row['bookdate'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            }
            else {
                // Details are not available
                //Reddirect to mamage bookig page
                header('location: '.SITEURL.'admin_/manage-booking.php');
            }
        }
        else {
            // Details are not available
            header('location: '.SITEURL.'admin_/manage-booking.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-2">
                <tr>
                    <td>Departure</td>
                    <td><b><?php echo $departure; ?></b></td>
                </tr>

                <tr>
                    <td>Arrival</td>
                    <td><b><?php echo $arrival; ?></b></td>
                </tr>

                <tr>
                    <td>Fare: </td>
                    <td><b>Ksh. <?php echo $fare; ?></b></td>
                </tr>

                <tr>
                    <td>Date: </td>
                    <td><b><?php echo $date; ?></b></td>
                </tr>

                <tr>
                    <td>Time</td>
                    <td><b><?php echo $time; ?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status=="Booked") {echo "selected"; } ?> value="Booked">Booked</option>
                            <option <?php if ($status=="Cancelled") {echo "selected"; } ?> value="Cancelled">Cancelled</option>
                        </select>
                        
                    </td>
                </tr>

                <tr>
                    <td>Customer name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer email</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>customer address</td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="fare" value="<?php echo $fare; ?>">
                        <input type="submit" name="submit" value="Update Booking" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        //Check whether button is clicked or not
        if (ISSET($_POST['submit'])) {
            //echo "clicked";
            $id = $_POST['id'];
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $fare = $_POST['fare'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $qty = $_POST['qty'];

            $total = $fare * $qty;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            //Update the values in the DB
            $sql2 = "UPDATE tbl_book SET 
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id=$id;
            ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Check whether updated or not
            //Redirrect to manage booking page
            if ($res2==true) {
                $_SESSION['update'] = "<div class = 'success'>Book details updated successfully.</div>";
                header('location: '.SITEURL.'admin_/manage-booking.php');
            }
            else {
                $_SESSION['update'] = "<div class = 'error'>Failed to update Booking.</div>";
                header('location: '.SITEURL.'admin_/manage-booking.php');
            }
        }
        ?>
    </div>
</div>

<?php //Include footer page...?>
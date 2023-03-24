<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Bookings</h1>
        <br><br><br>

        <?php 
        //Set and unset sessions
        if (ISSET($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class="tbl-1">
            <tr>
                <th>S.N</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Fare</th>
                <th>Date</th>
                <th>Time</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Book Date</th>
                <th>Status</th>
                <th>Customer name</th>
                <th>Customer contact</th>
                <th>Customer email</th>
                <th>Customer address</th>
                <th>Actions</th>
            </tr>

            <?php 
            //Get all the booking information from the database
            $sql = "SELECT * FROM tbl_book ORDER BY id DESC;";
            //Execute query
            $res = mysqli_query($conn, $sql);
            //Count rows
            $count = mysqli_num_rows($res);

            $sn=1;

            if ($count>0) {
                # Booking details available
                while ($row=mysqli_fetch_assoc($res)) {
                    # Get all the bookingking details
                    $id = $row['id'];
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

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $departure; ?></td>
                        <td><?php echo $arrival; ?></td>
                        <td><?php echo $fare; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $time; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $bookdate; ?></td>
                        <td>
                            <?php 
                            //Booked, cancelled
                            if ($status=="Booked") {
                                echo "<label style ='color:blue;'>$status</label>";
                            } 
                            elseif ($status="Cancelled") {
                                echo "<label style = 'color:red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin_/update-booking.php?id=<?php echo $id; ?>" class="btn-green">Update Booking</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                # Details not available
                echo "<tr><td colspan='15' class='error'>Bookings Not available</td></tr>";
            }
            ?>

        </table>
    </div>
</div>

<?php include('partia/footer.php'); ?>
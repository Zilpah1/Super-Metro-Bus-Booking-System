<?php 
include('partials/header.php');
//include('partials/const-connect.php');
?>

<?php 
//Check whether book id is set or not
if (ISSET($_GET['book_id'])) {
    //Get the book id and details of it
    $book_id = $_GET['book_id'];

    //Get the details
    $sql = "SELECT * FROM tbl_vehicles WHERE id = $book_id;";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    //Count rows
    $count = mysqli_num_rows($res);
    //Check whether data is available or not
    if ($count ==1) {
        $row = mysqli_fetch_assoc($res);

        $departure = $row['departure'];
        $arrival = $row['arrival'];
        $date = $row['date'];
        $time = $row['time'];
        $fare = $row['fare'];
        $image_name = $row['image_name'];

    }
    else {
        header('location: '.SITEURL);
    }

}
else {
    header('location: '.SITEURL);
}
?>

<!-- Bus search section starts here-->
<section class="bus-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your booking!!!</h2>

        <form action="" method="POST" class="book">
            <fieldset>
                <legend>Selected Bus</legend>

                <div class="bus-img">
                    <?php 
                    //Chech whether is available or not
                    if ($image_name =="") {
                        # image not available
                        echo "<div class = 'error'>Image not available</div>";
                    }
                    else {
                        # Image available
                        ?>
                        <img src="<?php echo SITEURL; ?>Pics/vehicle/<?php echo $image_name; ?>" alt="vehicle-img" class="img-responsive img-curve">
                        <?php
                    }
                    
                    ?>
                </div>

                <div class="vehicle-desc">
                    <h3>From: <?php echo $departure; ?></h3>
                    <input type="hidden" name="departure" value="<?php echo $departure; ?>">

                    <h3>To: <?php echo $arrival; ?></h3>
                    <input type="hidden" name="arrival" value="<?php echo $arrival; ?>">

                    <p class="vehicle-price">Ksh. <?php echo $fare; ?></p>
                    <input type="hidden" name="fare" value="<?php echo $fare; ?>">

                    <p class="vehicle-detail">Date: <?php echo $date; ?></p>
                    <input type="hidden" name="date" value="<?php echo $date; ?>">

                    <p class="vehicle-detail">Time: <?php echo $time; ?></p>
                    <input type="hidden" name="time" value="<?php echo $time; ?>">

                    <div class="book-label">Quantity: </div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Customer's Details</legend>
                <div class="book-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g Zillah Andria" class="input-responsive" required>

                <div class="book-label">Email Address</div>
                <input type="email" name="email" placeholder="E.g 123@gmail.com" class="input-responsive" required>

                <div class="book-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g 07xxxxxxxx" class="input-responsive" required>

                <div class="book-label">Residence</div>
                <textarea name="address" rows="10" placeholder="E.g Street, City, County" class="input-responsive" required></textarea>
                             
                <input type="submit" name="submit" value="Confirm Booking" class="btn btn-blue">
               
            </fieldset>
        </form>

        <?php 
        //Check whether submit button is clicked
        if (ISSET($_POST['submit'])) {
            #Get all details from the form
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $fare = $_POST['fare'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $qty = $_POST['qty'];

            $total = $fare * $qty;

            $bookdate = date("Y-m-d h:i:sa");

            $status = "Booked";

            $customer_name = $_POST['full-name'];
            $customer_email = $_POST['email'];
            $customer_contact = $_POST['contact'];
            $customer_address = $_POST['address'];

            //Save the booking details in a database
            //SQL to save the data
            $sql2 = "INSERT INTO tbl_book SET 
            departure = '$departure',
            arrival = '$arrival',
            fare = '$fare',
            date = '$date',
            time = '$time',
            qty = '$qty',
            total = '$total',
            bookdate = '$bookdate',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address';";

            //echo $sql2; die();

            //Execute query
           $res2 = mysqli_query($conn, $sql2);
            
            //Check whether query executed
            if ($res2==true) {
                // Query executed and book details saved             
                $_SESSION['book'] = "<div class = 'success text-center'>Seat booked successfully, Click 'view info' above to view booking information and pay..</div>";
                header('location: '.SITEURL.'pay.php');
                
            }
            else {
                $_SESSION['book'] = "<div class = 'error text-center'>Failed to book seat, please try again.</div>";
                header("location: ".SITEURL);
            }

        }
        ?>

    </div>

</section>
<!-- Bus search section ends here-->

<?php // include('partials/footer.php'); ?>
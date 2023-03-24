<?php

include('partials/header.php');

//Session variable
if (ISSET($_SESSION['book'])) {
            
    echo $_SESSION['book'];
    unset($_SESSION['book']);
}

// Use the customer ID to query the database for the customer details
$sql = "SELECT * FROM tbl_book ORDER BY id DESC LIMIT 1";
$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);
?>
<form>
<section class="bus-search">
    <div class="container">
        <div class="pay">
    <h2 class="text-center text-white">Ticket</h2>
    
        <legend class="text-white">Bus information</legend>
<?php
if ($count>=0) {
    $row=mysqli_fetch_assoc($res);
    echo "Departure: " . $row["departure"] . "<br>";
    echo "Arrival: " . $row["arrival"] . "<br>";
    echo "Fare: " . $row["fare"] . "<br>";
    echo "Date: " . $row["date"] . "<br>";
    echo "Time: " . $row["time"] . "<br>";
    echo "Tickets: " . $row["qty"] . "<br>";
    echo "Total Fare: " . $row["total"] . "<br>";
    ?>
    
        <legend class="text-white">Customer Info</legend>
    <?php
    echo "Date of Booking: " . $row["bookdate"] . "<br>";
    echo "Name: " . $row["customer_name"] . "<br>";
    echo "Contact: " . $row["customer_contact"] . "<br>";
    echo "Email: " . $row["customer_email"] . "<br>";
    echo "Address: " . $row["customer_address"] . "<br>";
}
else {
    echo "NO RESULTS";
}
mysqli_close($conn);

?>
    
        </div>

        <div class="pay">
            <p class="text-white">
                Send fare to the paybill number 10001, account number "TICKET", the M-pesa message will be used as your ticket when you board the bus.
            </p>   
        </div>

    </div>
        
</section>
</form>

<?php  include('partials/footer.php'); ?>

<?php 
include('partia/menu.php');
include('../partials/const-connect.php');

?>

<!-- Main content -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php 
        //Set and unset login session
        if (ISSET($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

        <div class="col-4 text-center">
            <?php 
            //SQL query
            $sql = "SELECT * FROM tbl_admin;";
            //Execute query
            $res = mysqli_query($conn, $sql);
            //Count rows
            $count = mysqli_num_rows($res);            
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Admin Available
        </div>
       
        <div class="col-4 text-center">
            <?php 
            //SQL query
            $sql1 = "SELECT * FROM tbl_vehicles;";
            //Execute query
            $res1 = mysqli_query($conn, $sql1);
            //Count rows
            $count1 = mysqli_num_rows($res1);            
            ?>
            <h1><?php echo $count1; ?></h1>
            <br>
            Vehicles available
        </div>

        <div class="col-4 text-center">
            <?php 
            //SQL query
            $sql2 = "SELECT * FROM tbl_book;";
            //Execute query
            $res2 = mysqli_query($conn, $sql2);
            //Count rows
            $count2 = mysqli_num_rows($res2);            
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Booking Entries
        </div>
              
        <div class="col-4 text-center">
            <?php 
            //SQL query
            $sql3 = "SELECT SUM(qty) AS Qty FROM tbl_book;";
            //Execute query
            $res3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($res3);
            $tot_qty = $row3['Qty'];            
            ?>
            <h1><?php echo $tot_qty; ?></h1>
            <br>
            Seats Booked
        </div>

        <div class="col-4 text-center">
            <?php 
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_book WHERE status = 'Booked';";
            //Execute the query
            $res4 = mysqli_query($conn, $sql4);
            //Get the value
            $row4 = mysqli_fetch_assoc($res4);
            //Get the total revenue
            $total_revenue = $row4['Total'];            
            ?>
            <h1>Ksh. <?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>

        <div class="clear-fix"></div>
    </div>
    
</div>

<!--End of main content -->

<?php include('partia/footer.php'); ?>
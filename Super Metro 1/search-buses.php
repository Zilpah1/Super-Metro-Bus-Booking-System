<?php
include('partials/header.php');
//include('const/const-connect.php');
?>
<!-- Bus search section starts-->
<section class="search-bus text-center">
    <div class="container">
        <?php
        $leave = mysqli_real_escape_string($conn, $_POST['leave']);
        $arrive= mysqli_real_escape_string($conn, $_POST['arrive']);
        $dep_date = $_POST['dep_date'];
        
        ?>

        <h2 class="text-white"><span style="background-color: black;">Buses on your search: <a href="#" class="text-white"><?php echo $leave;echo "--";echo $arrive;echo "--";echo $dep_date; ?></a></span></h2>

    </div>

</section>
<!--Bus search section ends-->

<!--Available bus section starts here-->
<section class="available-bus">
    <div class="container">
        <h2 class="text-center">Available bus based on your search...</h2>
        
        <?php 
        //SQL query to get vehicles based on search keyword
        $sql = "SELECT * FROM tbl_vehicles WHERE departure LIKE '%$leave%' AND arrival LIKE '%$arrive%' AND date LIKE '%$dep_date%';";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //Count rows
        $count = mysqli_num_rows($res);
        //Check whether vehicles are available or not
        if ($count>0) {
            //echo "count is greater than 0";
            while ($row=mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $departure = $row['departure'];
                $arrival = $row['arrival'];
                $fare = $row['fare'];
                $date = $row['date'];
                $time = $row['time'];
                $image_name = $row['image_name'];
                ?>
                <div class="available-bus-box">
                    <div class="bus-img">
                        <?php 
                        //check whether image is available or not
                        if ($image_name!= "") 
                            {
                                # display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>Pics/vehicle/<?php echo $image_name; ?>" width="100px" height="100px" alt="Thika super metro bus" class="img-responsive img-curve">
                                <?php
                            }
                            else {
                                // Display message
                                echo "<div class = 'error'>Image not found!!!</div>";

                            }
                        ?>

                    </div>

                    <div class="vehicle-desc">
                        <h4>From: <?php echo $departure; ?><br>To: <?php echo $arrival; ?></h4>
                        <p class="vehicle-price">Ksh.<?php echo $fare;//echo $price; ?></p>
                        <p class="vehicle-detail">Date: <?php echo $date;//echo $description; ?></p>
                        <p class="vehicle-detail">Time: <?php echo $time;//echo $description; ?></p><br>
                        <a href="<?php echo SITEURL; ?>book.php?book_id=<?php echo $id;//Linking the "book" button wuth booking page, so that data can be acquired using "$_GET" method ?>"class="btn btn-blue">Book now</a>

                    </div>

                </div>
                <?php
            }
        }
        else {
            // Vehicle not found
            echo "<div class = 'error'>Vehicle not found...</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Available bus section ends-->
<?php include('partials/header.php');


 ?>
        <!--search bus section-->
        <section class="search-bus text-center">
        <div class="container">
        
            <form action="<?php echo SITEURL; ?>search-buses.php" method="POST">
                <input type="search" name="leave" placeholder="Leaving from..." required><br><br>
                <input type="search" name="arrive" placeholder="Going to..." required><br><br>
                <input type="date" name="dep_date" min="<?php echo date('Y-m-d'); ?>" required><br><br>
                <input type="submit" name="submit" value="Search buses" class="btn btn-blue"><br><br>
            </form>

            <script>
                const today = new Date().toISOString().split("T")[0];
                document.getElementsByName("date")[0].setAttribute('min', today);
            </script>

        </div>
        </section>
        <!-- Bus search section ends here-->

        <?php 
        if (ISSET($_SESSION['book'])) {
            
            echo $_SESSION['book'];
            unset($_SESSION['book']);
        }
        ?>

        <!-- Bus Display section starts here -->
        <section class="available-bus">
            <div class="container">
                <h2 class="text-center">Available buses</h2>
                
                <?php 
                //Getting all bus data that are active and featured
                $sql = "SELECT * FROM tbl_vehicles WHERE active ='Yes' AND featured = 'Yes' LIMIT 6;";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether vehicles are available or not
                if ($count>0) {
                    # vehicles available
                    while ($row = mysqli_fetch_assoc($res)) {
                        # get all the values
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
                                //Check whether image is available or not
                                if ($image_name=="") {
                                    # image not available
                                    echo "<div class = 'error'>Image not available...</div>";
                                }
                                else {
                                    # Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>Pics/vehicle/<?php echo $image_name; ?>" alt="Vehicle" class="img-responsive img-curve">
                                    <?php

                                }
                                ?>
                            </div>

                            <div class="vehicle-desc">
                            <h4>From: <?php echo $departure; ?><br>To: <?php echo $arrival; ?></h4>
                            <p class="vehicle-price">Ksh.<?php echo $fare; ?></p>
                            <p class="vehicle-detail">Date: <?php echo $date; ?></p>
                            <p class="vehicle-detail">Time: <?php echo $time; ?></p><br>

                            <a href="<?php echo SITEURL; ?>book.php?book_id=<?php echo $id; ?>"class="btn btn-blue">Book now</a>


                            </div>
                        </div>
                        <?php
                    }
                }
                else {
                    # Vehicles missing
                    echo "<div class = 'error'>Bus not available...</div>";
                }
                ?>

                <div class="clearfix"></div>
                
            </div>
        </section>

        <!-- Bus display section ends here -->
        
    </body>
</html>

<?php  include('partials/footer.php'); ?>
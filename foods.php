<?php include('partials_front/menu.php'); ?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            // SQL query to get all active food items
            $sql = "SELECT * FROM food_tbl WHERE active='Yes'";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            // Count the rows to check whether food is available or not
            $count = mysqli_num_rows($res);

            if($count > 0){
                // Food available
                while($row = mysqli_fetch_assoc($res)){
                    // Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div style="height: 150px;" class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name == ""){
                                    // Image not available
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                    // Image available
                                    ?>
                                    <img style="height: 130px;" src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary2">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Food not available
                echo "<div class='error'>Food not available.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials_front/footer.php'); ?>

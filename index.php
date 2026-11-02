<?php include('partials_front/menu.php'); ?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- CATEGORIES Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2  class="text-center">Explore Foods</h2>

        <?php 
            // Create SQL query to display categories from the database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6;";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether the categories are available or not
            $count = mysqli_num_rows($res);

            if($count > 0){
                // Categories available
                while($row = mysqli_fetch_assoc($res)){
                    // Get the values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name == ""){
                                    // Display message if image is not available
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                    // Image available
                                    ?>
                                    <img style="height: 400px;" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                // Categories not available
                echo "<div class='error'>Category not added.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- CATEGORIES Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            // Create SQL query to get food from the database
            $sql2 = "SELECT * FROM food_tbl where active='Yes' and featured='Yes' LIMIT 6;";
            // Execute the query
            $res2 = mysqli_query($conn, $sql2);
            // Count rows to check whether the food is available or not
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0){
                // Food available
                while($row2 = mysqli_fetch_assoc($res2)){
                    // Get all the values
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name == ""){
                                    // Display message if image not available
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                    // Image available
                                    ?>
                                    <img style="height: 150px;" src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
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

    <p class="text-center">
    <a style="color: red;" href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials_front/footer.php'); ?>

<?php include('partials_front/menu.php'); ?>

<!-- CATEGORIES Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2  class="text-center">Explore Categories</h2>

        <?php
            // Display all the categories that are active
            // SQL query
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
            
            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count Rows
            $count = mysqli_num_rows($res);

            // Check whether categories are available or not
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
                                    <img style="height:400px;" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
                echo "<div class='error'>Category not found.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials_front/footer.php'); ?>
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br/><br/>
        <!-- Button to add food -->
        <a href="<?php echo SITEURL; ?>admin/add_food.php" class="btn_primary">Add Food</a>
        <br/><br/>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove-failed'])){
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
            if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['no-food-found'])){
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }
        ?>
        <div class="table-responsive">
            <table class="tbl_full">
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr> 
                <?php
                    // Create SQL query to get all the food
                    $sql = "SELECT * FROM food_tbl;";
                    $res = mysqli_query($conn, $sql);
                    
                    // Count rows to check whether we have food or not
                    $count = mysqli_num_rows($res);
                    
                    // Create a number variable and set the default value as 1
                    $sn = 1;
                    
                    if($count > 0){
                        // We have food in database
                        // Get the food from database and display
                        while($row = mysqli_fetch_assoc($res)){
                            // Get values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        // Check whether we have image or not
                                        if($image_name == ""){
                                            // We do not have image, display error message
                                            echo "<div class='error'>Image not Added.</div>";
                                        } else {
                                            // We have Image, display image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn_secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Food</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Food not added in database
                        echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

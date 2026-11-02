<?php 
    include('partials/menu.php'); 

    // Check whether the id is set or not
    if(isset($_GET['id'])){
        // Get the ID of the selected food
        $id = $_GET['id'];
        
        // Create SQL Query to get the details
        $sql = "SELECT * FROM food_tbl WHERE id=$id";
        
        // Execute the Query
        $res = mysqli_query($conn, $sql);
        
        // Check whether the query is executed or not
        if($res == true){
            // Check whether the data is available or not
            $count = mysqli_num_rows($res);
            
            // Check whether we have food data or not
            if($count == 1){
                // Get the details
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $category_id = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirect to Manage Food
                $_SESSION['no-food-found'] = "<div class='error'>Food not Found.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
                die();
            }
        }
    } else {
        // Redirect to Manage Food
        header('location:'.SITEURL.'admin/manage_food.php');
        die();
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br/><br/>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo htmlspecialchars($description); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != ""){
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                            } else {
                                // Display message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                // Create PHP code to display categories from database
                                // 1. Create SQL to get all active categories
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                // Execute the Query
                                $res2 = mysqli_query($conn, $sql2);
                                
                                // Count rows to check whether we have categories or not
                                $count2 = mysqli_num_rows($res2);
                                
                                // If count is greater than zero, we have categories
                                if($count2 > 0){
                                    // We have categories
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        // Get the details of categories
                                        $cat_id = $row2['id'];
                                        $cat_title = $row2['title'];
                                        ?>
                                        <option <?php if($category_id == $cat_id){ echo "selected"; } ?> value="<?php echo $cat_id; ?>"><?php echo htmlspecialchars($cat_title); ?></option>
                                        <?php
                                    }
                                } else {
                                    // We do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){ echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured == "No"){ echo "checked"; } ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){ echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active == "No"){ echo "checked"; } ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 
                        <input type="submit" name="submit" value="Update Food" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category_id = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                // Update new image if selected
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    $image_name = $_FILES['image']['name']; // New Image Name
                    
                    // Check whether the file is available or not
                    if($image_name != ""){
                        // Image is available
                        // Rename the Image
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);

                        $image_name = "Food_Name_".rand(0000, 9999).'.'.$ext; // New Image Name

                        // Get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        // Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Check whether the image is uploaded or not
                        if($upload == false){
                            // Failed to upload the image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                            // Redirect to Manage Food
                            header('location:'.SITEURL.'admin/manage_food.php');
                            die();
                        }

                        // Remove the current image if available
                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not
                            if($remove == false){
                                // Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                // Redirect to Manage Food
                                header('location:'.SITEURL.'admin/manage_food.php');
                                die();
                            }
                        }
                    } 
                } else {
                    $image_name = $current_image;
                }
                
                // Update the food in database
                $sql3 = "UPDATE food_tbl SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category_id',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                
                // Execute the query
                $res3 = mysqli_query($conn, $sql3);
                
                // Check whether the query is executed or not
                if($res3 == true){
                    // Food updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                    die();
                } else {
                    // Failed to update food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                    die();
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

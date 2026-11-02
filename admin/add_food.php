<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>

        <br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                
                                
                                // Create SQL to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Execute query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have categories, else we do not have categories
                                if($count > 0){
                                    // We have categories
                                    while($row = mysqli_fetch_assoc($res)){
                                        // Get the details of the categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                } else {
                                    // We do not have categories
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the form is submitted
        if(isset($_POST['submit'])){
            // Retrieve the form data
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            
            // Check whether radio button for featured and active are checked or not
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; // Setting default value
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            } else {
                $active = "No"; // Setting default value
            }

            // Upload the image if selected
            // Check whether the select image is clicked or not and upload the image only if the image is selected  
            if(isset($_FILES['image']['name'])){
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];
                
                // Check whether the image is selected or not and upload image only if selected
                if($image_name != ""){
                    // Image is selected
                    // A. Rename the image
                    // Get the extension of the selected image (jpg, png, gif, etc.)
                    $image_info = explode(".", $image_name);
                    $ext = end($image_info);
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext; // New image name may be "Food-Name-657.jpg"

                    // B. Upload the image
                    // Get the src path and destination path

                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded
                    $dest = "../images/food/".$image_name;

                    // Ensure the destination directory exists
                    // Finally upload the food image
                    $upload = move_uploaded_file($src, $dest);

                    // Check whether image uploaded or not
                    if($upload == false){
                        // Failed to upload the image
                        // Redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        ob_start();
                        header('location:'.SITEURL.'admin/add_food.php');
                        ob_end_flush();
                        // Stop the process
                        die();
                    }
                }
            } else {
                $image_name = ""; // Setting default value as blank
            }

            // Insert into database
            // Create a SQL query to save or add food
            // For numerical we do not need to pass value inside quotes '' but for string value it is necessary
            $sql2 = "INSERT INTO food_tbl SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the data is inserted or not
            if($res2 == true){
                // Data is inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
                
            } else {
                // Failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
                header('location:'.SITEURL.'admin/add_food.php');
                
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    include('../config/constants.php'); // Include constants for SITEURL and database connection
    include('partials/login-check.php'); // Include login check to ensure user is logged in

    // Check whether id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        // Get the values and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != ""){
            // Image is available, so remove it
            $path = "../images/food/".$image_name;
            // Remove the image file from folder
            $remove = unlink($path);

            // Check whether the image is removed or not
            if($remove == false){
                // Failed to remove image
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
                // Redirect to manage food page
                header('location:'.SITEURL.'admin/manage_food.php');
                // Stop the process of deleting food
                die();
            }
        }

        // Delete food from database
        $sql = "DELETE FROM food_tbl WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully or not
        if($res == true){
            // Food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        } else {
            // Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }

    } else {
        // Redirect to manage food page
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
?>

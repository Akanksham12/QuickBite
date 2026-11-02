<?php
include('./config/constants.php');

//Check if the ID is set
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Update the order status to "Cancelled"
    $sql = "UPDATE order_tbl SET status='Cancelled' WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if($res){
        $_SESSION['order_message'] = "<div class='success'>Order Cancelled Successfully.</div>";
    } else {
        $_SESSION['order_message'] = "<div class='error'>Failed to Cancel Order. Try Again.</div>";
    }

    // Redirect back to the orders page
    header('location:'.SITEURL.'user_order.php');
} else {
    // Redirect to the orders page if the ID is not set
    header('location:'.SITEURL.'user_order.php');
}
?>

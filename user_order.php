<?php include('partials_front/menu.php');

// Fetch orders for the logged-in user
if(isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $sql = "SELECT * FROM order_tbl WHERE customer_email='$user_email'";
    $res = mysqli_query($conn, $sql);
} else {
    echo "User email not found in session.";
    exit; // Exit if user email is not set in session
}
?>

<html>
<head>
    <title>My Orders - Food Order System</title>
    
</head>
<body>
    <div class="categories text-center">
            <h1>My Orders</h1>
            <br><br>

            <?php
            if(isset($_SESSION['order_message'])){
                echo $_SESSION['order_message'];
                unset($_SESSION['order_message']);
            }
            ?>

            <div class="table-responsive">
                <table class="tbl_full">
                    <tr>
                        <th>S.No</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $sn = 1; 
                    if(isset($res) && mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td><?php echo $sn++;; ?></td>
                                <td><?php echo $row['food']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['order_date']; ?></td>
                                <td>
                                    <?php
                                    $status = $row['status'];
                                    if($status == "Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } else if($status == "On Delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } else if($status == "Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    } else {
                                        echo "<label>$status</label>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if($status == "On Delivery" || $status == "Ordered") { ?>
                                        <a href="<?php echo SITEURL; ?>cancel_order.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Cancel Order</a>
                                    <?php }
                                    else{
                                        echo "_";
                                    }  ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8" class="text-center">No orders found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <br><br>
            <p><a style="color: red;" href="index.php">Back to Home</a></p>
    </div>
</body>
</html>

<?php include('partials_front/footer.php'); ?>
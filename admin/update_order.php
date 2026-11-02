<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <?php 
            // Check whether the id is set or not
            if(isset($_GET['id'])){
                // Get the order details
                $id = $_GET['id'];

                // SQL Query to get the order details
                $sql = "SELECT * FROM order_tbl WHERE id=$id";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Check whether the query is executed or not
                if($res == true){
                    // Check whether the data is available or not
                    $count = mysqli_num_rows($res);

                    // Check whether we have order data or not
                    if($count == 1){
                        // Get the details
                        $row = mysqli_fetch_assoc($res);
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                    else{
                        // Redirect to manage order page
                        header('location:'.SITEURL.'admin/manage_order.php');
                    }
                }
            }
            else{
                // Redirect to manage order page
                header('location:'.SITEURL.'admin/manage_order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b>₹<?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <?php if($status == "Ordered"){ ?>
                                <option value="Ordered" selected>Ordered</option>
                                <option value="On Delivery">On Delivery</option>
                                <option value="Delivered">Delivered</option>
                            <?php } else if($status == "On Delivery"){ ?>
                                <option value="On Delivery" selected>On Delivery</option>
                                <option value="Delivered">Delivered</option>
                            <?php } else { ?>
                                <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr> 
                
            </table>
            <br>
            <?php if($status != "Delivered" && $status != "Cancelled"){ ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input style="padding:3px;" type="submit" name="submit" value="Update status" class="btn_secondary">
            <?php } ?>
        </form>

        <?php 
            // Check whether the Submit button is clicked or not
            if(isset($_POST['submit'])){
                // Get all the values from the form
                $id = $_POST['id'];
                $status = $_POST['status'];
                // SQL Query to update order
                $sql2 = "UPDATE order_tbl SET 
                    status = '$status'
                    WHERE id=$id
                ";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query is executed or not
                if($res2 == true){
                    // Query executed and order updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }
                else{
                    // Failed to update order
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

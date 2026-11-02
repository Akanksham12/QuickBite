<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ORDER</h1>
        
        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
        ?>
        <br><br>
        <div class="table-responsive">
            <table class="tbl_full">
                <tr>
                    <th>S.No</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php 
                // SQL query to get all orders
                $sql = "SELECT * FROM order_tbl ORDER BY id DESC";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count the rows
                $count = mysqli_num_rows($res);

                $sn = 1; // Create a serial number variable

                if($count > 0){
                    // Orders available
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
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
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td>₹<?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>₹<?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php
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
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <?php if($status != "Delivered" && $status != "Cancelled") { ?>
                                        <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn_secondary">Update Status</a>
                                <?php }
                                else{
                                    echo "_";
                                } ?>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // Orders not available
                    echo "<tr><td colspan='12' class='error'>Orders not available.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

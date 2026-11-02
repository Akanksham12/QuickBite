<?php 
include('partials/menu.php'); 
?>

<!--Main content starts-->
<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">DASHBOARD</h1>

        <br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo '<div class="alert success">'.$_SESSION['login'].'</div>';
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <?php
        // SQL query to select all categories
        $sql = "SELECT * FROM tbl_category";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        // Count the number of categories
        $category_count = mysqli_num_rows($res);
        ?>

        <div class="col-4 text-center">
            <h1 class="count"><?php echo $category_count; ?></h1>
            <br>
            <span class="description">Categories</span>
        </div>
        <!-- Fetch and display counts for other data such as foods, total orders, and revenue generated -->
        <div class="col-4 text-center">
            <?php
                $sql2 = "SELECT * FROM food_tbl";
                $res2 = mysqli_query($conn, $sql2);
                $food_count = mysqli_num_rows($res2);
            ?>
            <h1 class="count"><?php echo $food_count; ?></h1>
            <br>
            <span class="description">Foods</span>
        </div>
        <div class="col-4 text-center">
            <?php
                $sql3 = "SELECT * FROM order_tbl";
                $res3 = mysqli_query($conn, $sql3);
                $order_count = mysqli_num_rows($res3);
            ?>
            <h1 class="count"><?php echo $order_count; ?></h1>
            <br>
            <span class="description">Total Orders</span>
        </div>
        <div class="col-4 text-center">
            <?php
                $sql4 = "SELECT SUM(total) AS total_revenue FROM order_tbl WHERE status='Delivered'";
                $res4 = mysqli_query($conn, $sql4);
                $row = mysqli_fetch_assoc($res4);
                $total_revenue = $row['total_revenue'];
            ?>
            <h1 class="count"><?php echo $total_revenue; ?></h1>
            <br>
            <span class="description">Revenue Generated</span>
        </div>

        <div class="clearfix"></div>
    </div>  
</div>
<!--Main content end-->

<?php include('partials/footer.php')?>

<?php include('config/constants.php'); 
include('user_login_check.php');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="nav-container">
        <div class="logo">
            <a href="#" title="Logo">
                <img  style="height:60px; width:60px;" src="images/logo.jpeg" alt="Restaurant Logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>user_order.php">Orders</a>
                </li>
                <li style="  padding-left:45%;">
                    <a href="<?php echo SITEURL; ?>user_logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
 

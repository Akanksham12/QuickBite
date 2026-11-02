<?php
    //Authorization - access control
    //Check whetehr the user is logged in or not
    if(!isset($_SESSION['admin'])){  // if user seesion is not set
        //user is not logged in 
        //Redirect to login page with message
        $_SESSION['no_login_message']="<div class='error text-center'>Please login to access Admin panel.</div>";
        header("location:".SITEURL.'admin/login.php');

    }
?>
<?php
    //Authorization - access control
    //Check whetehr the user is logged in or not
    if(!isset($_SESSION['user'])){  // if user seesion is not set
        //user is not logged in 
        //Redirect to login page with message
        $_SESSION['no_login_message']="<div class='error text-center'>Please login to access user panel.</div>";
        header("location:".SITEURL.'user_login.php');

    }
?>
<?php
    //Include constant.php for SITEURL
    include('./config/constants.php');
    //1.Destroy the session
    unset($_SESSION['user_login']);  //Unset $_SESSION  ['admin']
    unset($_SESSION['login']);
    unset($_SESSION['signup']);
    unset($_SESSION['no_login_message']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user']);
    unset($_SESSION['order_message']);
    

    //2.Redirect to login page
    header('location:'.SITEURL.'user_login.php');
?>
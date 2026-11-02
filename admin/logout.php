<?php
    //Include constant.php for SITEURL
    include('../config/constants.php');
    //1.Destroy the session
    unset($_SESSION['add']);  //Unset $_SESSION  ['admin']
    unset($_SESSION['login']);
    unset($_SESSION['remove']);
    unset($_SESSION['upload']);
    unset($_SESSION['delete']);
    unset($_SESSION['update']);
    unset($_SESSION['user-not-found']);
    unset($_SESSION['pwd-not-match']);
    unset($_SESSION['change-pwd']);
    unset($_SESSION['no_login_message']);
    unset($_SESSION['admin']);
    unset($_SESSION['unauthorized']);
    unset($_SESSION['no-category-found']);
    
    

    //2.Redirect to login page
    header('location:'.SITEURL.'admin/login.php');


?>
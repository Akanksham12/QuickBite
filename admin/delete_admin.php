<?php
//Include constants.php file here
    include('../config/constants.php');
    //>1. get the Id of the admin to be deleted
     $id=$_GET['id'];
    //2. Create SqL Qeury to delete Admin
    $sql="Delete from admin_tbl where id=$id";
    //Execute the query
    $res=mysqli_query($conn,$sql);
    //Check whether the quey executed sucessfully or not 
    if($res=true)
    {
        //Query executes successfully and admin deleted
       // echo "Admin Deleted";
       //Create session variable to display message 
       $_SESSION['delete']='<div class="success">Admin Deleted successfully</div>';
       //Rediect to manage admin page
       header('location:'.SITEURL.'admin/manage_admin.php');
        
    }
    else{
        //Failed to delete admin
       // echo "failed to delete admin";
       $_SESSION['delete']='<div class="error">Failed to delete Admin</div>';
       header('location:'.SITEURL.'admin/manage_admin.php');
    }
    
    //3. Redirect to manage Admn page with message(success/error)


?>
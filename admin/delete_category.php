<?php 

    //Include constant file
    include('../config/constants.php');
    //echo "delete page";
    //Check whether the id and image_name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //GET the value and delete 
        //echo "Get value and delete :";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical image file if available
        if($image_name!=""){
            //Image is available. So remove it
            $path="../images/cateory/".$image_name;
            //Remove the image
            $remove=unlink($path);
            //If fail to remove image then add an error message and stop the process

            if($remove==false){
                //Set the session message 
                $_SESSION['remove']="<div class='error'>Failed to remove cstegory image.</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'admin/manage_category.php');
                //stop the process
                die();
            }
        }

        //Delete data from database
        //SQL query to dlete data from database
        $sql="DElete from tbl_category where id=$id";

        //EXecute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the data is deleted fromt he database or not
        if($res==TRUE){
            //Set success message 
            $_SESSION['delete']="<div class='success'>Category deleted successfully</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage_category.php');
        }
        else{
            //Set failed message and redirect
             $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
             //Redirect to manage category
             header('location:'.SITEURL.'admin/manage_category.php');

        }

        //Redirect to manage category page with message

    }
    else{
        //Redirect to mage category page
        header('location:'.SITEURL.'admin/manage_category.php');
    }
?>
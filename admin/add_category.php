<?php include('partials/menu.php'); ?>
<div class="mian_content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1>
        <br><br>

        <?php  
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){ // Corrected typo here
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!--Add category form starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add category form ends-->


        <?php 
            //Check whether the submit button is clicked or not 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get the value from Category Form
                $title=$_POST['title'];
                
                //For radio type , we need to check whether the button is selected or not 
                if(isset($_POST['featured'])){
                    //Get the value from form
                    $featured=$_POST['featured']; // Corrected variable name here
                }
                else{
                    //Set the default value
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    $active=$_POST['active'];
                }
                else{
                    $active="No";
                }

                //Check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);
                //die(); //Break the code here
                if(isset($_FILES['image']['name'])){ // Corrected syntax error here
                    //Upload the image
                    //To upload an image, we need image name, source path, and destination path
                    $image_name=$_FILES['image']['name'];

                    //Upload image if only image is selected
                    if($image_name!=""){

                    

                        //Auto Rename our Image
                        //Get the Extension of our image (jpeg,png,gif,etc) e.g. "special.food1.jpg"
                        $ext=end(explode('.',$image_name));

                        //Rename the image
                        $image_name="Food_category_".rand(000,999).'.'.$ext;  // e.g. Food_Category_834.jpg

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name; // Corrected concatenation operator here

                        //Finally upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded, then we will stop the process and redirect with an error message
                        if($upload==false){
                            //Set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";

                            //Redirect to Add category Page
                            header('location:'.SITEURL.'admin/add_category.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else{
                    //Don't upload image and set the image_name value as blank
                    $image_name="";
                }




                //Create sql query to insert category into the database
                $sql="INSERT INTO tbl_category SET
                     title='$title',
                     image_name='$image_name',
                     featured='$featured',
                     active='$active';
                    ";
                
                    //3. Execute the query and save it in the database
                    $res=mysqli_query($conn,$sql);
                    
                    //4. Check whether the query executes or not and data added or not

                    if($res==true){
                        //Query Executed and Category Added
                        $_SESSION['add']="<div class='success'>Category added successfully</div>";
                        
                        //Redirect to manage category page
                        header('location:'.SITEURL.'admin/manage_category.php');

                    }
                    else{
                        //Failed to add category

                        $_SESSION['add']="<div class='error'>Failed to add Category</div>";
                        
                        //Redirect to manage category page
                        header('location:'.SITEURL.'admin/add_category.php');

                    }
                }
        
        ?>
    </div>
</div>


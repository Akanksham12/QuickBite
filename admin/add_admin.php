<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN</h1>
        <br></br>
        <?php 
           if(isset($_SESSION['add'])){  // Checking whether the session is set or not 
            echo $_SESSION['add'];    //Display session message if set
            unset($_SESSION['add']);    //Remove Session Mesage
           }
           ?>
        <form action="" method="POST">
            <table class="tbl_30">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Your Pass"></td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn_secondary">
            </td>
            </tr>
            </table>
        </form> 
    </div>
</div>
        
<?php include('partials/footer.php'); ?>

<?php
//process the value from the frame and save it in the datbase 
//check whether the submit button is clicked or not 
if(isset($_POST['submit'])){
   //Button Clicked
    //echo "Button Clicked";

    // 1. get the data from the form
      $full_name=$_POST['full_name'];
      $username=$_POST['username'];
      $password=md5($_POST['password']);  //Password Encryption with MDS

    // 2. sql query to save the data into datbase
    $sql="INSERT INTO admin_tbl SET
            full_name='$full_name',
            username='$username',
            pswd='$password'
    ";

    // 3. Executing query and saving data into the database

    $res=mysqli_query($conn,$sql) or die(mysqli_error());

    // 4.check whether the (Query is Executed) data is inserted or not and display the appropriat message
    if($res==TRUE){
        //echo "Data is inserted";
        //Create a variable to display message
        $_SESSION['add']="Admin added sucessfully";
        //Redirect page to Manage admin
        header("location:".SITEURL.'admin/manage_admin.php');
    }
    else{
        //echo "Failed to insert data";
        //Create a variable to display message
        $_SESSION['add']="Failed to add Admin.";
        //Redirect page to Manage admin
        header("location:".SITEURL.'admin/add_admin.php');

    }


}

?>
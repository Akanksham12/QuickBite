<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br></br>
        <?php 
            // 1. Get the id of the  selected admin
            $id=$_GET['id'];  

            // 2. ceate sql Query to get the Deatils
            $sql="select * from admin_tbl where id=$id";

            // 3.Execute the query
            $res=mysqli_query($conn,$sql);
            
            //Check whether the query is executed or not 
            if($res==true){
               //Check whether the data is available or not
               $count=mysqli_num_rows($res);

               //Check whether we have admin data or not
               if($count==1){
                    //Get the details
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['username'];

               }
               else{
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }
        ?>
        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn_secondary">
                    </td>

            </table>
    </form>
    </div>
</div>

<?php
    //checkwhether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //Get all the values from form to update
         $id=$_POST['id'];
         $full_name=$_POST['full_name'];
         $username=$_POST['username'];

         //Create sql Query to update Admin
         $sql="Update admin_tbl SET
         full_name='$full_name',
         username='$username'
         where id='$id'
         ";
        
        //Execute the Query
    $res=mysqli_query($conn,$sql);

//Check whether the query executed successfully or not

if($res==true){
    //Query Executed and Admin updated
    $_SESSION['update']="<div class='success' >Admin Updated Successfully.";

    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage_admin.php');
}
else{
    //Failed to update Admin 
    $_SESSION['update']="<div class='error' >Failed to delete admin.";

    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage_admin.php');

}}
?>

<?php include('partials/footer.php'); ?>
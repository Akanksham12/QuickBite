<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body style="background-color: #eee;">
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no_login_message'])){
                echo $_SESSION['no_login_message'];
                unset($_SESSION['no_login_message']);
            }

            ?>
            <br><br>
            <!--login form starts here-->
            <form action="" method="POST" class="text-center">   
                <input style="width: 100%; padding: 8px 12px;" type="text" name="username" placeholder="Enter username"><br><br>
                <input style="width: 100%; padding: 8px 12px;" type="password" name="password" placeholder="Enter password"><br><br>
                <input style="width: 100%; padding: 8px 12px;" type="submit" name="submit" value="Log in" class="btn_primary">
                <br><br>
            </form>
            <!--login form ends here-->    
        </div>
    </body>
</html>

<?php
//Check whether button is clicked or not
if(isset($_POST['submit'])){
    //Process the login
    //Get the data from login form
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //2.SQL to check whether the user with username and password eists or not
    $sql="Select * from admin_tbl where username='$username' and pswd='$password'";
    //Execute the query
    $res=mysqli_query($conn,$sql);
    
    //4. Count the rows to check whether the user exists or not 
    $count=mysqli_num_rows($res);
    if($count==1){
        //User available and login success
        $_SESSION['login']="<div class='success'>Login successful.</div>";
        $_SESSION['admin']=$username; //To check wheteher the user is logged in or not and logout will unset or not
        //Redirect to HOME pge/Dashboard
        header('location:'.SITEURL.'admin/');
    }
    else{
        //User not available and login fail
        $_SESSION['login']="<div class='error text-center'>Username or password did not match.</div>";
        //Redirect to HOME pge/Dashboard
        header('location:'.SITEURL.'admin/login.php');

    }
}
?>
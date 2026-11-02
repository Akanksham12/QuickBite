<?php include('./config/constants.php'); ?>
<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body style="background-color: #eee;">
<div class="login">
    <h1 class="text-center">Login</h1>
    <br><br>
    <?php
    if(isset($_SESSION['user_login'])){
        echo $_SESSION['user_login'];
        unset($_SESSION['user_login']);
    }
    if(isset($_SESSION['signup'])){
        echo $_SESSION['signup'];
        unset($_SESSION['signup']);
    }

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
    <p>Don't have an account? </p><a href="sign_up.php">Sign up</a></p>
    
</div>
</body>
</html>

<?php
// Check whether button is clicked or not
if(isset($_POST['submit'])){
    // Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM user_tbl WHERE username='$username' AND password='$password'";
    // Execute the query
    $res = mysqli_query($conn, $sql);
    
    // Count the rows to check whether the user exists or not 
    $count = mysqli_num_rows($res);
    
    if($count == 1){
        $row = mysqli_fetch_assoc($res); // Fetch the user data
        $_SESSION['user_login'] = "<div class='success'>Login successful.</div>";
        $_SESSION['user'] = $username; // Username
        $_SESSION['user_email'] = $row['email']; // Store email in session
        header('location:'.SITEURL.'index.php');
        exit;
    } else {
        // User not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
        // Redirect back to login page
        header('location:'.SITEURL.'user_login.php');
        exit;
    }
}
?>

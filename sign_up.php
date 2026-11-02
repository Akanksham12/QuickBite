<?php include('./config/constants.php'); ?>
<html>
<head>
    <title>Sign Up - Food Order System</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body style="background-color: #eee;">
<div class="login">
    <h1 class="text-center">Sign Up</h1>
    <br><br>
    <?php
    if(isset($_SESSION['signup'])){
        echo $_SESSION['signup'];
        unset($_SESSION['signup']);
    }
    ?>
    <br><br>
    <!-- Sign up form starts here -->
    <form action="" method="POST" class="text-center">   
        <input style="width: 100%; padding: 8px 12px;" type="text" name="username" placeholder="Enter username" required><br><br>
        <input style="width: 100%; padding: 8px 12px;" type="email" name="email" placeholder="Enter email" required><br><br>
        <input style="width: 100%; padding: 8px 12px;" type="password" name="password" placeholder="Enter password" required><br><br>
        <input style="width: 100%; padding: 8px 12px;" type="password" name="confirm_password" placeholder="Confirm password" required><br><br>
        <input style="width: 100%; padding: 8px 12px;" type="submit" name="submit" value="Sign Up" class="btn_primary">
        <br><br>
    </form>
    <!-- Sign up form ends here -->
    <p>Already have an account? <a href="user_login.php">Login here</a></p>     
</body>
</html>

<?php
// Check whether button is clicked or not
if(isset($_POST['submit'])){
    // Get the data from sign up form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $confirm_password = $_POST['confirm_password']; 

    // Check if password and confirm password match
    if($password != $confirm_password){
        // Passwords do not match
        $_SESSION['signup'] = "<div class='error text-center'>Passwords do not match. Please try again.</div>";
        // Redirect back to sign up page
        header('location:'.SITEURL.'sign_up.php');
        exit;
    }

    // SQL to check if username or email already exists
    $check_sql = "SELECT * FROM user_tbl WHERE username='$username' OR email='$email'";
    $check_res = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_res) > 0){
        // Username or email already exists
        $_SESSION['signup'] = "<div class='error text-center'>Username or email already exists. Please try with a different one.</div>";
        // Redirect back to sign up page
        header('location:'.SITEURL.'sign_up.php');
        exit;
    } else {
        // Hash the password using md5
        $hashed_password = md5($password);

        // SQL to insert new user into database
        $sql = "INSERT INTO user_tbl (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        // Execute the query
        $res = mysqli_query($conn, $sql);

        if($res){
            // User registration successful
            $_SESSION['signup'] = "<div class='success'>Sign up successful. You can now login.</div>";
            // Redirect to login page
            header('location:'.SITEURL.'user_login.php');
            exit;
        } else {
            // User registration failed
            $_SESSION['signup'] = "<div class='error text-center'>Failed to sign up. Please try again.</div>";
            // Redirect back to sign up page
            header('location:'.SITEURL.'sign_up.php');
            exit;
        }
    }
}
?>

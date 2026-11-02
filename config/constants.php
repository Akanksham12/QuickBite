<?php
    ob_start();

    //Start the session
    session_start();
    //create constant to store non repeating value
    define('SITEURL','http://localhost/food_order/');
    define('DB_HOST','127.0.0.1');
    define('DB_PORT', 3307);
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food_order');
    // 3. Execute Query and save Data in database
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT) or die(mysqli_error());
?>
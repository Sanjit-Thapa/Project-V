<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "adminlogin_db";

    $conn = new mysqli($servername,$username,$password,$database);

    if($conn->connect_error)
    {
        die ("Error");
    }
    // else{
    //     echo "Connection success";
    // }
    
?>

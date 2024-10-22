<?php 
    require "connection.php";

    //setting up the email and password manually into the db
    $Email = "sandipthapa383@gmail.com";
    $password = "admin"; //this password should be hashed properly
    $img = "./Assets/Screenshot(99).png";

    //hashing the password using the password_hash method

    $hashed_Password = password_hash($password,PASSWORD_DEFAULT);//in here the password_default param usually uses the bcrypt method to hash the password


    $sql = "insert into adminlogin_tb (Email,Password,ImgDir) values (?,?,?)";

    //now prepare the statement and not executing the statement

    $stm = mysqli_prepare($conn,$sql);

    //binding the parameter where

    mysqli_stmt_bind_param($stm,'sss',$Email,$hashed_Password,$img);

    //now execution of the statement

    if(mysqli_stmt_execute($stm))
    {
        "<br>";
        echo "success...";
    }
    else{
        echo "failure to send the data";
    }

    

?>
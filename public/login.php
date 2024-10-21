<?php

require "connection.php";
print_r($_POST);
// Getting the email and password from the login form


if (isset($_POST['login'])) 
{
    $Emails = trim($_POST['email']);
$Passwords = trim($_POST['password']); // Plain text password input by user
    // Prepare the SQL statement to select user details based on the email
    $sql = "SELECT * FROM adminlogin_tb WHERE Email = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $Emails); // Bind the email parameter
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Check if the email exists and fetch the row
    if ($row = mysqli_fetch_assoc($result)) 
    {
        var_dump($row);
        // Debugging: Show the entered password and the hashed password from the DB
        echo "Entered password: " . $Passwords . "<br>";
        echo "Hashed password from DB: " . $row['Password'] . "<br>";

        // Verify the entered password against the hashed password in the database
        if (password_verify($Passwords, $row['Password'])) {
            // Password matches - login successful
            header("Location: index.php"); // Redirect to dashboard or homepage
            exit(); // Stop further execution
        } else {
            // Password does not match
            echo "Incorrect password.";
        }
    } 
    else {
        // Email does not exist in the database
        echo "Invalid email.";
    }
} 
else {
    // Handle case where the form was not submitted correctly
    echo "Error: Login form was not submitted properly.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-red-400">
    
    <div class=" bg-white flex justify-center items-center border-2 h-[100vh] ">
        <div class="formBody flex flex-col items-center border-2 border-red-200 min-w-[40vw] rounded-lg h-[55vh]">
            <div class="font-bold pt-2" >
                <h1 class="text-[2.5vw]">Admin Login</h1>
            </div>
                <form action="login.php" method="post" autocomplete="off" class="login flex flex-col  pt-4 gap-[1.8vw] text-[1.2vw]">

            <div class="relative">
                 <i class="fa-solid fa-user absolute left-2 top-2 flex items-center justify-center"></i>
                <input type="email" class="border-2 w-[25vw] h-[5vh] rounded-lg border-[#230B0B] pl-[2.2rem] pb-[0.2rem] hover:placeholder:text-red-950 hover:border-indigo-600 transition duration-200" placeholder="Email" name="email" id="email" required autocomplete="off">
            </div>

                    <div class="relative">
                        <i class="fa-solid fa-lock  absolute left-2 top-2 flex items-center justify-center"></i>
                        <input type="password" name="password" id="password" class="border-2 w-[25vw] h-[5vh]  rounded-lg border-[#230B0B] pl-[2.2rem] pb-[0.2rem] hover:placeholder:text-red-950 hover:border-indigo-600 transition duration-200" placeholder="Password" required>

                    </div>
                  
                    <div class="flex gap-5 justify-center pt-1 pl-5">
                        <input type="submit" value="Login" class="border-2 cursor-pointer w-[9vw] rounded-lg bg-black text-2xl hover:border-2 hover:border-[#4723DB] transition duration-200 font-bold hover:bg-indigo-900 text-white" name="login">
                 
                    </div>

                    <div class="flex items-center justify-center my-0.5">
                        <div class="border-t border-black flex-grow mr-1"></div>
                        <span class="text-black font-medium">or</span>
                        <div class="border-t border-black flex-grow ml-2"></div>
                    </div>
                    
                 </form>

                 <div class="flex gap-5 pl-5">
                    <a href="#" class=" hover:underline transition duration-200 pt-1 text-xl">Forgot Account?</a>
               
                </div>
        </div>
       
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let tl =gsap.timeline();
tl.from(".formBody",{
    opacity:0,
    y:-100,
    duration:2.9,
    ease:"elastic.out(1,0.5)"
})
    </script>
</body>
</html>
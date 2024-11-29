<?php
require "connection.php";

// inserting the data into the Artist database

if(isset($_POST['Signup'])){
    // Accessing All the inputs data from the form
    $ArtistName =  trim($_POST['username']);
    $ArtistEmail =  trim($_POST['ArtistEmail']);
    $ArtistPassword = trim( $_POST['ArtistPassword']);

    $hashedPassword = password_hash($ArtistPassword,PASSWORD_DEFAULT);

    //now creating the sql query
    $ArtistIns = "INSERT INTO artistsignup_tb (Username, Artistmail, ArtistPassword) VALUES (?, ?, ?);
";

    //preparing the statement

    $stmt = $conn->prepare($ArtistIns);

    //binding the input with the querry

    mysqli_stmt_bind_param($stmt,'sss',$ArtistName,$ArtistEmail,$hashedPassword);

    // Now execution of the statement
    if(mysqli_stmt_execute($stmt))
     {
        echo "inserted the Artist details";
     }
}


//updation of the password of the artist



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-gradient-to-br from-teal-200 via-blue-100 to-indigo-200 min-h-screen flex flex-col justify-center items-center text-white">

    <!-- Header Section with Catchy Tagline -->
    <div class="w-full bg-opacity-70 bg-indigo-800 py-5 text-center shadow-lg rounded-b-lg">
        <h1 class="text-3xl font-serif italic font-bold">Register Yourself</h1>
        <p class="text-md mt-1 italic">Unlock your creative potential and share your passion with the world!</p>
    </div>

    <!-- Signup Form Section -->
    <div class="bg-white flex justify-center items-center border-2 border-gray-300 h-full w-full md:max-w-lg p-6 mt-6 rounded-lg shadow-xl">
        <div class="formBody flex flex-col items-center w-full rounded-lg p-6">
            <div class="font-semibold pt-2 text-center text-gray-700">
                <h1 class="text-2xl md:text-3xl">Artist Signup</h1>
            </div>

            <!-- Form Starts Here -->
            <form action="ArtistSign.php" method="post" class="login flex flex-col pt-4 gap-6 w-full items-center">
                
                <!-- Username Field -->
                <div class="relative w-full">
                    <i class="fa-solid fa-user absolute left-3 top-4 text-gray-500"></i>
                    <input type="text" class="border-2 w-full h-12 rounded-lg pl-10 pr-4 border-gray-300 placeholder-gray-500 text-black focus:border-indigo-600 focus:outline-none transition duration-200" placeholder="Username" name="username" id="username" required>
                </div>

                <!-- Email Field -->
                <div class="relative w-full">
                    <i class="fa-solid fa-envelope absolute left-3 top-4 text-gray-500"></i>
                    <input type="email" class="border-2 w-full h-12 rounded-lg pl-10 pr-4 text-black  border-gray-300 placeholder-gray-500 focus:border-indigo-600 focus:outline-none transition duration-200" placeholder="Email" name="ArtistEmail" id="email" required>
                </div>

                <!-- Password Field -->
                <div class="relative w-full">
                    <i class="fa-solid fa-lock absolute left-3 top-4 text-gray-500"></i>
                    <input type="password" name="ArtistPassword" id="password" class="border-2 w-full h-12 rounded-lg pl-10 pr-4 border-gray-300 placeholder-gray-500 focus:border-indigo-600 focus:outline-none text-black  transition duration-200" placeholder="Password" required>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-center items-center text-center gap-4 w-full">
                    <button type="submit" name="Signup" class="w-full md:w-32 h-12 rounded-lg bg-indigo-600 text-white font-bold hover:bg-indigo-800 transition duration-200">Sign Up</button>
                    
                    <strong class="text-gray-500">OR</strong>

                    <button type="submit" name="ArtistLogin" class="w-full md:w-32 h-12 rounded-lg bg-gray-700 text-white font-bold hover:bg-gray-900 transition duration-200" onclick="window.location.href='ArtistLogin.php'" >Login</button>
                </div>        
            </form>
        </div>
    </div>

</body>
</html>
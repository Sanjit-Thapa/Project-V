<?php 
    require "connection.php";

 


    if (isset($_POST['submit'])) 
{
    $Email = $_POST['email'];
    $Password = $_POST['password']; // Plain text password input by user
    // Prepare the SQL statement to select user details based on the email
    $sql = "SELECT Username, Artistmail, ArtistPassword FROM artistsignup_tb WHERE Status = ?";
    $status = 'Approved';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $status); // Bind the email parameter
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Check if the email exists and fetch the row
    if ($row = mysqli_fetch_assoc($result)) 
    {
        var_dump($row);
        // Debugging: Show the entered password and the hashed password from the DB
        // echo "Entered password: " . $Passwords . "<br>";
        // echo "Hashed password from DB: " . $row['Password'] . "<br>";

        // Verify the entered password against the hashed password in the database
        if (password_verify($Password, $row['ArtistPassword'])) {
           
            $_SESSION['loggedin']=true;
           
            if($_SESSION['loggedin']===true)
            {   
                 // Password matches - login successful
            header("Location: index.php"); // Redirect to dashboard or homepage
            exit(); // Stop further execution
            }
           
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
    <title>Artist Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-br from-teal-200 via-blue-100 to-indigo-200">

    <!-- Catchy Header Section -->
    <div class="absolute top-0 w-full bg-gradient-to-r from-indigo-400 to-teal-400 py-5 text-center shadow-md">
        <h1 class="text-3xl font-bold text-white">Welcome Back, Creative Mind!</h1>
        <p class="text-white text-sm mt-1">Log in to explore, create, and share your art with the world.</p>
    </div>

    <!-- Glassmorphism Login Form Container -->
    <div class="glass-card w-full max-w-sm p-6 mt-32 rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Artist Login</h2>
        
        <!-- Form Starts Here -->
        <form action="ArtistLogin.php" method="POST" class="space-y-4">
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required 
                       class="w-full px-4 py-2 border rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-transparent">
            </div>
            
            <!-- Password Field -->
            <div>
                <label for="password" class="block text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required 
                       class="w-full px-4 py-2 border rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-transparent">
            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit" class="w-full bg-teal-500 text-white font-bold py-2 rounded-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:ring-opacity-50">
                Login
            </button>

            <!-- Additional Links -->
            <div class="flex justify-between text-sm mt-4">
                <a href="#" class="text-teal-500 font-semibold hover:text-teal-600">Forgot Password?</a>
                <a href="ArtistSign.php" class="text-teal-500 font-semibold hover:text-teal-600">New here? Sign Up</a>
            </div>
            
        </form>
    </div>

</body>

</body>
</html>
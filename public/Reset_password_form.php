<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gradient-to-r from-blue-100 to-blue-300 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md transform hover:scale-105 transition-all duration-300 ease-in-out">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-8 tracking-wide">Reset Your Password</h1>

        <form action="password_reset.php" method="post">
            <!-- Email Input -->
            <div class="mb-6">
                <label for="Email" class="block text-lg font-medium text-gray-700 mb-3">Enter Your Email</label>
                <input type="email" name="Email" id="Email" class="w-full p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out placeholder-gray-500" required placeholder="Enter Your Email">
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" name="reset" class="w-full bg-blue-600 text-white p-4 rounded-lg text-xl font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">Reset Password</button>
            </div>
        </form>

        <!-- Optional footer text -->
        <div class="text-center mt-6 text-sm text-gray-600">
            <p>Remembered your password? <a href="login.php" class="text-blue-600 hover:text-blue-700 font-medium">Login</a></p>
        </div>
    </div>

</body>

</html>

<?php
    require "../connection.php";

    $token = $_GET["token"];//take the token from the query string

    $token_hash = hash("sha256",$token);

    $sql = "select * from artistsignup_tb where token_hash = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$token_hash);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if($user===null){
        die("token not found");
    }

    //to check if the token has expired or not

    if(strtotime(($user["token_expires"])<=time())){
        die("token has expired please proceed to apply for the reset to change");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center text-green-500 mb-6">Reset Password</h1>

        <form method="post" action="artist_reset_password.php" onsubmit="return validatePassword()">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>" class="hidden">

            <!-- New Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Repeat Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            </div>

            <!-- Password Validation Warnings -->
            <div id="passwordWarnings" class="text-sm text-red-600 mb-4 hidden">
                <ul id="warningsList"></ul>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-green-500 text-white p-3 rounded-md text-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Submit</button>
            </div>
        </form>
    </div>

    <script src="ValidatePassword.js"></script>

</body>
</html>








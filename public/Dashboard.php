<?php 

    

    //for the Artist

    function Artist()
    {
        require "connection.php";   
        $sql = "SELECT COUNT(*) AS total FROM artistsignup_tb where status = ? ";
        $approved = "Approved";

        //preparing the statement

        $stm = $conn->prepare($sql);
        
        //binding of the statement
        $stm->bind_param('s',$approved);

        $stm->execute();

        // Getting the result
        $result = $stm->get_result();

        // Fetching the row
        if ($result) {
            $row = $result->fetch_assoc();
            $total = $row['total']; // Access the count
            echo  $total;
        } else {
            echo "Error: ";
        }

        // Closing the statement and connection
        $stm->close();
        $conn->close();

}

    function Reserved()
    {
        require "connection.php";   
        $sql = "SELECT COUNT(*) AS total FROM userdetail_tb  ";


        //preparing the statement

        $stm = $conn->prepare($sql);
        
        

        $stm->execute();

        // Getting the result
        $result = $stm->get_result();

        // Fetching the row
        if ($result) {
            $row = $result->fetch_assoc();
            $total = $row['total']; // Access the count
            echo  $total;
        } else {
            echo "Error: ";
        }

        // Closing the statement and connection
        $stm->close();
        $conn->close();
    }

    function Listed()
    {
        require "connection.php";   
        $sql = "SELECT COUNT(*) AS total FROM artistview_tb where Listed = ?  ";

        $listed = "Yes";


        $stm = $conn->prepare($sql);
        
        //binding of the statement
        $stm->bind_param('s',$listed);

        $stm->execute();

        // Getting the result
        $result = $stm->get_result();

        // Fetching the row
        if ($result) {
            $row = $result->fetch_assoc();
            $total = $row['total']; // Access the count
            echo  $total;
        } else {
            echo "Error: ";
        }

        // Closing the statement and connection
        $stm->close();
        $conn->close();
    }

?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-5">
    <div class="w-full max-w-6xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Dashboard</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Total Artists -->
            <div class="p-8 text-center rounded-xl shadow-lg bg-gradient-to-r from-blue-500 to-indigo-500 text-white 
                        hover:scale-105 hover:shadow-2xl transition-transform duration-300 ease-in-out">
                <h2 class="text-2xl font-semibold">Total Artists</h2>
                <p class="text-5xl font-bold mt-6"><?php Artist(); ?></p>
            </div>

            <!-- Total Reserved Products -->
            <div class="p-8 text-center rounded-xl shadow-lg bg-gradient-to-r from-green-400 to-teal-500 text-white 
                        hover:scale-105 hover:shadow-2xl transition-transform duration-300 ease-in-out">
                <h2 class="text-2xl font-semibold">Total Products Reserved</h2>
                <p class="text-5xl font-bold mt-6"><?php Reserved(); ?></p>
            </div>

            <!-- Total Listed Pictures -->
            <div class="p-8 text-center rounded-xl shadow-lg bg-gradient-to-r from-pink-500 to-red-500 text-white 
                        hover:scale-105 hover:shadow-2xl transition-transform duration-300 ease-in-out">
                <h2 class="text-2xl font-semibold">Total Listed Pictures</h2>
                <p class="text-5xl font-bold mt-6"><?php Listed(); ?></p>
            </div>
        </div>
    </div>
</body>

</html>
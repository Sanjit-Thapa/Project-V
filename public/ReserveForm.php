<?php

    require "connection.php";

    if(isset($_POST['Reserve'])){

        $ArtId =  $_POST['Artid'];
        echo $ArtId;
    }
    else{
        echo "not clicked";
    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="">
    
    <div class="min-h-screen flex items-center justify-center bg-[#e8c67d5b]">
        <div class="bg-white border-2  p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Contact Details</h1>
            <form action="ReserveForm.php" method="post" class="flex flex-col items-center gap-5">
                
                <!-- Name Input -->
                <input 
                    type="text" 
                    name="Fullname" 
                    id="Fname" 
                    placeholder="Enter Name" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                >
    
                <!-- Email Input -->
                <input 
                    type="email" 
                    name="Email" 
                    id="Email" 
                    placeholder="Enter Email" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                >
    
                <!-- Phone Number Input -->
                <input 
                    type="tel" 
                    name="number" 
                    id="num" 
                    placeholder="Phone Number" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                >
    
                <!-- Textarea -->
                <textarea 
                    name="askUs" 
                    id="ask" 
                    placeholder="Enquire" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 py-2 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                ></textarea>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="bg-indigo-500 text-white font-semibold py-2 px-6 rounded-md transition duration-200 hover:bg-indigo-600 hover:shadow-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
    
    
    
</body>
</html>
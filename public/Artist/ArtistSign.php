<?php

echo "hell";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist</title>
    <link rel="stylesheet" href="/public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-red-500 stroke-white">
    <!-- top level of the Artist Signup -->
     <div class="bg-indigo-400">
        <h1 class="text-3xl p-2 font-serif italic text-slate-900 ">Register Yourself</h1>
     </div>
        <!-- SignUp Page For the Artist  -->
        <div class=" bg-white flex justify-center items-center border-2 h-[100vh] ">
            <div class="formBody flex flex-col items-center border-2 shadow-md min-w-[40vw] rounded-lg h-[55vh]">
                <div class="font-medium pt-2" >
                    <h1 class="text-[2vw]">Artist Signup</h1>
                </div>
             <form action="ArtistSign.php" method="post" class="login flex flex-col  pt-4 gap-[1.8vw] text-[1.2vw] items-center">
    
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-2 top-3 flex items-center justify-center"></i>
                   <input type="text" class="border-2 w-[25vw] h-[6vh] rounded-lg border-[#230B0B] pl-[2.2rem] pb-[0.2rem] hover:placeholder:text-red-950 hover:border-indigo-600 transition duration-200" placeholder="Username" name="username" id="username" required>
               </div>

                <div class="relative">
                    
                     <i class="fa-solid fa-envelope absolute left-2 top-3 flex items-center justify-center"></i>
                    <input type="email" class="border-2 w-[25vw] h-[6vh] rounded-lg border-[#230B0B] pl-[2.2rem] pb-[0.2rem] hover:placeholder:text-red-950 hover:border-indigo-600 transition duration-200" placeholder="Email" name="ArtistEmail" id="email" required>
                </div>
    
                        <div class="relative">
                            <i class="fa-solid fa-lock  absolute left-2 top-3 flex items-center justify-center"></i>
                            <input type="password" name="ArtistPassword" id="password" class="border-2 w-[25vw] h-[6vh]  rounded-lg border-[#230B0B] pl-[2.2rem] pb-[0.2rem] hover:placeholder:text-red-950 hover:border-indigo-600 transition duration-200" placeholder="Password" required>
    
                        </div>
                        <div class="flex justify-center items-center text-center gap-5">
                            <div class="flex flex-col items-center gap-2">
                                <input type="submit" value="Sign Up" class="border-2 cursor-pointer w-[9vw] rounded-lg bg-black text-2xl hover:border-2 hover:border-[#4723DB] transition duration-200 font-bold hover:bg-indigo-900 h-[6vh] text-white" name="Signup">
                            </div>
                            
                            <strong class="text-center ">OR</strong>
                            
                            <div class="flex flex-col items-center gap-2">
                                <input type="submit" value="Login" class="border-2 cursor-pointer w-[9vw] rounded-lg bg-black text-2xl h-[6vh] hover:border-2 hover:border-[#4723DB] transition duration-200 font-bold hover:bg-indigo-900 text-white" name="ArtistLogin">
                            </div>
                        </div>
                        
                        
                        
                     </form>
    
            </div>
           
        </div>
</body>
</html>
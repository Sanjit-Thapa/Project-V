
<?php 
    // include "connection.php";

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];

        if($page=='setting')
        {
           $pageinclude =  "register.php";

        }
    }
        if($page=='display'){
            $pageinclude = "login.php";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="">
    <!-- header section -->
    <div class="bg-blue-900 flex items-center justify-between">
        <h1 class="text-slate-300 text-[1.8vw] p-1 font-semibold pl-3">Art Gallery</h1>
        <a href="https://www.facebook.com">
            <img src="Assets/62021a.jpg" alt="admin" class="w-16 h-14 pr-2 rounded-full ">
        </a>
    </div>


   
    <!-- side bar section -->
    <div class="flex">
        <div class="w-[17%] h-[93vh]  bg-blue-900 " id="menu">
            <!-- Buttons in the sidebar -->
            <button class="fa-solid fa-bars text-[1.8vw] text-white p-2 hover:text-[#3b1066] transition ease-in-out delay-10 cursor bg-gradient-to-r from-blue-800 via-cyan-700 to-teal-500  w-full" id="burgerBtn">
            </button>
            
            <div class="flex flex-col justify-start items-start  "> 
                <div class="m-3">
                   <a href="https://www.facebook.com"> <button class="fa-solid fa-chart-simple text-[1.8vw] text-white p-3  hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5">
                   </button></a> <label for="dashboard" class= "label text-white text-2xl pl-4 cursor-pointer hover:text-sky-400" ><a href="#">Dashboard</a></label>
                </div>
             
            <div class="m-3">
                 <a href="#"> <button class="fa-brands fa-telegram text-[1.8vw] text-white p-3  hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5">
                 </button></a>
                 <label for="enquiry"  class="label text-white text-2xl pl-4 cursor-pointer hover:text-sky-400 "><a href="#">Enquiry</a></label>
            </div>
            
            <div class="m-3 ">
                  
                 <a href="#"><button class="fa-solid fa-calendar-days text-[1.8vw] text-white p-3 hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5"></button></a>   
                 <label for="schedule" class="label text-white text-2xl cursor-pointer pl-4 hover:text-sky-400 "><a href="#">Events</a></label>
            </div>
    
            <div class="m-3 ">
            <a href="#"><button class="fa-solid fa-palette text-[1.8vw] text-white p-3  hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5">
            </button></a> <label for="artist" class="label text-white text-2xl pl-4 cursor-pointer hover:text-sky-400 "><a href="#">Artist</a></label>
            </div>
    
            <div class="m-3 ">
                <a href="#"><button class="fa-solid fa-table-cells text-[1.8vw] text-white p-3 hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5"></button></a> 
                <label for="Art" class="label text-white text-2xl pl-4 cursor-pointer hover:text-sky-400  "><a href="?page=display">Display</a></label>
            </div>
             
            <div class="m-3">
            <a href="#"><button class="fa-solid fa-gear text-[1.8vw] text-white p-3 hover:text-[#a3aebe] transition ease-in-out delay-10 cursor  pt-5"></button></a>
           
            
             <label for="Setting" class="label text-white text-2xl pl-4 cursor-pointer hover:text-sky-400"><a href="?page=setting">Setting</a></label>
    
            </div>
    
            </div>
        </div>
            <!--Right side of the screen -->

        <div class=" border-2 border-red-500 w-full">
            <!-- including the php file -->

            <?php include $pageinclude ?>
        </div>
    </div>
   


   

    <script src="dashboard.js"></script>
</body>
</html>


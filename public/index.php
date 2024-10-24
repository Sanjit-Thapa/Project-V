
<?php 
    include "connection.php";

   
    // $sql = "SELECT ImgDir FROM adminlogin_tb WHERE Email = ?";

    // mysqli_prepare($conn,$sql);

    // mysqli_bind_param($sql,'s',)
    

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];

        if($page=='setting')
        {
           $pageinclude =  "setting.php";
           
        }
        elseif($page=='display'){
            $pageinclude = "login.php";
        }
    }
   else{
    // $pageinclude = "";//make this as the dashboard part whenever the user visits they firstly see this part //work to be done
   }
    

   //for extracting the image into the profile of the admin
   $sql = "select Email,ImgDir from adminlogin_tb";

   $result = $conn->query($sql);

   if($row=mysqli_fetch_assoc($result))
   {
      $mail = $row['Email'];
       $url = $row['ImgDir'];
   }
   else{
       echo "umm";
   }


   //for the updation of the profile picture
   
   if (isset($_FILES['reimg'])) {
    // Get the uploaded file information
    $fileTmpName = $_FILES['reimg']['tmp_name'];  // Temporary file path
    $fileName = $_FILES['reimg']['name'];         // Original file name
    $fileDestination = 'uploads/' . $fileName;    // Destination folder

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        // Update the database with the new image path
        $imgupd = "UPDATE adminlogin_tb SET ImgDir = '$fileDestination' WHERE ImgDir = '$url'";
        $res = $conn->query($imgupd);

        if ($res) {
            echo "Profile picture updated successfully.";
        } else {
            echo "Error updating the database.";
        }
    } else {
        echo "Failed to upload the image.";
    }
} else {
    echo "No file was uploaded.";
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
        <a href="?page=" id="profile">
                <img src="<?php echo $url ?>" alt="admin" class="w-16 h-14 pr-2 rounded-full text-red-200" >
            
        </a>

    
    </div>


    <!-- Profile card options -->
    <div id="profileCard" class="absolute right-0 mt-4 w-[20vw] bg-white shadow-lg rounded-lg p-4 ">
        <!-- Profile picture and email section -->
        <div class="flex flex-col items-center justify-center">
          <img src="<?php echo $url ?>" alt="admin" class="w-12 h-12 rounded-full border-2 border-gray-300"> <!-- Circular profile picture -->
          <p class="text-[1rem] text-gray-600 pt-1"><?php echo $mail ?></p>
        </div>
        
        <!-- Horizontal line divider -->
        <hr class="my-3">
        <!-- <i class="fa-solid fa-person-running"></i> -->
        
        <!-- Options section -->
        <ul class="flex flex-col space-y-2 items-center">
            <li class="py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md text-center flex items-center justify-center space-x-2 w-full cursor-pointer">
                <a href="?page=">
                    <button class="fa-solid fa-images pr-2"></button>
                    <span>Change Profile</span>
                </a>
            
              </li>
              <li class="py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md text-center flex items-center justify-center space-x-2 w-full cursor-pointer">
                <a href="https://www.facebook.com">
                    <button class="fa-solid fa-person-running pr-2 " ></button>
                    <span>Sign Out</span>
                </a>
            
              </li>
            
        </ul>
      </div>

      <!-- changing the profile picture -->
       
      <div class="flex justify-center shadow-lg rounded-lg ">
    <div class="border-2 border-red-00 bg-white w-[25vw] h-[60vh] absolute rounded-lg">
        <div>
            <button class="text-2xl font-bold text-blue-400"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <hr class="opacity-1">
        <h1 class="text-2xl mt-1 pr-1 text-center">Profile Picture</h1>
        <p class="text-center">You can change your profile picture here.</p>
        <div class="flex justify-center item-center pt-4 text-green-400">
            <img src="<?php echo $url ?>" alt="profile" class="w-52 h-52 rounded-full">
        </div>

        <!-- Form for file upload -->
        <form action="" method="POST" enctype="multipart/form-data" class="flex items-center justify-center mt-3">
            <!-- The button for changing the profile photo -->
            <label for="reimg" class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
              Change Profile Photo
            </label>

            <!-- Hidden file input -->
            <input type="file" name="reimg" id="reimg" accept="image/*" class="hidden">

            <!-- Submit button -->
            <button type="submit" name="submit" class="ml-3 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
              Upload
            </button>
        </form>
    </div>
</div>

        

    <!-- side bar section -->
    <div class="flex">
        <div class="w-[17%] h-[100vh]  bg-blue-900 " id="menu">
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

        <div class=" border-2 border-red-500 w-full h-[100vh]">
            <!-- including the php file -->

            <?php include $pageinclude ?>

        </div>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>


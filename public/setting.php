<!-- <?php 
    include "connection.php";
    



?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="">
    <div class="flex flex-col items-center text-center text-indigo-800 font-medium justify-center ">   
        <h1 class="text-[2vw]">Change Your Password</h1>
        <form action="" method="post">
            <div class="border-red-500  border-2 flex flex-col  items-center mt-2 w-[35vw] h-[35vh] p-5 rounded-lg text-[1.2vw]">
                <input type="password" name="new" id="newPass" placeholder="Enter New Password" class="border-black border-[2px] w-[20vw] h-[5.4vh] placeholder:text-black placeholder:font-mono rounded-[0.235rem] hover:border-blue-500 mt-1" required>
                <input type="password" name="renew" id="renewPass" placeholder="Re-Enter Password" class="border-black border-2 w-[20vw] h-[5vh] placeholder:text-black placeholder:font-mono mt-4 rounded-[0.235rem] hover:border-blue-500" required>
                
                <label for="message" class="text-red-600 text-[1rem] font-medium font-mono mt-2 pl-1 hidden">PASSWORD ERROR</label>
    
                <button type="submit" name="update" class="border-2 w-[8vw] mt-2 border-black font-mono font-thin bg-black text-white h-[4.7vh] hover:bg-indigo-600 rounded-[0.2375rem]">Update</button>
        </form>
        


            


        </div>
        
    </form> 

    </div>  
</body>
</html>
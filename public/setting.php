<?php 
    require "connection.php";


    if(isset($_POST['update'])){

                
        $sql = "select Password from adminlogin_tb";

        $result = $conn->query($sql);

        if($row = mysqli_fetch_assoc($result)){
            $PreviousPassword =  $row['Password'];
        }

        $newPassword = trim($_POST['new']);
        $RePassword = trim($_POST['renew']);

        if($newPassword===$RePassword)
        {
            $hashed = password_hash($RePassword,PASSWORD_DEFAULT);

            $sqlupd = "update adminlogin_tb set Password = '$hashed' where Password = '$PreviousPassword'";

            $res = $conn->query($sqlupd);

            if($res == true )
            {
                echo "password updated successfully";
            }
            else{
               echo "something missing huh...";
            }

        }
        else{
            $msg= "PASSWORD ERROR";
        }

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
<body class="">
    <div class="flex flex-col items-center text-center text-indigo-800 font-medium">   
        <h1 class="text-[2vw] relative pb-4 w-full after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-black fixed top-0">
            Change Your Password
        </h1>
    
        <form action="setting.php" method="post" class="w-full flex justify-center items-top min-h-screen">
            <div class="border-red-500 border-2 flex flex-col items-center mt-2 w-[35vw] h-[35vh] p-5 rounded-lg text-[1.2vw]">
                <input type="password" name="new" id="newPass" placeholder="Enter New Password" class="border-black border-[2px] w-[20vw] h-[5.4vh] placeholder:text-black placeholder:font-mono rounded-[0.235rem] hover:border-blue-500 mt-1" required>
                <input type="password" name="renew" id="renewPass" placeholder="Re-Enter Password" class="border-black border-2 w-[20vw] h-[5vh] placeholder:text-black placeholder:font-mono mt-4 rounded-[0.235rem] hover:border-blue-500 " required>
                
                <label for="message" class="text-red-600 text-[1rem] font-medium font-mono mt-2 pl-1 "><?php 
                    global $msg;
                    echo $msg ?></label>
    
                <button type="submit" name="update" class="border-2 w-[8vw] mt-2 border-black font-mono font-thin bg-black text-white h-[4.7vh] hover:bg-indigo-600 rounded-[0.2375rem]">
                    Update
                </button>
            </div>
        </form>
    </div>
    
    </div>
    
</body>
</html>
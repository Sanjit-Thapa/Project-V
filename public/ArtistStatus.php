<?php 
    require "connection.php";

 

    if(isset($_POST['Reject']))
    {
        echo "Rejected";
    }
    else{
        echo "hmm";
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
<body>

        <table class="border-2 w-full text-center mt-1 p-2 ">
            <thead class="border-2" >
                <tr class="border-2 text-indigo-800 text-[1.2vw]">
                    <th>Artist Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Decide</th>
                </tr>
            </thead>
        
          
            <?php

        if ($result) {
            $sqlget = "select Artist_id,Username,Artistmail,Status from artistsignup_tb";

            $result = $conn->query($sqlget);
            // Loop through each row and output data in table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form action='ArtistStatus.php' method = 'POST' >";
                echo "<tr class='border-2 p-2 hover:bg-gray-200' >";
                echo "<td>" . $row['Artist_id'] . "</td>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td>" . $row['Artistmail'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "<td class='p-3'>
                <button name='Reject' class='border-2 font-semibold hover:bg-red-700 hover:text-white 
            rounded-full bg-red-500 text-white w-[6vw] h-[5vh] transition duration-300 ease-in-out'>
                Reject
             </button>

                 <button name='Accept' class='ml-4 border-2 font-semibold hover:bg-green-700 hover:text-white 
                    rounded-full bg-green-500 text-white w-[6vw] h-[5vh] transition duration-300 ease-in-out'>
                      Accept
                 </button>
</td>
"; // Example button in the "Decide" column
                echo "</tr>";
                echo "</form>";
            }
        } else {
            echo "<tr><td colspan='5'>Data is not fetched</td></tr>";
        }
        ?>
            </tbody>
        </table>

    
</body>
</html>
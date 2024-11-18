<?php
    require "connection.php";

    //updation of the Listed sites 

    if(isset($_POST['Yes'])||isset($_POST['No']))
    {
        $id = $_POST['Artid'];
        $listed = $_POST['Yes']?$_POST['Yes']:$_POST['No'];

        //updation of the Listed
        $sqlUpd = "UPDATE artistview_tb
        SET Listed = ? WHERE ArtId = ?";
    
        //preparing the statement
       $stm = $conn->prepare($sqlUpd);

       //binding the parameter
       $stm->bind_param('si',$listed,$id);

       //execution of the querry
       if($stm->execute()===true)
       {
        echo "Updation successfull";
       }
       else{
        echo "Updation is not successfull";
       }

    }
    else{
        echo "The Action button is not pressed";
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
    
<div class="text-center">
    <h1 class="text-slate-800 font-semibold text-[1rem] mb-2">Art Selection</h1>
    <div class="overflow-x-auto">
        <table class="w-full max-w-full mx-auto border-collapse border rounded-lg overflow-hidden shadow-lg">
            <thead>
                <tr class="bg-slate-700">
                <th class="p-1 text-sm border border-slate-600 text-white">Art ID</th>
                    <th class="p-1 text-sm border border-slate-600 text-white">Artist ID</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Art Title</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Description</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Art Form</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Image</th>
                   
                    <th class="p-2 text-sm border border-slate-600 text-white">Listed</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require "connection.php";
                $sqlget = "SELECT ArtId,ArtistId, ArtTitle, Description, ArtForm, ImgPath, Listed FROM artistview_tb where status=?";

                $stats = 'Approved';

                //prepare the statement
                $stm = $conn->prepare($sqlget);

                //binding of the statement
                $stm->bind_param('s',$stats);
                
                //execution of the statement
                 

                if ($stm->execute()) {
                    $result = $stm->get_result();

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='ArtSelect.php' method='POST'>";
                        echo "<tr class='border-b hover:bg-gray-100'>";

                        // ArtId
                               echo "<td class=' text-center border border-slate-600'>
                               <input type='number' name='Artid' value='{$row['ArtId']}' readonly class='bg-transparent text-center w-full'>
                             </td>";
                        // ArtistId
                        echo "<td class=' text-center border border-slate-600'>
                                <input type='number' name='id' value='{$row['ArtistId']}' readonly class='bg-transparent text-center w-full'>
                              </td>";

                        // Art Title, Description, Art Form
                        echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtTitle']) . "</td>";
                        echo "<td class='p-1 text-sm border border-slate-600 break-words max-w-xs overflow-hidden h-16'>" . htmlspecialchars($row['Description']) . "</td>"; // Smaller height
                        echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtForm']) . "</td>";

                        // Image
                        echo "<td class='p-2 flex justify-center border border-slate-600'>
                                <div class='w-24 h-auto md:w-32 lg:w-40'>
                                    <img src='" . htmlspecialchars($row['ImgPath']) . "' alt='Artwork Image' class='rounded-lg object-cover'>
                                </div>
                              </td>";

                        // Listed
                        echo "<td class='p-2 text-center border border-slate-600'>" 
                        
                        . htmlspecialchars($row['Listed']) . "</td>";

                        // Remarks (Text area for input)
                        // echo "<td class='p-2 border border-slate-600'>
                        //         <textarea  name='Remarks' class='w-full h-16 border rounded-md p-1 text-sm' placeholder='Enter remarks...' require!>" . htmlspecialchars($row['Remarks']) . "</textarea>
                        //       </td>";

                        // Action buttons (Centered)
                        echo "<td class=' text-center space-x-2 border border-slate-600 '>
                                <button type='submit' name='No' value='No' class='px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition mb-2'>No</button>
                                
                                <button type='submit' name='Yes' value='Yes' class='px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition'>Yes</button>
                              </td>";

                        echo "</tr>";
                        echo "</form>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center p-4'>Data is not fetched</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
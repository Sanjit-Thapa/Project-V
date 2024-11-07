<?php
    require "connection.php";

    if(isset($_POST['Reject'])||isset($_POST['Approve']))
    {
        $Decision =isset($_POST['Reject'])? trim($_POST['Reject']):trim($_POST['Approve']);
        
        $artid = $_POST['Artid'];

        $idnum = $_POST['id'];

        $Remark = trim($_POST['Remarks']);

        echo $Decision;

        //updation of the Arts
        
        $sqlUpdate = "UPDATE artistview_tb SET Status = ?, Remarks = ? WHERE ArtistId = ? AND ArtId = ?"
 ;

        $stm = $conn->prepare($sqlUpdate);
    
        $result = $stm->bind_param('ssii', $Decision,$Remark, $idnum,$artid);

        if($stm->execute()===true){
            echo "Updation success";
            echo $Decision;
        }
        else{
            echo "statement couldnt be updated";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="text-center">
    <h1 class="text-slate-800 font-semibold text-[1rem] mb-2">Art Status</h1>
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
                    <th class="p-2 text-sm border border-slate-600 text-white">Status</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Remarks</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require "connection.php";
                $sqlget = "SELECT ArtId,ArtistId, ArtTitle, Description, ArtForm, ImgPath, Status, Remarks FROM artistview_tb";
                $result = $conn->query($sqlget);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='Artstatus.php' method='POST'>";
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

                        // Status
                        echo "<td class='p-2 text-center border border-slate-600'>" 
                        
                        . htmlspecialchars($row['Status']) . "</td>";

                        // Remarks (Text area for input)
                        echo "<td class='p-2 border border-slate-600'>
                                <textarea  name='Remarks' class='w-full h-16 border rounded-md p-1 text-sm' placeholder='Enter remarks...' require!>" . htmlspecialchars($row['Remarks']) . "</textarea>
                              </td>";

                        // Action buttons (Centered)
                        echo "<td class=' text-center space-x-2 border border-slate-600 '>
                                <button type='submit' name='Reject' value='Rejected' class='px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition mb-2'>Reject</button>
                                
                                <button type='submit' name='Approve' value='Approved' class='px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition'>Approve</button>
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